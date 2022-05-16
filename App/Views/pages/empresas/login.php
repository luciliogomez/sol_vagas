<?= $this->layout("template::template",[
    "title" => "Login"
]);
?>
    <!-- CONTENT -->

    <div class="login container">
            <div class="content  flex-row-space-between">
                <div class="picture">
                    <figure>
                        <img src="<?=ASSETS?>/img/4.jpg" alt="">    
                    <figcaption>Aumente o potencial da sua Empresa, Contrate!</figcaption>
                
                    </figure>
                </div>
                <div class="formulario">
                    <h4 class="description">Faça Login</h4>
                    <form action="" method="post">
                        <div class="form-input">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="" placeholder="email@example.com" value="<?=$email?>">
                        </div>
                        <div class="form-input">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="" placeholder="**********" value="<?=$senha?>">
                        </div>
                        <div class="form-input">
                            <input type="submit" class="btn btn-medium" value="Entrar">
                        </div>
                        <div class="mb-2">
                            <p class="error"> <?=$status?> </p>
                        </div>
                        <div>
                            <p class="text-center">Não tem uma conta? <a href="empresas/cadastro" class="text-blue">Faça Login</a></p>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    <!--END CONTENT -->