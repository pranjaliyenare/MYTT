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
                  <h4 class="card-title">Edit Youth Empowerment </h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/edityouthEmpowerment"); ?>" method="POST"  enctype="multipart/form-data">                  
                        <div class="form-group" style="display:none">
                            <label for="id">ID:</label>
                            <input type="text" class="form-control" name="id" id="id" placeholder="ID"  value="<?php echo $id; ?>">
                        </div>
                        <div class="form-group">
                          <label for="youth_emp_title">Title:</label>
                          <input type="text" class="form-control" id="youth_emp_title" name="youth_emp_title" value="<?php echo $youth_title; ?>" placeholder="Youth Empowerment Title" required>
                        </div>
                        <div class="form-group">
                          <label for="youth_emp_subtitle">Subtitle:</label>
                          <input type="text" class="form-control" id="youth_emp_subtitle" name="youth_emp_subtitle" value="<?php echo $youth_subtitle; ?>" placeholder="Youth Empowerment Subtitle" required>
                        </div>
                        <div class="form-group" id="image">
                            <label for="youth_emp_img">Image:</label>
                                <input type="hidden" class="form-control hdn_youth_img_class" name="hdn_youth_emp_img" id="hdn_youth_emp_img" value="<?php echo $youth_img; ?>" >
                                <input type='file'  class="form-control" name="youth_emp_img" id="youth_emp_img" />
                                <img id="youth_emp_Img"  src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $youth_img; ?>" alt="MYTT"/>
                        </div>
                        <div class="form-group">
                          <label for="youth_content">Content:</label>
                          <textarea type="text" rows="10" name="youth_content" class="form-control" id="youth_content" placeholder="Youth Empowerment Content" ><?php echo $youth_cont; ?></textarea>
                        </div>
                      <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form>
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
    </script>