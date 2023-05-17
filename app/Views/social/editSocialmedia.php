<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Social Media Setting </h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/editSocialmedia"); ?>" method="POST"  enctype="multipart/form-data" >
                    <div class="form-group" style="display:none">
                        <label for="header">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                      </div>

                    <div class="form-group">
                    <label for="social_Img">Social Logo Image:</label>
                    <input type="hidden" class="form-control hdn_social_img_class" name="hdn_social_img" id="hdn_social_img" value="<?php echo $social_img; ?>" >
                        <input type='file'  class="form-control hdn_social_class" name="social_img" id="social_img" />
                        <img id="social_img" src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $social_img; ?>" alt="MMG" />
                    </div>
                   
                    <div class="form-group">
                      <label for="social_name">Social Name:</label>
                      <input type="text" class="form-control" name="social_name" id="social_name"  value="<?php echo $social_name; ?>"  placeholder="Logo Name" required>
                    </div>

                    <div class="form-group">
                      <label for="social_url">URL:</label>
                      <input type="text"  name="social_url" class="form-control" id="social_url"  value="<?php echo $social_url; ?>" required placeholder="Social Media URL">
                    </div>
                      <hr/>
                    <button  type="btnEdit" class="btn btn-info me-2" >Edit</button>
                  </form>
          </div>
        </div>
      </div>
</div></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
        document.getElementById("social_img").width = "300";
                      
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#social_img').attr('src', e.target.result);
                    document.getElementById("social_img").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        // service Onchange add text value in service name
        $(".hdn_social_img_class").change(function(){
          $(".hdn_social_class").val($(".hdn_social_img_class option:selected").text()); 
        });
        
        $("#social_Img").change(function(){
            readURL(this);
        });
        
    </script>