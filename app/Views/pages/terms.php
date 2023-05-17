<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Term and Conditions</h4>
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
                  
                  <form class="forms-sample" action="<?php echo base_url("Admin/".$form); ?>" method="POST"  enctype="multipart/form-data" >
                  
                  <div class="form-group" style="display:none">
                        <label for="header">ID:</label>
                        <input type="text" class="form-control" name="id" id="id"   value="<?php echo $id;?>" placeholder="ID">
                      </div>
                  
                  <div class="form-group">
                      <label for="header">Header Title:</label>
                      <input type="text" class="form-control"  name="header"   id="header" value="<?php echo $header;?>" placeholder="Header Title" required>
                    </div>
                    <div class="form-group">
                      <label for="subtitle">Subtitle:</label>
                      <input type="text" class="form-control"  name="subtitle"   id="subtitle" value="<?php echo $subtitle;?>" placeholder="Subtitle" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control hdn_slide_img_class" name="hdn_slide_img" id="hdn_slide_img" value="<?php echo $image; ?>" >
                        <input type='file'  class="form-control"  name="image" id="image" value="<?php echo $image;?>" />
                        <img id="imginp" alt="your image" src="<?php echo "./assets/images/upload_image/".$image;?>"  />
                    </div>

                    <div class="form-group">
                      <label for="content">Content:</label>
                      <textarea type="text" name="content" class="form-control" id="content" rows="10" placeholder="Term and Conditions" required><?php echo $content;?></textarea>
                    </div>
                   
                   
                    
                 
                    <button type="submit" class="btn btn-primary me-2"><?php echo  $button; ?></button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
       document.getElementById("imginp").width = "300";
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#imginp').attr('src', e.target.result);
                    document.getElementById("imginp").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#image").change(function(){
            readURL(this);
        });
    </script>