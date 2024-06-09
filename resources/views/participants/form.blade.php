<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Magic Bauliana</title>
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
        <div class="container bg-warning">
            <div class="row">
                {{-- <div class="logo pull-left sun-logo"></div> --}}

                <div class="col-lg-3 col-sm-12 col-xs-12">
                    <div class="btn-group language_switch">
                        <button type="button" class="btn btn-default btn-active bn"
                            onclick="setLanguage('bn')">বাংলা</button>
                        <button type="button" class="btn btn-primary en" onclick="setLanguage('en')">English</button>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-12 col-xs-12" style="display: flex;
                    justify-content: flex-end;
                    align-items: center;
                    gap: 10px;">

                    <div class="right-logo pull-right xs-button" style="padding:16px 0px">
                        <button type="button" class="registration btn btn-lg TermsandConditions " data-toggle="modal"
                        style="font-size: 12px; margin-bottom: 20px"
                            data-target="#myModal">শর্তাবলী</button>
                    </div>
                    {{-- <div class="left-logo pull-right xs-button" style="padding:16px 0px">
                        <button type="button" class="registration btn btn-lg HomePage"
                        style="font-size: 12px;"
                            onclick="location.href='http://www.magicbauliana.com.bd'"><i
                                class="glyphicon glyphicon-home "></i> মূলপাতা</button>
                    </div> --}}
                </div>
            </div>


            <!-- Example row of columns -->
            <div class="row" style="">

                <div class="col-md-offset-1 col-lg-11">
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
                    <h2 class="registration modal-bn" style="max-width: 60% !important">ধন্যবাদ! আপনার রেজিস্ট্রেশন সফলভাবে সম্পূর্ণ হয়েছে। ২৪ ঘণ্টার
                        ভেতরে আপনি একটি কনফার্মেশন এসএমএস/ মেইল পাবেন।</h2>
                    <h2 class="registration modal-en" style="max-width: 60% !important">Thank you! Your registration has successfully been completed. You
                        will receive a confirmation SMS/e-mail within next 24 hour</h2>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                    @endif


                    @if(!session('success') && !session('error'))

                    <form class="form-horizontal" role="form" method="post" action="{{route('participant.register')}}"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="registration_lang" id="registration_lang">
                        <div class="form-group">

                            <label for="inputPassword1" class="col-lg-4 control-label registration_type">রেজিস্ট্রেশনের
                                ধরণ</label>
                            <div class="col-lg-8">
                                <div class="radio radio-info radio-inline" style="margin-right: 10px">
                                    <input type="radio" id="INSIDE_BANGLADESH" class="INSIDE_BANGLADESH"
                                        value="INSIDE_BANGLADESH" name="reg_type"
                                        {{old('reg_type') == 'INSIDE_BANGLADESH' || old('reg_type') == null ? 'checked' : null}}>
                                    <label for="INSIDE_BANGLADESH" class="INSIDE_BANGLADESH"> বাংলাদেশের ভেতরে
                                        রেজিস্ট্রেশন </label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="OUTSIDE_BANGLADESH" class="OUTSIDE_BANGLADESH"
                                        value="OUTSIDE_BANGLADESH" name="reg_type"
                                        {{old('reg_type') == 'OUTSIDE_BANGLADESH' ? 'checked' : null}}>
                                    <label for="OUTSIDE_BANGLADESH" class="OUTSIDE_BANGLADESH"> বাংলাদেশের বাহিরে
                                        রেজিস্ট্রেশন </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-lg-4 control-label name">নাম</label>
                            <div class="col-lg-8">
                                <input type="text" name="name" class="form-control name" id="name" placeholder="নাম"
                                    value="{{old('name')}}">
                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="col-lg-4 control-label phone_number">ফোন নাম্বার
                                (ইংরেজিতে)</label>
                            <div class="col-lg-8">
                                <input type="text" name="phone_number" id="phone_number"
                                    class="form-control phone_number" placeholder="ফোন নাম্বার"
                                    value="{{old('phone_number')}}">
                                @error('phone_number')
                                <span class="help-block">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="whatsapp_number" class="col-lg-4 control-label whatsapp_number">হোয়াটসঅ্যাপ নম্বর</label>
                            <div class="col-lg-8">
                                <input type="text" name="whatsapp_number" id="whatsapp_number"
                                    class="form-control whatsapp_number" placeholder="হোয়াটসঅ্যাপ নম্বর"
                                    value="{{old('whatsapp_number')}}">
                                @error('whatsapp_number')
                                <span class="help-block">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group outsideBd">
                            <label for="email" class="col-lg-4 control-label email">ইমেইল</label>
                            <div class="col-lg-8">
                                <input type="text" name="email" id="email" class="form-control email"
                                    placeholder="ইমেইল" value="{{old('email')}}">
                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror


                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="col-lg-4 control-label dob">জন্ম তারিখ</label>
                            <div class="col-lg-8">
                                <input type="hidden" name="dob" id="dob" class="form-control dob datepicker"
                                    placeholder="জন্ম তারিখ" data-date-end-date="0d" autocomplete="off"
                                    value="{{old('dob')}}">
                                @error('dob')
                                <span class="help-block">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="age" class="col-lg-4 control-label age">বয়স </label>
                            <div class="col-lg-8">
                                <input type="number" name="age" class="form-control age" id="age" placeholder="বয়স"
                                    readonly min="1" value="{{old('age')}}">
                                @error('age')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group bd">

                            <label for="gender" class="col-lg-4 control-label gender">লিঙ্গ</label>
                            <div class="col-lg-8">
                                <select id="gender" class="form-control " name="gender">
                                    {{-- <option value="DHAKA_01" class="DHAKA_01">ঢাকা ০১</option> --}}
                                    <option value="" class="">-</option>

                                    <option value="MALE" class="male">পুরুষ </option>
                                    <option value="FEMALE" class="female"> মহিলা </option>
                                    <option value="OTHERS" class="others"> অন্যান্য </option>
                                </select>
                                @error('gender')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group bd">

                            <label for="zone" class="col-lg-4 control-label Choosewhereyouwanttoaudition">যেখানে অডিশন
                                দিতে চান, নির্বাচন করুন</label>
                            <div class="col-lg-8">
                                <select id="zone" class="form-control " name="zone">
                                    {{-- <option value="DHAKA_01" class="DHAKA_01">ঢাকা ০১</option> --}}
                                    <option value="" class="">-</option>
                                    <option value="DHAKA" class="DHAKA">ঢাকা </option>
                                    <option value="RAJSHAHI" class="RAJSHAHI"> রাজশাহী</option>
                                    <option value="RANGPUR" class="RANGPUR"> রংপুর</option>
                                    <option value="MYMENSING" class="MYMENSING">ময়মনসিংহ</option>
                                    <option value="KUSHTIA" class="KUSHTIA">কুষ্টিয়া</option>
                                    <option value="SYLHET" class="SYLHET">সিলেট</option>
                                    <option value="CHITTAGONG" class="CHITTAGONG">চট্টগ্রাম</option>

                                </select>
                                @error('zone')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group outsideBd">

                            <label for="present_country" class="col-lg-4 control-label present_country">আপনি বর্তমানে
                                কোন দেশে অবস্থান করছেন?</label>
                            <div class="col-lg-8">
                                <input type="text" name="present_country" id="present_country"
                                    class="form-control present_country"
                                    placeholder="আপনি বর্তমানে কোন দেশে অবস্থান করছেন?"
                                    value="{{old('present_country')}}">
                                @error('present_country')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-4 control-label yourmusicteacher">আপনার গানের
                                শিক্ষক/শিক্ষা প্রতিষ্ঠান (যদি থাকে)</label>
                            <div class="col-lg-8">
                                <input type="text" name="education" id="education" class="form-control yourmusicteacher"
                                    id="education" placeholder="শিক্ষক/শিক্ষা প্রতিষ্ঠান" value="{{old('education')}}">
                                @error('education')
                                <span class="help-block">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-lg-4 control-label Present_address ">বর্তমান
                                ঠিকানা</label>
                            <div class="col-lg-8">
                                <input type="text" name="address" class="form-control Present_address" id="address"
                                    placeholder="বর্তমান ঠিকানা" maxlength="250" value="{{old('address')}}">
                                @error('address')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="participated_before" class="col-lg-4 control-label participated_before ">পূর্বে
                                কোন সংগীত বিষয়ক রিয়েলিটি শো- তে অংশ নিয়েছেন কিনা? নিলে কোনটি?</label>
                            <div class="col-lg-8">
                                <input type="text" name="participated_before" class="form-control participated_before"
                                    id="participated_before"
                                    placeholder="পূর্বে কোন সংগীত বিষয়ক রিয়েলিটি শো- তে অংশ নিয়েছেন কিনা? নিলে কোনটি?"
                                    maxlength="250" value="{{old('participated_before')}}">
                                @error('participated_before')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group outsideBd">
                            <label for="file" class="col-lg-4 control-label file ">আপনার গাওয়া একটি ভিডিও গান আপলোড
                                করুন</label>
                            <div class="col-lg-8">
                                <input type="file" name="file" accept="video/mp4,video/x-m4v,video/*"
                                    class="form-control file" id="file"
                                    placeholder="আপনার গাওয়া একটি ভিডিও গান আপলোড করুন" maxlength="250"
                                    value="<?php echo isset($error['address']) ? $error['address'] : ''; ?>">

                                @error('file')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">
                            <input type="hidden" name="registration_type" value="Web">
                            <button type="submit" class="registration btn col-lg-12 save" name="submit" style="width: 100%; margin-bottom:0">জমা দিন</button>
                        </div>
                        <div class="modal-bn" style="text-align: center; color: white;">
                            ** বিস্তারিত তথ্য এবং রেজিস্ট্রেশনের জন্য ডায়াল করুন: টোল ফ্রি নম্বর: ০৮০০০৮৮৮০০০ (বাংলাদেশের ভিতরে)
                        </div>
                        <div class="modal-en" style="text-align: center; color: white;">
                            ** To know more or to register, dial this toll-free number: 08000888000 (Inside Bangladesh) 
                        </div>
                    </form>
                    
                    @endif



                    <div id="myModal" class="modal modal-xl fade " role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content custom-background">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3>Magic Bauliana Season-4 Terms &amp; Conditions</h3>
                                    <p class="modal-bn" style="text-align: left">লোকসংগীত বাংলাদেশের আপামর সব মানুষের
                                        কাছে সমান জনপ্রিয়। এ গানের আবেদন অতীতে যেমন ছিল, বর্তমানেও তেমন আছে। প্রবাহমান
                                        সংস্কৃতির ধারায় সংগীতের অন্যান্য ক্ষেত্রগুলোর মতো লোকসংগীত সহাবস্থান করছে তার
                                        স্বকীয় রূপবৈচিত্র্য নিয়ে। &lsquo;ম্যাজিক বাউলিয়ানা&rsquo; রিয়েলিটি শো&rsquo;র
                                        মাধ্যমে লোকগানের শক্তিশালী রূপটি নতুন প্রজন্মের সামনে ভিন্ন আঙ্গিকে তুলে ধরার
                                        উদ্দেশ্যেই স্কয়ার টয়লেট্রিজ লিমিটেড-এর ব্র্যান্ড ম্যাজিক-এর এই উদ্যোগ।</p>
                                    <p class="modal-bn" style="text-align: left">নিয়মাবলী:</p>

                                    <p class="modal-en" style="text-align: left">The love of folk music is shared by
                                        Bangladeshis of all ages. The appeal of this music is timeless. It has been
                                        popular for a long time, and is still just as well-regarded today, alongside all
                                        the other contemporary musical genres. That is why Sun Foundation, in
                                        collaboration with Square Toiletries Limited&rsquo;s brand Magic, has arranged
                                        &lsquo;Magic Bauliana&rsquo;. This reality show will present all the power,
                                        passion and dedication that local musicians share for folk music and reveal the
                                        talent of a new generation.</p>
                                    <p class="modal-en" style="text-align: left">Terms and Conditions:</p>

                                </div>
                                <div class="modal-body">

                                    <p class="modal-bn" style="text-align: left">১. এই প্রথমবারের মত দেশের বাইরে থেকেও
                                        ম্যাজিক বাউলিয়ানা-য় ভার্চুয়াল অডিশনের মাধ্যমে অংশগ্রহণ করা যাবে। সারাবিশ্বের যে
                                        কেউ বাংলায় বাউল গান গেয়ে অংশ নিতে পারবেন ম্যাজিক বাউলিয়ানা-য়। তবে ১৮ বছরের কম
                                        বয়সী আবেদনকারীর জন্য অভিভাবকের অনুমতি প্রয়োজন।</p>
                                    <p class="modal-bn" style="text-align: left">দেশের বাইরে থেকে রেজিস্ট্রেশন করতে এবং
                                        বিস্তারিত জানতে ভিজিট করুন: <a href="https://www.magicbauliana.com.bd"
                                            target="_blank">www.magicbauliana.com.bd</a></p>
                                    <p class="modal-bn" style="text-align: left">২. দেশের বাইরের রেজিস্ট্রেশনকারীদের
                                        ইমেইল এর মাধ্যমে রেজিস্ট্রেশন কনফার্মেশন জানানো হবে। সকল অংশগ্রহণকারীকে
                                        রেজিস্ট্রেশন কনফার্মেশনের ইমেইল/মেসেজ সেভ করে রাখতে হবে, যা অডিশনের সময়
                                        প্রমাণস্বরূপ দেখাতে হবে।</p>
                                    <p class="modal-bn" style="text-align: left">৩. দেশের বাইরে থেকে যারা অংশগ্রহণ করবেন
                                        তাদের অবশ্যই ম্যাজিক বাউলিয়ানা-এর ওয়েবসাইটে নিজের অডিশনের বাউল গানের ভিডিও আপলোড
                                        করতে হবে।</p>
                                    <p class="modal-bn" style="text-align: left">৪. অডিশনের সময় নাগরিকত্বের প্রমাণস্বরূপ
                                        জাতীয় পরিচয়পত্র/জন্মনিবন্ধন সনদ/প্রয়োজনীয় তথ্যাদি সাথে নিয়ে আসতে হবে।</p>
                                    <p class="modal-bn" style="text-align: left">৫. অংশগ্রহণকারী &lsquo;ম্যাজিক
                                        বাউলিয়ানা ২০২২&rsquo;-এর সকল প্রকার নিয়মকানুন, শর্ত ও চুক্তিসমূহ মেনে চলতে বাধ্য
                                        থাকবেন। পুরো অনুষ্ঠানের যেকোনো বিষয়ে আয়োজক/প্রযোজকের সিদ্ধান্ত চূড়ান্ত বলে গণ্য
                                        হবে। অংশগ্রহণকারীর ধারণকৃত যেকোনো চিত্র, সাক্ষাৎকার, অডিশন, প্রতিযোগিতা বা
                                        অনুষ্ঠান সম্পর্কিত যেকোনো অংশ কর্তৃপক্ষ যেকোনো সময়ে যেকোনো মাধ্যমে প্রকাশ করার
                                        অধিকার রাখে।</p>
                                    <p class="modal-bn" style="text-align: left">৬. ম্যাজিক বাউলিয়ানায় প্রতিযোগিতায় কোনো
                                        অংশগ্রহণকারী প্রতিযোগিতার রেজিস্ট্রেশন থেকে সমাপ্তি পর্যন্ত অন্য কোনো রিয়্যালিটি
                                        শো বা মিউজিক প্ল্যাটফর্মে যুক্ত হওয়া এবং পারফর্মেন্স অথবা রেকর্ডিং এর জন্য কোনো
                                        ব্যক্তি বা প্রতিষ্ঠানের সাথে চুক্তিবদ্ধ থাকতে পারবেন না।</p>
                                    <p class="modal-bn" style="text-align: left">৭. ম্যাজিক বাউলিয়ানায় অংশগ্রহণকারীর
                                        অংশগ্রহণ সম্পর্কিত কোনো তথ্য, অনুষ্ঠানের আয়োজক/সম্প্রচারক বা কর্তৃপক্ষ সংশ্লিষ্ট
                                        কোনো ব্যক্তি/প্রতিষ্ঠান সম্পর্কিত কোনো তথ্য, মন্তব্য, প্রতিক্রিয়া অথবা অনুভূতি,
                                        কর্তৃপক্ষের অনুমতি ছাড়া কোথাও, কোনো মিডিয়াতে (যেমন: ফেসবুক, টুইটারসহ অন্য কোনো
                                        প্ল্যাটফর্মে) প্রকাশ করা যাবে না।</p>
                                    <p class="modal-bn" style="text-align: left">৮. মিডিয়াকম লিমিটেড/মাছরাঙা টেলিভিশন
                                        লিমিটেড/স্কয়ার গ্রুপ-এর সাথে সরাসরিভাবে সম্পৃক্ত কোনো ব্যক্তি বা তার পরিবারের
                                        সদস্য এই প্রতিযোগিতায় অংশ নিতে পারবেন না।</p>
                                    <p class="modal-bn" style="text-align: left">৯. প্রতিযোগিতায় অংশগ্রহণের কারণে কোনো
                                        অংশগ্রহণকারী যেকোনো ক্ষতির সম্মুখীন হলে বাউলিয়ানা কর্তৃপক্ষ তার দায়ভার নিবে না।
                                    </p>
                                    <p class="modal-bn" style="text-align: left">১০. উপরে উল্লেখিত কোনো তথ্যে গড়মিল
                                        থাকলে অথবা প্রতিযোগিতা কার্যক্রমের কোনো শর্ত বা নিয়ম অমান্য করলে কারণ দর্শানো
                                        ছাড়াই কর্তৃপক্ষ অংশগ্রহণকারীকে প্রতিযোগিতা থেকে বাদ দিতে পারবেন।</p>
                                    <p class="modal-bn" style="text-align: left">বিস্তারিত তথ্য এবং রেজিস্ট্রেশনের জন্য
                                        ডায়াল করুন: টোল ফ্রি নম্বর: ০৮০০০৮৮৮০০০ (বাংলাদেশের ভিতরে) অথবা ইনবক্স করুন
                                        ম্যাজিক বাউলিয়ানা-এর ফেসবুক পেইজে।</p>
                                    <p class="modal-bn" style="text-align: left">অডিশন রাউন্ড কোথায় হচ্ছে: (বাংলাদেশের
                                        ভিতরে)&nbsp;</p>
                                    <p class="modal-bn" style="text-align: left">৭টি এলাকায়:</p>
                                    <p class="modal-bn" style="text-align: left">&ndash; রংপুর</p>
                                    <p class="modal-bn" style="text-align: left">&ndash; রাজশাহী</p>
                                    <p class="modal-bn" style="text-align: left">&ndash; সিলেট</p>
                                    <p class="modal-bn" style="text-align: left">&ndash; চট্টগ্রাম</p>
                                    <p class="modal-bn" style="text-align: left">&ndash; ময়মনসিংহ</p>
                                    <p class="modal-bn" style="text-align: left">&ndash; কুষ্টিয়া</p>
                                    <p class="modal-bn" style="text-align: left">&ndash; ঢাকা</p>
                                    <p class="modal-bn" style="text-align: left">রেজিস্ট্রেশনের সময়: ১০ মে, ২০২২ - ২৬
                                        মে, ২০২২</p>



                                    <p class="modal-en" style="text-align: left">1. For the first time, people from
                                        abroad will be able to participate in the Magic Bauliana through a virtual
                                        audition. Anyone from all over the world can take part in Magic Bauliana by
                                        singing Baul songs in Bengali. However, applicant under the age of 18 needs
                                        parental permission.</p>
                                    <p class="modal-en" style="text-align: left">To register from abroad and learn more
                                        visit: <a href="https://www.magicbauliana.com.bd"
                                            target="_blank">www.magicbauliana.com.bd</a></p>
                                    <p class="modal-en" style="text-align: left">2. Registration confirmation of
                                        registrants outside the country will be notified via email. All participants
                                        need to save the email / message of registration confirmation.</p>
                                    <p class="modal-en" style="text-align: left">3. Participants from abroad must upload
                                        a video of their audition on the Magic Bauliana website.</p>
                                    <p class="modal-en" style="text-align: left">4. At the time of audition, you will
                                        need to bring National Identity Card / Birth Registration Card / necessary
                                        information as proof of citizenship.</p>
                                    <p class="modal-en" style="text-align: left">5. Participants must consent to all the
                                        terms and conditions required by &lsquo;Magic Bauliana 2022&rsquo;. The
                                        organizers/producers hold the right to final decisions on all matters pertaining
                                        to the program. Any footage, still photography, video or audio recordings of the
                                        participants may be used by the organizers on any chosen media at any time.</p>
                                    <p class="modal-en" style="text-align: left">6. No participant in the Magic Bauliana
                                        contest can join any other reality show or music platform from the time of
                                        registration to the end of the contest and cannot enter into a contract with any
                                        person or organization for performance or recording.</p>
                                    <p class="modal-en" style="text-align: left">7. Participants cannot share
                                        information on their participation in Magic Bauliana, or quotes comments by any
                                        affiliated personnel, audition round, episode information, reactions or any
                                        other information pertaining to the show on any public media (such as: Facebook,
                                        Twitter or any other platform) without permission from the authorities.</p>
                                    <p class="modal-en" style="text-align: left">8. Persons employed at Mediacom
                                        Limited/ Maasranga Television/ Square Group or family members of such persons
                                        cannot participate in this program.</p>
                                    <p class="modal-en" style="text-align: left">9. In case of any distress sustained by
                                        participants during the course of the program, authorities will not be held
                                        responsible.</p>
                                    <p class="modal-en" style="text-align: left">10. The authority holds the right to
                                        disqualify participants/registration without showing cause if any errors or
                                        discrepancies are found in the required information.</p>
                                    <p class="modal-en" style="text-align: left">To know more or to register, dial this
                                        toll-free number: 08000888000 (Inside Bangladesh) or inbox on Magic
                                        Bauliana&apos;s Facebook page.</p>
                                    <p class="modal-en" style="text-align: left">Audition Round Locations: (Inside
                                        Bangladesh)</p>
                                    <p class="modal-en" style="text-align: left">In 7 regions</p>
                                    <p class="modal-en" style="text-align: left">Rangpur</p>
                                    <p class="modal-en" style="text-align: left">Rajshahi</p>
                                    <p class="modal-en" style="text-align: left">Sylhet</p>
                                    <p class="modal-en" style="text-align: left">Chattogram</p>
                                    <p class="modal-en" style="text-align: left">Mymensingh</p>
                                    <p class="modal-en" style="text-align: left">Kushtia</p>
                                    <p class="modal-en" style="text-align: left">Dhaka</p>
                                    <p class="modal-en" style="text-align: left">Registration Deadline: May 10 to 26,
                                        2022</p>
                                </div>

                            </div>

                        </div>
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
                        minYear: '1970',
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
