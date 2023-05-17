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
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Our Partners</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/add_partners_content"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group">
                        <!-- <label for="id">ID:</label> -->
                        <input type="hidden" class="form-control" name="id" id="id" placeholder="ID">
                      </div>
                     
                      <div class="col-md-12 mb-3" id="mmg_div_id">
                          <label for="partners_Type">Select Type</label>    
                          <input type="hidden" class="form-control partnerstype_class" name="partnerstype" id="partnerstype">                      
                          <select class="form-control partners_Type_class" name="partners_Type" id="partners_Type">';
                          <option value="0">Select Type...</option>
                            <?php $i = 0; if($partners): ?>
                              <?php foreach($partners as $type): ?>
                                  <option value="<?php echo $type['id'] ?>"><?php echo $type['partnersType'] ?></option>       
                              <?php endforeach; ?>
                            <?php endif; ?>                            
                          </select>
                        </div>
                        

                        <div class="form-group">
                        <label for="partner">Partners Name:</label>
                        <input type="text" class="form-control" id="partner" name="partner"  placeholder="Our Partners Name" required>
                      </div>
                      <div class="form-group">
                      <label for="partner_logo">Partners Logo:</label>
                          <input type='file'  class="form-control" name="partner_logo" id="partner_logo" required/>
                          <img id="partner_Img"  src="#" alt="MYTT" />
                      </div>                    
                      <div class="form-group">
                        <label for="partner_link">Partners Link:</label>
                        <input type="text" name="partner_link" class="form-control" id="partner_link" placeholder="Partners Link" >
                      </div>
                      <div class="form-group">
                        <label for="partner_content">Partners Content:</label>
                        <textarea type="text" name="partner_content" class="form-control" id="partner_content" placeholder="Our Partners Content" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form>
                </div>
              </div>
            </div>
 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Our Partners</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sr. No.</th>
                        <th>ID</th>
                          <th>Partners Type</th>
                          <th>Name</th>
                          <th>Logo</th>
                          <th>Link</th>
                          <th>Content</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($partner): ?>
                          <?php foreach($partner as $our): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($our['id']) { echo $our['id']; } else { ""; } ?></td>
                                   <td><?php if($our['partnersType']) { echo $our['partnersType']; } else { ""; } ?></td>
                                   <td><?php if($our['partners_name']) { echo $our['partners_name']; } else { ""; } ?></td>
                                  <td><img style="border-radius:0%;" src="./assets/images/upload_image/partners/<?php echo $our['partners_logo']; ?>" /></td>
                                  <td><?php if($our['partners_link']) { echo $our['partners_link']; } else { ""; } ?></td>
                                   <td><?php echo $our['partners_contents']; ?></td>
                                  <td> <a href="<?php echo base_url('editpartnersContents/'.$our['id']); ?>" type="button" class="btn btn-info btn-sm "><i class="mdi mdi-lead-pencil"></i></a>
                                  <button data-id="<?php echo $our['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deletePartnersModal">
                                    <i class="mdi mdi-delete"></i></td>
                                  </button> 
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
      </div>
    </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
           document.getElementById("partner_Img").width = "300";
           
           
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#partner_Img').attr('src', e.target.result);
                    document.getElementById("partner_Img").width = "300";
                }                
                reader.readAsDataURL(input.files[0]);
            }
          }
             // Fintch and BlockChain Onchange add text value in Fintch and BlockChain name
              $(".partners_Type_class").change(function(){
                $(".partnerstype_class").val($(".partners_Type_class option:selected").text()); 
              });
            
            $("#partner_logo").change(function(){
                readURL(this);
            });
            $('.delete').click(function() {
              $('.deletePartnersModal').modal('toggle');
              var id = $(this).attr('data-id');
              $(".id_class").val(id);
            });
            
        </script>
    <!-- Large modal -->
       
        <div class="modal fade deletePartnersModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/deletePartnersContent"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Our Partners</h1>
                <p>Are you sure you want to permenant delete Our Partners?</p>
                <br>
                <div>
                  <input type="hidden" id="id" name="id" class="id_class">
                  <button type="button" class="btn btn-secondary " onclick="$('.deletePartnersModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        