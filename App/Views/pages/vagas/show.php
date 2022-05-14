<?php $this->layout("template::template",[
    "title" => "Vaga - " . $vaga->getTitulo()
]); ?>


<div class="vaga-info container">
            <article class="flex-row-start">
                <div class="start">
                    <figure>
                        <img src="img/c1.png" alt="">
                    </figure>
                </div>
                <div class="middle">
                    <h4 class="titulo"><?=$vaga->getTitulo()?></h4>
                    <h5 class="empresa"><i class="fa fa-building-o"></i> <?=$vaga->getEmpresa()?></h5>
                    <div class="details flex-row-start">
                        <div class="flex-column-center">
                            <span><i class="fa fa-map-marker"></i> Localização</span>
                            <h4><?=$vaga->getCidade()?></h4>
                        </div>

                        <div class="flex-column-center">
                            <span><i class="fa fa-street-view"></i> Tipo</span>
                            <h4><?=$vaga->getFormato()?></h4>
                        </div>
                        <div class="flex-column-center">
                            <span><i class="fa fa-money"></i> Faixa Salarial</span>
                            <h4>$<?=$vaga->getSalarioMin()?></h4>
                        </div>
                        <div class="flex-column-center">
                            <span><i class="fa fa-info-circle"></i> Estado</span>
                            <h4><?=$vaga->getEstado()?></h4>
                        </div>
                    </div>
                </div>

                <div class="end flex-column-center">
                    <a href="<?=URL?>/vagas/<?=$vaga->getId()?>/aplicar" class="btn">Candidatar-se</a>
                </div>

            </article>
            <h3>Decrição</h3>
            <p class="descricao"><?=$vaga->getDescricao()?></p>
            <h3>Habilidades Necessárias</h3>
            <ul class="habilidades">
            <?=$vaga->getHabilidades()?>
            </ul>
            <h3>Requisitos</h3>
            <div class="requisitos">
                <p>
                    <span>Escolaridade Minima: </span>
                    <?=$vaga->getEducacao()?>
                </p>
                <p>
                    <span>Esperiência: </span>
                    <?=$vaga->getAnos()?> anos
                </p>
                <p>
                    <span>Línguas: </span>
                    Português
                </p>
            </div>
            <a href="<?=URL?>/vagas/<?=$vaga->getId()?>/aplicar" class="btn btn-medium">Candidatar-se</a>
    </div>
    