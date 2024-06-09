@extends('layouts.app')
@section('title', "Change Password")

@section('content')

<x-block-header title="Change Password" />


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Password Form</h2>
            </div>
            <div class="body">
                <form id="basic-form"  action="{{route('update.password')}}" method="post"
                    novalidate autocomplete="off">
                   
                        @csrf

                        <div class="form-row">

                            <div class="col-md-6 mb-2">
                                <label for="current_password">Cuttent Password</label>

                                <input type="password" id="current_password" value="{{old('current_password') ?? ''}}"
                                    class="form-control {{$errors->has('current_password') ? 'is-invalid' : ''}}"
                                    name="current_password" placeholder="Enter Cuttent Password" required>

                                @error('current_password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label for="new_password">New Password</label>

                                <input type="password" id="new_password" 
                                    class="form-control {{$errors->has('new_password') ? 'is-invalid' : ''}}"
                                    name="new_password" placeholder="Enter New Password" required>

                                @error('new_password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label for="confirm_new_password">Confirm New Password</label>

                                <input type="password" id="confirm_new_password"
                                   
                                    class="form-control {{$errors->has('confirm_new_password') ? 'is-invalid' : ''}}"
                                    name="confirm_new_password" placeholder="Confirm New Password" required>

                                @error('confirm_new_password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    

                    <div class="col-md-12 p-0 mt-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
