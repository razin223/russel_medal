@extends("quiz_template")

@section("og_content")
<meta property="og:url"                content="{{url()->current()}}" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="শেখ রাসেল কুইজ" />
<meta property="og:description"        content="" />
<meta property="og:image"              content="{{asset('assets/img/russel-logo.jpeg')}}" />
@endsection

@section("content")

<style>

    .services .box{
        width: 300px;
        margin-bottom:  30px;
        margin-left: 15px;
        margin-right: 15px;
    }

    .services .icon-box a{
        padding: 5px 0px;
        font-size: 1.5em;
        font-weight: 500;
        color: rgb(68, 68, 68);
    }
    .services .icon-box a:hover{
        color: rgb(68, 68, 68);
        font-weight: 500;
        line-height: 1.2;
    }


    /* CSS */
    .button-63 {
        align-items: center;
        background-image: linear-gradient(144deg,#AF40FF, #5B42F3 50%,#00DDEB);
        border: 0;
        border-radius: 8px;
        box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
        box-sizing: border-box;
        color: #FFFFFF;
        display: inline;
        font-family: Phantomsans, sans-serif;
        font-size: 20px;
        justify-content: center;
        line-height: 1em;
        min-width: 140px;
        padding: 19px 24px;
        text-decoration: none;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        white-space: nowrap;
        cursor: pointer;
    }

    .button-63:active,
    .button-63:hover {
        outline: 0;
        color: rgb(255,255,255);
    }

    @media (min-width: 768px) {
        .button-63 {
            font-size: 24px;
            min-width: 196px;
        }
    }
    
    
    h5{
        color: #0067b2;
        font-weight: bold;
    }

</style>

<section class="breadcrumbs">
    <h2 class="text-center">শেখ রাসেল অনলাইন কুইজ প্রতিযোগিতা ২০২১</h2>
</section>
<!-- ======= Cta Section ======= -->
<section class="services" style="background-color: #fff; padding-top: 20px">
    <div class="container">

        <div class="row">
            <div class="col-12 " style=" text-align: justify;">
                <h5>যারা অংশগ্রহণ করতে পারবে:</h5>
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;<strong>গ্রুপ ক:</strong> ৮-১২ বছর <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;<strong>গ্রুপ খ:</strong> ১৩-১৮ বছর
                </p>
                <h5>নিবন্ধন:</h5>
                <p>
                    ০৩ অক্টোবর থেকে ১১ অক্টোবর, ২০২১, রাত ১২টা পর্যন্ত অনলাইনে (quiz.sheikhrussel.gov.bd) নিবন্ধন করা যাবে।
                </p>
                <h5>অনলাইন প্রতিযোগিতা:</h5>
                <p>

                    <strong>গ্রুপ ক:</strong>: ৮-১২ বছর<br/>
                    &nbsp;&nbsp;&nbsp;১২ অক্টোবর ২০২১, সন্ধ্যা ৭টা থেকে ৮টার মধ্যে যে কোনো ১০ মিনিট।<br/>
                    <strong>গ্রুপ খ:</strong>: ১৩-১৮ বছর<br/>
                    &nbsp;&nbsp;&nbsp;১৩ অক্টোবর ২০২১, সন্ধ্যা ৭টা থেকে ৮টার মধ্যে যে কোনো ১০ মিনিট। 
                </p>
                <h5>পুরস্কার:</h5>
                <p>

                    <strong>গ্রুপ ক</strong>: ৮-১২ বছর<br/> 
                    &nbsp;&nbsp;&nbsp;৫টি ল্যাপটপ (কোর আই ৭, ১০ জেনারেশন) <br/>
                    <strong>গ্রুপ খ:</strong>: ১৩-১৮ বছর<br/> 
                    &nbsp;&nbsp;&nbsp;৫টি ল্যাপটপ (কোর আই ৭, ১০ জেনারেশন) 
                <ul>
                    <li>কুইজ প্রতিযোগিতাটি শুধু ৮ থেকে ১৮ বছর বয়সীদের জন্য উন্মুক্ত।</li>
                    <li>একজন প্রতিযোগী একবারই অংশগ্রহণ করতে পারবেন।</li>
                    <li>ভুল/মিথ্যা তথ্য দিয়ে অংশগ্রহণ করলে তাকে প্রতিযোগিতা থেকে বাতিল বলে গণ্য করা হবে।</li>
                </ul>

                </p>
                <h5>নিয়মাবলি:</h5>
                <p>
                <ul>
                    <li>প্রতিযোগিতায় অংশগ্রহণের জন্য বরাদ্দকৃত সময় ১০ মিনিট।</li>
                    <li>সকল প্রশ্নের মান সমান। ভুল উত্তরের জন্য কোনো নম্বর কাটা যাবে না।</li>
                    <li>সকল প্রশ্নের উত্তরের জন্য চারটি বিকল্প থেকে একটি সঠিক উত্তর বাছাই করতে হবে (এমসিকিউ)।</li>
                    <li>কম সময়ে সর্বোচ্চ সংখ্যক উত্তরদাতা থেকে বিজয়ী নির্বাচন করা হবে।</li>
                    <li>চূড়ান্ত বিজয়ীদের ক্ষেত্রে বয়স যাচাই সাপেক্ষে পুরস্কার প্রদান করা হবে।</li>
                </ul>

                </p>

                <h5>কুইজের বিষয়:</h5>
                <p>শেখ রাসেলের জন্ম, দুরন্ত শৈশব, শিক্ষা জীবন, স্বপ্ন, ভ্রমণ, পছন্দ, খেলাধুলা, তাঁর উপর রচিত গ্রন্থ, জাতির পিতা বঙ্গবন্ধু শেখ মুজিবুর রহমান ও তাঁর পরিবারের সদস্যদের সঙ্গে কাটানো মুহূর্তসহ বিভিন্ন বিষয় থেকে প্রশ্ন নির্ধারণ করা হবে। </p>

                <p class="text-center">
                    <br/><br/>

                    <a class="button-63" href="{{route('ka_group_registration')}}">গ্রুপ ক: ৮-১২ বছর রেজিস্ট্রেশন</a><br/><br/><br/><a class="button-63" href="{{route('kha_group_registration')}}">গ্রুপ খ: ১৩-১৮ বছর  রেজিস্ট্রেশন</a>
                </p>


            </div>


        </div>
    </div>
</section><!-- End Cta Section -->





@endsection