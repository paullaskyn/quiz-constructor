<?php require_once('../config/const_paths.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Simple service to create quizzes WEBEE QUIZ v.0.2">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="pragma" content="no-cache">
	<title>Simple service to create quizzes WEBEE QUIZ v.0.2</title>

	<link rel="apple-touch-icon" sizes="180x180" href="<?=FAVICON?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=FAVICON?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=FAVICON?>/favicon-16x16.png">
	<link rel="manifest" href="<?=FAVICON?>/site.webmanifest">
	<link rel="mask-icon" href="<?=FAVICON?>/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="stylesheet" type="text/css" href="<?=BOOTSTRAP?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=BOOTSTRAP?>/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="<?=BOOTSTRAP?>/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="../static/css/admin/admin-style.min.css">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark main-navbar">
		<div class="container">
			<div class="logo_block">
				<a class="logo_w" href="/">WEBEE QUIZ</a>
			</div>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

			<span class="navbar-toggler-icon"></span>

			</button>

			<div class="collapse navbar-collapse justify-content-end header-menu" id="navbarNavDropdown">

				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="/profile">Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/quizzes">Quizzes</a>
					</li>
				</ul>

				<div class="signs_buttons">
					<a class="btn btn-outline-light" href="/" role="button">Home page</a>
					<button class="btn btn-light logout_btn" type="button">Logout</button>
				</div>
			</div>
		</div>
	</nav>

	<?= $content ?>


	<script type="text/javascript" src="../static/libs/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../static/libs/sweetalert.min.js"></script>
	<script type="text/javascript" src="../static/js/global.min.js"></script>
	<script type="text/javascript" src="../static/js/admin/admin.min.js"></script>
	<script type="text/javascript" src="<?=BOOTSTRAP?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=BOOTSTRAP?>/js/bootstrap.bundle.min.js"></script>
</body>
</html>
