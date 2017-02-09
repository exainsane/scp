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
          <h2>Users</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?php echo $action ?>" method="post">
            <input type="hidden" name="form-id" value="<?php echo $id ?>">  

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" placeholder="" value="<?php echo $username ?>" name="form-username">
              </div>
            </div>
            <br><br>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" placeholder="" value="" name="form-password">
              </div>
            </div>
            <br><br>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" placeholder="First" value="<?php echo $firstname ?>" name="form-firstname">
                <input type="text" class="form-control" required="required" placeholder="Last" value="<?php echo $lastname ?>" name="form-lastname">
              </div>              
            </div>
            <br><br><br><br>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" multiline="true" placeholder="" value="<?php echo $address ?>" name="form-address">
              </div>
            </div>
            <br><br>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" placeholder="" value="<?php echo $phone ?>" name="form-phone">
              </div>
            </div>
            <br><br>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" placeholder="" value="<?php echo $email ?>" name="form-email">
              </div>
            </div>
            <br><br>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Shift</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select name="form-shift" id="">
                  <option value="" disabled>Select Shift</option>
                  <?php foreach ($shifts as $shift): ?>
                    <option value="<?php echo $shift->id ?>"  <?php echo $shift == $shift->id?"selected":"" ?> ><?php echo $shift->title ?></option>  
                  <?php endforeach ?>
                </select>              
              </div>
            </div>
            <br><br>
            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Level</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" placeholder="" value="<?php echo $user_level ?>" name="form-user_level">
              </div>
            </div>
            <br><br>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Device Key</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" required="required" placeholder="" value="<?php echo $device_key ?>" name="form-device_key">
              </div>
            </div>
            <br><br>
            
            <br>
            <br>
            <br>
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