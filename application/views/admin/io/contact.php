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
          <h2><?php echo $mode == null?"":ucfirst($mode)." - " ?>Contact</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?php echo $action ?>" method="POST">
          <input type="hidden" name="form-id" value="<?php echo $id; ?>">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" required="required" placeholder="Nama" value="<?php echo $name ?>" name="form-name">
            </div>
          </div><br><br><br>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" required="required" placeholder="Email" value="<?php echo $email ?>" name="form-email">
            </div>
          </div><br><br><br>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Message</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" required="true" placeholder="Your Message" value="<?php echo $message ?>" name="form-message">
            </div>
          </div>    
          <br><br>
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