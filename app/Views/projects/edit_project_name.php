
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
                  <h4 class="card-title">Edit Project Name:</h4>

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
                  
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/editProjectName"); ?>" method="POST"  enctype="multipart/form-data" >
                  
                  <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id"   value="<?php echo $id; ?>" placeholder="ID">
                      </div>

                  <div class="form-group">
                      <label for="project_name">Project Name:</label>
                      <input type="text" class="form-control proj_name_class" name="proj_name" id="proj_name" value="<?php echo $project_name;?>" placeholder="Project Name" required>
                      <!-- <select class="form-control project_name_class" name="project_name" id="project_name">';
                          <option value="0">Select Project...</option>
                             <?php //$i = 0; if($proj_content): ?>
                              <?php //foreach($proj_content as $content): ?>
                                <option value="<?php //echo $content['id'] ?>"><?php //echo $content['project_name'] ?></option>       
                              <?php //endforeach; ?>
                            <?php //endif; ?>  
							
                          </select> -->
                    </div>


                    <div class="form-group">
                    <label for="proj_image">Image:</label>
                        <input type='file'  class="form-control" name="proj_image" id="proj_image"  />
                        <img id="imginp"  src="<?php echo base_url()."/assets/images/upload_image/project_img/".$proj_images; ?>" alt="MYTT" />
                        <input type="hidden" class="form-control hdn_proj_img_class" name="hdn_proj_img" id="hdn_proj_img" value="<?php echo $proj_images;?>" placeholder="ID">                      
                    </div>

                    <div class="form-group">
                      <label for="proj_url">Project URL:</label>
                      <input type="text" class="form-control" name="proj_url" id="proj_url" value="<?php echo $proj_url;?>" placeholder="Project URL" required>
                    </div>
                    
                   <div class="col-md-12 mb-3" id="mmg_div_id">
                          <label for="proj_cat_name">Select Project Category:</label>    
                          <input type="hidden" class="form-control proj_cat_class" name="proj_cat_class" id="proj_cat_class"  value="<?php echo $project_category;?>"  placeholder="ID">                      
                          <select class="form-control proj_category_class" name="proj_cat_name" id="proj_cat_name">
                          <option value="0">Select Project Category...</option>
                             <?php $i = 0; if($proj_category): ?>
                              <?php foreach($proj_category as $category): ?>
                                <?php if($category['id'] == $project_category) { $selected = 'selected'; } ?>
                                <option value="<?php echo $category['id'] ?>" <?php echo $selected; ?>><?php echo $category['project_category'] ?></option>       
                              <?php endforeach; ?>
                            <?php endif; ?>  
							
                          </select>
                        </div>
                    <div class="form-group">
                      <label for="proj_start_date">Project Start Date:</label>
                      <input type="date" class="form-control" name="proj_start_date" id="proj_start_date" value="<?php echo date('Y-m-d',strtotime($proj_start_date));?>" required>
                    </div>
                    <div class="form-group">
                      <label for="proj_end_date">Project End Date:</label>
                      <input type="date" class="form-control" name="proj_end_date" id="proj_end_date" value="<?php echo date('Y-m-d',strtotime($proj_end_date));?>"  required>
                    </div>
                    <div class="form-group">
                      <label for="proj_type">Project Type:</label>
                      <input type="text" class="form-control" name="proj_type" id="proj_type" value="<?php echo $project_type;?>" placeholder="Project Type" required>
                    </div>
                    <div class="form-group">
                      <label for="proj_price">Project Price:</label>
                      <input type="text" class="form-control" name="proj_price" id="proj_price" value="<?php echo $project_price;?>" placeholder="Project Price" required>
                    </div>
                    <button type="btnEdit" class="btn btn-primary me-2">Edit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
       document.getElementById("imginp").width = "300";
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#imginp').attr('src', e.target.result);
                    document.getElementById("imginp").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        // Project name add text value in Project name
        $(".project_name_class").change(function(){
                $(".proj_name_class").val($(".project_name_class option:selected").text()); 
            });

            // Project category add text value in Project name
        $(".proj_category_class").change(function(){
                $(".proj_cat_class").val($(".proj_category_class option:selected").text()); 
            });
        $("#proj_image").change(function(){
            readURL(this);
        });
    
       
    </script>

   