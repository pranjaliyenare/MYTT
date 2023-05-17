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
                  <h4 class="card-title">Add Home Page</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/home"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="header">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                      </div>
                    <div class="form-group">
                      <label for="header">Header Title:</label>
                      <input type="text" class="form-control" id="header" name="header"  placeholder="Header Title" required>
                    </div>
                    <div class="form-group">
                    <label for="bgimg">Slide Image:</label>
                        <input type='file'  class="form-control" name="image1" id="image1" required/>
                        <img id="slideImg1"  src="#" alt="MYTT" />
                    </div>                    

                    <div class="form-group">
                      <label for="content">Content:</label>
                      <textarea type="text" name="content" class="form-control" id="content" placeholder="Content" required></textarea>
                    </div>
                  <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form></div></div></div>

          <!--</div> <div class="row"> -->
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Display Home Page</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sr. No.</th>
                        <th>ID</th>
                          <th>Name</th>
                          <th>Images</th>
                          <th>Content</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($home): ?>
                          <?php foreach($home as $user): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($user['id']) { echo $user['id']; } else { ""; } ?></td>
                                  <td><?php if($user['home_header']) { echo $user['home_header']; } else { ""; } ?></td>
                                  <td><img style="border-radius:0%;" src="./assets/images/upload_image/<?php echo $user['home_image1']; ?>" /></td>
                                  
                                  <td><?php echo $user['home_content']; ?></td>
                                  <td> <a href="<?php echo base_url('edithome/'.$user['id']); ?>" type="button" class="btn btn-info btn-info ">
                                    <i class="mdi mdi-lead-pencil"></i>
                                      </a>
                                      <button  data-id="<?php echo $user['id']; ?>" type="button" class="btn btn-danger btn-info delete" data-toggle="modal" data-target=".deleteHomeModal">
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

            $('.delete').click(function() {
              
              $('.deleteHomeModal').modal('toggle');
              var id = $(this).attr('data-id');
              $(".id_class").val(id);
            });
       
        
        $("#image1").change(function(){
            readURL(this);
        });
        
    </script>

    <!-- Large modal -->
       
        <div class="modal fade deleteHomeModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/deleteHome"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Home Page</h1>
                <p>Are you sure you want to permenant delete Home Page?</p>
                <br>
                <div>
                  <input type="hidden" id="id" name="id" class="id_class">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteHomeModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>