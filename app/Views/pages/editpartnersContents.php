    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Our Partners</h4>  
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
                    <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/editpartnersContents"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group">
                        <!-- <label for="id">ID:</label> -->
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                      </div>
                      
                       <div class="col-md-12 mb-3" id="mmg_div_id">
                          <label for="partners_Type">Select Type</label>    
                          <input type="hidden" class="form-control partnerstype_class" name="partnerstype" id="partnerstype"  value="<?php echo $partnersType;?>" >                      
                          <select class="form-control partners_Type_class" name="partners_Type" id="partners_Type" >;
                          <option value="0">Select Type...</option>
                          <?php $i = 0; if($partners): ?>
                              <?php foreach($partners as $type): ?>
                                <?php if($type['partnersType'] == $partnersType) { $selected = 'selected'; } else { $selected = ''; } ?> 
                                  <option value="<?php echo $type['id'] ?>"<?php echo $selected; ?>><?php echo $type['partnersType']; ?></option>       
                              <?php endforeach; ?>
                            <?php endif; ?>  
                            </select>
                        </div> 
                        <div class="form-group">
                        <label for="partner">Partners Name:</label>
                        <input type="text" class="form-control" id="partner" name="partner" value="<?php echo $partners_name; ?>"  placeholder="Our Partners Name"required >
                      </div>
                      <div class="form-group">
                      <label for="partner_logo">Partners Logo:</label>
                      <input type="hidden" class="form-control hdn_partner_img_class" name="hdn_partner_img" id="hdn_partner_img" value="<?php echo $partners_logo; ?>" >
                          <input type='file'  class="form-control" name="partner_logo" id="partner_logo"  />
                          <img id="partner_Img"  src="<?php echo base_url(); ?>/assets/images/upload_image/partners/<?php echo $partners_logo; ?>" alt="MYTT" />
                      </div>  
                      <div class="form-group">
                        <label for="partner_link">Partners Link:</label>
                        <input type="text" name="partner_link" class="form-control" id="partner_link" value="<?php echo $partners_link; ?>" placeholder="Partners Link" required>
                      </div>
                      <div class="form-group">
                        <label for="partner_content">Partners Content:</label>
                        <textarea type="text" name="partner_content" class="form-control" id="partner_content" placeholder="Our Partners Content" required><?php echo $partners_contents; ?></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Edit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script>
           document.getElementById("partner_Img").width = "300";
           
           
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#partner_Img').attr('src', e.target.result);
                    document.getElementById("partner_Img").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#partner_logo").change(function(){
            readURL(this);
        });

        // Fintch and BlockChain Onchange add text value in Fintch and BlockChain name
        $(".partners_Type_class").change(function(){
                $(".partnerstype_class").val($(".partners_Type_class option:selected").text()); 
              });
      </script>