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
                  <h4 class="card-title">Fintech Content</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/add_fintech_content"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                      </div>
					 
                      <div class="col-md-12 mb-3" id="mmg_div_id">
                          <label for="fintch_name">Select Fintech</label>    
                          <input type="hidden" class="form-control fintchname_class" name="fintchname" id="fintchname" placeholder="ID">                      
                          <select class="form-control fintch_name_class" name="fintch_name" id="fintch_name">';
                          <option value="0">Select Fintech...</option>
                            <?php $i = 0; if($fintch): ?>
                              <?php foreach($fintch as $block): ?>
                                  <option value="<?php echo $block['id'] ?>"><?php echo $block['fintech_name'] ?></option>       
                              <?php endforeach; ?>
                            <?php endif; ?>                            
                          </select>
                        </div>


                    <div class="form-group">
                      <label for="fintch_title">Title:</label>
                      <input type="text" class="form-control" id="fintch_title" name="fintch_title"  placeholder="Fintech Title" required>
                    </div>	
                    <div class="form-group">
                      <label for="fintch_sub">Subtitle:</label>
                      <input type="text" class="form-control" id="fintch_sub" name="fintch_sub"  placeholder="Fintech Subitle" required>
                    </div>
                    <div class="form-group">
                    <label for="fintch_img">Image:</label>
                        <input type='file'  class="form-control" name="fintch_img" id="fintch_img" required/>
                        <img id="fintch_Img"  src="#" alt="MYTT" />
                    </div>                    

                    <div class="form-group">
                      <label for="fintch_content">Content:</label>
                      <textarea rows="10" name="fintch_content" class="form-control" id="fintch_content" placeholder="Fintech Content" required></textarea>
                    </div>
                  <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form></div></div></div>

          <!--</div> <div class="row"> -->
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Fintech Content</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Sr. No.</th>
                          <th>ID</th>
                          <th>Fintech</th>
                          <th>Title</th>
                          <th>Subtitle</th>
                          <th>Images</th>
                          <th>content</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($fintech_content): ?>
                          <?php foreach($fintech_content as $chain): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($chain['id']) { echo $chain['id']; } else { ""; } ?></td>
								                  <td><?php echo $chain['fintech_name']; ?></td>
                                  <td><?php if($chain['fintech_title']) { echo $chain['fintech_title']; } else { ""; } ?></td>
                                  <td><?php echo $chain['fintech_sub']; ?></td>
                                  <td><img style="border-radius:0%;" src="./assets/images/upload_image/<?php echo $chain['fintech_img']; ?>" /></td>
                                  <td><?php echo $chain['fintech_content']; ?></td>
                                  <td>
                                  <a href="<?php echo base_url('edit_fintech_contents/'.$chain['id']); ?>" class="btn btn-info btn-sm">
                                          <i class="mdi mdi-lead-pencil"></i>
                                        </a>
                                        <button data-id="<?php echo $chain['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteModal"><i class="mdi mdi-delete" ></i></button>
                                        <!-- <button data-id="<?php echo $chain['id']; ?>" name="delete_name" data-toggle="modal" data-target="#deleteModal"  class="btn btn-danger btn-sm delete"> <i class="mdi mdi-delete" ></i></button>  -->

                                  </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>      
                        </tbody>
                    </table><br><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
        $('.delete').click(function() {
              
              $('.deleteModal').modal('toggle');
              var fintch_id = $(this).attr('data-id');
              var id = $(this).attr('data-id');
              $("#fintch_id").val(fintch_id);
            });
    </script>
    <!-- Large modal -->
       
    <div class="modal fade deleteModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/delete_fintech_contents"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Fintech Content</h1>
                <p>Are you sure you want to permanent delete your Fintech Content?</p>
                <br>
                <div>
                  <input type="hidden" id="fintch_id" name="fintch_id">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>