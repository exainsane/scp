<div id="loader-wrapper">
    <div class="logo"></div>
    <div id="loader">
    </div>
</div>
        <!-- end preloader -->
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		
<!-- Start Header Section -->
<header class="main_menu_sec navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="lft_hd">
					<span>UNJ Mengajar</span>
				</div>
			</div>			
			<div class="col-lg-9 col-md-9 col-sm-12">
				<div class="rgt_hd">					
					<div class="main_menu">
						<nav id="nav_menu">
							<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>	
						<div id="navbar">
							<ul>
								<li><a class="page-scroll" href="index.php">Home</a></li> 
								<li><a class="page-scroll" href="#abt_sec">About</a></li>
								<li><a class="page-scroll" href="#pr_sec">Service</a></li>
								<li><a class="page-scroll" href="#tm_sec">Team</a></li>
								<li><a class="page-scroll" href="#tstm_sec">Testimonial</a></li>
								<li><a class="page-scroll" href="#lts_sec">Latest Blog</a></li>
								<li><a class="page-scroll" href="#rgs_sec">Registration</a></li>
								<li><a class="page-scroll" href="login.php">Login</a></li>
								<li><a class="page-scroll" href="#ctn_sec">Contact Us</a></li>
							</ul>
						</div>		
						</nav>			
					</div>					
						
				</div>
			</div>	
		</div>	
	</div>	
</header>
<!-- End Header Section -->

<!-- start slider Section -->
<section id="slider_sec">
	<div class="container">
		<div class="row">
			<div class="slider">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
					<?php foreach ($slider as $data): ?>
						<div class="'.$data['class'].'">
							<div class="wrap_caption">
							  <div class="caption_carousel">
								<h1><?php echo $data->judul ?></h1>
								<p><?php echo $data->des ?></p>
							  </div>						
							</div>
						</div>
					<?php endforeach ?>
							
				  </div>

				  <!-- Controls -->
				  <a class="left left_crousel_btn" href="#carousel-example-generic" role="button" data-slide="prev">
					<i class="fa fa-angle-left"></i>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="right right_crousel_btn" href="#carousel-example-generic" role="button" data-slide="next">
					<i class="fa fa-angle-right"></i>
					<span class="sr-only">Next</span>
				  </a>
				</div>
			</div>	
		</div>			
	</div>	
</section>
<!-- End slider Section -->

<!-- start about Section -->
<section id="abt_sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs12 ">
				<div class="title_sec">
					<h1>ABOUT</h1>
					<h2>### UNJ Mengajar ###</h2>
				</div>			
			</div>		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs12 ">
				<div class="abt">
					<?php foreach ($about as $data): ?>
						<?php echo $data->about ?>
					<?php endforeach ?>
				</div>
			</div>			
		</div>
	</div>
</section>
<!-- End About Section -->

<!-- start Service Section -->
<section id="pr_sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs12 ">
				<div class="title_sec">
					<h1>OUR Service</h1>
					<h2>### UNJ Mengajar ###</h2>
				</div>			
			</div>
			<?php foreach ($services as $data): ?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="service">						
						<i class="fa fa-<?php echo $data->icon ?>"></i>
						<h2><?php echo $data->judul ?></h2>
						<div class="service_hoverly">
							<i class="fa fa-<?php echo $data->icon ?>"></i>
							<h2><?php echo $data->judul ?></h2>
							<?php echo $data->des ?>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			
		</div>
	</div>
</section>
<!-- End Service Section -->

<!-- start our team Section -->
<section id="tm_sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs12 ">
				<div class="title_sec">
					<h1>Our Team</h1>
					<h2>### UNJ Mengajar ###</h2>
				</div>			
			</div>		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs12">
				<div class="all_team">
					<?php foreach ($team as $data): ?>
						<div class="sngl_team">						
							<img src="<?php echo base_url($data->img) ?>" alt=""/>	
							<h3><?php echo $data->nama ?><br><span><?php echo $data->job ?></span></h3>
							<?php echo $data->des ?>					
						</div>	
					<?php endforeach ?>
											
				</div>			
			</div>
		</div>
	</div>
</section>
<!-- End our team Section -->

<!-- start our teastimonial Section -->
<section id="tstm_sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="all_tstm">
				<?php foreach ($testimoni as $data): ?>
					<div class="clnt_tstm">
						<div class="sngl_tstm">
							<i class="fa fa-quote-right"></i>
							<h3><?php echo $data->judul ?></h3>
							<?php echo $data->des ?>
							<h6><?php echo $data->nama ?></h6>					
						</div>
					</div>
				<?php endforeach ?>
				
				</div>
			</div>	
		</div>
	</div>
</section>
<!-- End our teastimonial Section -->


<!-- start Latest post Section -->
<section id="lts_sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs12 ">
				<div class="title_sec">
					<h1>Our Latest Blog</h1>
					<h2>### UNJ Mengajar ###</h2>
				</div>			
			</div>

			<?php foreach ($blog as $data): ?>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<div class="lts_pst">						
						<img src="<?php echo base_url($data->img) ?>" alt=""/>
						<h2><?php echo $data->judul ?></h2>
						<?php echo limit_words($data->des, 20) ?>...
						<a href="blog.php?id=<?php echo $data->id ?>">Read more <i class="fa fa-long-arrow-right"></i></a>					
					</div>
				</div>
			<?php endforeach ?>
			
			<div class="post_btn">
				<div class="hover_effect_btn" id="hover_effect_btn">
					<a href="blog.php" data-hover="view more post"><span>view more post</span></a>
				</div>
			</div>			

		</div>
	</div>
</section>
<!-- End Latest post Section -->

<!-- start contact us Section -->
<section id="rgs_sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs12 ">
				<div class="title_sec">
					<h1>Registration</h1>
					<h2>### UNJ Mengajar ###</h2>
				</div>			
			</div>		
			<div class="col-sm-6"> 
				<div id="cnt_form">
					<h2>Sebagai User</h2>
					<form id="contact-form" class="contact" name="contact-form" method="post" action="regist.php">
						<div class="form-group">
							<input type="text" name="fname" class="form-control" required="required" placeholder="First Name">
						</div>
						<div class="form-group">
							<input type="text" name="lname" class="form-control" required="required" placeholder="Last Name">
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" required="required" placeholder="Your Email">
						</div> 
						<div class="form-group">
							<input type="text" name="username" class="form-control" required="required" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" required="required" placeholder="Your Password">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Send</button>
						</div>
					</form> 
				</div>
			</div>
			<div class="col-sm-6">
				<div id="cnt_form">
					<h2>Sebagai Guru</h2>
					<form id="contact-form" class="contact" name="contact-form" method="post" action="regist.php">
						<div class="form-group">
							<input type="text" name="fname" class="form-control" required="required" placeholder="First Name">
						</div>
						<div class="form-group">
							<input type="text" name="lname" class="form-control" required="required" placeholder="Last Name">
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" required="required" placeholder="Your Email">
						</div> 
						<div class="form-group">
							<input type="text" name="username" class="form-control" required="required" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" required="required" placeholder="Your Password">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Send</button>
						</div>
					</form> 
				</div>
			</div>			
		</div>
	</div>
</section>
<!-- End contact us  Section -->

<!-- start contact us Section -->
<section id="ctn_sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs12 ">
				<div class="title_sec">
					<h1>Contact Info</h1>
					<h2>### UNJ Mengajar ###</h2>
				</div>			
			</div>		
			<div class="col-sm-6"> 
				<div id="cnt_form">
					<form id="contact-form" class="contact" name="contact-form" method="post" action="contact.php">
						<div class="form-group">
						<input type="text" name="name" class="form-control name-field" required="required" placeholder="Your Name">
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control mail-field" required="required" placeholder="Your Email">
						</div> 
						<div class="form-group">
							<textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
						</div> 
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="submit">Send</button>
						</div>
					</form> 
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="cnt_info">
					<ul>
						<li><i class="fa fa-facebook"></i><p>UNJ Mengajar</p></li>
						<li><i class="fa fa-twitter"></i><p>@UNJ_Mengajar</p></li>
						<li><i class="fa fa-instagram"></i><p>@UNJ_Mengajar</p></li>
						<li><i class="fa fa-envelope"></i><p>info@unjmengajar.com</p></li>
						<li><i class="fa fa-phone"></i><p>+62 896 3794 6678 (Erfan Kurniawan)</p></li>
					</ul>
				</div>
			</div>			
		</div>
	</div>
</section>
<!-- End contact us  Section -->

<!-- start located map Section -->
<section id="ltd_map_sec">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="map">						
			<h1>located THE MAP</h1><a href="#slidingDiv" class="show_hide" rel="#slidingDiv"><i class="fa fa-angle-up"></i></a>
			<div id="slidingDiv">
				<div class="map_area">
					<div id="googleMap" style="width:100%;height:300px;"></div>
				</div>
			</div>	
			</div>
		</div>
	</div>
</div>
</section>

<!-- End located map  Section -->
<!-- start footer Section -->

