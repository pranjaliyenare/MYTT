<section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(<?php echo base_url(); ?>/assets/images/upload_image/career2.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title"><?php echo $page; ?></h1>
                    <ul class="page-list">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url("career"); ?>">Career</a></li>
                        <li><?php echo $page; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if($careerContent)  { 
    foreach($careerContent as $carr) {
    ?>
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-job-details">
                        <ul class="job-meta-list">
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title"> Job Context</h4>
                                    <p><?php echo $carr['job_description'];?></p>
                                </div>
                            </li>
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title">Job Responsibility</h4>
                                    <p><?php echo $carr['Job_Responsibility'];?></p>
                                </div>
                            </li>
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title">Educational Requirement</h4>
                                    <p><?php echo $carr['Education_Required'];?></p>
                                </div>
                            </li>
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title"> Experience Requirement</h4>
                                    <p>At least <?php echo $carr['expFrom'];?>&nbsp; to <?php echo $carr['expTo'];?>&nbsp; year(s)</p>
                                </div>
                            </li>
                                                                                    <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title"> Additional Requirement</h4>
                                    <p><?php echo $carr['additional_req'];?></p>
                                </div>
                            </li>
                            <li>
                                <div class="single-job-meta-block">
                                    <h4 class="title">Others Benefits</h4>
                                    <p><?php echo $carr['benefits'];?></p>
                                </div>
                            </li>
                        </ul>
                        <div class="apply-procedure">
                            <a class="btn-boxed style-01 margin-top-30" href="<?php echo base_url();?>/apply/<?php echo $carr['post_name'];?>/<?php echo $carr['id'];?>">Apply To The Job</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="widget job_information">
                            <h2 class="widget-title">Jobs Information</h2>
                            <ul class="job-information-list">
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">Company Name</h4>
                                            <span class="details"> <?php echo $carr['company_name'];?></span>
                                        </div>
                                    </div>
                                </li>
                                <!-- <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">Job Category</h4>
                                            <span class="details"><a href="#">UI/ UX Designer</a></span>
                                        </div>
                                    </div>
                                </li> -->
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">Job Position</h4>
                                            <span class="details"> <?php echo $carr['Designation'];?></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="far fa-folder"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">Job Type</h4>
                                            <span class="details"><?php echo $carr['Job_Type'];?></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">Salary</h4>
                                            <span class="details"><?php echo $carr['salary'];?></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">Job Location</h4>
                                            <span class="details"><?php echo $carr['Location'];?></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">Deadline</h4>
                                            <span class="details"><?php echo $carr['Deadline'];?></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php }  }?>


