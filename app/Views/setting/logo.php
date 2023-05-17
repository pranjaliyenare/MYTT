<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Logo Setting</h4>
                  <?php $validation = \Config\Services::validation(); ?>
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
                  <form class="forms-sample" name="form1" id="form1"  action="<?php echo base_url("Admin/".$form); ?>" method="POST"  enctype="multipart/form-data">
                    <div class="form-group">
                          <input type='hidden'  class="form-control" name="id" id="id" value="<?php echo $id ?>" />
                    </div>
                    <div class="form-group">
                      <label for="favicon">Choose a Favicon File:</label>
                    </div>
                    <div class="form-group">
                        <input type='file'  class="form-control"  name="favicon" id="imgInp" />
                        <input type="hidden" name="hdnfavicon" value="<?php echo $faviconImg; ?>" >
                        <img id="faviconImg" name="faviconImg"  src="<?php echo "./assets/images/".$faviconImg;?>" alt="MYTT" />
                    </div>
                    <?php if($validation->getError('favicon')) {?>
                      <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('favicon'); ?>
                      </div>
                    <?php }?> 
                    <div class="form-group">
                      <label for="logo">Choose a Logo File:</label>                      
                    </div>

                    <div class="form-group">
                        <input type='file'  class="form-control" name="logo" id="logo" value="<?php echo $logoImg;?>" />
                        <img id="logoImg" src="<?php echo "./assets/images/".$logoImg;?>" alt="MYTT" />
                        <input type="hidden" name="hdnlogo" value="<?php echo $logoImg; ?>" >
                    </div>

                    <?php if($validation->getError('logo')) {?>
                      <div class='alert alert-danger mt-2'>
                          <?= $error = $validation->getError('logo'); ?>
                      </div>
                    <?php }?>
                    <button type="submit" class="btn btn-primary me-2"><?php echo $button; ?></button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
       document.getElementById("faviconImg").width = "300";
       document.getElementById("logoImg").width = "300";

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#faviconImg').attr('src', e.target.result);
                    document.getElementById("faviconImg").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#logoImg').attr('src', e.target.result);
                    document.getElementById("logoImg").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#imgInp").change(function(){
            readURL(this);
        });
        $("#logo").change(function(){
            readURL1(this);
        });
    </script>