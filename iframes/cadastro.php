<div class="d-flex justify-content-around mt-1">
  <form action="<?php DIR."/cadhandling.php"?>" class="form-horizontal justify-content-center" role="form" method="POST">
  <p class="h1 form-group row">Cadastro</p>
  <div class="form-group row">
      <label for="login" class="control-label col-sm-2 col-form-label">Login</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-sm" id="login" name="login" placeholder="Login">
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="control-label col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email">
      </div>
    </div>
    <div class="form-group row">
      <label for="password" class="control-label col-sm-2 col-form-label">Senha</label>
      <div class="col-sm-10">
        <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password">
      </div>
    </div>
    <fieldset class="form-group">
      <div class="row">
        <legend class="col-form-label col-sm-2 pt-0">O que você busca conosco?</legend><br>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gridRadios" id="worker" value="option1" checked>
            <label class="control-label form-check-label" for="worker">
              Prestar serviços
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gridRadios" id="user" value="option2">
            <label class="control-label form-check-label" for="user">
              Buscar serviços
            </label>
          </div>
        </div>
      </div>
    </fieldset>
    <div class="form-group row">
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck1">
          <label class="control-label form-check-label" for="gridCheck1">
            Ao clicar em cadastrar, você confirma estar de acordo com os nossos <a href="#">termos de serviço</a> e afins.
          </label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </form>
</div>