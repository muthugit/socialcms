<style>
.vertical-align {
	padding-top: 30%;
}

.form-group {
	padding-top: 2%;
}

body {
	background-color: white;
}
</style>
<div class="vertical-align">
	<div class="row col-lg-offset-6">
	
	<?php
	if ($login) {
		echo "<a href='" . $logout_url . "' class='btn'>Logout</a>";
	} else
		echo "<a href='" . $login_url . "'><img style='max-width:300px;' class='fb' src=" . SITE_PATH . "images/fb.png" . "></a>";
	?>
	
		<div style="display: none" class="login-box">
			<form action="<?php echo API_PATH.'user/loginForm';?>" method="post"
				class="form-horizontal">
				<div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Username</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="inputEmail"
							name="userName" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Password</label>
					<div class="col-lg-10">
						<input type="password" class="form-control" id="inputEmail"
							placeholder="Password" name="password">
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="" class="btn btn-primary">Login</button>

					</div>
				</div>
			</form>
			<button type=""
				onclick="$('.login-box').hide();$('.register-box').show();return false;"
				class="btn btn-link">Not having account? Register now</button>
		</div>
		<div style="display: none" class="register-box">
			<form method="post" class="form-horizontal"
				action="<?php echo API_PATH.'user/register';?>">
				<div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" name="userEmail"
							id="userEmail" placeholder="Your Email">
					</div>

				</div>
				<div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Name</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" name="userFirstName"
							id="inputEmail" placeholder="Name">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Unique
						identity</label>
					<div class="col-lg-10">
						<div class="input-group">
							<span class="input-group-addon">@</span> <input type="text"
								name="userUniqueId" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="submit" class="btn btn-primary">Register</button>
					</div>
				</div>
			</form>
			<center>
				<button type="submit"
					onclick="$('.login-box').show();$('.register-box').hide();"
					class="btn btn-link">Having account? Login now</button>
			</center>
		</div>
	</div>