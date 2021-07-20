<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= $pagetitle??'' ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?= $pagetitle??'' ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">



      <!-- <div class="row"> -->
        <div class="card">
          <div class="card-header" style="display: flex; align-items:center">
            <h3 class="card-title" style="flex: 1;"><?= $pagetitle??'' ?></h3>
            <a href="<?= base_url('admin/user')?>" class="btn btn-outline-info btn-flat"><i class="far fa-user"></i>&nbsp&nbspAdd User</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="user_table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Action</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Address</th>
                </tr>
              </thead>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
<!-- </div> -->