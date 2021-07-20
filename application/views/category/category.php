  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1><?= $pagetitle ?></h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active"><?= $pagetitle ?></li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                      <!-- jquery validation -->
                      <div class="card card-primary">
                          <div class="card-header">
                              <h3 class="card-title"><?= $pagetitle ?></h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form id="category-form" action="<?= base_url('category/manage_category')?>" method="post">
                              <div class="card-body">

                                  <div class="row">
                                      <div class="form-group col-md-12">
                                          <label for="vCategoryName d-flex "> <span class="flex-1 ">Category Name</span> 
                                          <button id="add-sub-category" class=" ms-auto btn btn-flat btn-info h-100">Add Sub-Category</button>
                                          </label>
                                          <input type="text" name="vCategoryName" class="form-control" id="vCategoryName" placeholder="Enter Category Name">
                                          <?= form_error('vCategoryName')?>
                                      </div>

                                      
                                  </div>
                                  <div class="row" id="sub-category-container">

                                  </div>

                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary rounded-0">Submit</button>
                              </div>
                          </form>
                      </div>
                      <!-- /.card -->
                  </div>
                  <!--/.col (left) -->
                  <!-- right column -->
                  <div class="col-md-6">

                  </div>
                  <!--/.col (right) -->
              </div>
              <!-- /.row -->
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>