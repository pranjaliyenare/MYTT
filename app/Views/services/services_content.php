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
                  <h4 class="card-title">Service Contents</h4>  
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
                      <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/services_content"); ?>" method="POST"  enctype="multipart/form-data">                  
                          <div class="form-group" style="display:none">
                            <label for="id">ID:</label>
                            <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                          </div>
              
                            <div class="form-group" id="Offerper_div_id">
                              <label for="ser_name">Select Service</label>    
                              <input type="hidden" class="form-control sername_class" name="sername" id="sername" required>                      
                              <select class="form-control ser_name_class" name="ser_name" id="ser_name">';
                              <option value="0">Select Service...</option>
                                <?php $i = 0; if($services): ?>
                                  <?php foreach($services as $serv): ?>
                                      <option value="<?php echo $serv['id'] ?>"><?php echo $serv['service_name'] ?></option>       
                                  <?php endforeach; ?>
                                <?php endif; ?>                            
                              </select>
                            </div>
                        <div class="form-group">
                          <label for="sub_service_name">Sub Service Name</label>
                          <input type="text" class="form-control" id="sub_service_name" name="sub_service_name"  placeholder="Sub Service Name" required>
                        </div>
                        <div class="form-group">
                          <label for="service_sub">Subtitle:</label>
                          <input type="text" class="form-control" id="service_sub" name="service_sub"  placeholder="Service Subitle" required>
                        </div>
                        <div class="form-group">
                        <label for="service_img">Image:</label>
                            <input type='file'  class="form-control" name="service_img" id="service_img" required/>
                            <img id="service_Img"  src="#" alt="MYTT" />
                        </div>                    

                        <div class="form-group">
                          <label for="service_content">Content:</label>
                          <textarea type="text" style="height:100px" name="service_content" rows="10" class="form-control" id="service_content" placeholder="Service Content" required> </textarea>
                        </div>
                      <button type="submit" class="btn btn-primary me-2">Add</button>
                    </form>
                  </div>
                </div>
              </div>

          <!--</div> <div class="row"> -->
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Service Contents</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Sr. No.</th>
                          <th>ID</th>
						              <th>Service</th>
                          <th>Sub Service Name</th>
                          <th>Subtitle</th>
                          <th>Images</th>
                          <th>content</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($service_content): ?>
                          <?php foreach($service_content as $service): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($service['id']) { echo $service['id']; } else { ""; } ?></td>
								                  <td><?php echo $service['services_name']; ?></td>
                                  <td><?php if($service['sub_service_name']) { echo $service['sub_service_name']; } else { ""; } ?></td>
                                  <td><?php echo $service['service_subtitle']; ?></td>
                                  <td><img style="border-radius:0%;" src="./assets/images/upload_image/<?php echo $service['service_image']; ?>" /></td>
                                  <td><?php echo $service['service_content']; ?></td>
                                  <td> <a href="<?php echo base_url('edit_service_content/'.$service['id']); ?>" class="btn btn-info btn-sm">
                                          <i class="mdi mdi-lead-pencil"></i>
                                        </a>
                                        <button data-id="<?php echo $service['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteModal"><i class="mdi mdi-delete" ></i></button>
                                      <!-- <a href="<?php echo $service['id']; ?>" class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-delete"></i></td> -->
                                  </a> 
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

        // service Onchange delete text value in service name
        $('.delete').click(function() {
          $('.deleteModal').modal('toggle');
          var services_id = $(this).attr('data-id');
          var id = $(this).attr('data-id');
          $("#services_id").val(services_id);
        });
    </script>
    <!-- Large modal -->
       
        <div class="modal fade deleteModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/delete_service_content"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Service content</h1>
                <p>Are you sure you want to permenant delete your Service content?</p>
                <br>
                <div>
                  <input type="hidden" id="services_id" name="services_id">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    