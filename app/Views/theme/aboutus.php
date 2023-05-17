
    <section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(assets/images/upload_image/about.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="page-title">About</h1>
                        <ul class="page-list">
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li> About</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="top-experience-area padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="experience-author padding-bottom-100">
                        <div class="thumb-1">
                            <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/about2.png"  alt=""/>
                        </div>
                        <div class="thumb-2">
                            <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/about1.jpg"  alt=""/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 p-0">
                    <div class="experience-content-03">
                        <div class="content section-title padding-bottom-100">
                            <span class="subtitle"><?php echo $title; ?></span>
                            <h2 class="title"><?php echo $subtitle; ?></h2>
                            <p><?php echo $content; ?></p>
                            <br/>
                            <div class="icon-area">
                                <div class="icon">
                                    <i class="flaticon-right-quote-1"></i>
                                </div>
                                <p>We Nurture Your Future.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="header-bottom-area padding-bottom-80 padding-top-80">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-header-bottom-item-02">
                        <div class="icon style-01">
                            <i class="flaticon-network"></i>
                        </div>
                        <div class="content">
                            <h4 class="title">Provide all kind of it service</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-header-bottom-item-02">
                        <div class="icon style-02">
                            <i class="flaticon-safe"></i>
                        </div>
                        <div class="content">
                            <h4 class="title">Solutions for all security</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-header-bottom-item-02">
                        <div class="icon style-03">
                            <i class="flaticon-group"></i>
                        </div>
                        <div class="content">
                            <h4 class="title">Most expert peoples</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-header-bottom-item-02">
                        <div class="icon style-04">
                            <i class="flaticon-translate"></i>
                        </div>
                        <div class="content">
                            <h4 class="title">Global support for all</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="global-network-area bg-liteblue padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="global-content">
                        <h2 class="title">
                            We Have Global Network Of Clients
                        </h2>
                        <p>
                        We have successfully widened our operations to over 5 states with 50,000 happy users of our internet services and designed over 150+ websites and software, a team of more than 50 employees that specializes to fit into your diverse needs and expectations from Long Term Projects.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map-img">
                        <img src="assets/theme/uploads/media-uploader/map1595833137.png" alt="MYTT"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $count1 = 1;
        if($story) {
            foreach ($story as $st) {
                if ($count1%2) {
    ?>
    <section class="top-experience-area bg-blue" style="line-height: 1;">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="experience-right style-01" style="background-image: url(assets/images/upload_image/<?php echo $st['our_story_image']; ?>);" >
                        <!-- <div class="vdo-btn">
                            <a class="video-play-btn mfp-iframe" href="https://www.youtube.com/watch?v=k26DOtwPN7s"><i class="fas fa-play"></i></a>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="experience-content-02">
                        <h2 class="title"><?php echo $st['our_story_title']; ?></h2>
                        <p><?php echo $st['our_story_content']; ?></p>
                        <div class="sign-area">
                            <p>Thus, the development of My Think Tank is guided to provide such help to level up to a top-notch business and investment opportunities.</p>
                            <!-- <div class="sing-img padding-top-10">
                                <img src="assets/theme/uploads/media-uploader/sign1595833298.png"  alt=""/>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } else { ?>
    <section class="top-experience-area bg-blue" style="line-height: 1;">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="experience-content-02">
                        <h2 class="title"><?php echo $st['our_story_title']; ?></h2>
                        <!-- <p>It was when our Founders Mr. Ravindra Kute and Mr. Kedar Sanghavi realized the importance of business mentorship and financial support after having faced certain difficulties themselves while running multiple companies in ISP and IT Sector. Such realization led to the development of this integrated effort to bring aid to the dynamic business requirements and to help the ones who face the same difficulties.</p> -->
                        <div class="sign-area">
                            <p><?php echo $st['our_story_content']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="experience-right style-01" style="background-image: url(assets/images/upload_image/<?php echo $st['our_story_image']; ?>);" >
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
        $count1++;
      }  
    }
    ?>

    <div class="global-network-area bg-white padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
                <?php $count2 = 1;
                if($expertise) {
                    foreach ($expertise as $expe) {
                        if ($count2 % 2) {
                ?>
                    <div class="col-lg-6">
                        <div class="global-content section-title padding-bottom-100">
                            <span class="subtitle"><?php if($expe['our_expertise_title']) { echo $expe['our_expertise_title']; }  ?></span>
                            <h2 class="title"><?php echo $expe['our_expertise_subtitle']; ?></h2>
                            <p><?php echo $expe['our_expertise_content']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="map-img">
                            <img src="assets/images/upload_image/<?php echo $expe['our_expertise_image']; ?>"  style="height:400px;" alt="Expertise">
                        </div>
                    </div>
                <?php } else { ?>
                    
                    <div class="col-lg-6">                        
                        <div class="col-lg-6">
                            <div class="map-img">
                                <img src="assets/images/upload_image/<?php echo $expe['our_expertise_image']; ?>"  style="height:400px;" alt="Expertise">
                            </div>
                        </div>
                        <div class="global-content section-title padding-bottom-100">
                            <span class="subtitle"><?php if ($expe['our_expertise_title']) {
                    echo $expe['our_expertise_title'];
                }  ?></span>
                            <h2 class="title"><?php echo $expe['our_expertise_subtitle']; ?></h2>
                            <p><?php echo $expe['our_expertise_content']; ?></p>
                        </div>
                    </div>
                <?php
                    }
                    $count2++;
                  }  
                }
                ?>
            </div>
        </div>
    </div>

    <!-- <section class="creative-team-two padding-top-110 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title desktop-center padding-bottom-55">
                        <h3 class="title">Our Team</h3>
                        <p>Lose away off why half led have near bed. At engage simple father of period others except. My giving do summer of though narrow marked at. Spring formal no county ye waited.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-carousel global-carousel-init" data-loop="true"  data-desktopitem="4"   data-mobileitem="1"   data-tabletitem="2"  data-autoplay="true"  data-margin="30">
                        <div class="team-section team-member-style-01">
                            <div class="team-img-cont">
                                <img src="assets/theme/uploads/media-uploader/011595229234.png"  alt=""/>
                                <div class="social-link">
                                    <ul>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-text">
                                <h4 class="title">Sharifur Rahman</h4>
                                <span>CEO Ir-Tech</span>
                            </div>
                        </div>
                        <div class="team-section team-member-style-01">
                            <div class="team-img-cont">
                                <img src="assets/theme/uploads/media-uploader/021595229234.png"  alt=""/>
                                <div class="social-link">
                                    <ul>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-text">
                                <h4 class="title">Olivia Hamel</h4>
                                <span>-Envato Cliente</span>
                            </div>
                        </div>
                        <div class="team-section team-member-style-01">
                            <div class="team-img-cont">
                                <img src="assets/theme/uploads/media-uploader/031595229240.png"  alt=""/>
                                <div class="social-link">
                                    <ul>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-text">
                                <h4 class="title">sharifur</h4>
                                <span>Founder</span>
                            </div>
                        </div>
                        <div class="team-section team-member-style-01">
                            <div class="team-img-cont">
                                <img src="assets/theme/uploads/media-uploader/041595229240.png"  alt=""/>
                                <div class="social-link">
                                    <ul>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-text">
                                <h4 class="title">Siful Islam</h4>
                                <span>-Envato Cliente</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimonial-area bg-image-01 padding-top-110 padding-bottom-115"
            style="background-image: url(assets/theme/uploads/media-uploader/011595833563.png);"
    >
        <div class=" container ">
            <div class="row justify-content-center ">
                <div class="col-lg-8 ">
                    <div class="section-title white desktop-center padding-bottom-20 ">
                        <h2 class="title ">Clients Testimonial</h2>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12 ">
                    <div class="testimonial-carousel-area margin-top-10 ">
                        <div class="testimonial-carousel global-carousel-init"
                             data-loop="true"
                             data-desktopitem="1"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-autoplay="true"
                             data-margin="0"
                        >
                                                            <div class="single-testimonial-item ">
                                    <div class="content style-01">
                                        <div class="thumb ">
                                            <img src="assets/theme/uploads/media-uploader/041595229240.png"  alt=""/>
                                        </div>
                                        <p class="description ">I found myself working in a true partnership that results in an extra incredible experience of us</p>
                                        <div class="author-details ">
                                            <div class="author-meta ">
                                                <h4 class="title ">Sheree Derouen</h4>
                                                <span class="designation ">Customer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="single-testimonial-item ">
                                    <div class="content style-01">
                                        <div class="thumb ">
                                            <img src="assets/theme/uploads/media-uploader/011595229234.png"  alt=""/>
                                        </div>
                                        <p class="description ">I found myself working in a true partnership that results in an extra incredible experience of us</p>
                                        <div class="author-details ">
                                            <div class="author-meta ">
                                                <h4 class="title ">Elvira Siebert</h4>
                                                <span class="designation ">Customer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="single-testimonial-item ">
                                    <div class="content style-01">
                                        <div class="thumb ">
                                            <img src="assets/theme/uploads/media-uploader/011595229234.png"  alt=""/>
                                        </div>
                                        <p class="description ">I found myself working in a true partnership that results in an extra incredible experience of us</p>
                                        <div class="author-details ">
                                            <div class="author-meta ">
                                                <h4 class="title ">Siful Islam</h4>
                                                <span class="designation ">Customer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="single-testimonial-item ">
                                    <div class="content style-01">
                                        <div class="thumb ">
                                            <img src="assets/theme/uploads/media-uploader/021595229234.png"  alt=""/>
                                        </div>
                                        <p class="description ">I found myself working in a true partnership that results in an extra incredible experience of us</p>
                                        <div class="author-details ">
                                            <div class="author-meta ">
                                                <h4 class="title ">Olivia Hamel</h4>
                                                <span class="designation ">Customer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="client-section padding-bottom-70 padding-top-85">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                        <div class="client-active-area global-carousel-init"
                             data-loop="true"
                             data-desktopitem="5"
                             data-mobileitem="2"
                             data-tabletitem="3"
                             data-autoplay="true"
                             data-margin="80"
                        >
                                                            <div class="single-brand">
                                    <div class="img-wrapper">
                                        <a href="#">                                            <img src="assets/theme/uploads/media-uploader/041591632968.png"  alt=""/>
                                              </a>                                    </div>
                                </div>
                                                            <div class="single-brand">
                                    <div class="img-wrapper">
                                                                                    <img src="assets/theme/uploads/media-uploader/031591632968.png"  alt=""/>
                                                                                </div>
                                </div>
                                                            <div class="single-brand">
                                    <div class="img-wrapper">
                                        <a href="#">                                            <img src="assets/theme/uploads/media-uploader/011591632968.png"  alt=""/>
                                              </a>                                    </div>
                                </div>
                                                            <div class="single-brand">
                                    <div class="img-wrapper">
                                                                                    <img src="assets/theme/uploads/media-uploader/021591632968.png"  alt=""/>
                                                                                </div>
                                </div>
                                                            <div class="single-brand">
                                    <div class="img-wrapper">
                                                                                    <img src="assets/theme/uploads/media-uploader/011591632968.png"  alt=""/>
                                                                                </div>
                                </div>
                                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->