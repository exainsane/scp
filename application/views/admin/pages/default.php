<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Marva Security Checkpoint</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-3 col-xs-6 col-sm-6">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-mobile-phone"></i>
              </div>
              <div class="count">5</div>

              <h3>Devices</h3>
              <p>4/5 Devices Registered.</p>
            </div>
          </div>
          <div class="col-md-3 col-xs-6 col-sm-6">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-crosshairs"></i>
              </div>
              <div class="count">7</div>

              <h3>Points</h3>
              <p>7/7 Points Registered.</p>
            </div>
          </div>
          <div class="col-md-3 col-xs-6 col-sm-6">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-qrcode"></i>
              </div>
              <div class="count">250</div>

              <h3>Checkouts</h3>
              <p>250/310 Checkouts Scheduled.</p>
            </div>
          </div>
          <div class="col-md-3 col-xs-6 col-sm-6">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-share-square-o"></i>
              </div>
              <div class="count">0</div>

              <h3>Events</h3>
              <p>0 Events Happened.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Recent Activities <small>Events & Broadcast</small></h2>            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <div class="dashboard-widget-content">
                <ul class="list-unstyled timeline widget scrollable" style="max-height:300px">
                  <?php foreach ($recents as $row): ?>
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                            <a><?php echo $row->type == 'event'?$row->title : ucfirst($row->type) ?></a>
                          </h2>
                          <div class="byline">
                            <span><?php echo $row->time ?></span> by <a><?php echo $row->username ?></a>
                          </div>
                          <p class="excerpt"><?php echo $row->type == 'event'? $row->title : $row->message ?></a>
                          </p>
                        </div>
                      </div>
                    </li>
                  <?php endforeach ?>
                  <!--  -->
                  <li>
                    <div class="block">
                      <div class="block_content">
                        <h2 class="title">
                                          <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                      </h2>
                        <div class="byline">
                          <span>13 hours ago</span> by <a>Jane Smith</a>
                        </div>
                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                        </p>
                      </div>
                    </div>
                  </li>
                  <!--  -->
                </ul>
              </div>
            </div>
        </div>
      </div>
      <div class="col-md-8 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>User Checkout Accomplishment</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a href="#" class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="data table table-striped no-margin">
              <tr>
                <th>User Name</th>
                <th>Fullname</th>
                <th>Accomplishment</th>
              </tr>
              <?php foreach ($accm as $row): ?>
                <?php $percentage = $row->checkouts / $row->point_no * 100 ?>
                <tr>
                  <td><?php echo $row->username ?></td>
                  <td><?php echo $row->firstname." ".$row->lastname ?></td>
                  <td>
                    <div class="progress">
                      <div class="progress-bar progress-bar-<?php echo $percentage >= 30?"success":"danger" ?>" data-transitiongoal="<?php echo intval($percentage) ?>"></div>
                    </div>
                  </td>
                </tr>
              <?php endforeach ?>              
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Schedule</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a href="" class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <canvas id="schedulechart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Best Accuracy</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a href="#" class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>        
          <ul class="list-unstyled top_profiles scroll-view">
              <li class="media event">
                <a class="pull-left border-aero profile_thumb">
                  <i class="fa fa-user aero"></i>
                </a>
                <div class="media-body">
                  <a class="title" href="#">Ms. Mary Jane</a>
                  <p><strong>$2300. </strong> Agent Avarage Sales </p>
                  <p> <small>12 Sales Today</small>
                  </p>
                </div>
              </li>
              <li class="media event">
                <a class="pull-left border-green profile_thumb">
                  <i class="fa fa-user green"></i>
                </a>
                <div class="media-body">
                  <a class="title" href="#">Ms. Mary Jane</a>
                  <p><strong>$2300. </strong> Agent Avarage Sales </p>
                  <p> <small>12 Sales Today</small>
                  </p>
                </div>
              </li>
            </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
          <h2>Selamat Datang</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <h2>Anda Sedang Berada Di Halaman Admin</h2>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>