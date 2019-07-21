<div class="container htu-text-block content-start">
	<h2>Profile</h2>
	<div class="data_change_forms">
		<form id="userdataChange">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputName">Name</label>
					<input type="text" class="form-control" id="inputName" name="pd_name" placeholder="Name" value="<?php echo $user_name?>" autocomplete="off">
				</div>
				<!--<div class="form-group col-md-6">
					<label for="inputEmail">Email</label>
					<input type="email" class="form-control" id="inputEmail" name="pd_email" placeholder="Email" value="<?php #echo $user_email?>" autocomplete="off">
				</div>-->
			</div>
			<button type="submit" class="btn btn-success">Save data</button>
		</form>

		<form id="passwordChange">
			<div class="form-row">
				<input type="email" class="hidden" name="email" value="<?php #echo $profile['user_email']?>">
				<div class="form-group col-md-6">
					<label for="inputPassword1">Old password</label>
					<input type="password" class="form-control" id="inputPassword1" name="pd_pass_old" placeholder="Old password" autocomplete="new-password">
				</div>
				<div class="form-group col-md-6">
					<label for="inputPassword2">New password</label>
					<input type="password" class="form-control" id="inputPassword2" name="pd_pass_new" placeholder="New password" autocomplete="off">
				</div>
				<div class="form-group col-md-6">
					<label for="inputPassword3">Repeat new password</label>
					<input type="password" class="form-control" id="inputPassword3" name="pd_pass_new_rec" placeholder="Repeat new password" autocomplete="off">
				</div>
			</div>
			<button type="submit" class="btn btn-success">Change password</button>
		</form>
		<div class="alert alert-danger" role="alert"></div>
	</div>
</div>
