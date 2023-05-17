<style>
.single-events-list-item .content-area .top-part .time-wrap .date {
    font-size: 20px;
}
</style>
<section class="breadcrumb-area breadcrumb-bg navbar-variant-01"
    style="background-image: url(<?php echo base_url(); ?>/assets/theme/uploads/media-uploader/011589562979.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">Branches</h1>
                    <ul class="page-list">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li>Branches</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                    <div class="col-lg-3">
                    </div>
                        <div class="col-lg-6">
                            <?php foreach($multibranches as $branch) {
                                if($branch['multi_title'] == 'Head'){
                            ?>
                            <div class="single-events-list-item">    
                                <div class="content-area">
                                    <div class="top-part">
                                        <div class="time-wrap">
                                            <span class="date">Head</span>
                                        <span class="month"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <div class="title-wrap" >
                                            <a href="#"><h4 class="title"><?php echo $branch['branch_location']; ?></h4></a>
                                            <span class="location"><i class="fas fa-map-marker-alt"></i> <?php echo $branch['branch_address']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <?php  }
                             } ?>
                        </div> 
                    </div>
                    </div>
                </div>
               <hr/><br/>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">  
                                <h3 class="title" style="text-align: center;">India</h3>  
                                <hr/>                           
                                <?php foreach($multibranches as $branch) {
                                    if($branch['multi_drop'] == 'India' && $branch['multi_title'] == 'Branch'){
                                ?>
                                <div class="single-events-list-item">
                                    <div class="content-area">
                                        <div class="top-part">
                                            <div class="time-wrap">
                                                <span class="date">Branch</span>
                                            <span class="month"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <div class="title-wrap">
                                                <a href="#"><h4 class="title"><?php echo $branch['branch_location']; ?></h4></a>
                                                <span class="location"><i class="fas fa-map-marker-alt"></i> <?php echo $branch['branch_address']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <?php 
                            }
                            } ?>                          
                            </div> 
                            <div class="col-lg-6"> 
                                <h3 class="title" style="text-align: center;">Abroad</h3> <hr/>                             
                                <?php foreach($multibranches as $branch) {
                                    if($branch['multi_drop'] == 'Abroad' && $branch['multi_title'] == 'Branch'){
                                ?>
                                    <div class="single-events-list-item">
                                        <div class="content-area">
                                            <div class="top-part">
                                                <div class="time-wrap">
                                                    <span class="date">Branch</span>
                                                <span class="month"><i class="fas fa-map-marker-alt"></i></span>
                                                </div>
                                                <div class="title-wrap">
                                                    <a href="#"><h4 class="title"><?php echo $branch['branch_location']; ?></h4></a>
                                                    <span class="location"><i class="fas fa-map-marker-alt"></i> <?php echo $branch['branch_address']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php 
                                    }
                                    } ?>                       
                            </div>
                        </div>
                        </div>
                    </div>   <hr/>                 
                </div>
                
            </div>
        </div>
    </section>
    <style>
        .single-events-list-item .content-area .top-part .time-wrap {
            width: 100px;
        }
    </style>