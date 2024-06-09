@extends('layouts.main')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Send SMS') }}</div>
                @if (session('status'))
                <div class="alert alert-success m-2" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success m-2" role="alert">
                    {{ session('success') }}
                </div>
                @endif

            @if ($errors->any())
            <div class="alert alert-danger m-2">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                <div class="card-body">
                    <div class="card-body">
                        
                    <form action="{{route('sms.send.apply')}}" method="post" autocomplete="off"
                        enctype="multipart/form-data">

                        @csrf
                        <div class="form-row">
                            <div class="position-relative form-group col-4">
                                <label for="zone">Divisions</label>
                                <select name="zone" id="zone" class="custom-select" >
                                <option value=""></option>
                                   @foreach($divisions as $division)
									<option value="{{$division->name}}">{{$division->name_bn}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>

                    
                        <div class="form-row" id="file_div">
                            <div class="position-relative form-group col-6">
                                <label for="file">File</label>
                                <input name="file" value="{{old('file') ?? ''}}" id="file"
                                    placeholder="Please Enter Designation" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" type="file" class="form-control-file" >
                            </div>
                            <div class="position-relative form-group col-6 m-auto">
                                <a href="{{asset('files/sample/sample-file.xlsx')}}" class="mb-2 mr-2 btn btn-link active text-bold m-auto">   <i class="fa fa-arrow-down"></i> Download Sample File</a>
                            </div>

                        </div>
                    
                        <div class="form-row">
                            <div class="position-relative form-group col-6">
                                <label for="sms_body">SMS Body</label>
                                <textarea class="form-control" rows="5" name="sms_body" placeholder="Hello, [name]. Good Morning!" required>{{old('body') ?? ''}}</textarea>
                            </div>

                        </div>
                   
                        <div class="divider"></div>
                        <div class="clearfix">
                            {{-- <button type="submit" class="btn-shadow float-right btn-wide mr-3 btn btn-info">Submit</button> --}}

                            <button type="submit"
                                class="ladda-button float-right mb-2 mr-2 btn-shadow btn btn-outline-primary"
                                data-style="zoom-out">
                                <span class="ladda-label">Submit
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


@push('script')
    <link rel="STYLESHEET" type="text/css" href="{{asset('bootstrap/css/bootstrap-datetimepicker.css')}}" />
    <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap-datetimepicker.min.js')}}"></script>
    <link rel="STYLESHEET" type="text/css" href="{{asset('bootstrap/css/datepicker.css')}}"/>
    <script type="text/javascript" src="{{asset('bootstrap/js/datepicker.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-dropdown-datepicker@1.3.0/dist/jquery-dropdown-datepicker.min.js"></script>
    <script>
         $(document).ready(function () {
                    $('#zone').on('click', function () {
                        $('#file_div').hide();
                    });
                });
    </script>
@endpush

