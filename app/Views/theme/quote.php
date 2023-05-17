    <section class="order-service-page-content-area padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="quote-content-area">
                        <h3 class="quote-title">Request A Quote</h3>
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
                        <form action="<?php echo base_url("Theme/send_quote"); ?>" method="post" enctype="multipart/form-data" class="contact-form quote-form">
                            <input type="hidden" name="_token" value="yt3p7eEeYRO22LsZOegPgGKFWTFcy0fnbwsv4SyS">                            
                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group" style="display: none;"> 
                                        <input type="text" id="quote_email" name="quote_email" class="form-control" value="<?php echo $template['quote_email']; ?>" >
                                    </div>
                                    <div class="form-group"> 
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" >
                                    </div> 
                                    <div class="form-group">
                                        <select class="form-control" name="service" style="height: 55px;">
                                            <?php if($template['service']) { 
                                                    foreach($template['service'] as $serv) { ?>
                                                    <option value="<?php echo $serv['service_name']; ?>"><?php echo $serv['service_name']; ?></option>
                                            <?php  } } ?>
                                        </select> 
                                        <!-- <input type="text" id="your-subject" name="your-subject" class="form-control" placeholder="Your Subject" required="required"> -->
                                    </div> 
                                    <div class="form-group"> 
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required="required">
                                    </div> 
                                    <div class="form-group"> 
                                        <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Your Mobile" required="required">
                                    </div> 
                                    <div class="form-group textarea">
                                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Your Message" required="required"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="btn-wrapper text-center">
                                        <button class="btn-boxed style-01" type="submit">Send Quote</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>