<div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Products</h4>

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
                  
                  <form class="forms-sample" name="form1" id="form1" action="<?php echo base_url("Admin/product"); ?>" method="POST"  enctype="multipart/form-data" >
                  
                  <div class="form-group" style="display:none">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" name="id" id="id"  placeholder="ID">
                      </div>
                      <div class="form-group" >
                      <label for="title">Title:</label>
                      <input type="text" class="form-control" name="title" id="title"  placeholder="Product Title" required>
                    </div>

                    <div class="form-group" >
                      <label for="subtitle">Subtitle:</label>
                      <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Product Subtitle" required>
                    </div>

                    <div class="form-group">
                      <label for="image">Image:</label>
                      <input type="file" class="form-control"  name="image" id="image" placeholder="Image" >
                      <img id="img" alt="your image" />
                    </div>

                    <div class="form-group">
                      <label for="content">Content:</label>
                      <input type="text" style="height:100px" name="content" class="form-control" id="content"  placeholder="Content" required>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary me-2">Add</button>
                    <button class="btn btn-light">Cancel</button>
                    
                  </form>
                </div>
              </div>
            </div>
          
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Products</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th> Sr.No.</th>
                                    <th>Title of Product</th>
                                    <th>Subitle of Product</th>
                                    <th>Product Image</th>
                                    <th>Product Content</th>
                                   
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; if($products): ?>
                                    <?php foreach($products as $product): ?>
                                        <tr>
                                            <th><?php echo ++$i; ?></th>
                                            <td><?php if($product['product_title']) { echo $product['product_title']; } else { ""; } ?></td>
                                            <td><?php if($product['product_subtitle']) { echo $product['product_subtitle']; } else { ""; } ?></td>
                                            <td><img style="border-radius:0%;" src="./assets/images/upload_image/<?php echo $product['product_image']; ?>" /></td>
                                            <td><?php if($product['product_content']) { echo $product['product_content']; } else { ""; } ?></td>
                                            
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
                                </table>
                            </div>
                        </div>
                    </div>
        </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
           document.getElementById("img").width = "300";
           
           
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);
                    document.getElementById("img").width = "300";
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

       
        
        $("#image").change(function(){
            readURL(this);
        });
        
    </script>
        