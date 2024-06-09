@extends('layouts.main')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Division') }}</div>

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


                    <form action="{{route('division.update', $division->id)}}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        <!-- @method('put') -->
                        @csrf
                        <div class="form-row">
                            <div class="position-relative form-group col-4">
                                <label for="name">Name</label>
                                <input name="name" value="{{old('name') ?? $division->name}}" id="name"
                                    placeholder="Please Enter Name" type="text" readonly class="form-control">
                            </div>
                            <div class="position-relative form-group col-4">
                                <label for="msisdn">Short Name</label>
                                <input name="msisdn" value="{{old('msisdn') ?? $division->short_name}}" id="msisdn"
                                    placeholder="Please Enter Short Name" type="text" readonly class="form-control">
                            </div>
                            <div class="position-relative form-group col-4">
                                <label for="email">Start Time</label>
                                <input type="date" class="form-control-sm form-control" name="start_time" id="start_time" placeholder="Select start date" value="{{old('start_time') ?? $division->start_time}}">

                            </div>

                            <div class="position-relative form-group col-4">
                                <label for="email">End Time</label>
                                <input type="date" class="form-control-sm form-control" name="end_time" id="end_time" placeholder="Select start date" value="{{old('end_time') ?? $division->end_time}}">
                            </div>
                        </div>
                       
                        <div class="form-row">
                            <div class="position-relative form-group col-6">
                                <label for="image">Status</label>

                                <div class="custom-radio custom-control">
                                    <input type="radio" id="active" value="1" {{$division->status == 1 ? 'checked' : ''}} name="status"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="active">Active</label>
                                </div>
                                <div class="custom-radio custom-control">
                                    <input type="radio" id="inactive" value="0"  {{$division->status == 0 ? 'checked' : ''}} name="status"
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
