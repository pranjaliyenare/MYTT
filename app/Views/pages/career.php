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
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Career</h4>

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
                  
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/career"); ?>" method="POST"  enctype="multipart/form-data" >
                  
                  <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                      </div>
                    <div class="form-group" >
                      <label for="post"> Post:</label>
                      <input type="text" class="form-control" name="post" id="post" placeholder="Post" required>
                    </div>

                    <div class="form-group" >
                      <label for="designation"> Designation:</label>
                      <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" required>
                    </div>

                    <div class="form-group">
                      <label for="company">Company Name:</label>
                      <input type="text" class="form-control"  name="company"   id="company" placeholder="Company Name">
                    </div>

                    <div class="form-group">
                      <label for="job_type">Job Type:</label>
                      <select type="text" class="form-control"  name="job_type"   id="job_type" required>
                        <option>Please Select.....</option>
                        <option>Full time</option>
                        <option>Part time</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="deadline">Deadline:</label>
                      <input type="date" name="deadline" class="form-control" id="deadline"  placeholder="Deadline" required>
                    </div>

                    <div class="form-group">
                      <label for="timeFrom">Working Time From:</label>
                      <input type="time" name="timeFrom" class="form-control" id="timeFrom"  placeholder="Working Time From" required>
                    </div>
                    <div class="form-group">
                      <label for="timeTo">Working Time To:</label>
                      <input type="time" name="timeTo" class="form-control" id="timeTo"  placeholder="Working Time To" required>
                    </div>
                   
                    <div class="form-group">
                      <label for="experienceFrom">Experience From:</label>
                      <input type="number" name="experienceFrom" class="form-control" id="experienceFrom" placeholder="Experience From" required>
                    </div>
                    <div class="form-group">
                      <label for="experienceTo">Experience To:</label>
                      <input type="number" name="experienceTo" class="form-control" id="experienceTo" placeholder="Experience To" required>
                    </div>

                    <div class="form-group">
                      <label for="location">Location:</label>
                      <input type="text" name="location" class="form-control" id="location" placeholder="Location" required>
                    </div>

                    <div class="form-group">
                      <label for="emptotal">Employees Total:</label>
                      <input type="number" name="emptotal" class="form-control" id="emptotal" placeholder="Employees Total" required>
                    </div>

                    <div class="form-group">
                      <label for="description">Job Description:</label>
                      <textarea type="text" name="description" class="form-control" id="description"  placeholder="Job Description" required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="responsibility">Job Responsibility:</label>
                      <textarea type="text" name="responsibility" class="form-control" id="responsibility"  placeholder="Job Responsibility" required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="education">Education Required:</label>
                      <textarea type="text" name="education" class="form-control" id="education"  placeholder="Education Required" required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="add_req">Additional Requirement:</label>
                      <textarea type="text" name="add_req" class="form-control" id="add_req"  placeholder="Additional Requirement" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="other_Benefits">Others Benefits:</label>
                      <textarea type="text" name="other_Benefits" class="form-control" id="other_Benefits"  placeholder="Others Benefits" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="sal">Salary:</label>
                      <input type="number" name="sal" class="form-control" id="sal"  placeholder="Salary" required>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary me-2">Add</button>
                    
                    
                  </form>
                </div>
              </div>
            </div>
          
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Career</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th> Sr.No.</th>
                                    <th>Post</th>
                                    <th>Designation</th>
                                    <th>Company Name</th>
                                    <th>Deadline</th>
                                    <th>Job Type</th>
                                    <th>Working Time From</th>
                                    <th>Working Time To</th>
                                    <th>Experience From</th>
                                    <th>Experience To</th>
                                    <th>Location</th>
                                    <th>Employees Total</th>
                                    <th>Job Description</th>
                                    <th>Job Responsibility</th>
                                    <th>Education Required</th>
                                    <th>Additional Requirement</th>
                                    <th>Others Benefits</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; if($career): ?>
                                    <?php foreach($career as $user): ?>
                                        <tr>
                                            <th><?php echo ++$i; ?></th>
                                            <td><?php if($user['post_name']) { echo $user['post_name']; } else { ""; } ?></td>
                                            <td><?php if($user['Designation']) { echo $user['Designation']; } else { ""; } ?></td>
                                            <td><?php if($user['company_name']) { echo $user['company_name']; } else { ""; } ?></td>
                                            <td><?php if($user['Deadline']) { echo $user['Deadline']; } else { ""; } ?></td>
                                            <td><?php if($user['Job_Type']) { echo $user['Job_Type']; } else { ""; } ?></td>
                                            <td><?php if($user['working_timeFrom']) { echo $user['working_timeFrom']; } else { ""; } ?></td>
                                            <td><?php if($user['working_timeTo']) { echo $user['working_timeTo']; } else { ""; } ?></td>
                                            <td><?php if($user['expFrom']) { echo $user['expFrom']; } else { ""; } ?></td>
                                            <td><?php if($user['expTo']) { echo $user['expTo']; } else { ""; } ?></td>
                                            <td><?php if($user['Location']) { echo $user['Location']; } else { ""; } ?></td>
                                            <td><?php if($user['employees_total']) { echo $user['employees_total']; } else { ""; } ?></td>
                                            <td><?php if($user['job_description']) { echo $user['job_description']; } else { ""; } ?></td>
                                            <td><?php if($user['Job_Responsibility']) { echo $user['Job_Responsibility']; } else { ""; } ?></td>
                                            <td><?php if($user['Education_Required']) { echo $user['Education_Required']; } else { ""; } ?></td>
                                            <td><?php if($user['additional_req']) { echo $user['additional_req']; } else { ""; } ?></td>
                                            <td><?php if($user['benefits']) { echo $user['benefits']; } else { ""; } ?></td>
                                            <td><?php if($user['salary']) { echo $user['salary']; } else { ""; } ?></td>
                                            <td> <a href="<?php echo base_url('editCareer/'.$user['id']); ?>" type="button" class="btn btn-info btn-sm ">
                                                <i class="mdi mdi-lead-pencil"></i>
                                    </a>
                                            <button  data-id="<?php echo $user['id']; ?>" type="button" class="btn btn-danger btn-info delete" data-toggle="modal" data-target=".deleteCareerModal">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
           
        $('.delete').click(function() {
              
              $('.deleteCareerModal').modal('toggle');
              var id = $(this).attr('data-id');
              $(".id_class").val(id);
            });

        
    </script>
    <!-- Large modal -->
       
    <div class="modal fade deleteCareerModal" id="id01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="<?php echo base_url("Admin/deleteCareer"); ?>" method="POST">
              <div class="modal-content">
                <h1 style="color:red">Delete Career</h1>
                <p>Are you sure you want to permenant delete Career?</p>
                <br>
                <div>
                  <input type="hidden" id="id" name="id" class="id_class">
                  <button type="button" class="btn btn-secondary " onclick="$('.deleteCareerModal').modal('toggle')">Cancel</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        