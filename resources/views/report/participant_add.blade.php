@extends('layouts.main')
@section('title', "")

@section('content')
    

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-warning" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <form class="form-horizontal" role="form" method="post" action="{{ route('participant.register') }}" enctype="multipart/form-data">
        <input type="hidden" name="registration_type" value="{{ auth()->user()->getRoleNames()[0] }}">
        <!-- <input type="hidden" name="created_by" value="{{ auth()->user()->id }}"> -->
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="header">
                        <div class="col-lg-8">
                        <center><h2>নিবন্ধন ফর্ম</h2></center>
                        </div>
                    </div>
                    <div class="body">
                        <input type="hidden" name="registration_lang" id="registration_lang">
                        <!-- <div class="form-group">
                            <label for="inputPassword1" class="col-lg-4 control-label registration_type">Registration Type</label>
                            
                        </div> -->
                        <div class="form-group">
                            <label for="name" class="col-lg-4 control-label name">অংশগ্রহণকারীর নাম</label>
                            <div class="col-lg-8">
                                <input type="text" name="name" class="form-control name" id="name" placeholder="অংশগ্রহণকারীর নাম" value="{{old('name')}}">
                                @error('name')
                                <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="col-lg-4 control-label phone_number">মোবাইল</label>
                            <div class="col-lg-8">
                                <input type="text" name="phone_number" id="phone_number" class="form-control phone_number" placeholder="মোবাইল" value="{{old('phone_number')}}">
                                @error('phone')
                                <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
  
                        <div class="form-group">
                            <label for="age" class="col-lg-4 control-label age">বয়স</label>
                            <div class="col-lg-8">
                            <select name="age" id="age" class="form-control input-lg">
                                     <option value=""></option>
									<option value="10">১০</option>
									<option value="11">১১</option>
									<option value="12">১২</option>
									<option value="13">১৩</option>
									<option value="14">১৪</option>
									<option value="15">১৫</option>
									<option value="16">১৬</option>
									<option value="17">১৭</option>
									<option value="18">১৮</option>
									<option value="19">১৯</option>
									<option value="20">২০</option>
							</select>
                                @error('age')
                                <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="class" class="col-lg-4 control-label age">শ্রেণি</label>
                            <div class="col-lg-8">
                            <select name="class" id="class" class="form-control input-lg">
                            <option value=""> শ্রেণি নির্বাচন </option>
									<option value="6">ষষ্ঠ</option>
									<option value="7">সপ্তম</option>
									<option value="8">অষ্টম</option>
									<option value="9">নবম</option>
									<option value="10">দশম</option>
							</select>
                            @error('class')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group bd">

                            <label for="zone" class="col-lg-4 control-label Choosewhereyouwanttoaudition">বিভাগ</label>
                            <div class="col-lg-8">
                                <select id="zone" class="form-control " name="zone">
                                <option value=""> বিভাগ/অঞ্চল  নির্বাচন</option>
                                    @foreach($divisions as $division)
									<option value="{{$division->name}}">{{$division->name_bn}}</option>
                                    @endforeach
                                </select>
                                @error('zone')
                                <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="ladda-button btn btn-primary btn-lg col-lg-8 save">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@push('script')
    <link rel="STYLESHEET" type="text/css" href="{{asset('bootstrap/css/bootstrap-datetimepicker.css')}}" />
    <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap-datetimepicker.min.js')}}"></script>
    <link rel="STYLESHEET" type="text/css" href="{{asset('bootstrap/css/datepicker.css')}}"/>
    <script type="text/javascript" src="{{asset('bootstrap/js/datepicker.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-dropdown-datepicker@1.3.0/dist/jquery-dropdown-datepicker.min.js"></script>
    <script>
        $('input[type=radio][name=reg_type]').change(function () {
            if (this.value == 'INSIDE_BANGLADESH') {

                $('.bd').show();
                $('.outsideBd').hide();
            } else if (this.value == 'OUTSIDE_BANGLADESH') {
                $('.bd').hide();
                $('.outsideBd').show();
            }
        });

        $(document).ready(function () {
            $("#dob").dropdownDatepicker({
                dropdownClass: 'custom-drorpdown date-dropdown',
                minYear: '1970',
                maxYear: '2020',
                daySuffixValues: ['', '', '', ''],
                onChange: function(day, month, year){
                    if (day && month  && year) {
                        let date = new Date(year+'-'+month+'-'+day);
                        var age = GetAge(date);
                        $('#age').val(age);

                    }
                }
            });

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                minDate : '2015-01-01'
            }).on('changeDate', function (ev) {
                var age = GetAge(ev.date);
                $('#age').val(age)
            });


            function GetAge(birthDate) {
                var today = new Date();
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }

            let oldRegType = "{{old('reg_type')}}";

            if (oldRegType == 'INSIDE_BANGLADESH') {

                $('.bd').show();
                $('.outsideBd').hide();
            } else if (oldRegType == 'OUTSIDE_BANGLADESH') {
                $('.bd').hide();
                $('.outsideBd').show();
            } else {

                $('.bd').show();
                $('.outsideBd').hide();
            }
        });
    </script>
@endpush

