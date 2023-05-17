<div class="header-style-03  header-variant-08">
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="<?php echo base_url("index"); ?>" class="logo">
                            <img src="<?php echo base_url()."/assets/images/logo.png"; ?>"  alt="MYTT"/>
                    </a>
                </div>
                <div class="mobile-cart">
                    <a href="products-cart">
                        <i class="flaticon-shopping-cart"></i>
                        <span class="pcount">0</span>
                    </a>
                </div>
 
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">                    
                    <li > 
                        <a href="<?php echo base_url("index"); ?>" target="_blank"><i class='fas fa-home'></i>Home</a>
                    </li>
                    <li class=" menu-item-has-children "> 
                        <a href="<?php echo base_url("aboutus"); ?>">About</a>
                        <ul class="sub-menu">
                            <!-- <li > 
                                <a href="image_gallery">Image Gallery</a>
                            </li> -->
                            <li > 
                                <a href="<?php echo base_url("aboutus"); ?>">About</a>
                            </li>
                            <li > 
                                <a href="<?php echo base_url("comp_vision"); ?>">Vision</a>
                            </li>
                            <li > 
                                <a href="<?php echo base_url("comp_mission"); ?>">Mission</a>
                            </li>
                            <!-- <li > 
                                <a href="<?php //echo base_url("clients_feedback"); ?>">Clients Feedback</a>
                            </li>
                            <li > 
                                <a href="<?php //echo base_url("team"); ?>">Team</a>
                            </li> -->
                        </ul>
                    </li>
                    <li class="menu-item-has-mega-menu"> 
                        <a href="<?php echo base_url("service"); ?>">Service</a>
                        <div class="xg_mega_menu_wrapper" style="border-bottom: 4px solid var(--main-color-one);">
                            <div class="xg-mega-menu-container">
                                <div class="row">
                                    <?php if($template['service']) { 
                                        foreach($template['service'] as $serv) { ?>
                                            <div class="col-lg-2 col-md-12">
                                                <div class="xg-mega-menu-single-column-wrap">
                                                    <h4 class="mega-menu-title"><?php echo $serv['service_name']; ?></h4>
                                                    <ul>
                                                    <?php if($template['service_content']) { 
                                                        foreach($template['service_content'] as $servCont) { ?>
                                                            <?php  if($serv['id'] == $servCont['services_id']) { ?>
                                                            <li><a href="<?php echo base_url("services/".$servCont['sub_service_name']); ?>"><?php echo $servCont['sub_service_name']; ?></a></li>
                                                        <?php } } } ?>
                                                    </ul> 
                                                </div>
                                            </div>
                                        <?php  } } ?>  
                                </div>
                            </div>
                        </div>
                    </li>
                       
                    <li class="menu-item-has-mega-menu"> 
                        <a href="#">Projects</a>
                        <div class="xg_mega_menu_wrapper" style="border-bottom: 4px solid var(--main-color-one);" >
                            <div class="xg-mega-menu-container">
                                <div class="row">
                                    <?php if($template['category']) { 
                                        foreach($template['category'] as $cate) { ?>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="xg-mega-menu-single-column-wrap">
                                                    <h4 class="mega-menu-title"> <a href="#"><?php echo $cate['project_category']; ?></a></h4>
                                                    <ul>
                                                    <?php if($template['projName']) { 
                                                        foreach($template['projName'] as $projname) { 
                                                            if($projname['project_category'] == $cate['id']) { ?>
                                                                <li class="single-mega-menu-product-item">
                                                                    <div class="thumbnail">
                                                                        <a href="<?php echo base_url('project/'.$cate['project_category'].'/'.$projname['id']) ?>"><img src="<?php echo base_url(); ?>/assets/images/upload_image/project_img/<?php echo $projname['proj_images']; ?>" alt=""/></a>
                                                                    </div>
                                                                    <div class="content">
                                                                        <a href="<?php echo base_url('project/'.$cate['project_category'].'/'.$projname['id']) ?>"><h4 class="title"><?php echo $projname['project_name']; ?></h4></a>
                                                                        <!-- <div class="price-wrap">
                                                                            <span class="price"><?php //echo $projname['project_type']; ?> </span>
                                                                        </div> -->
                                                                    </div>
                                                                </li>
                                                        <?php } } }  ?>                                                       
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php } }  ?>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="menu-item-has-mega-menu"> 
                        <a href="#">Fintech</a>
                        <div class="xg_mega_menu_wrapper" style="border-bottom: 4px solid var(--main-color-one); ">
                            <div class="xg-mega-menu-container">
                                <div class="row">
                                    <?php if($template['fintech']) { 
                                        foreach($template['fintech'] as $fitec) { ?>
                                            <div class="col-lg-3 col-md-12">
                                                <div class="xg-mega-menu-single-column-wrap">
                                                    <h4 class="" style="font-weight: 0; font-size: 15px;"><a href="<?php echo base_url("fintech/".$fitec['fintech_name']."/".$fitec['id']); ?>"><?php echo $fitec['fintech_name']; ?></a></h4>
                                                </div>
                                            </div>
                                        <?php  } } ?>  
                                        <hr/>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class=" menu-item-has-children "> 
                        <a href="#">Solution</a>
                        <ul class="sub-menu">
                            <?php if($template['solution']) { 
                                foreach($template['solution'] as $soln) { ?>
                                    <li > 
                                        <a href="<?php echo base_url("solution/".$soln['solution_name']."/".$soln['id']); ?>"><?php echo $soln['solution_name']; ?></a>
                                    </li>
                            <?php  } } ?>
                        </ul>
                    </li>

                    <!-- <li> 
                        <a href="<?php //echo base_url("youth_empowerment"); ?>" ><i class='fas fa-fist-raised'></i>Youth Empowerment</a>
                    </li> -->

                    <!-- <li class="menu-item-has-mega-menu"> 
                        <a href="#">Solution</a>
                        <div class="xg_mega_menu_wrapper">
                            <div class="xg-mega-menu-container">
                                <div class="row">
                                    <?php //if($template['solution']) { 
                                        //foreach($template['solution'] as $soln) { ?>
                                            <div class="col-lg-3 col-md-12">
                                                <div class="xg-mega-menu-single-column-wrap">
                                                    <h4 class="mega-menu-title" style="font-weight: 0; font-size: 15px;"><a href="<?php //echo base_url("solution/".$soln['solution_name']."/".$soln['id']); ?>"><?php //echo $soln['solution_name']; ?></a></h4>
                                                </div>
                                            </div>
                                        <?php  //} } ?>  
                                </div>
                            </div>
                        </div>
                    </li> -->

                        <li > 
                            <a href="<?php echo base_url("career"); ?>"><i class='fas fa-award'></i>Career</a>
                        </li>
                        <li > 
                            <a href="<?php echo base_url("contact"); ?>"><i class='fas fa-phone'></i>Contact</a>
                        </li>
                    <li class=" menu-item-has-children ">
                        <a href="#">More</a>
                        <ul class="sub-menu">
                            <li class=" menu-item-has-children ">
                                <a href="<?php echo base_url("privacypolicy"); ?>">Legal</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo base_url("privacypolicy"); ?>">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url("terms_and_condition"); ?>">Terms And Conditions</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url("refund_cancel"); ?>">Refund And Cancellation</a>
                                    </li>
                                </ul>
                            </li>
                            <li class=" menu-item-has-children ">
                                <a href="#">Partners</a>
                                <ul class="sub-menu">
                                <?php if($template['partnersType']) { 
                                    foreach($template['partnersType'] as $partType) { ?>
                                        <li>
                                            <a href="<?php echo base_url("partner/".$partType['partnersType']); ?>"><?php echo $partType['partnersType']; ?></a>
                                        </li>
                                    <?php  } } ?>    
                                </ul>
                            </li>
                            <!-- <li > 
                                <a href="<?php //echo base_url("partner"); ?>">Partners</a>
                            </li> -->
                            <li > 
                                <a href="<?php echo base_url("branch"); ?>">Branches</a>
                            </li>                            
                            <li> 
                                <a href="<?php echo base_url("youth_empowerment"); ?>" >Youth Empowerment</a>
                            </li>
                        </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

