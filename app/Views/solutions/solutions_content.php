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
                  <h4 class="card-title">Solution Contents</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/solutions_content"); ?>" method="POST"  enctype="multipart/form-data">                  
                          <div class="form-group" style="display:none">
                            <label for="id">ID:</label>
                            <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                          </div>
              
                            <div class="form-group" id="Offerper_div_id">
                              <label for="sol_name">Select Solution</label>    
                              <input type="hidden" class="form-control solname_class" name="solname" id="solname" required>                      
                              <select class="form-control sol_name_class" name="sol_name" id="sol_name">';
                              <option value="0">Select Solution...</option>
                                <?php $i = 0; if($solutions): ?>
                                  <?php foreach($solutions as $sol): ?>
                                      <option value="<?php echo $sol['id'] ?>"><?php echo $sol['solution_name'] ?></option>       
                                  <?php endforeach; ?>
                                <?php endif; ?>                            
                              </select>
                            </div>
                        <div class="form-group">
                          <label for="sub_solution_name">Sub-Solution Name</label>
                          <input type="text" class="form-control" id="sub_solution_name" name="sub_solution_name"  placeholder="Sub Solution Name" required>
                        </div>
                        <div class="form-group">
                          <label for="solution_title">Title:</label>
                          <input type="text" class="form-control" id="solution_title" name="solution_title"  placeholder="Solution Title" required>
                        </div>
                        <div class="form-group">
                        <label for="solution_img">Image:</label>
                            <input type='file'  class="form-control" name="solution_img" id="solution_img" required/>
                            <img id="solution_Img"  src="#" alt="MYTT" />
                        </div>                    

                        <div class="form-group">
                          <label for="solution_content">Content:</label>
                          <input type="text" style="height:100px" name="solution_content" class="form-control" id="solution_content" placeholder="Solution Content" required>
                        </div>
                      <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form></div></div></div>

          <!--</div> <div class="row"> -->
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Solution Contents</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Sr. No.</th>
                          <th>ID</th>
						  <th>Solution</th>
                          <th>Sub Solution Name</th>
                          <th>Title</th>
                          <th>Images</th>
                          <th>content</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($solution_content): ?>
                          <?php foreach($solution_content as $solution): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($solution['id']) { echo $solution['id']; } else { ""; } ?></td>
								                  <td><?php echo $solution['solution_name']; ?></td>
                                  <td><?php if($solution['sub_solution_name']) { echo $solution['sub_solution_name']; } else { ""; } ?></td>
                                  <td><?php echo $solution['solution_subtitle']; ?></td>
                                  <td><img style="border-radius:0%;" src="./assets/images/upload_image/<?php echo $solution['solution_image']; ?>" /></td>
                                  <td><?php echo $solution['solution_content']; ?></td>
                                  <td> <a href="<?php echo base_url('edit_solution_content/'.$solution['id']); ?>" class="btn btn-info btn-sm">
                                          <i class="mdi mdi-lead-pencil"></i>
                                        </a>
                                        <button data-id="<?php echo $solution['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteModal"><i class="mdi mdi-delete" ></i></button>
                                      <!-- <a href="<?php echo $solution['id']; ?>" class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-delete"></i></td> -->
                                  </a> 
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
        document.getElementById("solution_Img").width = "300";
                      
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#solution_Img').attr('src', e.target.result);
                    document.getElementById("solution_Img").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        //solution Onchange add text value in solution name
        $(".sol_name_class").change(function(){
          $(".solname_class").val($(".sol_name_class option:selected").text()); 
        });
        
        $("#solution_img").change(function(){
            readURL(this);
        });
        // solution Onchange delete text value in solution name
        $('.delete').click(function() {
              
              $('.deleteModal').modal('toggle');
              var solution_id = $(this).attr('data-id');
              var id = $(this).attr('data-id');
              $("#solution_id").val(solution_id);
            });
    </script>
    <!-- Large modal -->
       
    <div class="modal fade deleteModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/delete_solution_content"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Solution content</h1>
                <p>Are you sure you want to permenant delete your Solution content?</p>
                <br>
                <div>
                  <input type="hidden" id="solution_id" name="solution_id">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    