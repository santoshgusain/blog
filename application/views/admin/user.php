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
                          <form id="quickForm" method='post' action="<?= base_url('admin/user')?>">
                              <div class="card-body">

                                  <div class="row">
                                      <div class="form-group col-md-6">
                                          <label for="exampleInputEmail1">First Name</label>
                                          <input type="text" name="vFirstName" class="form-control" id="vFirstName" placeholder="Enter email">
                                          <?= form_error('vFirstName')?>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <label for="exampleInputEmail1">Last Name</label>
                                          <input type="text" name="vLastName" class="form-control" id="vLastName" placeholder="Enter email">
                                          <?= form_error('vLastName')?>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="form-group col-md-6">
                                          <label for="exampleInputEmail1">Email Address</label>
                                          <input type="email" name="vEmail" class="form-control" id="vEmail" placeholder="Enter email">
                                          <?= form_error('vEmail')?>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <label for="exampleInputPassword1">Mobile Number</label>
                                          <input type="text" name="vMobile" class="form-control" id="vMobile" placeholder="Password">
                                          <?= form_error('vMobile')?>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="form-group col-md-12">
                                          <label for="exampleInputEmail1">Address</label>
                                          <textarea class="form-control" name="tAddress" id="tAddress" rows="2"></textarea>
                                          <?= form_error('tAddress')?>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="form-group col-md-6">
                                          <label for="exampleInputPassword1">Password</label>
                                          <input type="password" name="vPassword" class="form-control" id="vPassword" placeholder="Password">
                                          <?= form_error('vPassword')?>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <label for="exampleInputPassword1">Confirm Password</label>
                                          <input type="password"  class="form-control" id="vConfirmPassword" placeholder="Password">
                                      </div>
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