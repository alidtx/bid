@extends('layouts.main')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Doctor') }}</div>

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


                    <form action="{{route('doctor.update', $doctor->id)}}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="position-relative form-group col-4">
                                <label for="name">Name</label>
                                <input name="name" value="{{old('name') ?? $doctor->name}}" id="name"
                                    placeholder="Please Enter Name" type="text" required class="form-control">
                            </div>
                            <div class="position-relative form-group col-4">
                                <label for="msisdn">Phone Number</label>
                                <input name="msisdn" value="{{old('msisdn') ?? $doctor->msisdn}}" id="msisdn"
                                    placeholder="Please Enter Phone Number" type="text" required class="form-control">
                            </div>
                            <div class="position-relative form-group col-4">
                                <label for="email">Email</label>
                                <input name="email" value="{{old('email') ?? $doctor->email}}" id="email"
                                    placeholder="Please Enter Email" type="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="position-relative form-group col-6">
                                <label for="designation">Designation</label>
                                <input name="designation" value="{{old('designation') ?? $doctor->designation}}"
                                    id="designation" placeholder="Please Enter Designation" type="text"
                                    class="form-control">
                            </div>
                            <div class="position-relative form-group col-6">
                                <label for="address">Address</label>
                                <input name="address" value="{{old('address') ?? $doctor->address}}" id="address"
                                    placeholder="Please Enter address" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="position-relative form-group col-6">
                                <label for="image">Image</label>
                                <input name="image" id="image" placeholder="Please Enter Designation" type="file"
                                    class="form-control-file">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="position-relative form-group col-6">
                                <label for="image">Gender</label>

                                <div class="custom-radio custom-control">
                                    <input type="radio" id="male" value="MALE" {{$doctor->gender == 'MALE' ? 'checked' : ''}} name="gender"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="male">Male</label>
                                </div>
                                <div class="custom-radio custom-control">
                                    <input type="radio" id="female" value="FEMALE" {{$doctor->gender == 'FEMALE' ? 'checked' : ''}} name="gender"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="female">Female</label>
                                </div>

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="position-relative form-group col-6">
                                <label for="image">Status</label>

                                <div class="custom-radio custom-control">
                                    <input type="radio" id="active" value="1" {{$doctor->status == 1 ? 'checked' : ''}} name="status"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="active">Active</label>
                                </div>
                                <div class="custom-radio custom-control">
                                    <input type="radio" id="inactive" value="0"  {{$doctor->status == 0 ? 'checked' : ''}} name="status"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="inactive">Inactive</label>
                                </div>

                            </div>
                        </div>



                        <div class="divider"></div>
                        <div class="clearfix">
                            {{-- <button type="submit" class="btn-shadow float-right btn-wide mr-3 btn btn-info">Submit</button> --}}

                            <button type="submit"
                                class="ladda-button float-right mb-2 mr-2 btn-shadow btn btn-outline-primary"
                                data-style="zoom-out">
                                <span class="ladda-label">Update
                                </span>

                                <span class="ladda-spinner">
                                </span>
                                <div class="ladda-progress" style="width: 0px;"></div>
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
