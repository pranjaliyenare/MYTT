<style>
    .creative-agency-call-to-action .shape.shape-01 {
        top : 10px;
    }
</style>

    <section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/youth_banner.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="page-title"><?php echo $page; ?></h1>
                        <ul class="page-list">
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li><?php echo $page; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="creative-agency-call-to-action padding-100">
         <div class="shape shape-01">
            <img src="<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/011589562979.png" alt="">
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
       
        <div class="container">
            <div class="row">
              <?php $count = 1; if($youth) { 
                    foreach($youth as $youthEmp) {
                    if ($count % 2) {
                    ?>
                    
                    <div class="col-xl-6 col-lg-12">
                        <div class="cagency-cta-area-inner">
                            <img src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $youthEmp['youth_Img']; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12" >
                        <div class="section-title">
                            <span class="subtitle"><?php echo $youthEmp['youth_Title']; ?></span>
                            <h4 class="title"><?php echo $youthEmp['youth_Subtitle']; ?></h4>
                        </div>
                        <div class="content">
                            <p class="description"><?php echo $youthEmp['youth_Content']; ?></p>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="col-xl-6 col-lg-12" >
                        <div class="section-title">
                            <span class="subtitle"></span>
                            <h4 class="title"><?php echo $youthEmp['youth_Subtitle']; ?></h4>
                        </div>
                        <div class="content">
                            <p class="description"><?php echo $youthEmp['youth_Content']; ?></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="cagency-cta-area-inner">
                            <img src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $youthEmp['youth_Img']; ?>" alt="">
                        </div>
                    </div>
                <?php } 
                 $count++; 
                 } } ?>
            </div>
        </div>
    </div>