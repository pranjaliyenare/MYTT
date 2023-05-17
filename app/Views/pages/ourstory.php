<style>
     .modal-content {
        padding: 20px;
        text-align: center;
     }
</style>

<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/ourstory"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                      </div>
                    <div class="form-group">
                      <label for="ourstory">Title:</label>
                      <input type="text" class="form-control" id="ourstory" name="ourstory"  placeholder="Our Story Title" required>
                    </div>
                    <div class="form-group">
                      <label for="story_subtitle">Subtitle:</label>
                      <input type="text" class="form-control" id="story_subtitle" name="story_subtitle"  placeholder="Our Story Subitle" required>
                    </div>
                    <div class="form-group">
                    <label for="story_img">Image:</label>
                    <input type="hidden" class="form-control hdn_story_class" name="hdn_story" id="hdn_story" >
                        <input type='file'  class="form-control" name="story_img" id="story_img" required/>
                        <img id="story_Img"  src="#" alt="MYTT" />
                    </div>                    

                    <div class="form-group">
                      <label for="story_content">Content:</label>
                      <textarea type="text"  name="story_content" class="form-control" id="story_content" placeholder="Our Story Content" required></textarea>
                    </div>
                  <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form></div></div></div>
 
          <!--</div> <div class="row"> -->
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Our Story</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sr. No.</th>
                        <th>ID</th>
                          <th>Title</th>
                          <th>Subtitle</th>
                          <th>Images</th>
                          <th>content</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($story): ?>
                          <?php foreach($story as $our): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($our['id']) { echo $our['id']; } else { ""; } ?></td>
                                  <td><?php if($our['our_story_title']) { echo $our['our_story_title']; } else { ""; } ?></td>
                                  <td><?php echo $our['our_story_subtitle']; ?></td>
                                  <td><img style="border-radius:0%;" src="./assets/images/upload_image/<?php echo $our['our_story_image']; ?>" /></td>
                                  <td><?php echo $our['our_story_content']; ?></td>
                                  <td> <a href="<?php echo base_url('editourstory/'.$our['id']); ?>"  class="btn btn-info btn-sm">
                                    <i class="mdi mdi-lead-pencil"></i>
                          </a>
                                  <button data-id="<?php echo $our['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteOurStoryModal">
                                    <i class="mdi mdi-delete"></i></td>
                                  </button> 
                              </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>      
                        </tbody>
                    </table><br><br>
                  </div>
                </div>
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
        $('.delete').click(function() {
              
              $('.deleteOurStoryModal').modal('toggle');
              var id = $(this).attr('data-id');
              $(".id_class").val(id);
            });

            $("#story_img").change(function(){
            readURL(this);
        });
        
    </script>
    <!-- Large modal -->
       
        <div class="modal fade deleteOurStoryModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/deleteOurStory"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Our Story</h1>
                <p>Are you sure you want to permenant delete Our Story?</p>
                <br>
                <div>
                  <input type="hidden" id="id" name="id" class="id_class">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteOurStoryModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        