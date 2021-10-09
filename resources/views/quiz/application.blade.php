@extends("quiz_template")

@section("og_content")
<meta property="og:url"                content="{{url()->current()}}" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="শেখ রাসেল পদক" />
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
    <h2 class="text-center">শেখ রাসেল অনলাইন পদক প্রতিযোগিতা ২০২১</h2>
</section>
<!-- ======= Cta Section ======= -->
<section class="services" style="background-color: #fff; padding-top: 20px">
    <div class="container">

        <div class="row">
            <div class="col-12 " style=" text-align: justify;">
                


            </div>


        </div>
    </div>
</section><!-- End Cta Section -->





@endsection