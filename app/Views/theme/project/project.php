<section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/project.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title"><?php echo $page; ?></h1>
                    <ul class="page-list">
                        <li><a href="<?php echo base_url(); ?>">Projects</a></li>
                        <li><?php echo $page; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="page-content service-details padding-top-120 padding-bottom-115">
    <div class="container">
        <div class="row">
        <?php //print_r($project);
            foreach ($project as $proj) {
                ?>
        <div class="col-lg-1"> </div>
            <div class="col-lg-10">
                <div class="service-details-item">
                    <h1><?php echo $proj['project_name']; ?></h1>
                        <br/>
                        <div class="thumb margin-bottom-40">
                            <img style="width:700px; height: 400px;" src="<?php echo base_url(); ?>/assets/images/upload_image/project_img/<?php echo $proj['project_images']; ?>" alt="" />
                        </div>
                        <br/>
                        <div class="service-description">
                            <p><?php echo $proj['project_contents']; ?></p>
                        </div>
                        <!-- <div class="widget-nav-menu margin-bottom-30 service-category">
                            <ul>
                                <li>
                                    <a href="#" class="service-widget active">
                                        <div class="service-title">
                                            <h6 class="title">Project Name : &nbsp;&nbsp;<?php //echo $proj['project_name']; ?></h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="service-widget active">
                                        <div class="service-title">
                                            <h6 class="title">Project URL  : &nbsp;&nbsp;<?php //echo $proj['proj_url']; ?></h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="service-widget active">
                                        <div class="service-title">
                                            <h6 class="title">Complete Date : &nbsp;&nbsp;<?php //echo date('d-m-Y', strtotime($proj['proj_end_date'])); ?></h6>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            <div class="col-lg-1"> </div>
            <?php
            } ?>
        </div>
    </div>
</div>