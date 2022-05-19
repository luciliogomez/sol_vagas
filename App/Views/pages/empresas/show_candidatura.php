<?= $this->layout("template::template",[
    "title" => "Candidatura"
]);

?>


    <!-- CONTENT -->
    <div class=" flex-row-space-between mt-2 container">
            
            <div class=" flex-column-start w-100">
                <h3 class="text-size-normal mb-1">Candidatura</h3>
                <div class="mb-1 w-100 flex-row-space-between">
                    <a href="<?=URL?>/vagas/<?=$vaga->getId()?>/ver" class="vaga-horizontal w-60">
                        <article class="flex-row-start ">
                            <div class="start">
                                <figure>
                                <?php if(empty($vaga->getLogotipo())):?>
                            <i class="fa fa-building-o" ></i>
                        <?php else:?>
                            <img src="<?=URL."/uploads/".$vaga->getLogotipo()?>" alt="">
                        <?php endif;?>
                                </figure>
                            </div>
                            <div class="middle">
                                <h4 class="titulo"><?=$vaga->getTitulo()?></h4>
                                <h5 class="empresa"><i class="fa fa-building-o"></i> <?=$vaga->getEmpresa()?></h5>
                            </div>
                            <div class="end flex-column-center">
                                <p> Oferta aberta até </br> <span><?=$vaga->getDataLimite()?></span></p>
                            </div>
                        
                        </article>
                    </a>
                    <div class="w-30  pa-1 rad-3 flex-column-start">
                        <h3 class="w-100 mb-5 text-center">STATUS DA CANDIDATURA</h3>
                        <?php if($candidatura['estado'] == "pendente"): ?>
                            <span class="mb-10 w-100 btn btn-medium no-border green">PENDENTE <i class="fa fa-flag"></i> </span>
                            <a href="<?=URL?>/empresas/<?=$vaga->getIdEmpresa()?>/candidaturas/<?=$candidatura['id']?>/entrevista" class="w-100 btn btn-medium text-size-small-1">Marcar Entrevista</a>
                        <?php elseif($candidatura['estado'] == "entrevista"): ?>
                            <span class="mb-10 w-100 btn btn-medium no-border green">ENTREVISTA <i class="fa fa-flag"></i> </span>
                            <a href="<?=URL?>/empresas/<?=$vaga->getIdEmpresa()?>/candidaturas/<?=$candidatura['id']?>/aprovar" class="w-100 btn btn-medium text-size-small-1">Aprovar Candidato</a>
                        <?php elseif($candidatura['estado'] == "aprovado"): ?>
                            <span class="mb-10 w-100 btn btn-medium no-border green">CANDIDATO APROVADO <i class="fa fa-flag"></i> </span>
                       <?php endif; ?>
                    </div>
                </div>

                <h4 class="text-size-small-2 mb-1">Candidato</h4>
                <div class="pa-2 ba-1 rad-3 w-100 flex-row-space-between">
                    
                    <div class="flex-column-start text-size-small-1">
                        <h4 class="mb-2 text-dark-grey"><i class="fa fa-user"></i> <?=$candidato->getNome()?></span></h4>
                        <h4 class="mb-2 text-dark-grey"><i class="fa fa-map-marker"></i> <?=$candidato->getCidade()?></span></h4>
                        <h4 class="mb-2 text-dark-grey"><i class="fa fa-envelope"></i> <?=$candidato->getEmail()?></span></h4>
                        <a href="<?=URL?>/candidatos/<?=$candidato->getId()?>/perfil" class="btn  mt-5">Ver Perfil</a>
                      
                    </div>
                    
                    
                </div>

            </div>
        </div>

    <!--END CONTENT -->