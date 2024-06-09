<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>বাংলাবিদ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" type="image/x-icon"
        href="http://www.magicbauliana.com/wp-content/uploads/2013/07/fav_Bawliana_Logo.png"> -->
    <script type="text/javascript" src="{{asset('bootstrap/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <link rel="STYLESHEET" type="text/css" href="{{asset('bootstrap/css/bootstap_icon.css')}}" />
    <link rel="STYLESHEET" type="text/css" href="{{asset('bootstrap/css/bootstrap.css')}}" />
    <link rel="STYLESHEET" type="text/css" href="{{asset('bootstrap/css/bootstrap-datetimepicker.css')}}" />
    <link rel="STYLESHEET" type="text/css" href="{{asset('bootstrap/css/bootstrap-theme.css')}}" />
    <link rel="STYLESHEET" type="text/css" href="{{asset('css/style.css')}}" />
    <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap-datetimepicker.min.js')}}"></script>
    <link rel="STYLESHEET" type="text/css" href="{{asset('bootstrap/css/datepicker.css')}}" />
    <script type="text/javascript" src="{{asset('bootstrap/js/datepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap/js/css3-mediaqueries.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-dropdown-datepicker@1.3.0/dist/jquery-dropdown-datepicker.min.js">
    </script>
    <style>
        .date-dropdowns {
            display: flex
        }

        .date-dropdown {
            width: 25% !important;
            margin-right: 5px;
        }

    </style>
</head>

<body class="custom-background">
    <div class="wrapper">
        <div class="container">
            <div class="row">                
            </div>


            <!-- Example row of columns -->
            <div class="row" >
                <div class="col-md-offset-1 col-lg-10">
                    <div class="center"><img src="img/Banglabid.png" style="height: 250px;width: auto;" /></div>

                    {{-- @if(!session('success') && !session('error'))
                    <div class="registration" style="max-width: unset !important">
                        <h2 class="ml">অংশগ্রহণের জন্য আবেদনপত্র</h2>

                    </div>
                    @endif --}}
                    @if(session('success'))

                    <div style="    display: flex;
                     justify-content: center;
                      align-content: center;
                      align-items: center;">
                    <h2 class="registration modal-bn" style="max-width: 60% !important">অভিনন্দন, আপনার নিবন্ধন সফল হয়েছে। চোখ রাখুন banglabid.com –এ।</h2>
                    <h2 class="registration modal-en" style="max-width: 60% !important">অভিনন্দন, আপনার নিবন্ধন সফল হয়েছে। চোখ রাখুন banglabid.com –এ।</h2>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                    @endif


                    @if(!session('success') && !session('error'))
                    <div class="col-md-offset-2 col-lg-8 col-md-offset-2 background-yellow">

                    <form class="form-horizontal background-white" role="form" method="post" action="{{route('participant.register')}}"
                        enctype="multipart/form-data">
                        @csrf
                        <h2 class="registration">নিবন্ধন  ফর্ম</h2>

                        <div class="col-md-12 m-t-20">
						
			           <p>নিচে তোমার তথ্যগুলো বসিয়ে ফর্মটি পূরণ করো । সঠিক তথ্য প্রদান করো কারণ আমরা এই তথ্য ব্যবহার করেই তোমার সাথে পরবর্তীতে যোগাযোগ করবো।</p>
		               </div>
                       
                       <div class="col-md-6 m-r-10 form-group has-error-student_name">
								<label class="sr-only">অংশগ্রহণকারীর নাম</label>
                               
								<input name="name" id="name" type="text" value="" placeholder="অংশগ্রহণকারীর নাম" class="form-control input-lg">
                                @error('name')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                               
					   </div>

                       <div class="col-md-6 form-group has-error-age">
								<label class="sr-only">বয়স</label>
                               
								<!--<input name="age" type="text" id="age" value="" placeholder="বয়স সর্বোচ্চ ২০" class="form-control input-lg"> -->
								<select name="age" id="age" class="form-control input-lg">
									<option value="">-- বয়স --</option>
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
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
						</div>

                        <div class="col-md-6 form-group has-error-class">
								<label class="sr-only">শ্রেণি</label>
                                
								<select name="class" id="class" class="form-control input-lg">
									<option value="">-- শ্রেণি নির্বাচন --</option>
									<option value="6">ষষ্ঠ</option>
									<option value="7">সপ্তম</option>
									<option value="8">অষ্টম</option>
									<option value="9">নবম</option>
									<option value="10">দশম</option>
								</select>
                                @error('class')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
						</div>

                        <div class="col-md-6 m-r-10 form-group has-error-class">
                               
								<label class="sr-only">মোবাইল</label>
                                
								<input name="phone_number" id="inputMobile" type="text" value="" placeholder="মোবাইল নাম্বার" class="form-control input-lg">
                                @error('phone')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
						</div>

                        <div class="col-md-6 form-group has-error-class">
								<label class="sr-only">বিভাগ</label>
                                
								<select name="zone" id="zone2" class="form-control input-lg">
                                <option value="">-- বিভাগ/অঞ্চল  নির্বাচন--</option>
                                   @foreach($divisions as $division)
									<option value="{{$division->name}}">{{$division->name_bn}}</option>
                                    @endforeach
								</select>
                                @error('zone')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
						</div>

                        <!-- <div class="col-md-6 m-r-10 form-group has-error-class">
                               
								<label class="sr-only">টাইপ</label>
                                @error('plartform')
                                <p style="color:red;">{{ $message }}</p>
                                @enderror
                                <select name="platform_type" id="platform_type" class="form-control input-lg">
									<option value="">-- টাইপ নির্বাচন --</option>
									<option value="Web">ওয়েব</option>
									<option value="Call center">কল সেন্টার</option>
									<option value="Field agent">ফিল্ড এজেন্ট</option>
								</select>
						</div> -->

                        <div class="form-group"></div>

                        <div class="form-group">
								<input type="submit" class="registration col-md-12"  name="submit" value="প্রেরণ করো" />
						</div>
                    </form>

                    </div>
                    
                    @endif
                  
                </div>

            </div>
            
            <script type="text/javascript">
                $(document).ready(function () {
                    getLanguage();
                    $('.language_switch').on('click', '.btn', function () {
                        $(this).addClass('btn-active').siblings().removeClass('btn-active');
                    });
                });

            </script>
            <script type="text/javascript">
                function changeState(el) {
                    if (el.readOnly) el.checked = el.readOnly = false;
                    else if (!el.checked) el.readOnly = el.indeterminate = true;
                }

            </script>

            <script>
                var language;

                function getLanguage() {
                    (localStorage.getItem('language') == null) ? setLanguage('bn'): false;
                    $("." + localStorage.getItem('language')).addClass('btn-active').siblings().removeClass(
                        'btn-active');
                    $('#registration_lang').val(localStorage.getItem('language'));

                    if (localStorage.getItem('language') == 'bn') {
                        $('.modal-en').hide();
                        $('.modal-bn').show();
                    } else if (localStorage.getItem('language') == 'en') {
                        $('.modal-bn').hide();
                        $('.modal-en').show();
                    }

                    $.ajax({
                        url: '/language/' + localStorage.getItem('language') + '.json',


                        dataType: 'json',
                        success: function (lang) {
                            {
                                language = lang
                            }

                            $(".ml").text(language.registration2);

                            $(".Choosewhereyouwanttoaudition").text(language.Choosewhereyouwanttoaudition);
                            $(".name").text(language.name);
                            $(".name").attr("placeholder", language.name);
                            $(".age").text(language.age);
                            $(".age").attr("placeholder", language.age);
                            $(".gender").text(language.gender);
                            $(".male").text(language.male);
                            $(".female").text(language.female);
                            $(".others").text(language.others);
                            $(".condition").text(language.condition);
                            $(".yourmusicteacher").text(language.yourmusicteacher);
                            $(".yourmusicteacher").attr("placeholder", language.yourmusicteacher);

                            $(".Mobilenumber").text(language.Mobilenumber);
                            $(".Mobilenumber").attr("placeholder", language.Mobilenumber);
                            $(".Someonesmobilenumber").text(language.Someonesmobilenumber);
                            $(".Someonesmobilenumber").attr("placeholder", language.Someonesmobilenumber);
                            $(".Present_address").text(language.Present_address);
                            $(".Present_address").attr("placeholder", language.Present_address);
                            $(".save").text(language.save);
                            $(".phone_number").text(language.phoneNumber);
                            $(".phone_number").attr("placeholder", language.phoneNumber);
                            $(".email").text(language.email);
                            $(".email").attr("placeholder", language.email);
                            $(".dob").text(language.dob);
                            $(".dob").attr("placeholder", language.dob);
                            $(".whatsapp_number").text(language.whatsappNumber);
                            $(".whatsapp_number").attr("placeholder", language.whatsappNumber);
                            $(".present_country").text(language.Present_country);
                            $(".file").text(language.file);
                            $(".present_country").attr("placeholder", language.Present_country);


                            $(".registration_type").text(language.registration_type);
                            $(".INSIDE_BANGLADESH").text(language.INSIDE_BANGLADESH);
                            $(".OUTSIDE_BANGLADESH").text(language.OUTSIDE_BANGLADESH);

                            $(".participated_before").text(language.participatedBefore);
                            $(".participated_before").attr("placeholder", language.participatedBefore);

                            $(".TermsandConditions").text(language.TermsandConditions);
                            $(".HomePage").text(language.HomePage);

                            $(".DHAKA").text(language.DHAKA);
                            $(".DHAKA_01").text(language.DHAKA_01);
                            $(".DHAKA_02").text(language.DHAKA_02);
                            $(".CHITTAGONG").text(language.CHITTAGONG);
                            $(".KUSHTIA").text(language.KUSHTIA);
                            $(".RAJSHAHI").text(language.RAJSHAHI);
                            $(".SYLHET").text(language.SYLHET);
                            $(".RANGPUR").text(language.RANGPUR);
                            $(".MYMENSING").text(language.MYMENSING);


                        }
                    });
                }

                function setLanguage(lang) {

                    localStorage.setItem('language', lang);
                    getLanguage();
                }



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
                        dropdownClass: 'form-control custom-drorpdown date-dropdown',
                        minYear: '1920',
                        maxYear: '2020',
                        daySuffixValues: ['', '', '', ''],
                        onChange: function (day, month, year) {
                            if (day && month && year) {
                                let date = new Date(year + '-' + month + '-' + day);
                                var age = GetAge(date);
                                $('#age').val(age);

                            }
                        }
                    });

                    $('.datepicker').datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true
                    }).on('changeDate', function (ev) {
                        var age = GetAge(ev.date);
                        $('#age').val(age)
                    });;



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
</body>
