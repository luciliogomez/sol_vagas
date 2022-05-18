<?= $this->layout("template::template",[
    "title" => $candidato->getNome()
]);?>

<div class="perfil container flex-row-space-between" >
            <div class="basic-info">
                <div class="picture">
                    <figure>
                        <?php if($candidato->getFoto() == NULL):?>
                            <img src="<?=ASSETS?>/img/user.png" alt="">
                        <?php else:?>
                            <img src="<?=URL."/uploads/".$candidato->getFoto()?>" alt="">
                        <?php endif;?>
                    </figure>
                </div>
                <div class="presentation">
                    <h3 class="name"><?=$candidato->getNome();?></h3>
                    <h4 class="title"><?=$candidato->getTitulo();?></h4>
                </div>
                <?php if($_SESSION['usuario']['id'] == $candidato->getId()):?>
                <div class="links flex-column-start">
                    <a href="<?=URL?>/candidatos/<?=$candidato->getId()?>/perfil/editar" class="btn">Editar meu perfil</a>
                    <a href="<?=URL?>/candidatos/<?=$candidato->getId()?>/dashboard" class="btn">Voltar ao dashboard</a>
                </div>
                <?php endif;?>
                <div class="contacts flex-column-start">
                <span><i class="fa fa-map-marker"></i> <?=$candidato->getCidade()?> </span>
                    <span><i class="fa fa-envelope"></i> <?=$candidato->getEmail()?></span>
                    <span><i class="fa fa-phone"></i> <?=$candidato->getTelefone()?></span>
                    <span><i class="fa fa-linkedin"></i> <a href="#">Perfil do Linkedin</a></span>
                    <span><i class="fa fa-github"></i> <a href="#">Perfil do Github</a></span>
                </div>
            </div>
            <div class="general-info flex-column-start">
            <?php if($_SESSION['usuario'] == $candidato->getId()): ?>
                        <div class="warning">
                            <p class="text-center "> Mantenha seu Perfil sempre actualizado!</p>
                        </div>
                <?php endif; ?>
                <div class="section resume mt-5">
                    <h3 class="title">RESUMO</h3>
                    <div class="section-content">
                        <p><?=$candidato->getResumo()?></p>
                    </div>
                </div>
                
                <!--  -->
                <div class="section information">
                    <h3 class="title">INFORMAÇÕES</h3>
                    <div class="section-content flex-row-space-between">
                        
                        <div class="info flex-row-space-between">
                            <div class="picture">
                                <figure>
                                    <i class="fa fa-user"></i>
                                </figure>
                            </div>
                            <div class="text flex-column-start ">
                                <h3>Status Actual</h3>
                                <h2><?= translate_estado($candidato->getEstado()); ?></h2>
                            </div>  
                        </div>
                        <div class="info flex-row-space-between">
                            <div class="picture">
                                <figure>
                                    <i class="fa fa-clock-o"></i>
                                </figure>
                            </div>
                            <div class="text">
                                <h3>Nivel de Inglês</h3>
                                <h2><?=$candidato->getNivelIngles()?></h2>
                            </div>  
                        </div>
                    
                    </div>
                </div>
                <!--  -->
                <div class="section cursos">
                    <h3 class="title">Formação Acadêmica</h3>
                    <div class="section-content">
                    
                    <?php foreach($formacoes as $formacao): ?>
                        <div class="course flex-row-space-between">
                            <div>
                                <p>
                                    <span>Nivel: </span> <?=strtoupper($formacao['nivel'])?>
                                </p>
                                <p>
                                    <span>Curso: </span> <?=$formacao['curso']?>
                                </p>
                                <p>
                                    <span>Escola: </span><?=$formacao['escola']?>
                                </p>
                                <p>
                                    <span>Data: </span>
                                    <?=date("M-Y",strtotime($formacao['inicio']))?> --> <?=date("M-Y",strtotime($formacao['fim']))?>
                                </p>
                            </div>
                            <div class="w-20">
                                <a href="<?=URL?>/candidatos/<?=$candidato->getId()?>/formacao/<?=$formacao['id']?>/editar" class="btn btn-small">Editar</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <?php if($_SESSION['usuario'] == $candidato->getId()): ?>
                    <a href="<?=URL?>/candidatos/<?=$candidato->getId()?>/formacao/adicionar" class="btn">+</a>
                    <?php endif; ?>
                </div>
                <!--  -->
                <div class="section habilidades">
                    <h3 class="title">HABILIDADES</h3>
                    <div class="section-content">
                        <p class="mb-2">
                            <?=$candidato->getHabilidades()?>
                        </p>
                        <!-- <form action="#" method="post" class="flex-row-start ">
                            <div class="form-input">
                                <input type="text" name="skill" placeholder="Nova Habilidade" id="">
                            </div>
                            <button type="submit" class="btn">Adicionar</button>
                        </form> -->
                    </div>
                </div>

                <!--  -->
                <div class="section experiencias">
                    <h3 class="title">EXPERIÊNCIAS PROFISSIONAIS</h3>
                    <div class="section-content">

                    <?php foreach($experiencias as $experiencia): ?>
                        <div class="experiency flex-row-space-between">
                            <div class="w-70">
                            <p>
                                <span>Cargo: </span> <?=$experiencia['cargo']?>
                            </p>
                            <p>
                                <span>Empresa: </span> <?=$experiencia['empresa']?>
                            </p>
                            <p>
                                <span>Duração: </span>
                                <?=$experiencia['inicio']?> -> <?=$experiencia['fim']?>
                            </p>
                            <p>
                                <span>Descrição: </span>
                                <?=$experiencia['descricao']?>
                            </p>
                            </div>
                            <div class="w-20">
                                <a href="<?=URL?>/candidatos/<?=$candidato->getId()?>/experiencia/<?=$experiencia['id']?>/editar" class="btn btn-small">Editar</a>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php if($_SESSION['usuario'] == $candidato->getId()): ?>
                            <a href="<?=URL?>/candidatos/<?=$candidato->getId()?>/experiencia/adicionar" class="btn">+</a>
                        <?php endif; ?>
                    </div>
                
                    
                </div>
                <!--  -->
                <div class="section cursos">
                    <h3 class="title">CURSOS PROFISSIONAIS</h3>
                    <div class="section-content">
                        <?php foreach($cursos as $curso): ?>
                        <div class="course flex-row-space-between">
                            <div>
                            <p>
                                <span>Nome do Curso: </span> <?=$curso['nome']?>
                            </p>
                            <p>
                                <span>Escola: </span> <?=$curso['escola']?>
                            </p>
                            <p>
                                <span>Data de Conclusão: </span>
                                <?=$curso['data_conclusao']?>
                            </p>
                            <p>
                                <span>Certificado: </span>
                                <a href="<?=URL."/uploads/".$curso['certificado']?>"  target="_blank">Ver</a>
                            </p>
                            </div>
                            <div class="w-20">
                                <a href="<?=URL?>/candidatos/<?=$candidato->getId()?>/curso/<?=$curso['id']?>/editar" class="btn btn-small">Editar</a>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                    <?php if($_SESSION['usuario'] == $candidato->getId()): ?>
                    <a href="<?=URL?>/candidatos/<?=$candidato->getId()?>/cursos/adicionar" class="btn">+</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        