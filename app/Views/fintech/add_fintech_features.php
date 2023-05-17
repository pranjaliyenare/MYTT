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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/add_fintech_features"); ?>" method="POST"  enctype="multipart/form-data">                  
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
                      <label for="title">Title:</label>
                      <input type="text" class="form-control" id="title" name="title"  placeholder="Fintech Title" required>
                    </div>	               

                    <div class="form-group">
                      <label for="content">Content:</label>
                      <textarea rows="10" name="content" class="form-control" id="content" placeholder="Fintech Content" required></textarea>
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
                  <h4 class="card-title">Fintech Content</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Fintech</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($fintch_feature): ?>
                          <?php foreach($fintch_feature as $fin_feat): ?>
                            <tr>
                                <th><?php echo ++$i; ?></th>
								<td><?php echo $fin_feat['fintech_name']; ?></td>
                                <td><?php if($fin_feat['title']) { echo $fin_feat['title']; } else { ""; } ?></td>
                                <td><?php echo $fin_feat['content']; ?></td>
                                <td>
                                      <a href="<?php echo base_url('edit_fintech_features/'.$fin_feat['id']); ?>" class="btn btn-info btn-sm">
                                        <i class="mdi mdi-lead-pencil"></i>
                                      </a>
                                      <button data-id="<?php echo $fin_feat['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteModal"><i class="mdi mdi-delete" ></i></button>
                                </td>
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
            <form action="<?php echo base_url("Admin/delete_fintech_features"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Features</h1>
                <p>Are you sure you want to permanent delete your Fintech Features?</p>
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