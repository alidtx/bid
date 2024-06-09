<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Magic Bauliana | Resistration Time over</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon"
        href="http://www.magicbauliana.com/wp-content/uploads/2013/07/fav_Bawliana_Logo.png">
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
                <div class="logo pull-left sun-logo col-lg-3 col-sm-12 col-xs-12"></div>
                <div class="col-lg-3 col-sm-6 col-xs-6">
                    <div class="btn-group language_switch">
                        <button type="button" class="btn btn-default btn-active bn"
                            onclick="setLanguage('bn')">বাংলা</button>
                        <button type="button" class="btn btn-primary en" onclick="setLanguage('en')">English</button>
                    </div>
                </div>
             
            </div>


            <!-- Example row of columns -->
            <div class="row" style="">

                <div class="col-md-offset-1 col-lg-11">
                    <div class="center"><img src="img/logo.png" style="height: 250px;width: auto;" /></div>

              
                    <div style="    display: flex;
                    justify-content: center;
                    align-content: center;
                    align-items: center;">
                                    <h2 class="registration modal-bn" style="max-width: 60% !important">ম্যাজিক বাউলিয়ানা ২০২২-এর রেজিস্ট্রেশনের সময়সীমা শেষ হয়েছে।</h2>
                                    <h2 class="registration modal-en" style="max-width: 60% !important">The registration deadline of Magic Bauliana 2022 has passed.</h2>
                                    </div>



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
