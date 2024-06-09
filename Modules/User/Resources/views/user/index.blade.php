@extends('layouts.main')
@section('title', "User List")


@section('content')



<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">

                <div class="card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        User List
                    </div>
                    <div class="btn-actions-pane-right">
                        <div class="btn-group">
                            @hasanyrole(\App\Enums\RoleEnum::SUPERADMIN.'|'.\App\Enums\RoleEnum::ADMIN)
                                <a href="{{route('users.create')}}" class="btn btn-sm px-3 btn-primary mr-2"><i class="fa fa-plus"></i>
                                    <span>Create User</span></a>
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
                    <table class="mb-0 table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Role</th>
                                {{-- <th>Status</th> --}}
                                @hasanyrole(\App\Enums\RoleEnum::SUPERADMIN.'|'.\App\Enums\RoleEnum::ADMIN)
                                <th>Action</th>
                                @endhasanyrole
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rowCount = 0;
                            @endphp
                            @forelse ($users as $user)
                            <tr>
                                <td>{{++$rowCount}}</td>
                                <td><span>{{$user->name}}</span></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->msisdn}}</td>
                                <td>{{$user->getRoleNames()->first()}}</td>
                                {{-- <td>{{$user->status}}</td> --}}
                                @hasanyrole(\App\Enums\RoleEnum::SUPERADMIN.'|'.\App\Enums\RoleEnum::ADMIN)
                                <td>
                                    <a type="button" href="{{route('users.edit', $user->id)}}" class="btn btn-sm btn-outline-info mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                    {{-- <button type="button" data-type="confirm" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete"><i class="fa fa-trash-o"></i></button> --}}
                                </td>
                                @endhasanyrole
                         

                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No Users Found</td>
                            </tr>
                            @endforelse
                            
                            
                        </tbody>
                    </table>
                </div>

          

          
                    {{ $users->appends(request()->input())->links('vendor.pagination.theme') }}
           
         
        </div>
    </div>
</div>

@endsection
