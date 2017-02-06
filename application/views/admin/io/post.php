<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>UNJ Mengajar</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
          <h2>Post</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form enctype="multipart/form-data" action="<?php echo $action ?>" method="post">
          <input type="hidden" name="form-id" value="<?php echo $id ?>">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" required="required" value="<?php echo $judul ?>" placeholder="Judul Post" name="form-judul">
            </div>
          </div><br><br><br>
          <div class="form-group">
            <input type="hidden" name="old-form-img" value="<?php echo $img ?>">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gambar</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="file" name="form-img">
            </div>
          </div><br><br><br>
          <textarea name="form-des" class="ckeditor" id="ckeditor"><?php echo $des ?></textarea>             
          <br />
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-primary">Cancel</button>
              <button type="submit" class="btn btn-success" name="add">Submit</button>
            </div>
          </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>