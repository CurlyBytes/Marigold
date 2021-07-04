<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="otherdetails" content="Branch Information System">
	<meta name="author" content="Curlybytes">
	<title><?php echo CI_title(); ?></title>
	<?php echo CI_head(); ?>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
	<script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
</head>
<body data-theme="default" data-layout="fluid" data-sidebar="left" <?php echo  CI_body_attr(); ?>>
	<main class="d-flex w-100 h-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center">
							<h1 class="display-1 font-weight-bold">404</h1>
							<p class="h1">Page not found.</p>
							<p class="h2 font-weight-normal mt-3 mb-4">The page you are looking for might have been removed.</p>
							<a href="<?php echo  site_url(); ?>" class="btn btn-primary btn-lg">Return to website</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

<?php
 echo CI_footer(); 
?>
</body>
</html>
