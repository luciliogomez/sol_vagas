<?php $this->layout("template::template",[
    'title' => "Vagas"
]); ?>

<section class="container search flex-column-center">
            <h3>Pesquise a sua Vaga</h3>
            <form action="" method="post">
                <div>
                    <input type="text" name="pesquisa" id="pesquisa" value="<?=isset($titulo)?$titulo:''?>">
                    <button type="submit" class="btn btn-small">Pesquisar</button>
                </div>
            </form>
                
    </section>


    <div class="container vagas flex-row-space-between-start">
        <div class="filter">
            <h4 style="text-align: center;"> FILTRO</h4>
            <div>
                <form action="" method="post">
                    <div class="form-input">
                        <label for="area">Area</label>
                        <select name="area" id="">
                            <option value="ti" <?=(isset($area)&&$area=='ti'?'selected':'')?> >Tecnologias de Informação</option>
                            <option value="Saúde" <?=(isset($area)&&$area=='Saúde'?'selected':'')?> >Saúde</option>
                            <option value="Educação" <?=(isset($area)&&$area=='educacao'?'selected':'')?>>Educação</option>
                            <option value="mecanica" <?=(isset($area)&&$area=='mecanica'?'selected':'')?>>Mecanica</option>
                        </select>
                    </div>
                    <div class="form-input">
                        <label for="formato">Tipo</label>
                        <select name="formato" id="">
                            <option value="estagio" <?=(isset($formato)&&$formato=='estagio'?'selected':'')?>>Estágio</option>
                            <option value="meioperiodo" <?=(isset($formato)&&$formato=='meio-periodo'?'selected':'')?>>Meio Período</option>
                            <option value="fulltime" <?=(isset($formato)&&$formato=='fulltime'?'selected':'')?>>Full-Time</option>
                        </select>
                    </div>
                    <div class="form-input">
                        <label for="modalidade">Modalidade</label>
                        <select name="modalidade" id="" >
                            <option value="presencial" <?=(isset($modalidade)&&$modalidade=='presencial'?'selected':'')?>>Presencial</option>
                            <option value="remoto" <?=(isset($modalidade)&&$modalidade=='remoto'?'selected':'')?>>Remoto</option>
                        </select>
                    </div>
                    <div class="form-input">
                        <label for="cidade">Cidade</label>
                        <input type="text" name="cidade" id="" value="<?=(isset($cidade)?$cidade:'')?>" >
                    </div>
                    <div class="form-input">
                        <label for=""><input type="checkbox" name="activas" id="" value="activas"> Apenas Vagas Activas </label>
                        
                    </div>
                    <div class="flex-row-space-between">
                    <div class="form-input ">
                        <input type="submit" value="Filtrar" class="btn ">
                    </div>
                    <div class="form-input">
                        <a href="<?=URL?>/vagas" class="btn btn-small red ">Limpar</a>
                    </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="articles flex-columm-center">
        <?php foreach($vagas as $vaga): ?>
            
            <a href="<?=URL?>/vagas/<?=$vaga->getId()?>/ver" class="vaga-horizontal">
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
                    </div>
                </div>

                <div class="end flex-column-center">
                    <p> Oferta aberta até </br> <span><?=$vaga->getDataLimite()?></span></p>
                </div>

            </article>
        </a>

        <?php endforeach; ?>

            <div class="pagination ">
                <?=$links?>
            </div>
        </div>

    </div>



    
</div>