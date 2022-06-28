<div class="row">
    <div class="col">
        <p class="h2 text-center mt-2">Nossos Prestadores</p>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <td class="text-center">Login</td>
                    <td class="text-center">Senha</td>
                    <td class="text-center">Email</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conexao = new SearchHandler();
                    $table = "workers";
                    $fields = "login,password,email";
                    $fetch = $conexao->fetch($table,$fields);
                    echo $fetch;
                ?>
            </tbody>            
        </table>
    </div>
</div>