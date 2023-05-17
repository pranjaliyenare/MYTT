<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Our Happy Customers</h4>

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
                  
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/happycustomer"); ?>" method="POST"  enctype="multipart/form-data" >
                  
                  <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                      </div>
                      <div class="form-group" >
                      <label for="name">Name:</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Our Happy Customer Name" required>
                    </div>

                    <div class="form-group">
                      <label for="message">Message:</label>
                      <textarea type="text" class="form-control"  name="message"   id="message"  placeholder="Message" required></textarea>
                    </div>

                    <div class="form-group">
                    <input type='file'  class="form-control" name="image" id="image" />
                        <img  alt="your image" />
                    </div>

                    
                    <button type="submit" class="btn btn-primary me-2">Add</button>
                    <button class="btn btn-light">Cancel</button>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Display Happy Customers</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>Sr. No.</th>
                          <th>HAppy Customers Name</th>
                          <th>Message</th>
                          <th>Costomer Images</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($customer): ?>
                          <?php foreach($customer as $customers): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($customers['cust_name']) { echo $customers['cust_name']; } else { ""; } ?></td>
                                  <td><?php echo $customers['cust_msg']; ?></td>
                                  <td><img style="border-radius:0%;" src="./assets/images/upload_image/<?php echo $customers['cust_image']; ?>" /></td>
                                  
                                  <td> <button type="button" class="btn btn-info btn-rounded btn-icon">
                                    <i class="mdi mdi-lead-pencil"></i>
                                  </button>
                                  <button type="button" class="btn btn-danger btn-rounded btn-icon">
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      document.getElementById("imginp").width = "300";
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#imginp').attr('src', e.target.result);
                    document.getElementById("imginp").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#image").change(function(){
            readURL(this);
        });
    </script>