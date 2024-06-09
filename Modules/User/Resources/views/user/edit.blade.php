@extends('layouts.main')
@section('title', "User Edit")

@section('content')


<form id="basic-form"  action="{{route('users.update', $user->id)}}" method="POST" >
    @csrf
    @method('put')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    User Edit
                </div>
            </div>
            <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label for="name">Name</label>

                            <input type="text" id="name" value="{{old('name') ?? ($user->name ?? '')}}"
                                class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name"
                                placeholder="Enter Name" required>

                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="email">Email</label>
                            <input type="email" id="email" value="{{old('email') ?? ($user->email ?? '')}}"
                                class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email"
                                placeholder="Enter Email" required>

                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                    @role(\App\Enums\RoleEnum::SUPERADMIN)

                        <div class="col-md-6 mb-2">
                            <label for="password">Password</label>
                            <input type="password" id="password"
                                class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                                name="password" placeholder="Enter Password">

                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-2">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" class="form-control "
                                name="password_confirmation" placeholder="Enter Confirm Password">
                        </div>

                    @endrole

                        <div class="col-md-6 mb-2">
                            <label for="msisdn">Mobile Number</label>
                            <input type="text" id="msisdn" value="{{old('msisdn') ?? ($user->msisdn ?? '')}}"
                                class="form-control {{$errors->has('msisdn') ? 'is-invalid' : ''}}" name="msisdn"
                                placeholder="Enter Mobile Number" >

                            @error('msisdn')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-2">
                            <label for="status">Status</label>

                            <select id="status" name="status" required
                                class="form-control {{$errors->has('status') ? 'is-invalid' : ''}} show-tick ms select2"
                                data-placeholder="Select Status">
                                <option> Select status </option>
                                <option value="1" {{$user->status == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{$user->status == 0 ? 'selected' : ''}}> Inactive </option>
                            </select>

                            @error('status')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-2">
                            <label for="role_id">Roles</label>

                            <select id="role_id" name="role_id" required
                                class="form-control {{$errors->has('role_id') ? 'is-invalid' : ''}} show-tick ms select2"
                                data-placeholder="Select Role">
                                <option> Select role </option>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}" {{$user->getRoleNames()[0] == $role->name ? 'selected' : ''}}>{{$role->name}}</option>
                                @endforeach
                               
                                </option>
                            </select>

                            @error('role_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
            </div>

            <div class="card-footer">
                <div class="btn-actions-pane-right">
                    <div class="btn-group">
                        @hasanyrole(\App\Enums\RoleEnum::SUPERADMIN.'|'.\App\Enums\RoleEnum::ADMIN)
                        <button class="ladda-button btn btn-primary btn-lg" data-style="zoom-out" type="submit">
                            <span class="ladda-label">Submit
                            </span>

                            <span class="ladda-spinner">
                            </span>
                            <div class="ladda-progress" style="width: 0px;"></div>
                        </button>
                        @endhasanyrole
                    </div>
                </div>
            </div>
        </div>

  
    </div>  
</div>
</form>

@endsection