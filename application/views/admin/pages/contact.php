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
          <h2>Contact</h2>
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
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Message</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($contact as $data): ?>                
                  <tr>
                    <td><?php echo $data->name ?></td>
                    <td><?php echo $data->email ?></td>
                    <td><?php echo limit_words($data->message,10) ?></td>
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