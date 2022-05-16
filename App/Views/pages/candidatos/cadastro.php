<?= $this->layout("template::template",[
    'title' => "Criar Conta"
]);?>


    <!-- CONTENT -->

    <div class="login container">
            <div class="content  flex-row-space-between">
                <div class="picture">
                    <figure>
                    <img src="<?=ASSETS?>/img/3.jpg" alt="">
                        
                    <figcaption>Crie seu perfil e seja contratado</figcaption>
                
                    </figure>
                </div>
                <div class="formulario">
                    <h4 class="description mb-4">Crie sua Conta</h4>
                    <form action="" method="post">
                        <div class="form-input mb-2">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="" placeholder="Nome Completo" value="<?=$nome?>" required>
                        </div>
                        <div class="form-input mb-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="" placeholder="email@example.com" value="<?=$email?>" required>
                        </div>
                        <div class="form-input mb-2">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="" placeholder="**********" required>
                        </div>
                        <div class="form-input mb-0">
                            <input type="submit" class="btn btn-medium" value="Inscreva-se">
                        </div>
                        <div class="mb-1">
                            <p><?=$status?></p>
                        </div>
                        <div>
                            <p class="text-center">Já tem uma conta? <a href="login.html" class="text-blue">Entra</a></p>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    <!--END CONTENT -->