<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				Login Form
			</div>
			<div class="panel-body">
				<form action="<?= base_url() ?>index.php/welcome/loginProcess" method="POST" class="form-horizontal">
					<div class="form-group">
						<label for="email_user" class="control-label col-sm-3">Email :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="email_user" name="email_user" required>
						</div>
					</div>
					<div class="form-group">
						<label for="pass_user" class="control-label col-sm-3">Password :</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="pass_user" name="pass_user" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12" style="text-align: right;">
							<button class="btn btn-primary" type="submit" name="btn_login">Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#email_user').focus();
	})
</script>