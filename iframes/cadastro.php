<?php include_once DIR.'/lib/handling.php'; ?>
<?php $user = new Handling();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
		$userReg	= $user->userRegistration($_POST);
	}
?>

<div class="d-flex justify-content-around mt-1">
  <div><p class="h1 form-group row">Cadastro</p>
  <?php
							if (isset($userReg)) {
								echo $userReg;
							}
						?>
            </div>
  <form action="" class="form-control" method="POST">
  
  <div class="form-group">
      <label for="name" class="control-label col-sm-2 col-form-label">Nome</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Nome">
      </div>
    </div>
  <div class="form-group">
      <label for="username" class="control-label col-sm-2 col-form-label">Nome de usuário</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Nome de usuário">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="control-label col-sm-2 col-form-label">Senha</label>
      <div class="col-sm-10">
        <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Senha">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="control-label col-sm-2 col-form-label">Confirmar a senha</label>
      <div class="col-sm-10">
        <input type="password" class="form-control form-control-sm" id="confirmpassword" name="confirmpassword" placeholder="Confirmar a senha">
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="control-label col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email">
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="control-label col-sm-2 col-form-label">Confirme o Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control form-control-sm" id="confirmemail" name="confirmemail" placeholder="Confirmar o email">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck1" required>
          <label class="control-label form-check-label" for="gridCheck1">
            Ao clicar em cadastrar, você confirma estar de acordo com os nossos <a href="#">termos de serviço</a> e afins.
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-10">
        <button type="submit" name="register" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </form>
</div>