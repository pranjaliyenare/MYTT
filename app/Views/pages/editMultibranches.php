<div class="container-fluid page-body-wrapper">
              <div class="main-panel">
                <div class="content-wrapper">
                  <div class="row">
                      <div class="col-md-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Update Multibranches</h4>

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
                              
                              <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/editMultibranches"); ?>" method="POST"  enctype="multipart/form-data" >
                                    <div class="form-group" style="display:none">
                                      <label for="id">ID:</label>
                                      <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>" placeholder="ID">
                                    </div>
                                    <div class="form-group" >
                                      <label for="title">Office:</label>
                                        <select id="title" class="form-control" name="title" value="<?php echo $multi_title; ?>" required>
                                          <option  value="Branch">Branch</option>
                                          <option  value="Head" >Head</option>
                                          <option  value="Regional">Regional</option>
                                        </select>
                                    </div>

                                <div class="form-group"  class="dropdown">
                                      <label for="drop">Branches:</label>
                                      <select id="drop" class="form-control"  name="drop" value="<?php echo $multi_drop; ?>" required>
                                      <option  value="Abroad" >Abroad</option>
                                      <option  value="CommingSoon">Comming Soon</option>
                                      </select>                                    
                                </div>

                                <div class="form-group">
                                    <label for="branch">Branch Location:</label>
                                    <input type="text" class="form-control"  name="branch"   id="branch" value="<?php echo $branch_location; ?>" placeholder="Branch Location" required>
                                </div>


                                <div class="form-group">
                                    <label for="address">Address of Branch:</label>
                                    <textarea type="text" name="address" class="form-control" id="address" placeholder="Address of Branch" required><?php echo $branch_address ?></textarea>
                                </div>
                                <button type="btnEdit" class="btn btn-primary me-2">Edit</button>
                              </form>
                            </div>
                          </div>
                        </div>
                  </div>
                </div>
              </div>
</div>
                      