<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Our Expertise Page</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/editOurexpertise"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                      </div>
                    <div class="form-group">
                      <label for="expertise">Title:</label>
                      <input type="text" class="form-control" id="expertise" name="expertise" value="<?php echo $our_expertise_title; ?>"  placeholder="Our Expertise Title" required>
                    </div>
                    <div class="form-group">
                      <label for="expertise_subtitle">Subtitle:</label>
                      <input type="text" class="form-control" id="expertise_subtitle" name="expertise_subtitle" value="<?php echo $our_expertise_subtitle; ?>" placeholder="Our Expertise Subitle" required>
                    </div>
                    <div class="form-group">
                    <label for="expertise_img">Image:</label>
                    <input type="hidden" class="form-control hdn_exp_img_class" name="hdn_exp_img" id="hdn_exp_img" value="<?php echo $our_expertise_image; ?>" >
                        <input type='file'  class="form-control" name="expertise_img" id="expertise_img" />
                <img id="expertise_Img"  src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $our_expertise_image; ?>" alt="MYTT" />
                    </div>   
                    <div class="form-group">
                      <label for="expertise_content">Content:</label>
                      <textarea type="text" name="expertise_content" class="form-control" id="expertise_content" placeholder="Our Expertise Content" required><?php echo $our_expertise_content; ?></textarea>
                    </div>
                  <button type="btnEdit" class="btn btn-info me-2">Edit</button>
                  </form></div></div></div>
          </div>
        </div>
      </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
           document.getElementById("expertise_Img").width = "300";
           
           
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#expertise_Img').attr('src', e.target.result);
                    document.getElementById("expertise_Img").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#expertise_img").change(function(){
            readURL(this);
        });
        </script>