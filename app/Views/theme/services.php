<style>
    .fadeRight {
        animation: fadeInRight 1s ease-in-out;
    }

    .fadeLeft {
        animation: fadeInLeft 1s ease-in-out;
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(300px);
        }
        to {
            opacity: 1;
        }
    }
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-300px);
        }
        to {
            opacity: 1;
        }
    }


</style>
<section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/service_banner.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title"><?php echo $page; ?></h1>
                    <ul class="page-list">
                        <li><a href="<?php echo base_url('service');?>">Services</a></li>
                        <li><?php echo $page; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="work-details-content-area padding-120">
    <div class="container">
        <div class="row">
            <?php $count = 1;
                foreach ($service as $serv) {
                    if ($count % 2) {
            ?>
            <div class="col-lg-6 fadeLeft">
                <div class="portfolio-details-item">
                    <div class="thumb">
                        <img src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $serv['service_image']; ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 fadeRight">
                <div class="portfolio-details-item">
                    <div class="post-description">
                        <h2 class="title"><?php echo $serv['service_subtitle']; ?></h2>
                        <p><?php echo $serv['service_content']; ?></p>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="col-lg-6">
                <div class="portfolio-details-item">
                    <div class="post-description">
                        <h2 class="title"><?php echo $serv['service_subtitle']; ?></h2>
                        <p><?php echo $serv['service_content']; ?></p>
                        </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="portfolio-details-item">
                    <div class="thumb">
                    <img src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $serv['service_image']; ?>" alt="">
                    </div>
                </div>
            </div>
            <?php
                 } 
                 $count++; 
             }
            ?>

            <!-- Start Service List -->
                <div class="col-lg-12">
                    <div class="related-work-area padding-top-100">
                        <div class="section-title margin-bottom-30">
                            <h2 class="title">Service List</h2>
                        </div>
                        <div class="related-case-study-carousel global-carousel-init" data-loop="true" data-desktopitem="3"   data-mobileitem="1"  data-tabletitem="1"   data-nav="true"  data-autoplay="true" data-margin="40" >                            
                        <?php if($template['service']) { 
                            foreach($template['service'] as $serv) { ?>
                            <div class="single-related-case-study-item">
                                <div class="thumb">
                                    <img src="<?php echo base_url(); ?>/assets/images/upload_image/service.jpg"  alt=""/>
                                </div>
                                <div class="content">
                                    <h4 class="title"><a href="#"> <?php echo $serv['service_name']; ?></a></h4>
                                </div>
                            </div>
                        <?php  } } ?>
                        </div>
                    </div>
                </div>
            <!-- End Service List -->
        </div>
    </div>
</div>