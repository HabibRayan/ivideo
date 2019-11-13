<!DOCTYPE HTML>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('admin/')}}/css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="{{asset('admin/')}}/css/style.css" rel='stylesheet' type='text/css' />

    <!-- font-awesome icons CSS -->
    <link href="{{asset('admin/')}}/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('admin/')}}/css/jquery.tagsinput-revisited.min.css" rel="stylesheet">
    <!-- //font-awesome icons CSS-->

    <!-- side nav css file -->
    <link href='{{asset('admin/')}}/css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
    <!-- //side nav css file -->

    <!-- js-->
    <script src="{{asset('admin/')}}/js/jquery-1.11.1.min.js"></script>
    <script src="{{asset('admin/')}}/js/modernizr.custom.js"></script>

    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <!--//webfonts-->

    <!-- chart -->
    <script src="{{asset('admin/')}}/js/Chart.js"></script>
    <script src="{{asset('admin/')}}/js/jquery.tagsinput-revisited.min.js"></script>
    <!-- //chart -->

    <!-- Metis Menu -->
    <script src="{{asset('admin/')}}/js/metisMenu.min.js"></script>
    <script src="{{asset('admin/')}}/js/custom.js"></script>
    <link href="{{asset('admin/')}}/css/custom.css" rel="stylesheet">
    <!--//Metis Menu -->
    <style>
        #chartdiv {
            width: 100%;
            height: 295px;
        }
    </style>
    <!--pie-chart --><!-- index page sales reviews visitors pie chart -->
    <script src="{{asset('admin/')}}/js/pie-chart.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#2dde98',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#8e43e7',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ffc168',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });


        });

    </script>
    <!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->

    <!-- requried-jsfiles-for owl -->
    <link href="{{asset('admin/')}}/css/owl.carousel.css" rel="stylesheet">
    <script src="{{asset('admin/')}}/js/owl.carousel.js"></script>
    <script>
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                items : 3,
                lazyLoad : true,
                autoPlay : true,
                pagination : true,
                nav:true,
            });
        });
    </script>
    <!-- //requried-jsfiles-for owl -->
</head>
<body class="cbp-spmenu-push">
<div class="main-content">

    <!--left-fixed -navigation-->
    @include('admin.includes.sidebar')

    <!-- header-starts -->
    @include('admin.includes.header')
    <!-- //header-ends -->
    <!-- main content start-->
    @yield('content')
    <!--footer-->
    @include('admin.includes.footer')

<!--//footer-->
</div>

<!-- new added graphs chart js-->

<script src="{{asset('admin/')}}/js/Chart.bundle.js"></script>
<script src="{{asset('admin/')}}/js/utils.js"></script>

<!-- Classie --><!-- for toggle left push menu script -->
<script src="{{asset('admin/')}}/js/classie.js"></script>
<script>
    var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
        showLeftPush = document.getElementById( 'showLeftPush' ),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle( this, 'active' );
        classie.toggle( body, 'cbp-spmenu-push-toright' );
        classie.toggle( menuLeft, 'cbp-spmenu-open' );
        disableOther( 'showLeftPush' );
    };


    function disableOther( button ) {
        if( button !== 'showLeftPush' ) {
            classie.toggle( showLeftPush, 'disabled' );
        }
    }
</script>
<!-- //Classie --><!-- //for toggle left push menu script -->

<!--scrolling js-->
<script src="{{asset('admin/')}}/js/jquery.nicescroll.js"></script>
<script src="{{asset('admin/')}}/js/scripts.js"></script>
<!--//scrolling js-->

<!-- side nav js -->
<script src='{{asset('admin/')}}/js/SidebarNav.min.js' type='text/javascript'></script>
<script>
    $('.sidebar-menu').SidebarNav()
</script>
<!-- //side nav js -->

<!-- for index page weekly sales java script -->
<script src="{{asset('admin/')}}/js/SimpleChart.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('admin/')}}/js/bootstrap.js"> </script>
<!-- //Bootstrap Core JavaScript -->

</body>
</html>
