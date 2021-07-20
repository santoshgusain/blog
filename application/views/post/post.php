<?php

$vTitle = set_value('vTitle');
$vFeaturedImage = set_value('vFeaturedImage');
$iCategoryId = set_value('iCategoryId');
$iSubCategoryId = set_value('iSubCategoryId');
$tContent = set_value('tContent');

if(isset($post)){
    $vTitle = $post->vTitle;
    $vFeaturedImage = $post->vFeaturedImage;
    $iCategoryId = $post->iCategoryId;
    $iSubCategoryId = $post->iSubCategoryId;
    $tContent = $post->tContent;
}

?>

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
                          <form id="quickForm" action="<?= base_url('post/manage_post') ?>" method="post" enctype="multipart/form-data">
                              <div class="card-body">

                              <input type="hidden" name="iPostId" value="<?= $iPostId??''?>">
                                  <div class="row">
                                      <div class="form-group col-md-6">
                                          <label for="exampleInputEmail1">Title</label>
                                          <input type="text" name="vTitle" value="<?= $vTitle?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                          <?= form_error('vTitle')?>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <label for="exampleInputEmail1">Featured Image</label>
                                          <div class="custom-file">
                                              <label class="custom-file-label" for="vFeaturedImage">Choose file</label>
                                              <input type="file" name="vFeaturedImage" class="custom-file-input" id="vFeaturedImage">
                                              <?= form_error('vFeaturedImage')?>
                                          </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="iCategoryId" id="iCategoryId" class="form-control">
                                            <option value="" selected>-select-</option>
                                            <?php foreach($category as $row){?>
                                                <option <?= ($iCategoryId == $row->iCategoryId)?'selected':'' ?> value="<?= $row->iCategoryId??'' ?>"><?= ucwords($row->vCategoryName) ?></option>
                                            <?php }?>
                                            </select>
                                            <?= form_error('iCategoryId')?>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Sub-Category</label>
                                            <select name="iSubCategoryId" id="iSubCategoryId" class="form-control">
                                            <option selected>-select-</option>
                                            <?php foreach($subcategory as $row){?>
                                                <option <?= ($iSubCategoryId == $row->iSubCategoryId)?'selected':'' ?> value="<?= $row->iSubCategoryId	??'' ?>"><?= ucwords($row->vSubCategoryName) ?></option>
                                            <?php }?>
                                            </select>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="form-group col-md-12">
                                          <label for="exampleInputEmail1">Content</label>
                                          <textarea class="form-control" name="tContent" id="post-content" rows="2"><?=$tContent?></textarea>
                                          <?= form_error('tContent')?>
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