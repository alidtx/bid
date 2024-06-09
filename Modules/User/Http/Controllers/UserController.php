<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use App\Traits\WriteException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Requests\UserRequest;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\UpdatePasswordRequest;


class UserController extends Controller
{

  use  WriteException;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $paginationLength;
    public $model;
    public $viewDirectory = 'user::user';
    public $route = 'users';
    public $dataName = 'User';

    public function __construct(User $model){
        $this->paginationLength = \config('constants.pagination_length');
        $this->model = $model;

        // $this->middleware('can:read-'.strtolower($this->dataName), ['only' => ['index','show']]);
        // $this->middleware('can:create-'.strtolower($this->dataName), ['only' => ['create','store']]);
        // $this->middleware('can:edit-'.strtolower($this->dataName), ['only' => ['edit', 'update']]);

        $this->middleware('role:super-admin|admin|admin', ['only' => ['create','store', 'edit','update']]);
    }


    public function index(Request $request)
    {
      
     
        $users = $this->model;
        $roles = Role::whereNotIn('name', [RoleEnum::SUPERADMIN, RoleEnum::PARTICIPANT])->select(['id', 'name'])->get();

        // if ( !Auth::user()->hasAnyRole([RoleEnum::SUPERADMIN, RoleEnum::ADMIN])) {
        //   $ids = allChildIds( Auth::user()->id);
        //   $users = $users->whereIn('id', \explode(',', $ids[0]->id));
        // }
        
        $users = $users->where('id', '!=', 1)->latest()->paginate($this->paginationLength);
        return view($this->viewDirectory.'.index', compact('users', 'request', 'roles'));
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', [RoleEnum::SUPERADMIN, RoleEnum::PARTICIPANT])->get();

        return view($this->viewDirectory.'.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        try {
          DB::beginTransaction();

          if ($request->filled('password') && $request->filled('password_confirmation')) {
            $request->merge(['password' => Hash::make($request->password)]);
          }
          $data = $this->model->create($request->except(['role_id', 'location_id', 'password_confirmation', '_token']));

          $user = $data;

          $role = Role::find($request->role_id);

          $user->assignRole($role->name);

          DB::commit();

          if ($data) {
            return \redirect()->route($this->route.'.index')->with('success', $this->dataName.' Added Successfully!');
         }

        } catch (\Exception $exception) {
          DB::rollback();

          $this->writeExceptionMessage($exception);
            return \redirect()->back()->with('error', $this->dataName.' Can Not Be Added!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = $this->model->findOrFail($id);
        $roles = Role::whereNotIn('name', [RoleEnum::SUPERADMIN, RoleEnum::PARTICIPANT])->get();
        return view($this->viewDirectory.'.edit', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->model->findOrFail($id);


        try {
            DB::beginTransaction();

            if (!$request->filled('password') && !$request->filled('password_confirmation')) {
              $request->merge(['password' => $user->password]);
            }

            if ($request->filled('password') && $request->filled('password_confirmation')) {
              $request->merge(['password' => Hash::make($request->password)]);
            }

            $data = $user->update($request->except(['role_id', 'location_id', 'password_confirmation', '_token']));

            $user->roles()->detach();

            $role = Role::find($request->role_id);
  
            $user->assignRole($role->name);
  
            DB::commit(); 
            if ($data) {
              return \redirect()->route($this->route.'.index')->with('success', $this->dataName.' Updated Successfully!');
           }

          } catch (\Exception $exception) {
            DB::rollback();

            $this->writeExceptionMessage($exception);

            return \redirect()->back()->with('error', $this->dataName.' Can Not Be Updated!');

          }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


  
    public function changePassword()
    {

        return view($this->viewDirectory.'.change-password');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {

        try {
            DB::beginTransaction();

            $data = $this->model->find(auth()->user()->id)->update(['password'=> $request->new_password]);

            DB::commit();

            if ($data) {
              return \redirect()->back()->with('success', 'Password Updated Successfully!');
           }

          } catch (\Exception $exception) {
            DB::rollback();

            $this->writeExceptionMessage($exception);

            return \redirect()->back()->with('error', 'Password Update failed!');

          }
    }
}
