<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Solution Contents</h4>  
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
                  <?php  $selected = ''; ?>    
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/edit_solution_content"); ?>" method="POST"  enctype="multipart/form-data">                  
                          <div class="form-group" style="display:none">
                            <label for="id">ID:</label>
                            <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                          </div>              
                            <div class="form-group" id="Offerper_div_id">
                              <label for="sol_name">Select Solution</label>    
                              <input type="hidden" class="form-control solname_class" name="solname" id="solname" value="<?php echo $solution_name; ?>" required>                      
                              <select class="form-control sol_name_class" name="sol_name" id="sol_name">';
                              <option value="0">Select Solution...</option>
                                <?php $i = 0; if($solutions): ?>
                                  <?php foreach($solutions as $sol): 
                                    if($sol['id'] == $solution_id) { $selected = 'selected'; } else { $selected = ''; } ?>
                                    <option value="<?php echo $sol['id'] ?>" <?php echo $selected; ?>><?php echo $sol['solution_name'] ?></option>       
                                  <?php  endforeach; ?>
                                <?php endif; ?>                            
                              </select>
                            </div>
                        <div class="form-group">
                          <label for="sub_solution_name">Sub-Solution Name</label>
                          <input type="text" class="form-control" id="sub_solution_name" name="sub_solution_name" value="<?php echo $sub_solution_name; ?>" placeholder="Sub-Solution Name" required>
                        </div>
                        <div class="form-group">
                          <label for="solution_title">Title:</label>
                          <input type="text" class="form-control" id="solution_title" name="solution_title" value="<?php echo $solution_subtitle; ?>"  placeholder="Solution Title" required>
                        </div>
                        <div class="form-group">
                        <label for="solution_img">Image:</label>
                        <input type="hidden" class="form-control hdn_sol_img_class" name="hdn_sol_img" id="hdn_sol_img" value="<?php echo $solution_image; ?>" >                      
                            <input type='file'  class="form-control" name="solution_img" id="solution_img"/>
                            <img id="solution_Img" name="imgSolName"  src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $solution_image; ?>" alt="MYTT" />
                        </div>                    

                        <div class="form-group">
                          <label for="solution_content">Content:</label>
                          <textarea type="text" style="height:100px" name="solution_content" class="form-control" id="solution_content" rows="10" placeholder="Solution Content" required><?php echo $solution_content; ?></textarea>
                        </div>
                      <button type="btnEdit" class="btn btn-info me-2">Edit</button>
                  </form></div></div></div>
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
        // solution Onchange add text value in solution name
        $(".sol_name_class").change(function(){
          $(".solname_class").val($(".sol_name_class option:selected").text()); 
        });
        
        $("#solution_img").change(function(){
            readURL(this);
        });
        
    </script>