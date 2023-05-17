<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">System Setting</h4>
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
                        <input type="text" class="form-control" name="id" id="id"   value="<?php echo $id;?>" placeholder="ID">
                    </div>
                    <div class="form-group">
                      <label for="sitename">Site Name</label>
                      <input type="text" class="form-control" name="sitename" id="sitename" required  value="<?php echo $sitename;?>" placeholder="Enter Site name">
                    </div>
                    <div class="form-group">
                      <label for="shortsite">Short Site Name</label>
                      <input type="text" class="form-control" name="shortsite" id="shortsite" required  value="<?php echo $shortsite;?>" placeholder="Enter Short Site name">
                    </div>
                    <div class="form-group">
                      <label for="siteurl">Site URL</label>
                      <input type="text" class="form-control" name="siteurl"  id="siteurl" required  value="<?php echo $siteurl;?>" placeholder="Enter Site Url">
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" name="address" id="address" required value="<?php echo $address;?>" placeholder="Address">
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone Number</label>
                      <input type="text" class="form-control" name="phone" id="phone"required value="<?php echo $phone;?>" placeholder="Phone">
                    </div>
                    <div class="form-group">
                      <label for="email">Email </label>
                      <input type="email" class="form-control" name="email" id="email" required value="<?php echo $email;?>" placeholder="Email">
                    </div>
                    
                    <button type="submit" class="btn btn-primary me-2"><?php echo  $button; ?></button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>