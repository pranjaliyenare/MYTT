    <style>
        .grid {
            width: 300px;
            height: 250px;
        }
        
    </style>

<section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/partner.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title"><?php echo $page; ?></h1>
                    <ul class="page-list">
                        <li><a href="<?php echo base_url('index'); ?>">Home</a></li>
                        <li> Partners</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="creative-agency-news-area padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle"></span>
                    <h2 class="title"><?php echo $title; ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-grid-carosel-wrapper">
                    <div class="global-carousel-init logistic-dots" data-loop="true" data-desktopitem="3" data-mobileitem="1" data-tabletitem="2" data-dots="true" data-autoplay="true" data-margin="30">
                        <?php $i = 0; if($partner): ?>
                          <?php foreach($partner as $ourpart): ?>
                                <div class="single-portfolio-blog-grid creative-agency-page">
                                    <div class="thumb">
                                        <img style="float:right;" src="<?php echo base_url(); ?>/assets/images/upload_image/partners/<?php echo $ourpart['partners_logo']; ?>" class="grid" alt="" />
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            <a href="<?php if($ourpart['partners_link']) {
                                                echo $ourpart['partners_link'];
                                            } else { echo "#";} ?>" target="_blank"><?php echo $ourpart['partners_name']; ?></a>
                                        </h4>
                                        <p class="excerpt"><?php echo $ourpart['partners_contents']; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>