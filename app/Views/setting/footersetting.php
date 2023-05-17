<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Footer Setting</h4>
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
                 
                  <form class="forms-sample" action="<?php echo base_url("Admin/".$form); ?>" method="POST">
                   
                    <div class="form-group" style="display:none">
                        <label for="header">ID:</label>
                        <input type="text" class="form-control" name="id" id="id"   value="<?php echo $id;?>" placeholder="ID">
                      </div>
                      <div class="form-group">
                      <label for="copy">Copyright</label>
                      <input type="text" class="form-control" name="copy" id="copy"  value="<?php echo $copy;?>" placeholder="Copyright" required>
                    </div>
                    <div class="form-group">
                      <label for="link">Link</label>
                      <input type="text" class="form-control" name="link" id="link"  value="<?php echo $link;?>" placeholder="Link"  required>
                    </div>
                    <div class="form-group">
                      <label for="developedBy">Developed by:</label>
                      <input type="text" class="form-control" name="developedBy" id="developedBy"  value="<?php echo $developedBy;?>" placeholder="Developed by" required>
                    </div>
                     <button type="submit" class="btn btn-primary me-2"><?php echo  $button; ?></button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>