<?= $this->layout("template::template",[
    'title' => "Iniciar Seção"
]);?>

        <div class="login container">
            <div class="content  flex-row-space-between">
                <div class="picture">
                    <figure>
                        <img src="<?=ASSETS?>/img/4.jpg" alt="">
                        
                    <figcaption>Desenvolva seu potencial para alavancar sua carreira</figcaption>
                
                    </figure>
                </div>
                <div class="formulario">
                    <h4 class="description">Faça Login</h4>
                    <form  method="post">
                        <div class="form-input">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="" placeholder="email@example.com">
                        </div>
                        <div class="form-input">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="" placeholder="**********">
                        </div>
                        <div class="form-input mb-0">
                            <input type="submit" class="btn btn-medium" value="Entrar">
                        </div>
                        <div class="form-input mt-0">
                            <?=$status?>
                        </div>
                        <div>
                            <p class="text-center">Não tem uma conta? <a href="cadastro.html" class="text-blue">Cadastra-se</a></p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
