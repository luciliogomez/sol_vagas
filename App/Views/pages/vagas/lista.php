<?php $this->layout("template::template",[
    'title' => "Vagas"
]); ?>

<section class="container search flex-column-center">
            <h3>Pesquise a sua Vaga</h3>
            <form action="" method="post">
                <div>
                    <input type="text" name="search" id="">
                    <button type="submit" class="btn btn-medium">Pesquisar</button>
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
                            <option value="ti">Tecnologias de Informação</option>
                            <option value="saude" selected>Saúde</option>
                            <option value="educacao">Educação</option>
                            <option value="mecanica">Mecanica</option>
                        </select>
                    </div>
                    <div class="form-input">
                        <label for="formato">Tipo</label>
                        <select name="formato" id="">
                            <option value="estagio">Estágio</option>
                            <option value="meioperiodo">Meio Período</option>
                            <option value="fulltime" selected>Full-Time</option>
                        </select>
                    </div>
                    <div class="form-input">
                        <label for="modalidade">Modalidade</label>
                        <select name="modalidade" id="">
                            <option value="presencial" selected>Presencial</option>
                            <option value="remoto">Remoto</option>
                        </select>
                    </div>
                    <div class="form-input">
                        <label for="cidade">Cidade</label>
                        <input type="text" name="cidade" id="">
                    </div>
                    <div class="form-input">
                        <label for=""><input type="checkbox" name="activas" id="" value="activas"> Apenas Vagas Activas </label>
                        
                    </div>
                    <div class="form-input">
                        <input type="submit" value="Filtrar" class="btn ">
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