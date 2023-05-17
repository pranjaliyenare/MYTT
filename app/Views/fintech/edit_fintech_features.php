<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Fintech Features</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/edit_fintech_features"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display: none;">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                      </div>
					 
                      <div class="col-md-12 mb-3" id="mmg_div_id">
                          <label for="fintch_name">Select Fintech</label>    
                          <input type="hidden" class="form-control fintchname_class" name="fintchname" id="fintchname" value="<?php echo $fintech_name; ?>"  placeholder="ID">                      
                          <select class="form-control fintch_name_class" name="fintch_name" id="fintch_name">';
                          <option value="0">Select Fintech...</option>
                            <?php $i = 0; if($fintch): ?>
                              <?php foreach($fintch as $fintech): ?>
                                <?php if($fintech['fintech_name'] == $fintech_name) { $selected = 'selected'; } else { $selected = ''; } ?>
                                  <option value="<?php echo $fintech['id'] ?>"<?php echo $selected; ?>><?php echo $fintech['fintech_name']; ?></option>       
                              <?php endforeach; ?>
                            <?php endif; ?>                            
                          </select>
                      </div>
                    <div class="form-group">
                      <label for="title">Title:</label>
                      <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>"  placeholder="Fintech Title" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="content">Content:</label>
                      <input type="text" style="height:100px" name="content" class="form-control" id="content" value="<?php echo $content; ?>" placeholder="Fintech and BlockChain Content" required>
                    </div>
                  <button type="btnEdit" class="btn btn-info me-2">Edit</button>
                  </form></div></div></div>

         
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
           document.getElementById("fintch_Img").width = "300";
           
           
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#fintch_Img').attr('src', e.target.result);
                    document.getElementById("fintch_Img").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
         // Fintch and BlockChain Onchange add text value in Fintch and BlockChain name
         $(".fintch_name_class").change(function(){
          $(".fintchname_class").val($(".fintch_name_class option:selected").text()); 
        });
        $("#fintch_img").change(function(){
            readURL(this);
        });
        
    </script>