    <section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/fintech.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="page-title"><?php echo $page; ?></h1>
                        <ul class="page-list">
                            <li><a href="<?php echo base_url('fintech');?>">Fintech</a></li>
                            <li><?php echo $page; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="work-details-content-area padding-120">
        <div class="container">
            <div class="row" style="padding-bottom: 20px;">
                <?php $count = 1;
                    foreach ($fintech as $fin) {
                        if ($count % 2) {
                ?>
                <div class="col-lg-6">
                    <div class="portfolio-details-item">
                        <div class="thumb">
                        <img src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $fin['fintech_img']; ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="portfolio-details-item">
                        <div class="post-description">
                            <h2 class="title"><?php echo $fin['fintech_sub']; ?></h2>
                            <p><?php echo $fin['fintech_content']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
                <?php } else { ?>
            <div class="row" style="padding-bottom: 20px;">
                <div class="col-lg-6">
                    <div class="portfolio-details-item">
                        <div class="post-description">
                            <h2 class="title"><?php echo $fin['fintech_sub']; ?></h2>
                            <p><?php echo $fin['fintech_content']; ?></p>
                            </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="portfolio-details-item">
                        <div class="thumb">
                        <img src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $fin['fintech_img']; ?>" alt="">
                        </div>
                    </div>
                </div>
                <?php
                    }
                    $count++;  
                }
                ?>
            </div>
        </div>
    </div>
    
    <?php if($fintch_feature) { ?>
    <section class="knowledgebase-content-area padding-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="main-title" style="text-align: center;">Our Features</h4>
                    <div class="row">
                        <?php foreach ($fintch_feature as $fin) { 
                           if($fin['fintech_id'] == $id) {
                        ?>
                            <div class="col-lg-4">
                                <div class="article-with-topic-title-style-01">
                                    <h4 class="topic-title"><i class="fas fa-certificate base-color"></i>  <?php echo $fin['title']; ?></h4>
                                    <ul class="know-articles-list">
                                        <li><i class="far fa-file-alt"></i>  <?php echo $fin['content']; ?></li>
                                    </ul>
                                </div>
                            </div>  
                        <?php } } ?>                      
                    </div>
                </div>                
            </div>
        </div>
    </section>
    <?php } ?>