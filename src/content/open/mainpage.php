<div class="firstscreen">
	<div class="blackbg">
		<div class="screen_content">
			<div class="container">
					<div class="row align-items-start">
						<div class="col-12 col-md-7">
							<h1 class="main-header">Simple service to create quizzes WEBEE QUIZ v.0.2</h1>
							<?php if (isset($_SESSION['user'])) : ?>
								<a class="btn btn-primary btn-lg" href="profile" role="button">Admin-panel</a>
							<?php else : ?>
						</div>
						<div class="col-12 col-md-5">
							<form class="open-form mainpage-signup">
								<div class="form-group">
									<label for="signupUsername" class="font-weight-bold">Username</label>
									<input type="text" class="form-control" id="signupUsername" placeholder="Enter username">
								</div>
								<div class="form-group">
									<label for="signupEmail" class="font-weight-bold">Email address</label>
									<input type="email" class="form-control" id="signupEmail" aria-describedby="emailHelp" placeholder="Enter email">
									<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
								</div>
								<div class="form-group">
									<label for="signupPassword" class="font-weight-bold">Password</label>
									<input type="password" class="form-control" id="signupPassword" placeholder="Enter password">
									<small class="form-text text-muted">Make sure it's at least 15 characters OR at least 8 characters including a number and a lowercase letter</small>
								</div>
								<button type="submit" class="btn btn-success btn-block btn-lg">Sign up</button>
								<div class="alert alert-danger" role="alert"></div>
							</form>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
