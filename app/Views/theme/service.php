
<section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/011589562979.png);">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-inner">
                <h1 class="page-title">Service</h1>
                <ul class="page-list">
                   <li><a href="<?php echo base_url('index'); ?>">Home</a></li>
                   <li>Service</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>
    <section class="service-area service-page padding-120">
        <div class="container">
            <div class="row">
            <?php if($template['service_content']) { 
                foreach($template['service_content'] as $servCont) { ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-what-we-cover-item-02 margin-bottom-30">
                            <div class="single-what-img">
                                <img style="width: 500px; height: 250px;" src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $servCont['service_image']; ?>"  alt=""/>
                            </div>
                            <!-- <div class="icon-02 style-01">
                                <i class="flaticon-cloud-2"></i>
                            </div> -->
                            <div class="content">
                                <a href="<?php echo base_url("services/".$servCont['sub_service_name']); ?>"><h4 class="title"><?php echo $servCont['sub_service_name']; ?></h4></a>
                                <!-- <p>Financial investment in a company for Expansion and consult to Eliminate the Guesswork & Confidently scale startup with proven system.</p> -->
                            </div>
                        </div> 
                    </div>
                <?php  } } ?> 
            </div>
        </div>
    </section>
