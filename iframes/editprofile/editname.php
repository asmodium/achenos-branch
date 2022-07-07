<?php include_once DIR.'/lib/handling.php'; require_once DIR.'/lib/validator.php';?>
<?php 
  Session::checkSession();
  $user = new Handling();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
    $updatus = $user->updateName($_POST);
}
?>

        <div class="container">
            <div class="form-control">
				<form method="POST" action="">
					<input type="hidden" class="form-control" name="username" value="<?php echo Session::get('username')?>">
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo Session::get('name')?>">
                    </div><br>
                    <div class="form-group row">
                        <button type="submit" name="update" class="btn btn-primary btn-lg btn-block">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>

