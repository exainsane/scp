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
          <h2>Device Key</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?php echo $action ?>" method="post">
            <input type="hidden" name="form-id" value="<?php echo $id ?>">
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12 row">Key</label>              
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" class="form-control" required="required" placeholder="Judul Testimoni" value="<?php echo $device_key ?>" name="form-device_key">                
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <button class="btn btn-sm">Generate</button>  
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 col-xs-12 row">Key</label>              
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select name="form-used_by" id="" class="form-control" required>
                    <option value="" disabled="">Select user that will use this key</option>
                    <?php foreach ($users as $user): ?>
                      <option value="<?php echo $user->id ?>"><?php echo $user->firstname." ".$user->lastname." (<br>".$user->username."</br>)" ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">                  
                </div>
              </div>
            </div>
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