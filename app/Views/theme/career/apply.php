<section class="breadcrumb-area breadcrumb-bg navbar-variant-01" style="background-image: url(<?php echo base_url(); ?>/assets/images/upload_image/apply.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">    Apply To <?php echo $page; ?></h1>
                    <ul class="page-list">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li>Apply To <?php echo $page; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-content-area padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="job-apply-form-wrapper">
                        <h2 class="job-apply-title"> Apply To <?php echo $page; ?></h2>
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
                        <form action="<?php echo base_url(); ?>/Theme/applyForm" method="post" enctype="multipart/form-data">                         
                            <input type="hidden" class="form-control" name="job_type" value="<?php echo $page; ?>">
                            <input type="hidden" class="form-control" name="job_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="support_email" value="<?php echo $template['email']; ?>"> 
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Your Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Your Email" class="form-control" required>
                            </div>                            
                            <div class="form-group">
                                <input type="phone" name="phone" placeholder="Your Phone" class="form-control" required>
                            </div>
                            <div class="form-group file"> <label for="cv">Your CV</label>
                                <input type="file" id="cv" name="cv" class="form-control" accept="application/msword, application/pdf"> 
                                <span class="help-info">Accept File Type: txt,pdf</span>
                            </div> 
                            <div class="form-group textarea">
                                <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Message"></textarea>
                            </div>                                                                               
                            <div class="btn-wrapper text-center">
                                <button class="boxed-btn style-01" type="submit">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
