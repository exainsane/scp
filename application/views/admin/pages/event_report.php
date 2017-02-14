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
          <h2>Report</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Time</th>
                  <th>Nearest Point</th>
                  <th>Username</th> 
                  <th>Caption</th>
                  <th>Description</th>
                  <th>Image</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0;foreach ($events as $data): ?>
                <?php EntityModel::LoadReference($data, "user_id", "m_user", "username") ?>
                  <tr>
                      <td><?php echo ++$i ?></td>
                      <td><?php echo $data->time ?></td>         
                      <td><?php echo $data->point_name ?></td>           
                      <td><?php echo $data->user_id ?></td>
                      <td><?php echo $data->title ?></td>
                      <td><?php echo $data->description ?></td>
                      <td><img src="<?php echo base_url($data->img) ?>" alt="" class="imgintable"></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>