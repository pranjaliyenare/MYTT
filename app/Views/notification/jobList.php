            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Display Job Apply List</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Sr.No.</th>
                          <th>Name</th>
                          <th>Email</th>                         
                          <th>Phone</th>                         
                          <th>CV</th>                         
                          <th>Job Type</th>
                           <th>Message</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $i = 0; if($job): ?>
                          <?php foreach($job as $jobAppl): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($jobAppl['name']) { echo $jobAppl['name']; } else { ""; } ?></td>
                                  <td><?php echo $jobAppl['email']; ?></td>
                                  <td><?php echo $jobAppl['phone']; ?></td>
                                  <td><form method="get" target="_blank" action="<?php echo base_url("/assets/images/upload_image/Resume")."/".$jobAppl['cv']; ?>">
                                        <button type="submit">Download!</button>
                                      </form>
                                  </td>
                                  <td><?php echo $jobAppl['job_type']; ?></td>
                                  <td><?php echo $jobAppl['message']; ?></td>
                                 
                              </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>      
                        </tbody>
                    </table><br><br>
                  </div>
                </div>
              </div>
            </div>
            