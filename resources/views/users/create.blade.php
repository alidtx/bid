@extends('layouts.app')
@section('title', "User Create")

@section('content')

<x-block-header title="Create User" />

<form id="basic-form" action="{{route('users.store')}}" method="post" autocomplete="off">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>User Form</h2>
            </div>
            <div class="body">
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
                                <label for="gender">Gender</label>
                                <div class="fancy-radio">
                                    <label><input name="gender" value="MALE" data-key="0" type="radio"
                                            {{old('gender') == 'MALE' ? 'checked' : ''}}
                                            data-parsley-errors-container="#error-radio"><span><i></i>MALE</span></label>
                                </div>

                                <div class="fancy-radio">
                                    <label><input name="gender" value="FEMALE" data-key="1" type="radio"
                                            {{old('gender') == 'FEMALE' ? 'checked' : ''}}
                                            data-parsley-errors-container="#error-radio"><span><i></i>FEMALE</span></label>
                                </div>

                                @error('gender')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="msisdn">Mobile Number</label>
                                <input type="text" id="msisdn" value="{{old('msisdn') ?? ''}}"
                                    class="form-control {{$errors->has('msisdn') ? 'is-invalid' : ''}}" name="msisdn"
                                    placeholder="Enter Mobile Number" required>

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
                                <label for="address">Address</label>
                                <textarea class="form-control {{$errors->has('status') ? 'is-invalid' : ''}}" rows="5"
                                    cols="30" name="address" placeholder="Enter Address"
                                    required>{{old('address') ?? ''}}</textarea>

                                @error('address')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @livewire('select-role')
            
            </div>
        </div>
    </div>
</div>

</form>
@endsection
