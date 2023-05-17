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
                  <h4 class="card-title">Add</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/proj_category"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="form_id">ID:</label>
                        <input type="text" class="form-control" name="form_id" id="form_id" placeholder="ID">
                      </div>
                    <div class="form-group">
                      <label for="proj_category">Project Category:</label>
                      <input type="text" class="form-control" id="proj_category" name="proj_category"  placeholder="Project Category" required>
                    </div>
                    
                  <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form></div></div></div>

          <!--</div> <div class="row"> -->
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Project Category</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sr. No.</th>
                        <th>ID</th>
                          <th>Project Category Name</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($category): ?>
                          <?php foreach($category as $project): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($project['id']) { echo $project['id']; } else { ""; } ?></td>
                                  <td><?php if($project['project_category']) { echo $project['project_category']; } else { ""; } ?></td>
                                  <td> <a href="<?php echo base_url('edit_project_category/'.$project['id']); ?>" class="btn btn-info btn-sm">
                                    <i class="mdi mdi-lead-pencil"></i>
                          </a>
                                  <button data-id="<?php echo $project['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteModal"><i class="mdi mdi-delete" ></i></button>
                                    <!-- <button type="button" class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-delete"></i></td>
                                  </button>  -->
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
           $('.delete').click(function() {
              
              $('.deleteModal').modal('toggle');
              var id = $(this).attr('data-id');
              $(".id_class").val(id);
            });

           
        </script>
      
        <!-- Large modal -->
       
    <div class="modal fade deleteModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/delete_proj_category"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Project Category</h1>
                <p>Are you sure you want to permenant delete your Project Category?</p>
                <br>
                <div>
                  <input type="hidden" id="id_class" name="id_class"  class="id_class">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        

