<?php

namespace Modules\Role\Http\Controllers;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use App\Traits\WriteException;
use Modules\Role\Entities\Module;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\Role\Http\Requests\RoleRequest;
use Illuminate\Contracts\Support\Renderable;


class RoleController extends Controller
{
    use  WriteException;

    public $paginationLength;
    public $model;
    public $viewDirectory = 'role::role';
    public $route = 'roles';
    public $dataName = 'Role';

    public function __construct(Role $model){
        $this->paginationLength = \config('constants.pagination_length');
        $this->model = $model;

        // $this->middleware('can:read-'.strtolower($this->dataName), ['only' => ['index','show']]);
        // $this->middleware('can:create-'.strtolower($this->dataName), ['only' => ['create','store']]);
        // $this->middleware('can:edit-'.strtolower($this->dataName), ['only' => ['edit', 'update']]);
        $this->middleware('role:super-admin|admin', ['only' => ['create','store','edit', 'update']]);
       
    }

    public function index(Request $request)
    {
        $req = $request->all();
        $roles = $this->model->whereNotIn('name', [RoleEnum::SUPERADMIN, RoleEnum::PARTICIPANT])->paginate($this->paginationLength);
        return view($this->viewDirectory.'.index',compact('roles','req'));
    }

    public function create(Request $request)
    {
        $permissions = Permission::get();

        return view($this->viewDirectory.'.create',compact('permissions'));
    }

    public function store(RoleRequest $request)
    {


        try {

            \DB::beginTransaction();

            $role = $this->model->create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));

            \DB::commit();
            
            return redirect()->route($this->route.'.index')->with('success', 'Role created');
        } catch (\Exception $exception) {
            \DB::rollback();

            $this->writeExceptionMessage($exception);
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function edit(Request $request,$id)
    {
        
    
       
        $role = $this->model->find($id);
        $permissions = Permission::get();
        $rolePermissions = \DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view($this->viewDirectory.'.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(RoleRequest $request,$id)
    {
        try {
            
            \DB::beginTransaction();

            $role = $this->model->find($id);
            $role->name = $request->input('name');
            $role->save();

            $role->syncPermissions($request->input('permission'));
            \DB::commit();

            return redirect()->route($this->route.'.index')->with('success', 'Role updated');
        } catch (\Exception $exception) {
            \DB::rollback();

            $this->writeExceptionMessage($exception);

            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }

    }
}
