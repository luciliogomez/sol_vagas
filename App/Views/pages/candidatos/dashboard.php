<?= $this->layout("template::template");?>



<div class="dashboard container">
            <div class="wellcome">
                <h4 class="text-center text-blue" >Bem Vindo, Lucilio Gomes</h4>
            </div>

            <div class="cards flex-row-space-between">
                <a href="perfil.html" class="card-link">
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

                <a href="candidaturas.html" class="card-link">
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


                <a href="vagas.html" class="card-link">
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
        </div>