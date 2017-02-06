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
                  <h2>Slider</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Data ditampilkan sesuai keinginan anda.
                    </p>
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Judul</th>
                          <th>Class</th>
                          <th>Deskripsi</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($slider as $data): ?>
                          <?php $enc_id = encrypt($data->id,true) ?>
                          <tr>
                            <td><?php echo $data->judul ?></td>
                            <td><?php echo $data->class ?></td>
                            <td><?php echo limit_words($data->des, 10) ?></td>
                            <td>
                                <center>
                                  <a href="<?php echo site_url("admin/slider/edit/".$enc_id) ?>" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-warning"> <i class="fa fa-pencil"></i> </a>
                                  <a href="<?php echo site_url("admin/slider/delete/".$enc_id) ?>" data-toggle="tooltip" title="Hapus" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin?\')"> <i class="fa fa-trash"></i> </a>
                                </center>
                              </td>
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