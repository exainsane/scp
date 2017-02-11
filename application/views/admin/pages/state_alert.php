<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Marva Security Checkpoint</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
          <h2>Information</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <h2><?php echo $message ?></h2>
          <?php if (isset($alert)): ?>
            <div class="alert alert-success" role="alert"><?php echo $alert ?></div>
          <?php endif ?>
          <p>
            <?php echo $content ?>
          </p>     
          <a href="<?php echo $redir ?>" class="btn btn-success btn-md">Go Back</a>     
        </div>
        </div>
      </div>
    </div>
  </div>
</div>