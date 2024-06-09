@extends('layouts.main')
@section('title', "User Create")

@section('content')

{{-- <x-block-header title="Create User" /> --}}

<form id="basic-form" action="{{route('users.store')}}" method="post" autocomplete="off">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        User Create
                    </div>
                </div>
                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
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
                    <div class="form-row">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label for="name">Name</label>
                                <input type="text" id="name" value="{{old('name') ?? ''}}"
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
                                <input type="email" id="email" value="{{old('email') ?? ''}}"
                                    class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email"
                                    placeholder="Enter Email" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="password">Password</label>
                                <input type="password" id="password"
                                    class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                                    name="password" placeholder="Enter Password" required>

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

                            <div class="col-md-6 mb-2">
                                <label for="msisdn">Mobile Number</label>
                                <input type="text" id="msisdn" value="{{old('msisdn') ?? ''}}"
                                    class="form-control {{$errors->has('msisdn') ? 'is-invalid' : ''}}" name="msisdn"
                                    placeholder="Enter Mobile Number">

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
                                    <option value="1" value="{{old('status') == '1' ? 'selected' : ''}}">Active</option>
                                    <option value="0" value="{{old('status') == '0' ? 'selected' : ''}}">Inactive
                                    </option>
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
                                    <option value="{{$role->id}}" {{old('role_id') == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
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

            {{-- <div class="card">
            <div class="card-body">
                @livewire('select-role')
            </div>
        </div> --}}
        </div>
    </div>

</form>
@endsection
