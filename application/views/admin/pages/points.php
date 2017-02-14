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
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Point Name</th> 
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Auth Key</th>
                  <th>QR Code</th>
                  <th>Actions</th>                 
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach ($rows as $data): ?>
                  <?php $enc_id = encrypt($data->id,true) ?>
                  <tr>
                    <td><?php echo ++$i ?></td>
                    <td><?php echo $data->point_name ?></td>                    
                    <td><?php echo $data->point_lat ?></td>                    
                    <td><?php echo $data->point_long ?></td>                    
                    <td><?php
                      if(strlen($data->point_key) != 0 && strlen($data->point_key) == 20){
                        echo $data->point_key;
                      }else{
                        ?>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-info dropdown-toggle" id="drop_addkey<?php echo $data->id ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Register a Key</button>
                          <div class="dropdown-menu row" aria-labelledby="drop_addkey<?php echo $data->id ?>">
                            <div class="col-md-12">
                              <label for="">POINT NAME : <?php echo $data->point_name ?></label>
                            </div>
                            <div class="col-md-12">
                              <label for="">Already have a Key</label>
                            </div>
                            <div class="col-md-12">
                              <form action="<?php echo site_url("admin/insertkey/point") ?>" method="POST">
                                <div class="form-group">
                                  <input type="hidden" name="form-pid" value="<?php echo $data->id ?>">
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
                                  <form action="<?php echo site_url("admin/requestkey/point") ?>" method="POST">
                                    <input type="hidden" name="form-pid" value="<?php echo $data->id ?>">
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
                    <td>
                      <div class="dropdown">
                          <button class="btn btn-sm btn-warning dropdown-toggle" id="drop_crtqrkey<?php echo $data->id ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Generate QR</button>
                          <div class="dropdown-menu row" aria-labelledby="drop_crtqrkey<?php echo $data->id ?>">
                            <div class="col-md-12">
                              <label for="">POINT NAME : <?php echo $data->point_name ?></label>
                            </div>
                            <div class="col-md-12">
                              <label for="">
                                Note : Generating new QR Code will make the old QR become invalid. <br>
                                Make sure ALL device holder resync their app after you generate a new QR
                              </label>
                            </div>
                            <div class="col-md-12">
                              <form action="<?php echo site_url("admin/qr/generate") ?>" method="POST">
                                <input type="hidden" name="form-pid" value="<?php echo $data->id ?>">
                                <button class="btn btn-sm btn-danger">Confirm</button>
                              </form>
                            </div>                          
                        </div>
                    </td>
                    <td><center>
                          <a href="<?php echo site_url("admin/points/edit/".$enc_id) ?>" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-warning"> <i class="fa fa-pencil"></i> </a>
                          <a href="<?php echo site_url("admin/points/delete/".$enc_id) ?>" data-toggle="tooltip" title="Hapus" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin?\')"> <i class="fa fa-trash"></i> </a>
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