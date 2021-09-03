<!DOCTYPE html>
<html lang="en">
@section('title')
    {{ trans('main_trans.Main_title') }}
@stop

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')

    <!-- css -->
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
    <link href="toastr.css" rel="stylesheet" />
    @toastr_css
</head>


<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <div id="pre-loader">
            <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">
                            {{ trans('main_trans.Dashboard_page') }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>

            <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=1741&amp;height=800&amp;hl=en&amp;q=University of Oxford&amp;t=&amp;z=9&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.fnfgo.com/">FNF Mods</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:800px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:800px;}.gmap_iframe {height:800px!important;}</style></div>



        </div>


        <!--=================================
             wrapper -->

        <!--=================================
             footer -->

        @include('layouts.footer')
    </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
    <script src="jquery.min.js"></script>
    <script src="toastr.js"></script>

</body>
@jquery
@toastr_js
@toastr_render

</html>
