<div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Display Requested Quote</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sr.No.</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Service</th>
                          <th>Subject</th>
                           <th>Message</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if($quote): ?>
                          <?php foreach($quote as $request): ?>
                            <tr>
                                  <th><?php echo ++$i; ?></th>
                                  <td><?php if($request['name']) { echo $request['name']; } else { ""; } ?></td>
                                  <td><?php echo $request['from']; ?></td>
                                  <td><?php echo $request['service']; ?></td>
                                  <td><?php echo $request['subject']; ?></td>
                                  <td><?php echo $request['message']; ?></td>
                                 
                              </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>      
                        </tbody>
                    </table><br><br>
                  </div>
                </div>
              </div>
            