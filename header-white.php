<?php 

global $coder;

 ?>


<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo(); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="<?php echo $coder['faviconupload']['url'] ?>" rel="shortcut icon" type="image/x-icon">



	<?php wp_head(); ?>

</head>

<body id="page-top" <?php body_class(); ?>>
	<!--==========================================
				Start Header area
	===========================================-->
	<header class="header_area">
		<div class="container">
			<div class="row">
				<!-- Logo  -->
				<div class="col-md-2">
					<div class="logo">
						<a class="logo_main" href="<?php echo get_home_url(); ?>"><img src="<?php echo $coder['logouploader']['url'];?>" alt="Logo"></a>
						<a href="#" class="nav-icon"><i class="fa fa-bars"></i></a>
					</div>
				</div>
				<!-- Logo  -->
				<!-- Menu  -->
				<div class="col-md-10">
					<div class="mobile_menu canvas-menu">
						<a href="#" class="nav-icon"><span aria-hidden="true">×</span></a>
						<div class="menu">
							<div class="wait_logo">
								<a target="_blank" href="https://wolt.com/fr/lux?tld=lu"><img src="<?php echo myfile(); ?>assets/images/logo/wait.png" alt="Logo"></a>
							</div>
							<?php 
								wp_nav_menu(array(
									'theme_location' =>'main-menu',
									));
							 ?>
						</div>
					</div>
				</div>
				<!-- Menu  -->
			</div>
		</div>
	</header>
	<!--==========================================
		 		End Header area
	===========================================-->