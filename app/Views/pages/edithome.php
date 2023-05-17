<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Home Page</h4>  
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
                    <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/editHome"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="header">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID"  value="<?php echo $id; ?>" >
                      </div>
                    <div class="form-group">
                      <label for="header">Header Title:</label>
                      <input type="text" class="form-control" id="header" name="header"  placeholder="Header Title"  value="<?php echo $home_header; ?>"  required>
                    </div>
                    <div class="form-group">
                    <label for="image1">Slide Image:</label>
                    <input type="hidden" class="form-control hdn_slide_img_class" name="hdn_slide_img" id="hdn_slide_img" value="<?php echo $home_image1; ?>" >
                        <input type='file'  class="form-control" name="image1" id="image1" />
                        <img id="slideImg1"  src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $home_image1; ?>" alt="MYTT" />
                    </div>                    

                    <div class="form-group">
                      <label for="content">Content:</label>
                      <textarea type="text" name="content" class="form-control" id="content" placeholder="Content" required><?php echo $home_content; ?></textarea>
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
           document.getElementById("slideImg1").width = "300";
           function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#slideImg1').attr('src', e.target.result);
                    document.getElementById("slideImg1").width = "300";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
            $("#image1").change(function(){
            readURL(this);
        });
    </script>