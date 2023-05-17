<footer class="footer-area home-variant-08">
            <div class="footer-top padding-top-50 padding-bottom-50">
            <div class="container" style="max-width: 1300px;">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class=" footer-widget widget">
                                    <div class="footer-widget widget">
                                        <div class="about_us_widget style-01">
                                            <img src="<?php echo base_url()."/assets/images/logo_footer.png"; ?>" class="footer-logo" alt="" />
                                            <p>
                                                <p> My Think Tank Multimedia Pvt Ltd, is established in 2021 as a sister company of HAASH Group, incorporated in 2014 has operations and businesses <br/> varied in multiple arenas ranging from Wealth Management, IPTV/OTT Solutions, Embedding Entrepreneurship, Complete IT Solutions, Real Estate, Digital Marketing, and Internet Services Accommodator. </p>
                                                <p> Be it support to your fund investment patterns or a desire to establish a business, we got your back! </p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class=" footer-widget widget">
                                    <div class="footer-widget widget widget_nav_menu">
                                        <h4 class="widget-title">Quick Links</h4>
                                        <ul>
                                            <li > 
                                                <a href="<?php echo base_url("index"); ?>">Home</a>
                                            </li>
                                            <li > 
                                                <a href="<?php echo base_url("aboutus"); ?>">About</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url("service"); ?>">Service</a>
                                            </li>
                                            <li > 
                                                <a href="<?php echo base_url("branch"); ?>">Branches</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class=" footer-widget widget">
                                    <div class="footer-widget widget widget_nav_menu">
                                        <h4 class="widget-title">Helping Links</h4>
                                        <ul>
                                            <li > 
                                                <a href="<?php echo base_url("contact"); ?>">Contact</a>
                                            </li>
                                            <li > 
                                                <a href="<?php echo base_url("quote"); ?>">Quote</a>
                                            </li>
                                            <li > 
                                                <a href="<?php echo base_url("career"); ?>"></i>Career</a>
                                            </li>
                                            <li> 
                                                <a href="<?php echo base_url("youth_empowerment"); ?>" >Youth Empowerment</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class=" footer-widget widget">
                                    <h4 class="widget-title">Contact info</h4>
                                    <ul class="contact_info_list"> 
                                        <li class="single-info-item">
                                            <div class="icon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <div class="details">
                                                <?php echo $template['address']; ?>
                                            </div>
                                        </li>
                                        <li class="single-info-item">
                                            <div class="icon">
                                                <i class="fas fa-envelope-open"></i>
                                            </div>
                                            <div class="details">
                                                <?php echo $template['email']; ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class=" footer-widget widget">
                                    <div class="footer-widget widget widget_nav_menu">
                                        <h4 class="widget-title">Legal</h4>
                                        <ul>
                                            <li > 
                                                <a href="<?php echo base_url("privacypolicy"); ?>">Privacy Policy</a>
                                            </li>
                                                <li > 
                                                    <a href="<?php echo base_url("terms_and_condition"); ?>">Terms And Conditions</a>
                                            </li>
                                                <li > 
                                                    <a href="<?php echo base_url("refund_cancel"); ?>">Refund And Cancellation</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class=" footer-widget widget">
                                    <div class="footer-widget widget widget_nav_menu">
                                        <h4 class="widget-title">Fintech</h4>
                                        <ul>
                                            <?php if($template['fintech']) { 
                                                foreach($template['fintech'] as $fitec) { ?>
                                                <li > 
                                                    <a href="<?php echo base_url("fintech/".$fitec['fintech_name']."/".$fitec['id']); ?>"><?php echo $fitec['fintech_name']; ?></a>
                                                </li>
                                            <?php  } } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class=" footer-widget widget">
                                    <div class="footer-widget widget widget_nav_menu">
                                        <h4 class="widget-title">Solution</h4>
                                        <ul>
                                            <?php if($template['solution']) { 
                                                foreach($template['solution'] as $soln) { ?>
                                                <li > 
                                                    <a href="<?php echo base_url("solution/".$soln['solution_name']."/".$soln['id']); ?>"><?php echo $soln['solution_name']; ?></a>
                                                </li>
                                            <?php  } } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class=" footer-widget widget">
                                    <div class="footer-widget widget widget_nav_menu">
                                        <h4 class="widget-title">Partners</h4>
                                        <ul>
                                            <?php if($template['partnersType']) { 
                                                foreach($template['partnersType'] as $partType) { ?>
                                                <li > 
                                                <a href="<?php echo base_url("partner/".$partType['partnersType']); ?>"><?php echo $partType['partnersType']; ?></a>    
                                                </li>
                                            <?php  } } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-item">
                        <div class="copyright-area-inner">
                            <?php echo $template['footer_copy']; ?>  <a href="<?php echo $template['footer_link']; ?>"><?php echo $template['developed_by']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="<?php echo base_url(); ?>/assets/theme/common/js/countdown.jquery.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/dynamic-script.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/jquery.magnific-popup.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/jquery.waypoints.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/jquery.counterup.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/jQuery.rProgressbar.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/jquery.mb.YTPlayer.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/main.js"></script>

    <script>
    $(document).ready(function () {

        var delayTime = "10000";
        var popupBackdrop =  $('.nx-popup-backdrop');
        var popupWrapper =  $('.nx-popup-wrapper');

        delayTime = delayTime ? delayTime : 4000;


        if (getCookie('nx_popup_show') == '') {
            setTimeout(function () {
                popupBackdrop.addClass('show');
                popupWrapper.addClass('show');

            }, parseInt(delayTime));
        }

        $(document).on('click', '.nx-popup-close,.nx-popup-backdrop', function (e) {
            e.preventDefault();
            $('.nx-modal-content').html('');
            popupBackdrop.removeClass('show');
            popupWrapper.removeClass('show');
            setCookie('nx_popup_show', 'no', 1);
        });

        var offerTime = "2020-09-30";
        var year = offerTime.substr(0, 4);
        var month = offerTime.substr(5, 2);
        var day = offerTime.substr(8, 2);
        if (offerTime && $('#countdown').length > 0) {
            $('#countdown').countdown({
                year: year,
                month: month,
                day: day,
                labels: true,
                labelText: {
                    'days': "days",
                    'hours': "hours",
                    'minutes': "min",
                    'seconds': "sec",
                }
            });
        }
    });
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/62bec08f7b967b1179977f4b/1g6si0dbc';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/jquery.ihavecookies.min.js"></script>
        <script>
        $(document).ready(function () {
            var delayTime = "5000";
            delayTime = delayTime ? delayTime : 4000; 
            $('body').ihavecookies({
                title: "Cookies &amp; Privacy",
                message: `We use cookies to improve your experience on our site and to show you relevant advertising To find out more, read our updated privacy policy and cookie policy.`,
                expires: "30",
                link: "<?php echo base_url("privacypolicy"); ?>",
                delay: delayTime,
                moreInfoLabel: "More information",
                acceptBtnLabel: "Accept",
            });
            $('body').on('click', '#gdpr-cookie-close', function (e) {
                e.preventDefault();
                $(this).parent().remove();
            });
        });
    </script>
    <script src="../../../www.google.com/recaptcha/api26e1.js?render=6LdvUeQUAAAAAHKM02AWBjtKAAL0-AqUk_qkqa0O"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute("6LdvUeQUAAAAAHKM02AWBjtKAAL0-AqUk_qkqa0O", {action: 'homepage'}).then(function (token) {
                if(document.getElementById('gcaptcha_token') != null){
                    document.getElementById('gcaptcha_token').value = token;
                }
            });
        });
    </script>
<script>
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    (function ($) {
        "use strict";

        var allProgress = $('.donation-progress');
        $.each(allProgress, function (index, value) {
            $(this).rProgressbar({
                percentage: $(this).data('percent'),
                fillBackgroundColor: "#06A3DA"
            });
        })

                $(window).on('scroll', function () {

            if ($(window).width() > 992) {
                /*--------------------------
                sticky menu activation
               -------------------------*/
                var st = $(this).scrollTop();
                var mainMenuTop = $('.navbar-area');
                if ($(window).scrollTop() > 1000) {
                    // active sticky menu on scrollup
                    mainMenuTop.addClass('nav-fixed');
                } else {
                    mainMenuTop.removeClass('nav-fixed ');
                }
            }
        });
                $(document).on('change', '.search-form-warp', function (e) {
            e.preventDefault();
            var el = $(this);
            var searchType = $('#search_popup_search_type').val();
            if (searchType == 'blog') {
                el.attr('action', "blog-search.html");
                el.find('.search-field').attr('name', 'search');
            } else if (searchType == 'event') {
                el.attr('action', "events-search.html");
                el.find('.search-field').attr('name', 'search');
            } else if (searchType == 'knowledgebase') {
                el.attr('action', "knowledgebase-search.html");
                el.find('.search-field').attr('name', 'search');
            } else if (searchType == 'product') {
                el.attr('action', "products.html");
                el.find('.search-field').attr('name', 'q');
            }

        });
        $(document).on('change', '#langchange', function (e) {
            $.ajax({
                url: "#",
                type: "GET",
                data: {
                    'lang': $(this).val()
                },
                success: function (data) {
                    window.location = "<?php echo base_url("index"); ?>";
                }
            })
        });
        $(document).on('click', '.newsletter-form-wrap .submit-btn', function (e) {
            e.preventDefault();
            var email = $('.newsletter-form-wrap input[type="email"]').val();
            $('.newsletter-widget .form-message-show').html('');

            $.ajax({
                url: "<?php echo base_url("index"); ?>",
                type: "POST",
                data: {
                    _token: "yt3p7eEeYRO22LsZOegPgGKFWTFcy0fnbwsv4SyS",
                    email: email
                },
                success: function (data) {
                    $('.newsletter-widget .form-message-show').html('<div class="alert alert-success">' + data + '</div>');
                },
                error: function (data) {
                    var errors = data.responseJSON.errors;
                    $('.newsletter-widget .form-message-show').html('<div class="alert alert-danger">' + errors.email[0] + '</div>');
                }
            });
        });

        $(document).on('submit', '.custom-form-builder-form', function (e) {
            e.preventDefault();
            var form = $(this);
            var formID = form.attr('id');
            var msgContainer =  form.find('.error-message');
            var formSelector = document.getElementById(formID);
            var formData = new FormData(formSelector);
            msgContainer.html('');
            $.ajax({
                url: "<?php echo base_url("index"); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': "yt3p7eEeYRO22LsZOegPgGKFWTFcy0fnbwsv4SyS",
                },
                beforeSend:function (){
                    form.find('.ajax-loading-wrap').addClass('show').removeClass('hide');
                },
                processData: false,
                contentType: false,
                data:formData,
                success: function (data) {
                    form.find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                    msgContainer.html('<div class="alert alert-'+data.type+'">' + data.msg + '</div>');
                },
                error: function (data) {
                    form.find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                    var errors = data.responseJSON.errors;
                    var markup = '<ul class="alert alert-danger">';
                    $.each(errors,function (index,value){
                        markup += '<li>'+value+'</li>';
                    })
                    markup += '</ul>';
                    msgContainer.html(markup);
                }
            });
        });

    }(jQuery));
</script><script src="../../../code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/frontend/js/toastr.min.js"></script>
<script>
    (function () {
        "use strict";
        $(document).on('click','.ajax_add_to_cart',function (e) {
            e.preventDefault();
            var allData = $(this).data();
            var el = $(this);
            $.ajax({
                url : "<?php echo base_url("index"); ?>",
                type: "POST",
                data: {
                    _token : "yt3p7eEeYRO22LsZOegPgGKFWTFcy0fnbwsv4SyS",
                    'product_id' : allData.product_id,
                    'quantity' : allData.product_quantity,
                },
                beforeSend: function(){
                    el.text("Adding");
                },
                success: function (data) {
                    el.html('<i class="fa fa-shopping-bag" aria-hidden="true"></i>'+"Add To Cart");
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success(data.msg);
                    $('.navbar-area .nav-container .nav-right-content ul li.cart .pcount,.mobile-cart a .pcount').text(data.total_cart_item);
                }
            });
        });


    })(jQuery);
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-173946136-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-173946136-1');
</script>

</body>
</html>

