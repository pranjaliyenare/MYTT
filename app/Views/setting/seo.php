<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">SEO Setting</h4>
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
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                    </div>
                    <div class="form-group">
                      <label for="metaTitle">Meta Title :</label>
                      <input type="text" class="form-control" name="metaTitle" id="metaTitle" required value="<?php echo $metaTitle; ?>"  placeholder="Enter Meta title">
                      
                      <!-- <label for="titleContent">Title Content:</label>
                      <input type="text" class="form-control" name="titleContent" id="titleContent" required  value="<//?php echo $titleContent; ?>"  placeholder="Enter Meta Title Content"> -->
                    </div>
                    <div class="form-group">
                      <label for="metaKeyword">Meta Keyword :</label>
                      <input type="text" class="form-control" name="metaKeyword" id="metaKeyword" required value="<?php echo $metaKeyword ; ?>" placeholder="Enter Meta Keyword">
                   
                      <!-- <label for="metaKeywordContent">Meta Keyword Content :</label>
                      <input type="text" class="form-control" name="metaKeywordContent"  id="metaKeywordContent" required value="<//?php echo $metaKeywordContent; ?>" placeholder="Enter Meta Content"> -->
                    </div>
                    <div class="form-group">
                      <label for="metaDescription">Meta Description :</label>
                      <input type="text" class="form-control" name="metaDescription" id="metaDescription" required value="<?php echo $metaDescription; ?>" placeholder="Enter Meta Description">
                    </div>
                    <button type="submit" class="btn btn-primary me-2"><?php echo  $button; ?></button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>