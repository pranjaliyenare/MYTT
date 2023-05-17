<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Service Contents</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/edit_services_content"); ?>" method="POST"  enctype="multipart/form-data">                  
                          <div class="form-group" style="display:none">
                            <label for="id">ID:</label>
                            <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                          </div>              
                            <div class="form-group" id="Offerper_div_id">
                              <label for="ser_name">Select Service</label>    
                              <input type="hidden" class="form-control sername_class" name="sername" id="sername" value="<?php echo $services_name; ?>" required>                      
                              <select class="form-control ser_name_class" name="ser_name" id="ser_name">';
                              <option value="0">Select Service...</option>
                                <?php $i = 0; if($services): ?>
                                  <?php foreach($services as $serv): 
                                    if($serv['id'] == $services_id) { $selected = 'selected'; } else { $selected = ''; } ?>
                                    <option value="<?php echo $serv['id'] ?>" <?php echo $selected; ?>><?php echo $serv['service_name'] ?></option>       
                                  <?php  endforeach; ?>
                                <?php endif; ?>                            
                              </select>
                            </div>
                        <div class="form-group">
                          <label for="sub_service_name">Sub Service Name</label>
                          <input type="text" class="form-control" id="sub_service_name" name="sub_service_name" value="<?php echo $sub_service_name; ?>" placeholder="Sub Service Name" required>
                        </div>
                        <div class="form-group">
                          <label for="service_sub">Subtitle:</label>
                          <input type="text" class="form-control" id="service_sub" name="service_sub" value="<?php echo $service_subtitle; ?>"  placeholder="Service Subitle" required>
                        </div>
                        <div class="form-group">
                        <label for="service_img">Image:</label>
                        <input type="hidden" class="form-control hdn_serv_img_class" name="hdn_serv_img" id="hdn_serv_img" value="<?php echo $service_image; ?>" >                      
                            <input type='file'  class="form-control" name="service_img" id="service_img"/>
                            <img id="service_Img" name="imgServiceName"  src="<?php echo base_url(); ?>/assets/images/upload_image/<?php echo $service_image; ?>" alt="MYTT" />
                        </div>                    

                        <div class="form-group">
                          <label for="service_content">Content:</label>
                          <textarea style="height:100px" name="service_content" class="form-control" rows="10" id="service_content" placeholder="Service Content" required><?php echo $service_content; ?></textarea>
                        </div>
                      <button type="btnEdit" class="btn btn-info me-2">Edit</button>
                  </form></div></div></div>
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
           document.getElementById("service_Img").width = "300";
           
           
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#service_Img').attr('src', e.target.result);
                    document.getElementById("service_Img").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        // service Onchange add text value in service name
        $(".ser_name_class").change(function(){
          $(".sername_class").val($(".ser_name_class option:selected").text()); 
        });
        
        $("#service_img").change(function(){
            readURL(this);
        });
        
    </script>