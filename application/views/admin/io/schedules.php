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
          <h2>Schedules</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?php echo $action ?>" method="post">
            <input type="hidden" name="form-id" value="<?php echo $id ?>">
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Shift</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <select name="form-shift_id" id="" class="form-control">
                  <option value="" disabled>Select Shift</option>
                  <?php foreach ($shifts as $shift): ?>
                    <option value="<?php echo $shift->id ?>"  <?php echo $shift_id == $shift->id?"selected":"" ?> ><?php echo $shift->title ?></option>  
                  <?php endforeach ?>
                </select>              
              </div>
            </div>            

            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Point</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <select name="form-point_id" id="" class="form-control">
                  <option value="" disabled>Select Point</option>
                  <?php foreach ($points as $point): ?>
                    <option value="<?php echo $point->id ?>"  <?php echo $point_id == $point->id?"selected":"" ?> ><?php echo $point->point_name ?></option>  
                  <?php endforeach ?>
                </select>
              </div>
            </div>            

            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Schedule (Hour)</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" placeholder="Base Time" value="<?php echo $schedule_base ?>" name="form-schedule_base">
              </div>
            </div>            

            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">After First Schedule (Minute)</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" placeholder="After (n) Minutes" value="<?php echo $after ?>" name="form-after">
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