<!DOCTYPE html>
<html lang="en_US"  dir="ltr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="<?php if($template['metaTitle']){ echo $template['metaTitle']; }  else { echo "MYTT"; }?>">
    <meta name="keyword" content="<?php if($template['metaKeyword']){ echo $template['metaKeyword']; } else { echo $template['metaKeyword'] ; }?>">
    <meta name="description" content="<?php if($template['metaDescription']){ echo $template['metaDescription']; } else { echo $template['metaDescription'] ;} ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/innovation1592320042.png" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com/"> <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link rel="canonical" href="https://mytt.in/">
    <link rel=preload href="<?php echo base_url(); ?>/assets/theme/frontend/css/fontawesome.min.css" as="style">
    <link rel=preload href="<?php echo base_url(); ?>/assets/theme/frontend/css/flaticon.css" as="style">
    <link rel=preload href="<?php echo base_url(); ?>/assets/theme/frontend/css/nexicon.css" as="style">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/nexicon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/fontawesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/animate.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/helpers.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/jquery.ihavecookies.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/dynamic-style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/theme/frontend/css/toastr.css">
    <link href="<?php echo base_url(); ?>/assets/theme/frontend/css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../../code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <style>
    :root {
        --main-color-one: #06A3DA;
        --main-color-two: #5580ff;
        --portfolio-color: #ff4756;
        --logistic-color: #ff4039;
        --industry-color: #ff5820;
        --secondary-color: #1d2228;
        --heading-color: #0a1121;
        --paragraph-color: #878a95;
        --construction-color: #ffbc13;

        --lawyer-color: #c89e66;
        --political-color: #e70f49;
        --medical-color: #47ccf1;
        --medical-two-color: #fc6286;
        --fruits-color: #4ca338;
        --fruits-heading-color: #014019;
        --portfolio-dark-one: #202334;
        --portfolio-dark-two: #191c47;
        --charity-color: #d1312e;
        --dagency-color: #ff8a47;
        --cleaning-color: #fee126;
        --cleaning-two-color: #20beea;
        --course-color: #21baf7;
        --course-two-color: #fda809;
        --grocery-color: #80b82d;
        --grocery-heading-color: #014019;
                --heading-font: 'Nunito',sans-serif;
        --body-font: 'Nunito',sans-serif;
    }
</style>
    <style>

        /* navbar style 01 */
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01{
        background-color: transparent;
    }
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li a ,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:before,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .nav-right-content ul li,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .nav-right-content ul li a
    {
        color:  rgba(255, 255, 255, .8);
    }
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li a:hover ,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:hover:before,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:hover:before,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .nav-right-content ul li:hover,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .nav-right-content ul li a:hover
    {
        color:  var(--main-color-one);
    }
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a {
        background-color: #fff;
        color: var(--paragraph-color);
    }
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a:hover {
        background-color: var(--main-color-one);
        color: #fff;
    }
    .header-style-01.navbar-variant-01 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu{
        border-bottom-color: var(--main-color-one);
    }
    .header-style-01.navbar-variant-01 .mobile-cart a .pcount,
    .header-style-01.navbar-variant-01 .navbar-area .nav-container .nav-right-content ul li.cart .pcount{
        background-color: var(--main-color-one);
        color: #fff;
    }
    .navbar-variant-01 .navbar-area .nav-container .navbar-collapse .navbar-nav li.current-menu-item a {
        color: #fff !important;
    }
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01.nav-fixed{
        background-color: #333;
    }
    .top-bar-area {
        background-color: var(--secondary-color);
    }
    .top-bar-inner ul li a,
    #langchange{
        color: #f2f2f2;
    }
    .top-bar-inner ul li a:hover {
        color: var(--main-color-two);
    }
    .top-bar-inner .btn-wrapper .boxed-btn.reverse-color {
        background-color: var(--main-color-two);
        color: #fff
    }
    .top-bar-inner .btn-wrapper .boxed-btn.reverse-color:hover {
        background-color: var(--main-color-two);
        color: #fff;
    }


    /* mega style */
    .xg_mega_menu_wrapper{
        background-color: #fff;;
    }

    .xg-mega-menu-single-column-wrap .mega-menu-title{
        color: var(--heading-color);
    }
    .xg-mega-menu-single-column-wrap ul li a,
    .xg-mega-menu-single-column-wrap ul .single-mega-menu-product-item .title,
    .xg-mega-menu-single-column-wrap ul .single-mega-menu-product-item .content .price-wrap .price,
    .single-donation-mega-menu-item .title{
        color: var(--paragraph-color) !important;
    }
    .single-donation-mega-menu-item .content .goal h4{
        color: var(--paragraph-color) !important;
        opacity: .6;
    }
    .xg-mega-menu-single-column-wrap ul li a:hover,
    .xg-mega-menu-single-column-wrap ul .single-mega-menu-product-item .title:hover,
    .single-donation-mega-menu-item .title:hover{
        color: var(--main-color-color) !important;
    }
    .xg-mega-menu-single-column-wrap ul .single-mega-menu-product-item .content .price-wrap del{
        color: var(--paragraph-color) !important;
        opacity: .6;
    }
    .single-donation-mega-menu-item .content .boxed-btn{
        background-color: var(--main-color-one);
        color: #fff !important;
    }
    .single-donation-mega-menu-item .content .boxed-btn:hover{
        background-color: var(--main-color-one) ;
        color: #fff !important;
    }
    /* breadcrumb css */
    .breadcrumb-area .breadcrumb-inner{
        padding-top: 215px;
        padding-bottom: 142px;
    }
    .breadcrumb-area:before{
        background-color: rgba(0, 0, 0, .6) ;
    }
    .breadcrumb-area .page-title{
        color: #fff;
    }
    .breadcrumb-area .page-list li:first-child a{
        color: var(--main-color-one);
    }
    .breadcrumb-area .page-list li{
        color: rgba(255, 255, 255, .7);
    }

    /* footer css */
    .footer-area .copyright-area{
        background-color:#17427d !important;
        color: rgba(255, 255, 255, .7);
    }
    .footer-area .footer-top {
        background-color: #143056 !important;
    }
    .widget.footer-widget .widget-title {
        color: rgba(255, 255, 255, .9);
    }
    .contact_info_list li.single-info-item .icon,
    .footer-widget.widget_nav_menu ul li a:after
    {
        color: var(--main-color-two);
    }
    .footer-area .footer-widget.widget_tag_cloud .tagcloud a,
    .footer-area .widget.footer-widget p,
    .footer-area .widget.footer-widget.widget_calendar caption,
    .footer-area .widget.footer-widget.widget_calendar td,
    .footer-area .widget.footer-widget.widget_calendar th,
    .footer-area .widget.footer-widget ul li,
    .footer-area .widget.footer-widget ul li a {
        color: rgba(255, 255, 255, .6);
    }

    .footer-area .footer-widget.widget_tag_cloud .tagcloud a:hover,
    .footer-area .widget.footer-widget ul li a:hover {
        color: rgba(255, 255, 255, .6);
    }

</style>            
    <meta property="og:title"  content="Mythink Tank" />
     <meta property="og:image" content="<?php echo base_url()."/assets/images/favicon.ico"; ?>" />
    <title>Mythink Tank Multimedia Pvt. Ltd.</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico" />
    <script src="<?php echo base_url(); ?>/assets/theme/frontend/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/theme/frontend/js/jquery-migrate-3.1.0.min.js"></script>
    <script>var siteurl = "https://mytt.in"</script>
    
        <script type="text/javascript">
        adroll_adv_id = "GXM5SRU2XZE7JOKGHSZPSZ";
        adroll_pix_id = "WP43YTLBS5BQXDP6XUEIC7";
        adroll_version = "2.0";

    (function(w, d, e, o, a) {
        w.__adroll_loaded = true;
        w.adroll = w.adroll || [];
        w.adroll.f = [ 'setProperties', 'identify', 'track' ];
        var roundtripUrl = "https://s.adroll.com/j/" + adroll_adv_id
                + "/roundtrip.js";
        for (a = 0; a < w.adroll.f.length; a++) {
            w.adroll[w.adroll.f[a]] = w.adroll[w.adroll.f[a]] || (function(n) {
                return function() {
                    w.adroll.push([ n, arguments ])
                }
            })(w.adroll.f[a])
        }

        e = d.createElement('script');
        o = d.getElementsByTagName('script')[0];
        e.async = 1;
        e.src = roundtripUrl;
        o.parentNode.insertBefore(e, o);
    })(window, document);
    adroll.track("pageView");
</script>
 </head>
<body class="/ home_variant_08 nexelit_version_3.1.3 not_verified apps_key_NB2GLtODUjYOc9bFkPq2pKI8uma3G6WX ">
    <div class="body-overlay" id="body-overlay"></div>
        <div class="search-popup" id="search-popup">
            <div class="search-popup-inner-wrapper">
                <form action="https://xgenious.com/laravel/nexelit/blog-search" method="get" class="search-form-warp">
                    <span class="search-popup-close-btn">×</span>
                    <div class="form-group">
                        <input type="text" class="form-control search-field" name="search" placeholder="Search...">
                    </div>
                    <div class="form-group">
                        <select name="search_type" id="search_popup_search_type" class="form-control">
                            <option value="blog">Blog</option>
                                                <option value="event">Events</option>
                                                                    <option value="product">Products</option>
                                                                    <option value="knowledgebase">Knowledgebase</option>
                                            </select>
                    </div>
                    <button class="close-btn border-none" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="top-bar-area header-variant-08">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-bar-inner">
                            <div class="left-content">
                                <ul class="social-icons">
                                        <li><a href="#" rel="canonical" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://www.facebook.com/mythinktankindia" target="_blank" rel="canonical"><i class="flaticon-facebook"></i></a></li>
                                         <li><a href="https://www.instagram.com/mytt_india/" rel="canonical" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                         <li><a href="https://www.linkedin.com/company/mytt/mycompany/verification/" target="_blank" rel="canonical"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="right-content">
                                <ul>
                                    <li class="login-register"><a href="https://crm.mytt.in" target="_blank">Login</a> <span>/</span> <a href="https://crm.mytt.in/register" target="_blank">Register</a></li>
                                    <li>
                                        <div class="btn-wrapper">
                                            <a href="<?php echo base_url("quote"); ?>" rel="canonical" class="boxed-btn reverse-color">Get A Quote</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>