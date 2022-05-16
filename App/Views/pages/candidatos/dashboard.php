<?= $this->layout("template::template",[
    'title' => $_SESSION['usuario']['nome'] . (isset($title)?$title:"")
]);?>



<div class="dashboard container">
            <div class="wellcome">
                <h4 class="text-center text-blue" >Bem Vindo, <?=$_SESSION['usuario']['nome'] ?></h4>
            </div>

            <div class="cards flex-row-space-between">
                <a href="<?=URL?>/candidatos/<?=$_SESSION['usuario']['id'] ?>/perfil" class="card-link">
                    <div class="card flex-row-start" >
                        <div class="card-image">
                            <figure>
                                <i class="fa fa-user"></i>
                            </figure>
                        </div>
                        <div class="card-content flex-column-start">
                            <h4 class="card-title">Meu Perfil</h4>
                            <p class="card-text">Complete seu Perfil</p>
                        </div>
                    </div>
                </a>

                <a href="candidaturas" class="card-link">
                    <div class="card flex-row-start">
                        <div class="card-image">
                            <figure>
                                <i class="fa fa-user"></i>
                            </figure>
                        </div>
                        <div class="card-content flex-column-start">
                            <h4 class="card-title">Candidaturas</h4>
                            <p class="card-number">7</p>
                        </div>
                    </div>
                </a>


                <a 
                href="<?=URL?>/vagas/filter?area=<?=$_SESSION['usuario']['area']?>" class="card-link">
                    <div class="card flex-row-start">
                        <div class="card-image">
                            <figure>
                                <i class="fa fa-user"></i>
                            </figure>
                        </div>
                        <div class="card-content flex-column-start">
                            <h4 class="card-title">Vagas</h4>
                            <p class="card-text">Vagas que correspondem com seu perfil</p>
                        </div>
                    </div>
                </a>

            </div>

            <div>

                <!-- PUT YOUR CONTENT HERE -->
                    <?= $this->section("content") ?>
                <!-- END CONTENT -->
            </div>
        </div>