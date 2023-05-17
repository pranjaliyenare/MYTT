<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Our Story Page</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/editourstory"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                      </div>
                    <div class="form-group">
                      <label for="ourstory">Title:</label>
                      <input type="text" class="form-control" id="ourstory" name="ourstory" value="<?php echo $our_story_title; ?>" placeholder="Our Story Title" required>
                    </div>
                    <div class="form-group">
                      <label for="story_subtitle">Subtitle:</label>
                      <input type="text" class="form-control" id="story_subtitle" name="story_subtitle" value="<?php echo $our_story_subtitle; ?>" placeholder="Our Story Subitle" required>
                    </div>
                    <div class="form-group">
                    <label for="story_img">Image:</label>
                    <input type="hidden" class="form-control hdn_story_class" name="hdn_story" id="hdn_story" value="<?php echo $our_story_image; ?>" >
                        <input type='file'  class="form-control" name="story_img" id="story_img" />
                        <img id="story_Img"  src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $our_story_image; ?>" alt="MYTT" />
                    </div>                       

                    <div class="form-group">
                      <label for="story_content">Content:</label>
                      <textarea type="text"  name="story_content" class="form-control" id="story_content"  placeholder="Our Story Content" required><?php echo $our_story_content;?></textarea>
                    </div>
                  <button type="btnEdit" class="btn btn-primary me-2">Edit</button>
                  </form></div></div></div>
          </div>
        </div>
      </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
           document.getElementById("story_Img").width = "300";
           function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#story_Img').attr('src', e.target.result);
                    document.getElementById("story_Img").width = "300";
                }
                 reader.readAsDataURL(input.files[0]);
            }
        }
        
            $("#story_img").change(function(){
            readURL(this);
        });
        
    </script>
