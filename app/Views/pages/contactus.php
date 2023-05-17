


<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Contact Us</h4>
                  
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
                  
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/".$form); ?>" method="POST"  enctype="multipart/form-data" >
                      <div class="form-group" style="display:none">
                        <label for="header">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $id;?>" placeholder="ID">
                      </div>
                      <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $title;?>" placeholder="Title" required>
                      </div>
                    <div class="form-group">
                      <label for="mobile">Mobile:</label>
                      <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $mobile;?>" placeholder="Mobile" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control" name="email" id="email"  value="<?php echo $email;?>" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" name="address" id="address" value="<?php echo $address;?>" placeholder="Address" required>
                    </div>

                    <div class="form-group">
                    <label for="contact_image">Image:</label>
                        <input type='file'  class="form-control" name="contact_image" id="contact_image"  value="<?php echo $contact_image;?>" />
                        <img id="contact_img" src="<?php echo "./assets/images/upload_image/".$contact_image;?>" alt="your image" />
                    </div>

                    <div class="form-group">
                      <label for="content">Content:</label>
                      <textarea type="text"  name="content" required class="form-control" id="content" rows="10" placeholder="Contact Us"><?php echo $content;?></textarea>
                    </div>                      
                    <button type="submit" class="btn btn-primary me-2"><?php echo  $button; ?></button>
                    <button class="btn btn-light">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
          document.getElementById("contact_img").width = "300";
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#contact_img').attr('src', e.target.result);
                        document.getElementById("contact_img").width = "300";
                    }                    
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $("#contact_image").change(function(){
                readURL(this);
            });
        </script>