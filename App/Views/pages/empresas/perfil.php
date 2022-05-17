<?=$this->layout("template::template",[
    "title" => "Perfil da Empresa"
])?>



    <!-- CONTENT -->
    <div class="perfil companie container flex-row-space-between" >
            <div class="basic-info">
                <div class="picture">
                    <figure class="no-border">
                        <?php if(empty($empresa->getLogo())):?>
                            <img src="<?=ASSETS?>/img/c1.png" alt="" class="no-border">    
                        <?php else:?>
                            <img src="<?=URL?>/uploads/<?=$empresa->getLogo()?>" alt="" class="no-border">
                        <?php endif;?>
                    </figure>
                </div>
                <div class="presentation">
                    <h3 class="name"><?=$empresa->getNome()?></h3>
                    <h4 class="title"><?=$empresa->getEmail()?></h4>
                </div>
                <div class="links flex-column-start">
                    <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/perfil/editar" class="btn">Editar perfil</a>
                    <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/dashboard" class="btn">Voltar ao dashboard</a>
                </div>
                <div class="contacts flex-column-start">
                    
                </div>
            </div>
            <div class="general-info flex-column-start">
                <div class="warning">
                    <p class="text-center "> Mantenha seu Perfil sempre actualizado!</p>
                </div>
                <div class="section resume">
                    <h3 class="title">Descrição da Empresa</h3>
                    <div class="section-content">
                        <p>
                            <?=$empresa->getDescricao()?>
                        </p>
                    </div>
                </div>
                
                <!--  -->
                <div class="section information">
                    <h3 class="title">INFORMAÇÕES</h3>
                    <div class="section-content flex-row-space-between-wrap">
                        <div class="info flex-row-space-between">
                            <div class="picture">
                                <figure>
                                    <i class="fa fa-calendar"></i>
                                </figure>
                            </div>
                            <div class="text flex-column-start ">
                                <h3>Ano de Fundação</h3>
                                <h2><?=$empresa->getAnoFundacao()?></h2>
                            </div>  
                        </div>
                        <div class="info flex-row-space-between">
                            <div class="picture">
                                <figure>
                                    <i class="fa fa-map-marker"></i>
                                </figure>
                            </div>
                            <div class="text flex-column-start ">
                                <h3>Localização</h3>
                                <h2><?=$empresa->getCidade()?></h2>
                            </div>  
                        </div>
                        <div class="info flex-row-space-between">
                            <div class="picture">
                                <figure>
                                    <i class="fa fa-phone"></i>
                                </figure>
                            </div>
                            <div class="text">
                                <h3>Telefone</h3>
                                <h2><?=$empresa->getTelefone()?></h2>
                            </div>  
                        </div>
                       
                    
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
        
    <!--END CONTENT -->