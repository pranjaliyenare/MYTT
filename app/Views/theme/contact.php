
    <section class="breadcrumb-area breadcrumb-bg navbar-variant-01"
        style="background-image: url(assets/theme/uploads/media-uploader/011589562979.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="page-title"><?php echo $title; ?></h1>
                        <ul class="page-list">
                            <li><a href="<?php echo base_url("index"); ?>">Home</a></li>
                            <li><?php echo $title; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="inner-contact-section padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                        <div class="single-contact-item">
                            <div class="icon style-01">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div class="content">
                                <span class="title">Email Address</span>
                                <p class="details"><?php echo $email; ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 col-lg-3">
                        <div class="single-contact-item">
                            <div class="icon style-02">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="content">
                                <span class="title">Phone</span>
                                <p class="details"><?php echo $mobile; ?></p>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-6 col-lg-4">
                        <div class="single-contact-item">
                            <div class="icon style-03">
                                <i class="far fa-clock"></i>
                            </div>
                            <div class="content">
                                <span class="title">Open Hours</span>
                                <p class="details">Mon - Sat</p>
                                <p class="details">10AM - 6PM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="single-contact-item">
                            <div class="icon style-04">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="content">
                                <span class="title">Location</span>
                                <p class="details"><?php echo $address; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="contact-section padding-bottom-120">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h5>If you have any questions about our Returns and Refunds Policy, please contact us:</h5>
                                </div>
                            </div>
                        </div>
                        <form action="<?php echo base_url('Theme/send_message'); ?>" method="POST" class="contact-page-form" enctype="multipart/form-data">
                        <?php 
                            // Display Response
                            if(session()->has('message')){
                            ?>
                                <div class="alert <?= session()->getFlashdata('alert-class') ?>">
                                <?= session()->getFlashdata('message') ?>
                                </div>
                            <?php
                            }
                        ?>
                        <input type="hidden" name="_token" value="yt3p7eEeYRO22LsZOegPgGKFWTFcy0fnbwsv4SyS">    
                        <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            <div class="form-group" style="display: none;"> 
                                <input type="text" name="support_email" class="form-control border-0 bg-light px-4" value="<?php echo $email; ?>" style="height: 55px;">
                            </div>
                             <div class="form-group"> 
                                 <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" >
                            </div> 
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required="required">
                            </div> 
                             <div class="form-group"> 
                                 <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone" >
                            </div> 
                            <div class="form-group textarea">
                                <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Message" ></textarea>
                            </div>
                            <div class="btn-wrapper">
                                <button type="submit" class="boxed-btn reverse-color">Send Message</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact_map">
                        <div class="elementor-custom-embed"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30267.343496932564!2d73.85416195233189!3d18.51000641583206!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c014271918c5%3A0xfa3ce63f0c494d3f!2sSwargate%2C%20Pune%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1657364466334!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  