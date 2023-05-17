<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Email Setting</h4>
                  <?php $validation = \Config\Services::validation(); ?>
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
                  
                  <form class="forms-sample" action="<?php echo base_url("Admin/".$form); ?>" method="POST"  enctype="multipart/form-data" >
                   
                  <div class="form-group" style="display:none">
                        <label for="header">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $id;?>" placeholder="ID">
                      </div>

                  <div class="form-group">
                      <label for="general">General Email</label>
                      <input type="email" class="form-control" name="general" id="general" value="<?php echo $general;?>" placeholder="General Email" required>
                    </div>
                    <div class="form-group">
                      <label for="support">Support Email</label>
                      <input type="email" class="form-control" name="support" id="support" value="<?php echo $support;?>" placeholder="Support Email" required>
                    </div>
                    <div class="form-group">
                      <label for="quote"> Quote Email</label>
                      <input type="email" class="form-control" name="quote" id="quote" value="<?php echo $quote;?>" placeholder="Quote Email" required>
                    </div>
                    

                    
                    <button type="submit" class="btn btn-primary me-2"><?php echo  $button; ?></button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
            