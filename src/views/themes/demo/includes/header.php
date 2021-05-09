<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<title><?php echo CI_title(); ?></title>
	<?php echo CI_head(); ?>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
	<script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
</head>
<body<?php echo  CI_body_attr(); ?>>

	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="<?php echo  site_url(); ?>">
          <span class="align-middle">Branch Info System</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Maps
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo  site_url('branch-information'); ?>">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Branch Information</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo  site_url('branch-expansion'); ?>">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Branch Expansion</span>
						</a>
					</li>

		

					<li class="sidebar-header">
						Branch Expansion Setup
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Branch Masterlist</span>
						</a>
						<ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="<?php echo  site_url('region'); ?>">Region</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="<?php echo  site_url('district'); ?>">District</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="<?php echo  site_url('area'); ?>">Area</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="<?php echo  site_url('branch'); ?>">Branch</a></li>
						</ul>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo  site_url('propose-branch'); ?>">
							<i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Propose Branch</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo  site_url('locationtype'); ?>">
							<i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Location Settings</span>
						</a>
					</li>
				</ul>

	
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>



				<div class="navbar-collapse collapse">
			
				</div>
			</nav>