@extends('layouts.main')

@section('title','Role List')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    Role List
                </div>
                <div class="btn-actions-pane-right">
                    <div class="btn-group">
                        @hasanyrole(\App\Enums\RoleEnum::SUPERADMIN.'|'.\App\Enums\RoleEnum::ADMIN)
                            <a href="{{route('roles.create')}}" class="btn btn-sm px-3 btn-primary mr-2"><i class="fa fa-plus"></i>
                                <span>Create Role</span></a>
                        @endhasanyrole
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
           
                    <div class="table-responsive">
                    <table class="mb-0 table table-striped">
                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Guard</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rowCount = 0;
                            @endphp
                            @forelse ($roles as $role)
                            <tr>
                                <td>{{++$rowCount}}</td>
                                <td><span>{{$role->name}}</span></td>
                                <td><span>{{$role->guard_name}}</span></td>
                                
                                 @hasanyrole(\App\Enums\RoleEnum::SUPERADMIN.'|'.\App\Enums\RoleEnum::ADMIN)
                                <td>
                                    <a type="button" href="{{route('roles.edit', $role->id)}}" class="btn btn-sm btn-outline-info mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                </td>
                                @endhasanyrole 
                         

                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No Roles Found</td>
                            </tr>
                            @endforelse
                            
                            
                        </tbody>
                    </table>
                </div>

          

          
                    {{ $roles->appends(request()->input())->links('vendor.pagination.theme') }}
           
               
            </div>
        </div>
    </div>
</div>
@endsection
