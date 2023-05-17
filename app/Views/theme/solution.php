<section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/solution.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title"><?php echo $page; ?></h1>
                    <ul class="page-list">
                        <li><a href="#">Solution</a></li>
                        <li><?php echo $page; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<br/>
<div class="creative-agency-news-area padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle">Solution</span>
                    <h2 class="title"><?php echo $page; ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-grid-carosel-wrapper">
                    <div class="global-carousel-init logistic-dots"  data-loop="true" data-desktopitem="3"        data-mobileitem="1"     data-tabletitem="2"     data-dots="true"  data-autoplay="true"  data-margin="30">
                        <?php 
                            foreach ($solution as $soln) {
                        ?>
                            <div class="single-portfolio-blog-grid creative-agency-page">
                                <div class="thumb">
                                    <img style="height: 300px;" src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $soln['solution_image']; ?>" class="grid" alt=""/>
                                    <!-- <div class="time-wrap">
                                        <span class="date">13</span>
                                        <span class="month">Jun</span>
                                    </div> -->
                                </div>
                                <div class="content">
                                    <h4 class="title">
                                        <a href="#"><?php echo $soln['solution_subtitle']; ?></a>
                                    </h4>
                                    <p class="excerpt"><?php echo $soln['solution_content']; ?></p>
                                    <!-- <a class="readmore" href="#">Read More</a> -->
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="work-details-content-area padding-120">
    <div class="container">
        <div class="row">
            <?php 
            // $count = 1;
            //     foreach ($solution as $soln) {
            //         if ($count % 2) {
            ?>
            <div class="col-lg-6">
                <div class="portfolio-details-item">
                    <div class="thumb">
                    <img src="<?php //echo base_url(); ?>/assets/images/upload_image/<?php //echo $soln['solution_image']; ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="portfolio-details-item">
                    <div class="post-description">
                        <h2 class="title"><?php //echo $soln['solution_subtitle']; ?></h2>
                        <p><?php //echo $soln['solution_content']; ?></p>
                    </div>
                </div>
            </div>
            <?php //} else { ?>
            <div class="col-lg-6">
                <div class="portfolio-details-item">
                    <div class="post-description">
                        <h2 class="title"><?php //echo $soln['solution_subtitle']; ?></h2>
                        <p><?php //echo $soln['solution_content']; ?></p>
                        </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="portfolio-details-item">
                    <div class="thumb">
                    <img src="<?php //echo base_url(); ?>/assets/images/upload_image/<?php //echo $soln['solution_image']; ?>" alt="">
                    </div>
                </div>
            </div>
            <?php
            //      }
            //      $count++;  
            //  }
            ?>
        </div>
    </div>
</div> -->