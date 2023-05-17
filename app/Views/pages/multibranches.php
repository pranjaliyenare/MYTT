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
                      <div class="col-md-6  grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Multibranches</h4>

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
                              
                              <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/multibranches"); ?>" method="POST"  enctype="multipart/form-data" >
                                    <div class="form-group" style="display:none">
                                      <label for="id">ID:</label>
                                      <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                                    </div>
                                    <div class="form-group" >
                                      <label for="title">Office:</label>
                                        <select id="title" class="form-control" name="title" required>
                                          <option  value="Branch">Branch</option>
                                          <option  value="Head" >Head</option>
                                          <option  value="Regional">Regional</option>
                                        </select>
                                    </div>

                                <div class="form-group"  class="dropdown">
                                      <label for="drop">Branches:</label>
                                      <select id="drop" class="form-control"  name="drop"  required>
                                      <option  value="Abroad" >Abroad</option>
                                      <option  value="CommingSoon">Comming Soon</option>
                                      </select>                                    
                                </div>

                                <div class="form-group">
                                    <label for="branch">Branch Location:</label>
                                    <input type="text" class="form-control"  name="branch"   id="branch"  placeholder="Branch Location" required>
                                </div>


                                <div class="form-group">
                                    <label for="address">Address of Branch:</label>
                                    <textarea type="text" name="address" class="form-control" id="address" placeholder="Address of Branch" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Add</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      
                    

                 <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Display Multibranches Page</h4>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                            <th>Sr.No.</th>
                            <th>ID</th>
                              <th>Office</th>
                              <th>Branches</th>
                              <th>Branch Location</th>
                              <th>Address of branch</th>
                              <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; if($multibranches): ?>
                              <?php foreach($multibranches as $branches): ?>
                                <tr>
                                      <th><?php echo ++$i; ?></th>
                                      <td><?php if($branches['id']) { echo $branches['id']; } else { ""; } ?></td>
                                      <td><?php echo $branches['multi_title']; ?></td>
                                      <td><?php echo $branches['multi_drop']; ?></td>
                                      <td><?php echo $branches['branch_location']; ?></td>
                                      <td><?php echo $branches['branch_address']; ?></td>
                                      <td> <a href="<?php echo base_url('editMultibranches/'.$branches['id']); ?>"  class="btn btn-info btn-sm">
                                        <i class="mdi mdi-lead-pencil"></i>
                              </a>
                                      <button data-id="<?php echo $branches['id']; ?>" type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteMultibranchesPageModal">
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
           $('.delete').click(function() {
              
              $('.deleteMultibranchesPageModal').modal('toggle');
              var id = $(this).attr('data-id');
              $(".id_class").val(id);
            });
        </script>
         <!-- Large modal -->
       
    <div class="modal fade deleteMultibranchesPageModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/deleteMultibranches"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Branch</h1>
                <p>Are you sure you want to permenant delete your Branch?</p>
                <br>
                <div>
                  <input type="hidden" id="id" name="id" class="id_class">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteMultibranchesPageModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        