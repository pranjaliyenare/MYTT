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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/ourexpertise"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                      </div>
                    <div class="form-group">
                      <label for="expertise">Title:</label>
                      <input type="text" class="form-control" id="expertise" name="expertise"  placeholder="Our Expertise Title" required>
                    </div>
                    <div class="form-group">
                      <label for="expertise_subtitle">Subtitle:</label>
                      <input type="text" class="form-control" id="expertise_subtitle" name="expertise_subtitle"  placeholder="Our Expertise Subitle" required>
                    </div>
                    <div class="form-group">
                    <label for="expertise_img">Image:</label>
                        <input type='file'  class="form-control" name="expertise_img" id="expertise_img" required/>
                        <img id="expertise_Img"  src="#" alt="MYTT" />
                    </div>                    

                    <div class="form-group">
                      <label for="expertise_content">Content:</label>
                      <textarea type="text" name="expertise_content" class="form-control" id="expertise_content"  rows="10" placeholder="Our Expertise Content" required></textarea>
                    </div>
                  <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form></div></div></div>
 
          <!--</div> <div class="row"> -->
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Our Expertise</h4>
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
                        <?php $i = 0; if($expertise): ?>
                          <?php foreach($expertise as $our): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($our['id']) { echo $our['id']; } else { ""; } ?></td>
                                  <td><?php if($our['our_expertise_title']) { echo $our['our_expertise_title']; } else { ""; } ?></td>
                                  <td><?php echo $our['our_expertise_subtitle']; ?></td>
                                  <td><img style="border-radius:0%;" src="./assets/images/upload_image/<?php echo $our['our_expertise_image']; ?>" /></td>
                                  <td><?php echo $our['our_expertise_content']; ?></td>
                                  <td> <a href="<?php echo base_url('editOurexpertise/'.$our['id']); ?>"  type="button" class="btn btn-info btn-sm ">
                                    <i class="mdi mdi-lead-pencil"></i>
                          </a>
                                  <button data-id="<?php echo $our['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteOurexpertiseModal">
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
        $('.delete').click(function() {
              
              $('.deleteOurexpertiseModal').modal('toggle');
              var id = $(this).attr('data-id');
              $(".id_class").val(id);
            });

        
    </script>
    <!-- Large modal -->
       
    <div class="modal fade deleteOurexpertiseModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/deleteOurexpertise"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Our Expertise</h1>
                <p>Are you sure you want to permenant delete Our Expertise?</p>
                <br>
                <div>
                  <input type="hidden" id="id" name="id" class="id_class">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteOurexpertiseModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>