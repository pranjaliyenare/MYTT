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
                  <h4 class="card-title">Partner</h4>  
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
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/add_partners"); ?>" method="POST"  enctype="multipart/form-data">                  
                      <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                      </div>
                    <div class="form-group" >
                        <label for="partner_type">Partner Type:</label>
                        <input type="text" class="form-control" id="partner_type" name="partner_type"  placeholder="Partner Type" required>
                    </div>
                  <button type="submit" class="btn btn-primary me-2">Add</button>
                  </form></div></div></div>

          <!--</div> <div class="row"> -->
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Partner</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sr. No.</th>
                        <th>ID</th>
                        <th>Partner Type</th>                          
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php  $i = 0; if($partners): ?>
                          <?php foreach($partners as $type): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($type['id']) { echo $type['id']; } else { ""; } ?></td>
                                  <td><?php if($type['partnersType']) { echo $type['partnersType']; } else { ""; } ?></td>
                                  <td> <a href="<?php echo base_url('edit_partner/'.$type['id']); ?>" class="btn btn-info btn-sm">
                                    <i class="mdi mdi-lead-pencil"></i>
                          </a>
                                  <button data-id="<?php echo $type['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteModal"><i class="mdi mdi-delete" ></i></button>
                                    <!-- <button type="button" class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-delete"></i></td>
                                  </button>  -->
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
           $('.delete').click(function() {
              
              $('.deleteModal').modal('toggle');
              var id = $(this).attr('data-id');
             $(".id_class").val(id);
            });
        </script>
         <!-- Large modal -->
       
    <div class="modal fade deleteModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/delete_partner"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Partner Type</h1>
                <p>Are you sure you want to permenant delete your added Partner Type?</p>
                <br>
                <div>
                  <input type="hidden" class="id_class" id="id" name="id">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        