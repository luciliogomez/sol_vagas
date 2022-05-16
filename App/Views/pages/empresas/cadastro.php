<?=
    $this->layout("template::template",[
        "title" => "Cadastre a sua Empresa"
    ])
?>


    <!-- CONTENT -->

    <div class="login container">
            <div class="content  flex-row-space-between">
                <div class="picture">
                    <figure>
                        <img src="img/3.jpg" alt="">
                        
                    <figcaption>Encontre os melhores talentos para duplicar os resultados da sua empresa</figcaption>
                
                    </figure>
                </div>
                <div class="formulario">
                    <h4 class="description">Cadastre a sua Empresa</h4>
                    <form action="dashboard_empresa.html" method="post">
                        <div class="form-input">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="" placeholder="Nome da empresa" required>
                        </div>
                        <div class="form-input">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="" placeholder="email@example.com" required>
                        </div>
                        <div class="form-input">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="" placeholder="**********" required>
                        </div>
                        <div class="form-input">
                            <input type="submit" class="btn btn-medium" value="Inscreva-se">
                        </div>
                        <div>
                            <p class="text-center">Já tem uma conta? <a href="login_empresa.html" class="text-blue">Entra</a></p>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    <!--END CONTENT -->