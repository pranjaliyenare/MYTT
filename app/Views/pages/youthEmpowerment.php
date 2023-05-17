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
                  <h4 class="card-title">Youth Empowerment </h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/youthEmpowerment"); ?>" method="POST"  enctype="multipart/form-data">                  
                        <div class="form-group" style="display:none">
                            <label for="id">ID:</label>
                            <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                        </div>
                        <div class="form-group">
                          <label for="youth_emp_title">Title:</label>
                          <input type="text" class="form-control" id="youth_emp_title" name="youth_emp_title"  placeholder="Youth Empowerment Title" required>
                        </div>
                        <div class="form-group">
                          <label for="youth_emp_subtitle">Subtitle:</label>
                          <input type="text" class="form-control" id="youth_emp_subtitle" name="youth_emp_subtitle"  placeholder="Youth Empowerment Subtitle" required>
                        </div>
                        <div class="form-group" id="image">
                            <label for="youth_emp_img">Image:</label>
                                <input type='file'  class="form-control" name="youth_emp_img" id="youth_emp_img" required/>
                                <img id="youth_emp_Img"  src="#" alt="MYTT" />
                        </div>
                        <div class="form-group">
                          <label for="youth_content">Content:</label>
                          <textarea type="text" rows="10" name="youth_content" class="form-control" id="youth_content" placeholder="Youth Empowerment Content" required></textarea>
                        </div>
                      <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form>
                </div>
              </div>
            </div>

          <!--</div> <div class="row"> -->
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Youth Empowerment</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Sr. No.</th>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Subtitle</th>
						              <th>Image</th>
                          <th>Content</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($youth): ?>
                          <?php foreach($youth as $empower): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($empower['id']) { echo $empower['id']; } else { ""; } ?></td>
								                  <td><?php echo $empower['youth_Title']; ?></td>
                                  <td><?php if($empower['youth_Subtitle']) { echo $empower['youth_Subtitle']; } else { ""; } ?></td>
                                 <td><img style="border-radius:0%;" src="./assets/images/upload_image/<?php echo $empower['youth_Img']; ?>" /></td>
                                  <td><?php echo $empower['youth_Content']; ?></td>
                                  <td> <a href="<?php echo base_url('edit_youthEmpowerment/'.$empower['id']); ?>" class="btn btn-info btn-sm">
                                          <i class="mdi mdi-lead-pencil"></i>
                                        </a>
                                        <button data-id="<?php echo $empower['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteModal"><i class="mdi mdi-delete" ></i></button>
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
        document.getElementById("youth_emp_Img").width = "300";
                      
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#youth_emp_Img').attr('src', e.target.result);
                    document.getElementById("youth_emp_Img").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#youth_emp_img").change(function(){
            readURL(this);
        });
        // youth Onchange delete text value in youth name
        $('.delete').click(function() {
              
              $('.deleteModal').modal('toggle');
              var youth_id = $(this).attr('data-id');
              var id = $(this).attr('data-id');
              $("#youth_id").val(youth_id);
            });
    </script>
    <!-- Large modal -->
       
        <div class="modal fade deleteModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/delete_youth_content"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Youth Empowerment content</h1>
                <p>Are you sure you want to permenant delete your Youth Empowerment content?</p>
                <br>
                <div>
                  <input type="hidden" id="youth_id" name="youth_id">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    