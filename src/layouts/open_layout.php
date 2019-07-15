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
	<link rel="stylesheet" type="text/css" href="../static/css/open/open-style.min.css">
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
						<a class="nav-link" href="/">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/howtouse">How to use</a>
					</li>
				</ul>

				<div class="signs_buttons">

					<?php if (isset($_SESSION['user'])) : ?>
						<a class="btn btn-outline-light" href="profile" role="button">Admin-panel</a>
						<button class="btn btn-light logout_btn" type="button">Logout</button>
					<?php else : ?>
						<a class="btn btn-outline-light open_form-blocks" href="#signin" role="button">Sign in</a>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</nav>

	<?= $content ?>

	<div class="form-blocks">

		<div class="popup_close">
			<hr class="lhr">
			<hr class="rhr">
		</div>

		<form id="signin" class="open-form signin">
			<p class="font-weight-bold">Sign in for Webee Quiz</p>
			<div class="form-group">
				<input type="email" class="form-control" id="signinEmail" aria-describedby="emailHelp" placeholder="Enter email">
			</div>

			<div class="form-group">
				<input type="password" class="form-control" id="signinPassword" placeholder="Enter password">
				<small><a href="#recover" class="open_form-blocks font-weight-bold">Forgot your password?</a></small>
			</div>

			<button type="submit" class="btn btn-primary btn-block">Sign in</button>

			<div class="alert alert-danger" role="alert"></div>
		</form>


		<form id="recover" class="open-form recover">
			<p class="font-weight-bold">Password recovering</p>
			<div class="form-group">
				<input type="email" class="form-control" id="recoverEmail" aria-describedby="emailHelp" placeholder="Enter email">
			</div>
			<button type="submit" class="btn btn-primary btn-block">Submit</button>
			<div class="alert alert-danger" role="alert"></div>
		</form>

		<form id="newpassword" class="open-form newpassword">
			<p class="font-weight-bold">Password recovering</p>

			<div class="form-group">
				<input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="newPasswordRepeat" placeholder="Repeat new password">
			</div>

			<button type="submit" class="btn btn-primary btn-block">Submit</button>
			<div class="alert alert-danger" role="alert"></div>
		</form>

	</div>

	<script type="text/javascript" src="../static/libs/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../static/libs/sweetalert.min.js"></script>
	<script type="text/javascript" src="../static/js/global.min.js"></script>
	<script type="text/javascript" src="../static/js/open/open.min.js"></script>
	<script type="text/javascript" src="<?=BOOTSTRAP?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=BOOTSTRAP?>/js/bootstrap.bundle.min.js"></script>
</body>
</html>
