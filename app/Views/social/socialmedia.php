<style>.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}


/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #0ad7f7;
  color: white;
}
.modal-content {
        padding: 20px;
        text-align: center;
     }

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #0ad7f7;
  color: white;
}
.horizontal-menu .bottom-navbar .page-navigation
{
  position: initial;
}
</style>
  <div class="container-fluid page-body-wrapper">
    <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Social Setting Table</h4>
                        
                          <button id="myBtn" class="btn btn-success" style="float: right" >Add</button>
                          <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr><br><br>
                                <th>Sr. No.</th>
                                <th>Social Media Logo</th>
                                <th>Social Media Name</th>
                                <th>Social Media URL</th>
                                <th>Action</th>                        
                              </thead>
                              <tbody>
                                  <?php $i = 0; if($socialmedia): ?>
                                    <?php foreach($socialmedia as $social): ?>
                                      <tr>
                                            <th><?php echo ++$i; ?></th>
                                            
                                            <td><img style="border-radius:0%;" src="./assets/images/upload_image/<?php echo $social['social_img']; ?>" /></td>
                                            <td><?php if($social['social_name']) { echo $social['social_name']; } else { ""; } ?></td>
                                            <td><?php echo $social['social_url']; ?></td>
                                            <td> <a href="<?php echo base_url('editSocialmedia/'.$social['id']); ?>" class="btn btn-info btn-sm" type="button" >
                                              <i class="mdi mdi-lead-pencil"></i>
                                    </a>
                                            <button data-id="<?php echo $social['id']; ?>" data-toggle="modal" type="button" data-target=".deleteSocialModal" class="btn btn-danger btn-info delete">
                                              <i class="mdi mdi-delete"></i></td>
                                            </button> 
                                        </tr>
                                    <?php endforeach; ?>
                                  <?php endif; ?>      
                              </tbody>
                            </table>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div class="modal fade deleteSocialModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/deletesocialmedia"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Social Media</h1>
                <p>Are you sure you want to permenant delete Social Media?</p>
                <br>
                <div>
                  <input type="text" id="id" name="id" class="id_class">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteSocialModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <div class="modal-header">
              <span class="close">&times;</span>
              <h3>Add Social Setting</h3>
            </div>
            <div class="modal-body">
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
            
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/socialmedia"); ?>" method="POST"  enctype="multipart/form-data" >
                    <div class="form-group" style="display:none">
                        <label for="header">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                      </div>

                    <div class="form-group">
                    <label for="social_image">Social Logo Image:</label>
                        <input type='file'  class="form-control file-upload-info" name="social_img" id="social_image"/>
                        <img id="social_Img" src="#" alt="MYTT"  />
                        
                    </div>
                   
                    <div class="form-group">
                      <label for="social_name">Social Name:</label>
                      <input type="text" class="form-control" name="social_name" id="social_name"    placeholder="Logo Name" required>
                    </div>

                    <div class="form-group">
                      <label for="social_url">URL:</label>
                      <input type="text"  name="social_url" class="form-control" id="social_url"   required placeholder="Social Media URL">
                    </div>
                      <hr/>
                    <button class="btn btn-success" type="submit" >Add</button>
                  </form>
            </div>            
          </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script>
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
        document.getElementById("social_Img").width = "300";
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#social_Img').attr('src', e.target.result);
                    document.getElementById("social_Img").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#social_image").change(function(){
            readURL(this);
        });

        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
          modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#social_img').attr('src', e.target.result);
                    document.getElementById("social_img").width = "300";
                }                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#social_img").change(function(){
            readURL(this);
        });

        $('.delete').click(function() {                
              $('.deleteSocialModal').modal('toggle');
              var id = $(this).attr('data-id');
              $(".id_class").val(id);
        });
      </script>
    <!-- Large modal -->
       
        



            