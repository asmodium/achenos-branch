<?php include_once DIR.'/lib/handling.php'; ?>
<?php
	 Session::checkLogin();
	 
	$user = new Handling();
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
		$userLogin	= $user->userLogin($_POST);

	}
?>
<div class="d-flex justify-content-around mt-1">
  <div><p class="h1 form-group row">Login</p>
	
	<?php 
		if (isset($userLogin)) {
			echo $userLogin;
		}
	?>
	<div class="container main-body">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
					<div class="panel-body">

						<form class="" action="" method="post">
							<div class="form-group">
								<label c>Nome de usuário</label>
								<input type="text" name="username" class="form-control">
							</div>
							<div class="form-group">
								<label>Senha</label>
								<input type="text" name="password" class="form-control">
							</div>
							<div class="form-group">
								<label ></label>
								<input type="submit" name="login" class="btn btn-block btn-success">
							</div>
						</form>

					</div>
			</div>
		</div>
	</div>
</body>
</html>