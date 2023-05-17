<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

@media only screen and (max-width: 600px) {
    .wrapper {
    display: flex;
    }
    .wrapper .static-txt {
    color: #1c4680;
    font-size: 60px;
    font-weight: 400;
    }
    .wrapper .dynamic-txts {
    margin-left: 15px;
    height: 90px;
    line-height: 90px;
    overflow: hidden;
    }
    .dynamic-txts li {
    list-style: none;
    color: #06a3da;
    font-size: 30px;
    font-weight: 500;
    position: relative;
    top: 0;
    animation: slide 12s steps(4) infinite;
    width: 400px;
    }
    @keyframes slide {
    100%{
        top: -360px;
    }
    }
    .dynamic-txts li span {
    position: relative;
    margin: 5px 0;
    line-height: 90px;
    }
    .dynamic-txts li span::after {
    content: "";
    position: absolute;
    left: 0;
    height: 100%;
    width: 100%;
    background: #ffffff;
    border-left: 2px solid #06a3da;
    animation: typing 3s steps(10) infinite;
    margin-top: 20px;
    }
    @keyframes typing {
    40%, 60%{
        left: calc(100% + 30px);
    }
    100%{
        left: 0;
    }
    }
}

@media only screen and (min-width: 768px) {
    .wrapper {
    display: flex;
    }
    .wrapper .static-txt {
    color: #1c4680;
    font-size: 60px;
    font-weight: 400;
    }
    .wrapper .dynamic-txts {
    margin-left: 15px;
    height: 90px;
    line-height: 90px;
    overflow: hidden;
    }
    .dynamic-txts li {
    list-style: none;
    color: #06a3da;
    font-size: 50px;
    font-weight: 500;
    position: relative;
    top: 0;
    animation: slide 12s steps(4) infinite;
    width: 400px;
    }
    @keyframes slide {
    100%{
        top: -360px;
    }
    }
    .dynamic-txts li span {
    position: relative;
    margin: 5px 0;
    line-height: 90px;
    }
    .dynamic-txts li span::after {
    content: "";
    position: absolute;
    left: 0;
    height: 100%;
    width: 100%;
    background: #ffffff;
    border-left: 2px solid #06a3da;
    animation: typing 3s steps(10) infinite;
    }
    @keyframes typing {
    40%, 60%{
        left: calc(100% + 30px);
    }
    100%{
        left: 0;
    }
    }
}

</style>

    <div class="cagency-header-static">
        <div class="header-area">
            <div class="shape-image shape-01">
                <img src="<?php echo base_url(); ?>/assets/theme/frontend/img/shape/08.png" alt="">
            </div>
            <div class="shape-image shape-02">
                <img src="<?php echo base_url(); ?>/assets/theme/frontend/img/shape/09.png" alt="">
            </div>
            <div class="shape-image shape-03">
                <img src="<?php echo base_url(); ?>/assets/theme/frontend/img/shape/10.png" alt="">
            </div>
            <div class="right-image">
                <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/home.png"  alt=""/>
                <div class="shape-04">
                    <img src="<?php echo base_url(); ?>/assets/theme/frontend/img/shape/11.png" alt="">
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-10">
                        <div class="header-inner"><div class="wrapper">
                            <!-- <div class="static-txt">Services</div> -->
                            <ul class="dynamic-txts">
                            <?php if($template['service']) { 
                                foreach($template['service'] as $serv) { ?>
                                    <li><span><?php echo $serv['service_name']; ?></span></li>
                            <?php  } } ?> 
                            </ul>
                        </div>
                        <div class="description">My Think Tank Multimedia Pvt Ltd. is currently working in the direction of, maximizing user experience and ease with IT. We put a constant effort in providing services that help businesses grow and configure easy and efficient functioning of processes and operations. We understand the hurdles in carrying out a business and develop strategies and measures that can prove to be helpful, our internet services are spread in more than 6 states with 50,000 happy customers, and our IPTV solutions are provided to more than 50 broadband companies.</div>
                                <div class="btn-wrapper margin-top-30">
                                    <a href="contact" class="cagency-btn">Contact Us <i class="far fa-comments"></i></a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="logistics-what-we-offer-area padding-top-115 padding-bottom-20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center padding-bottom-100">
                    <span class="subtitle">OUR SERVICES</span>
                    <h2 class="title">We Customise IT Solutions for Your Business to grow up</h2>
                </div>
            </div>
        </div>
        <div class="row">
                                        <div class="col-lg-4 col-md-6">
                    <div class="cagency-single-what-we-cover-item margin-bottom-30">
                                                    <div class="icon style-1">
                                <i class="fa fa-cogs"></i>
                            </div>
                                                <div class="content" style="height: 350px;">
                            <h4 class="title"><a href="service">Services</a></h4>
                            <p>We provide a different services like IPTV/ OTT Solutions, FTA Channels, Web Development, App Development, CRM, E-Commerce, Business Mentorship, and Services, with cost-efficient plans and opportunities to fulfill your diverse needs with a staff that specializes in the varied departments and fields. </p>
                            <!-- <a href="service" class="readmore">Read More <i class="fas fa-long-arrow-alt-right"></i></a> -->
                        </div>
                    </div>
                </div>
                                           <div class="col-lg-4 col-md-6">
                    <div class="cagency-single-what-we-cover-item margin-bottom-30">
                                                    <div class="icon style-2">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                                                <div class="content" style="height: 350px;">
                            <h4 class="title"><a href="service">Projects</a></h4>
                            <p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero.</p>
                            <!-- <a href="service" class="readmore">Read More <i class="fas fa-long-arrow-alt-right"></i></a> -->
                        </div>
                    </div>
                </div>
                                           <div class="col-lg-4 col-md-6">
                    <div class="cagency-single-what-we-cover-item margin-bottom-30">
                                                    <div class="icon style-3">
                                <i class="fas fa-chart-line"></i>
                            </div>
                                                <div class="content" style="height: 350px;">
                                    <h4 class="title"><a href="service">Fintech</a></h4>
                                    <p>Financial technology (better known as Fintech) is used to describe new tech that seeks to improve and automate the delivery and use of financial services​,​ Like Trading Platform Software Development Services, Crowdfunding Software Development Solution, Money Transfer Software etc.</p>
                            <!-- <a href="service" class="readmore">Read More <i class="fas fa-long-arrow-alt-right"></i></a> -->
                        </div>
                    </div>
                </div>
                                           <div class="col-lg-4 col-md-6">
                    <div class="cagency-single-what-we-cover-item margin-bottom-30">
                                                    <div class="icon style-4">
                                <i class="fas fa-check-double"></i>
                            </div>
                                                <div class="content" style="height: 350px;">
                            <h4 class="title"><a href="service">Solutions</a></h4>
                            <p>Our Experts help with the dynamic business mentorship and ideas to help your business reach heights and provide options for seed funding and long-term development projects to make investments and business easier. </p>
                            <!-- <a href="service" class="readmore">Read More <i class="fas fa-long-arrow-alt-right"></i></a> -->
                        </div>
                    </div>
                </div>
                                           <div class="col-lg-4 col-md-6">
                    <div class="cagency-single-what-we-cover-item margin-bottom-30">
                                                    <div class="icon style-5">
                                <i class="fas fa-search"></i>
                            </div>
                                                <div class="content" style="height: 350px;">
                            <h4 class="title"><a href="service">SEO Optimization</a></h4>
                            <p>Maximizing your existing reach with organic techniques and helping you connect with the right audience for your business.</p>
                            <!-- <a href="service" class="readmore">Read More <i class="fas fa-long-arrow-alt-right"></i></a> -->
                        </div>
                    </div>
                </div>
                                           <div class="col-lg-4 col-md-6">
                    <div class="cagency-single-what-we-cover-item margin-bottom-30">
                                                    <div class="icon style-6">
                                <i class="fas fa-arrow-alt-circle-right"></i>
                            </div>
                                                <div class="content" style="height: 350px;">
                            <h4 class="title"><a href="service">Read More</a></h4>
                            <p>For more information please check total website.</p>
                            <!-- <a href="service" class="readmore">Read More <i class="fas fa-long-arrow-alt-right"></i></a> -->
                        </div>
                    </div>
                </div>
                                   </div>
    </div>
</div>
<div class="logistic-video-area-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logistic-video-wrap" style="box-shadow: rgb(0 0 0 / 56%) 0px 2px 20px 4px;">
                     <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/video_image.JPG"  alt=""/>
                    <a href="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/MYTT_EXHIBITION.mp4" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
                    <!-- <video width="100%" controls>
                        <source src="<?php //echo base_url(); ?>/assets/theme/uploads/media-uploader/MYTT_EXHIBITION.mp4" type="video/mp4">
                    </video> -->
                    <div class="shape">
                        <img src="<?php echo base_url(); ?>/assets/theme/frontend/img/shape/11.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cagency-counterup-area bg-overlay padding-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                    <div class="cagency-counterup-item">
                        <div class="number style-1">
                            <div class="count-wrap"><span class="count-num"> 50,000</span>+</div>
                        </div>
                        <div class="content">
                            <h4 class="title">Happy Customer</h4>
                        </div>
                    </div>
                </div>
                            <div class="col-lg-3 col-md-6">
                    <div class="cagency-counterup-item">
                        <div class="number style-2">
                            <div class="count-wrap"><span class="count-num">150</span>+</div>
                        </div>
                        <div class="content">
                            <h4 class="title">Websites And Software</h4>
                        </div>
                    </div>
                </div>
                            <div class="col-lg-3 col-md-6">
                    <div class="cagency-counterup-item">
                        <div class="number style-3">
                            <div class="count-wrap"><span class="count-num">50</span></div>
                        </div>
                        <div class="content">
                            <h4 class="title">Employees</h4>
                        </div>
                    </div>
                </div>
                            <div class="col-lg-3 col-md-6">
                    <div class="cagency-counterup-item">
                        <div class="number style-4">
                            <div class="count-wrap"><span class="count-num">37</span></div>
                        </div>
                        <div class="content">
                            <h4 class="title">Total Agents</h4>
                        </div>
                    </div>
                </div>
                    </div>
    </div>
</div>

    <div class="creative-agency-call-to-action padding-100">
        <div class="shape shape-01">
            <img src="<?php echo base_url(); ?>/assets/theme/frontend/img/shape/01.png" alt="">
        </div>
        <div class="shape shape-02">
            <img src="<?php echo base_url(); ?>/assets/theme/frontend/img/shape/02.png" alt="">
        </div>
        <div class="shape shape-03">
            <img src="<?php echo base_url(); ?>/assets/theme/frontend/img/shape/03.png" alt="">
        </div>
        <div class="shape shape-04">
            <img src="<?php echo base_url(); ?>/assets/theme/frontend/img/shape/04.png" alt="">
        </div>
        <div class="shape shape-05">
            <img src="<?php echo base_url(); ?>/assets/theme/frontend/img/shape/05.png" alt="">
        </div>
        <div class="right-image-wrap" style="right:-1%; top: 100px;">
            <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/aboutUS.png"  alt=""/>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-10">
                    <div class="cagency-cta-area-inner">
                        <h2 class="title">About</h2>
                        <p class="description">My Think Tank Multimedia Pvt Ltd, was established in 2021 as a sister company of HAASH Group, incorporated in 2014 has operations and businesses varied in multiple arenas ranging from Wealth Management, IPTV/OTT Solutions, Embedding Entrepreneurship, Complete IT Solutions, Real Estate, Digital Marketing, and Internet Services Accommodator.</p>
                        <p class="description">We have successfully widened our operations to over 5 states with 50,000 happy users of our internet services and designed over 150+ websites and software, a team of more than 50 employees that specializes to fit into your diverse needs and expectations from Long Term Projects.</p>
                        <div class="btn-wrapper margin-top-30">
                            <a href="<?php echo base_url(); ?>/quote" class="cagency-btn">Get Quote <i class="far fa-comments"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="creative-agency-work-process-area padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle">Journey</span>
                    <h2 class="title">Work Process</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="cagency-work-process-list">
                                                            <li class="single-work-process-item">
                        <div class="num-wrap style-1">
                            <span class="number">1</span>
                        </div>
                        <h4 class="title">PLANNING</h4>
                    </li>
                                        <li class="single-work-process-item">
                        <div class="num-wrap style-2">
                            <span class="number">2</span>
                        </div>
                        <h4 class="title">DESIGN</h4>
                    </li>
                                        <li class="single-work-process-item">
                        <div class="num-wrap style-3">
                            <span class="number">3</span>
                        </div>
                        <h4 class="title">DEVELOPMENT</h4>
                    </li>
                                        <li class="single-work-process-item">
                        <div class="num-wrap style-4">
                            <span class="number">4</span>
                        </div>
                        <h4 class="title">TESTING</h4>
                    </li>
                                        <li class="single-work-process-item">
                        <div class="num-wrap style-5">
                            <span class="number">5</span>
                        </div>
                        <h4 class="title">HOSTING</h4>
                    </li>
                                    </ul>
            </div>
        </div>
    </div>
</div> 
<div class="creative-agency-testimonial-area padding-top-115 padding-bottom-120" style="padding-top: 10px; padding-bottom: 10px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle">Testimonial</span>
                    <h2 class="title">Clients Says</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-carousel-area margin-top-10 ">
                    <div class="global-carousel-init logistic-dots" data-loop="true" data-desktopitem="3"   data-mobileitem="1" data-tabletitem="2"data-dots="true" data-autoplay="true" data-margin="30">
                                                    <div class="cagency-single-testimonial-item">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description ">Well qualified professionals at service, always ready to suggest and implement changes in a web design, customer experience is the priority at My Think Tank</p>
                                </div>
                               <div class="author-details">
                                   <div class="thumb ">
                                       <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/user1.png"  alt=""/>
                                   </div>
                                   <div class="content">
                                       <!-- <h4 class="title ">Sheree Derouen</h4> -->
                                       <span class="designation ">Customer</span>
                                   </div>
                               </div>
                            </div>
                                                    <div class="cagency-single-testimonial-item">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description ">Amazing service and excellent team to provide with the best desirable app and logo design, team was very cooperative when it came to alterations</p>
                                </div>
                               <div class="author-details">
                                   <div class="thumb ">
                                       <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/user5.png"  alt=""/>
                                   </div>
                                   <div class="content">
                                       <!-- <h4 class="title ">Elvira Siebert</h4> -->
                                       <span class="designation ">Customer</span>
                                   </div>
                               </div>
                            </div>
                                                    <div class="cagency-single-testimonial-item">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description ">Easy transaction process with real estate dealings, very quick service and safe trustworthy deals</p><br><br>
                                </div>
                               <div class="author-details">
                                   <div class="thumb ">
                                       <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/user3.jpg"  alt=""/>
                                   </div>
                                   <div class="content">
                                       <!-- <h4 class="title ">Siful Islam</h4> -->
                                       <span class="designation ">Customer</span>
                                   </div>
                               </div>
                            </div>
                            <div class="cagency-single-testimonial-item">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description ">A to Z tech solutions, from establishing the business to ensuring a system which makes operations easier and reliable</p><br>
                                </div>
                               <div class="author-details">
                                   <div class="thumb ">
                                       <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/user4.jpg"  alt=""/>
                                   </div>
                                   <div class="content">
                                       <!-- <h4 class="title ">Olivia Hamel</h4> -->
                                       <span class="designation ">Customer</span>
                                   </div>
                               </div>
                            </div>
                            <div class="cagency-single-testimonial-item">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description ">Went for the Franchise model, and it is by far the most effective and well handled model, the customer service is well managed and quick service is company’s priority</p>
                                </div>
                               <div class="author-details">
                                   <div class="thumb ">
                                       <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/user2.png"  alt=""/>
                                   </div>
                                   <div class="content">
                                       <!-- <h4 class="title ">Olivia Hamel</h4> -->
                                       <span class="designation ">Customer</span>
                                   </div>
                               </div>
                            </div>
                            
                            <div class="cagency-single-testimonial-item">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description ">Amazing website delivered well before the quoted date of delivery, made by very knowledgeable individuals in the subject</p><br/>
                                </div>
                               <div class="author-details">
                                   <div class="thumb ">
                                       <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/user6.png"  alt=""/>
                                   </div>
                                   <div class="content">
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

<div class="modal fade home-variant-19 quick_view_modal" id="quick_view" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content p-5">
<div class="quick-view-close-btn-wrapper">
<button class="quick-view-close-btn close" data-dismiss="modal"><i class="fas fa-times"></i></button>
</div>
<div class="row">
<div class="col-md-12">
<div class="product_details">
<div class="row">
<div class="col-lg-6">
<div class="product-view-wrap product-img">
<ul class="other-content">
<li>
<span class="badge-tag image_category"></span>
</li>
</ul>
<img src="" alt="" class="img_con">
</div>
</div>
<div class="col-lg-6">
<div class="product-summery">

<h3 class="product-title title"></h3>
<div>
<span class="availability is_available text-success"></span>
</div>
<div class="price-wrap">
<span class="price sale_price font-weight-bold"></span>
<del class="del-price del_price regular_price"></del>
</div>
<div class="rating-wrap ratings" style="display: none">
<i class="fa fa-star icon"></i>
<i class="fa fa-star icon"></i>
<i class="fa fa-star icon"></i>
<i class="fa fa-star icon"></i>
<i class="fa fa-star icon"></i>
</div>
<div class="short-description">
<p class="info short_description"></p>
</div>
<div class="cart-option"><div class="user-select-option">
</div>
<div class="d-flex">
<div class="input-group">
<input class="quantity form-control" type="number" min="1" max="10000000" value="1" id="quantity_single_quick_view_btn">
</div>
<div class="btn-wrapper">
<a href="#" data-attributes="[]" class="btn-default rounded-btn add-cart-style-02 add_cart_from_quick_view ajax_add_to_cart" data-product_id="" data-product_title="" data-product_quantity="">
Add to cart
</a>
</div>
</div>
 </div>
<div class="category">
<p class="name">Category: </p>
<a href="" class="product_category"></a>
</div>
<div class="product-details-tag-and-social-link">
<div class="tag d-flex">
<p class="name">Subcategory: </p>
<div class="subcategory_container">
<a href="" class="tag-btn product_subcategory" rel="tag"></a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>