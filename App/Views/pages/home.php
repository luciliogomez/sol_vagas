<?php $this->layout("template::template",[

]);?>
<section class="banner container section flex-row-space-between all-screen">
    <div class="text">
        <h3>Encontre as melhores oportunidades de emprego </h3>
        <a href="<?=URL?>/vagas" class="btn ">VER VAGAS</a>
    </div>
    <div class="picture">
        <figure>
            <img src="<?=ASSETS?>/img/1.jpg" alt="">
        </figure>
    </div>
</section>

<section class="container section flex-row-space-between all-screen">
    <div class="text">
        <h3>Crie seu perfil e seja visto pelas melhores empresas do mercado</h3>
        <p>
            Com um perfil bem preenchido e completo certamente você estará entre 
            os candidatos aptos a serem contratados. 
        </p>
        <a href="#" class="btn">Criar Perfil</a>
    </div>
    <div class="picture">
        <figure>
            <img src="<?=ASSETS?>/img/2.jpg" alt="">
        </figure>
    </div>
</section>

<div class="container last all-screen">
    <h3>ÚLTIMAS VAGAS</h3>

    <div class="articles flex-row-center">

        <?php foreach($vagas as $vaga): ?>
        
        <a href="<?=URL?>/vagas/<?=$vaga->getId()?>/ver" class="art">
        <article class="flex-column-space-between">
            <div class="top">
                <figure>
                    <img src="<?=ASSETS?>/img/c1.png" alt="">
                </figure>
            </div>
            <div class="middle">
                <h4 class="titulo"><?=$vaga->getTitulo()?></h4>
                <h5 class="empresa"><?=$vaga->getEmpresa()?></h5>
                <div class="details flex-row-space-between">
                    <div class="flex-column-center">
                        <span><i class="fa fa-location"></i> Localização</span>
                        <h4><?=$vaga->getCidade()?></h4>
                    </div>

                    <div class="flex-column-center">
                        <span><i class="fa fa-location"></i> Formato</span>
                        <h4><?=$vaga->getFormato()?></h4>
                    </div>
                    <div class="flex-column-center">
                        <span><i class="fa fa-location"></i> Faixa Salarial</span>
                        <h4>$<?=$vaga->getSalarioMin()?></h4>
                    </div>
                </div>
            </div>

        </article>
    </a>
    <?php endforeach ?>
    </div>
    <a href="<?=URL?>/vagas" class="btn btn-medium">VER TODAS VAGAS</a>

</div>

<div class="container companies">
    <h3>EMPRESAS QUE RECRUTAM NA SOLVAGAS</h3>
    <div class="list flex-row-start">
        <div>
            <img src="<?=ASSETS?>/img/c1.png" alt="">
        </div>
        <div>
            <img src="<?=ASSETS?>/img/c2.jpg" alt="">
        </div>
        <div>
            <img src="<?=ASSETS?>/img/c3.jpg" alt="">
        </div>
        <div>
            <img src="<?=ASSETS?>/img/c4.jpg" alt="">
        </div>
        <div>
            <img src="<?=ASSETS?>/img/c5.png" alt="">
        </div>
        <div>
            <img src="<?=ASSETS?>/img/c3.jpg" alt="">
        </div>
        <div>
            <img src="<?=ASSETS?>/img/c1.png" alt="">
        </div>
    </div>
</div>
