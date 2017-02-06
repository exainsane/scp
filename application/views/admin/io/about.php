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
          <h2>About</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?php echo $action ?>" method="POST">
          <input type="hidden" name="form-id" value="<?php echo $id; ?>">
          <textarea name="form-about" class="ckeditor" id="ckedtor"><?php echo $about; ?></textarea>
          <br />
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-primary">Cancel</button>
              <button type="submit" class="btn btn-success" name="simpan">Update</button>
            </div>
          </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>