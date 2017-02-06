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
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>                  
                  <th>Shift</th>
                  <th>Point</th>                  
                  <th>Schedule</th> 
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach ($rows as $data): ?>
                  <?php $enc_id = encrypt($data->id,true) ?>
                  <?php EntityModel::LoadReference($data, "shift_id", "m_shift", "title") ?>
                  <?php EntityModel::LoadReference($data, "point_id", "m_point", "point_name") ?>
                  <tr>
                    <td><?php echo ++$i ?></td>                                  
                    <td><?php echo $data->shift_id ?></td>                    
                    <td><?php echo $data->point_id ?></td>                                        
                    <td><?php echo $data->schedule ?></td>    
                    <td><center>
                          <a href="<?php echo site_url("admin/schedules/edit/".$enc_id) ?>" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-warning"> <i class="fa fa-pencil"></i> </a>
                          <a href="<?php echo site_url("admin/schedules/delete/".$enc_id) ?>" data-toggle="tooltip" title="Hapus" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin?\')"> <i class="fa fa-trash"></i> </a>
                        </center></td>
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