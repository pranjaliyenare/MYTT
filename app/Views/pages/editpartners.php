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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/editpartners"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                      </div>
                    <div class="form-group">
                      <label for="partner">Title:</label>
                      <input type="text" class="form-control" id="partner" name="partner" value="<?php echo $partners_name; ?>" placeholder="Our Partners Title" required>
                    </div>
                    <div class="form-group">
                    <label for="partner_img">Image:</label>
                    <input type="hidden" class="form-control hdn_partner_img_class" name="hdn_partner_img" id="hdn_partner_img" value="<?php echo $partners_logo; ?>" >
                        <input type='file'  class="form-control" name="partner_img" id="partner_img" value="<?php echo $partners_logo; ?>"/>
                        <img id="partner_Img"  src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $partners_logo; ?>" alt="MYTT" />
                    </div>                    
                    <div class="form-group">
                      <label for="partner_content">Link:</label>
                      <input type="text" name="partner_link" class="form-control" id="partner_link" placeholder="Partners Link" value="<?php echo $partners_link; ?>" />
                    </div>   
                    <div class="form-group">
                      <label for="partner_content">Content:</label>
                      <textarea type="text" name="partner_content" class="form-control" id="partner_content" placeholder="Our Partners Content" required><?php echo $partners_contents; ?></textarea>
                    </div>
                  <button type="btnEdit" class="btn btn-info me-2">Edit</button>
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
        
        $("#partner_img").change(function(){
            readURL(this);
        });
      </script>