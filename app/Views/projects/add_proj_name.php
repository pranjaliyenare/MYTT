
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
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Project Name:</h4>

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
                  
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/add_proj_name"); ?>" method="POST"  enctype="multipart/form-data" >
                  
                  <div class="form-group">
                      <label for="proj_name">Project Name:</label>
                      <input type="text" class="form-control" name="proj_name" id="proj_name" placeholder="Project Name" required>
                    </div>


                    <div class="form-group">
                    <label for="proj_image">Image:</label>
                        <input type='file'  class="form-control" name="proj_image" id="proj_image" />
                        <img id="imginp"  src="" alt="MYTT" />
                    </div>

                    <div class="form-group">
                      <label for="proj_url">Project URL:</label>
                      <input type="text" class="form-control" name="proj_url" id="proj_url" placeholder="Project URL" required>
                    </div>
                    
                   <div class="col-md-12 mb-3" id="mmg_div_id">
                          <label for="project_category">Select Project Category:</label>    
                          <input type="hidden" class="form-control proj_cat_class" name="proj_cat_name" id="proj_cat_name" placeholder="ID">                      
                          <select class="form-control proj_category_class" name="project_category" id="project_category">';
                          <option value="0">Select Project Category...</option>
                             <?php $i = 0; if($proj_category): ?>
                              <?php foreach($proj_category as $category): ?>
                                <option value="<?php echo $category['id'] ?>"><?php echo $category['project_category'] ?></option>       
                              <?php endforeach; ?>
                            <?php endif; ?>  
							
                          </select>
                        </div>
                    <div class="form-group">
                      <label for="proj_start_date">Project Start Date:</label>
                      <input type="date" class="form-control" name="proj_start_date" id="proj_start_date" placeholder="Project Start Date" required>
                    </div>
                    <div class="form-group">
                      <label for="proj_end_date">Project End Date:</label>
                      <input type="date" class="form-control" name="proj_end_date" id="proj_end_date" placeholder="Project End Date" required>
                    </div>
                    <div class="form-group">
                      <label for="proj_type">Project Type:</label>
                      <input type="text" class="form-control" name="proj_type" id="proj_type" placeholder="Project Type" required>
                    </div>
                    <div class="form-group">
                      <label for="proj_price">Project Price:</label>
                      <input type="text" class="form-control" name="proj_price" id="proj_price" placeholder="Project Price" required>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Project</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sr. No.</th>
                        <th>ID</th>
						              <th>Project Name</th>
                          <th>Image</th>
                          <th>Project URL</th>
                          <th>Project Category</th>
                          <th>Project Start Date</th>
                          <th>Project End Date</th>
                          <th>Project Type</th>
                          <th>Project Price</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($project): ?>
                          <?php foreach($project as $name): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($name['id']) { echo $name['id']; } else { ""; } ?></td>
								                  <td><?php echo $name['project_name']; ?></td>
                                  <td><img style="border-radius:0%;" src="./assets/images/upload_image/project_img/<?php echo $name['proj_images']; ?>" /></td>
                                  <td><?php echo $name['proj_url']; ?></td>
                                  <td><?php echo $name['project_category']; ?></td>
                                  <td><?php echo $name['proj_start_date']; ?></td>
                                  <td><?php echo $name['proj_end_date']; ?></td>
                                  <td><?php echo $name['project_type']; ?></td>
                                  <td><?php echo $name['project_price']; ?></td>
                                  <td><a href="<?php echo base_url('edit_project_name/'.$name['id']); ?>" class="btn btn-info btn-sm">
                                          <i class="mdi mdi-lead-pencil"></i>
                                          </a>
                                          <button data-id="<?php echo $name['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteProjectNameModal"><i class="mdi mdi-delete" ></i></button>
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
       document.getElementById("imginp").width = "300";
       $("#proj_image").change(function(){
            readURL(this);
        });

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

        // Project Onchange add text value in Project name
            $(".proj_category_class").change(function() { 
                $(".proj_cat_class").val($(".proj_category_class option:selected").text()); 
            });
            
        
    
        $('.delete').click(function() {
              $('.deleteProjectNameModal').modal('toggle');
              var id = $(this).attr('data-id');
             $(".id_class").val(id);
            });
    </script>

    <!-- Large modal -->
       
    <div class="modal fade deleteProjectNameModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/delete_proj_name"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Project Name</h1>
                <p>Are you sure you want to permenant delete your Project Name ?</p>
                <br>
                <div>
                  <input type="hidden" id="id" name="id" class="id_class">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteProjectNameModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        