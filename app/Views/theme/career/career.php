<section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(<?php echo base_url(); ?>/assets/images/upload_image/career1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title"> Career With Us </h1>
                    <ul class="page-list">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li>Career With Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                    <?php if($career) {
                foreach($career AS $carr) {
        ?>
                        <div class="col-lg-12">
                            <div class="single-job-list-item">
                                <span class="job_type"><i class="far fa-clock"></i><?php echo $carr['Job_Type']; ?></span>
                                <!-- <a href="<//?php echo base_url(); ?>/career/Graphic Designer"> -->
                                <h3><a href="<?php echo base_url(); ?>/careerContent/<?php echo $carr['post_name'];?>/<?php echo $carr['id'];?>" class="title"><?php echo $carr['post_name'];?></a></h3>
                               <!-- </a> -->
                                <span class="company_name"><strong>Company:</strong><?php echo $carr['company_name'];?></span>
                                <span class="deadline"><strong>Deadline:</strong><?php echo $carr['Deadline'];?></span>
                                <ul class="jobs-meta">
                                    <li><i class="fas fa-briefcase"></i><?php echo $carr['Designation'];?></li>
                                    <li><i class="fas fa fa-history"></i> <?php echo $carr['expFrom'];?> - <?php echo $carr['expTo'];?> Years</li>
                                    <li><i class="fas fa-map-marker-alt"></i> <?php echo $carr['Location'];?></li>
                                </ul>
                            </div> 
                        </div>
                        
                         <?php } } ?>
                    </div>
                    <div class="col-lg-12 text-center">
                        <nav class="pagination-wrapper " aria-label="Page navigation ">
                            
                        </nav>
                    </div>
                </div>
                <div class="widget_archive career-widget widget">
                    <div class="widget_archive style-01">
                        <h3 class="widget-title style-01">Job Categories</h3>
                        <ul>
                            <li>
                                <a href="#">UI/UX Designer</a>
                            </li>
                            <li>
                                <a href="#"> Software Engineer</a>
                            </li>
                            <li>
                                <a href="#"> Office Management</a>
                            </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>