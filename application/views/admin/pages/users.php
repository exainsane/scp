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
          <h2>Shifts</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap user" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th> 
                  <th>Name (First-Last)</th> 
                  <th>Email</th>
                  <th>Shift</th>
                  <th>Level</th>
                  <th>Device Key</th>
                  <th>Actions</th>                 
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach ($rows as $data): ?>
                  <?php $enc_id = encrypt($data->id,true) ?>
                  <?php EntityModel::LoadReference($data, "shift", "m_shift", "title") ?>
                  <tr>
                    <td><?php echo ++$i ?></td>
                    <td><?php echo $data->username ?></td>                    
                    <td><?php echo $data->firstname." ".$data->lastname ?></td>                    
                    <td><?php echo $data->email ?></td>                    
                    <td><?php echo $data->shift ?></td>                    
                    <td><?php echo $filter($data->user_level) ?></td>                    
                    <td><?php
                      if(strlen($data->device_key) != 0 && strlen($data->device_key) == 20){
                        echo $data->device_key;
                      }else{
                        ?>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-info dropdown-toggle" id="drop_addkey<?php echo $data->id ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Register a Key</button>
                          <div class="dropdown-menu row" aria-labelledby="drop_addkey<?php echo $data->id ?>">
                            <div class="col-md-12">
                              <label for="">Username : <?php echo $data->username ?></label>
                            </div>
                            <div class="col-md-12">
                              <label for="">Already have a Key</label>
                            </div>
                            <div class="col-md-12">
                              <form action="<?php echo site_url("admin/insertkey/device") ?>" method="POST">
                                <div class="form-group">
                                  <input type="hidden" name="form-uid" value="<?php echo $data->id ?>">
                                  <input type="text" name="key" class="form-control" maxlength="20">
                                </div>
                                <button class="btn btn-sm btn-default">Verify</button>
                              </form>
                            </div>
                            <?php if ($req_check($data->id) == false): ?>
                              <span class="divider"></span>
                                <div class="col-md-12">
                                  <label for="">Request a Key</label>
                                </div>
                                <div class="col-md-12">
                                  <form action="<?php echo site_url("admin/requestkey/device") ?>" method="POST">
                                    <input type="hidden" name="form-uid" value="<?php echo $data->id ?>">
                                    <button class="btn btn-sm btn-warning">Request Key</button>
                                  </form>
                                </div>
                              </div>
                            <?php else: ?>
                              <div class="col-md-12">
                                <label for="">Key Requested</label>
                              </div>
                            <?php endif ?>
                            
                        </div>
                        <?php
                      }
                      ?>
                    </td>
                    <td><center>
                          <a href="<?php echo site_url("admin/users/edit/".$enc_id) ?>" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-warning"> <i class="fa fa-pencil"></i> </a>
                          <a href="<?php echo site_url("admin/users/delete/".$enc_id) ?>" data-toggle="tooltip" title="Hapus" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin?\')"> <i class="fa fa-trash"></i> </a>
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