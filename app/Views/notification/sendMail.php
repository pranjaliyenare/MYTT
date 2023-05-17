<div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Display Contacted Customer</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sr.No.</th>
                          <th>Name</th>
                          <th>Email</th>
                         
                          <th>Subject</th>
                           <th>Message</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($mail): ?>
                          <?php foreach($mail as $send): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($send['name']) { echo $send['name']; } else { ""; } ?></td>
                                  <td><?php echo $send['from']; ?></td>
                                  
                                  <td><?php echo $send['subject']; ?></td>
                                  <td><?php echo $send['message']; ?></td>
                                 
                              </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>      
                        </tbody>
                    </table><br><br>
                  </div>
                </div>
              </div>
            </div>
            