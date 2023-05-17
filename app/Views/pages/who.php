


<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Who We Are:</h4>

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
                        <input type="text" class="form-control" name="id" id="id"   value="<?php echo $id;?>" placeholder="ID">
                      </div>

                  <div class="form-group">
                      <label for="title">Title:</label>
                      <input type="text" class="form-control" name="title" id="title" value="<?php echo $title;?>" placeholder="Title" required>
                    </div>

                    <div class="form-group">
                      <label for="subtitle">Subtitle:</label>
                      <input type="text" class="form-control" name="subtitle" id="subtitle" value="<?php echo $subtitle;?>" placeholder="Subtitle" required>
                    </div>

                    <div class="form-group">
                    <label for="image">Image:</label>
                        <input type='file'  class="form-control" name="image" id="image"  value="<?php echo $image;?>"  />
                        <img id="imginp"  src="<?php echo "./assets/images/upload_image/".$image;?>" alt="your image" />
                    </div>

                    <div class="form-group">
                      <label for="content">Content:</label>
                      <textarea type="text" name="content" class="form-control" id="content" value="<?php echo $content;?>" placeholder="Content" required> </textarea>
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