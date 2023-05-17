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
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Project Contents</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/proj_contents"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="id">Type:</label>
                        <select class="form-control" name="type" id="type" class="typeClass" onselect="typeChange();">
                          <option value="Image">Image</option>
                          <option value="Content">Content</option>
                          <option value="Video">Video</option>
                        </select>
                      </div>

                      <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                      </div>
					 
                      <div class="col-md-12 mb-3" id="mmg_div_id">
                          <label for="project_name">Select Project</label>    
                          <input type="hidden" class="form-control prodname_class" name="projname" id="projname" placeholder="ID">                      
                          <select class="form-control proj_name_class" name="project_name" id="project_name">';
                          <option value="0">Select Project...</option>
                             <?php $i = 0; if($proj_content): ?>
                              <?php foreach($proj_content as $content): ?>
                                <option value="<?php echo $content['id'] ?>"><?php echo $content['project_name'] ?></option>       
                              <?php endforeach; ?>
                            <?php endif; ?>  
							
                          </select>
                        </div>
                    
                    <div class="form-group">
                        <label for="proj_img">Project Image:</label>
                        <input type='file'  class="form-control" name="proj_img" id="proj_img" required/>
                        <img id="proj_Img"  src="#" alt="MYTT" />
                    </div>                    

                    <div class="form-group">
                      <label for="proj_content">Project Content:</label>
                      <textarea name="proj_content" rows="10" class="form-control" id="proj_content" placeholder="Project Content" required> </textarea>
                    </div>
                  <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form></div></div></div>

          <!--</div> <div class="row"> -->
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Project Contents</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sr. No.</th>
                        <th>ID</th>
						            <th>Projects Name</th>
                        <th>Project Image</th>
                        <th>Project Content</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($proj_cont): ?>
                          <?php foreach($proj_cont as $project): ?>
                                <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($project['id']) { echo $project['id']; } else { ""; } ?></td>
								                  <td><?php echo $project['proj_name']; ?></td>
                                  <td><img style="border-radius:0%;" src="./assets/images/upload_image/project_img/<?php echo $project['project_images']; ?>" /></td>
                                  <td><?php echo $project['project_contents']; ?></td>
                                  <td>  <a href="#" class="btn btn-info btn-sm">
                                          <i class="mdi mdi-lead-pencil"></i>
                                        </a>
                                        <button data-id="<?php echo $project['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteProjectContentModal"><i class="mdi mdi-delete" ></i></button>
                                  </td>                                  
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
            document.getElementById("proj_Img").width = "300";
            function readURL(input) {
              if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                $('#proj_Img').attr('src', e.target.result);
                  document.getElementById("proj_Img").width = "300";
                }
                reader.readAsDataURL(input.files[0]);
              }
            }
            // Project Onchange add text value in Project Contents
            $(".proj_name_class").change(function(){
                $(".projname_class").val($(".proj_name_class option:selected").text()); 
            });
         
            $("#proj_img").change(function() {
             readURL(this);
            });
       
            $('.delete').click(function() {
              $('.deleteProjectContentModal').modal('toggle');
              var id = $(this).attr('data-id');
             $(".id_class").val(id);
            });

            // $('.typeClass').on('change', function() {
            //   if() {

            //   }
            // });
           
        </script>
         <!-- Large modal -->
       
         <div class="modal fade deleteProjectContentModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/delete_proj_contents"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Project content</h1>
                <p>Are you sure you want to permenant delete your Project content?</p>
                <br>
                <div>
                  <input type="hidden" id="id" name="id"  class="id_class">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteProjectContentModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>