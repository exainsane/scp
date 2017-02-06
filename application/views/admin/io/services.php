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
          <h2>Service</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?php echo $action ?>" method="post">
          <input type="hidden" value="<?php echo $id ?>" name="form-id">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name Service</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" required="required" placeholder="Nama Layanan Service" value="<?php echo $judul ?>" name="form-judul">
            </div>
          </div><br><br><br>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Icon</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" required="required" placeholder="Nama Icon" value="<?php echo $icon ?>" name="form-icon">
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