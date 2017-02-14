<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?php echo site_title() ?></h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
          <h2>Points</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?php echo $action ?>" method="post">
            <input type="hidden" name="form-id" value="<?php echo $id ?>">
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Point Name</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" placeholder="Point Name" value="<?php echo $point_name ?>" name="form-point_name">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Latitude</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" placeholder="Coordinate (Latitude)" value="<?php echo $point_lat ?>" name="form-point_lat">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" placeholder="Coordinate (Longitude)" value="<?php echo $point_long ?>" name="form-point_long">
              </div>
            </div>
            <div class="form-group row">
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