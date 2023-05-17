<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Fintech</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/edit_fintech"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>">
                      </div>
                    <div class="form-group">
                      <label for="fintech">Fintech Name:</label>
                      <input type="text" class="form-control" id="fintech" name="fintech" value="<?php echo $fintech_name; ?>" placeholder="Fintech Name" required>
                    </div>
                    
                  <button type="btnEdit" class="btn btn-info me-2">Edit</button>
                  </form></div></div></div>
          </div>
        </div>
      </div>
</div>