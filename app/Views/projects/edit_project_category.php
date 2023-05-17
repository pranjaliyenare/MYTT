
<style>
     .modal-content {
        padding: 20px;
        text-align: center;
     }
</style>

<?php $selected = ''; ?>
<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Project Category:</h4>

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
                  
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/edit_project_category"); ?>" method="POST"  enctype="multipart/form-data" >
                  
                  <div class="form-group" style="display:block">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id"   value="<?php echo $id; ?>" placeholder="ID">
                      </div>
                    
                    <div class="form-group">
                      <label for="proj_cat">Project Category:</label>
                      <input type="text" class="form-control" name="proj_cat" id="proj_cat" value="<?php echo $project_category;?>" placeholder="Project Category" required>
                    </div>
                     <button type="btnEdit" class="btn btn-primary me-2">Edit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>


        

   