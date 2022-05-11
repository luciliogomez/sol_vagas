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
                <div class="warning">
                    <p class="text-center "> Mantenha seu Perfil sempre actualizado!</p>
                </div>
                <div class="section resume">
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

                        <div class="course">
                            <p>
                                <span>Nivel: </span> Licenciatura
                            </p>
                            <p>
                                <span>Curso: </span> Engenheiro de Informatica
                            </p>
                            <p>
                                <span>Escola: </span> Universidade Pontifera
                            </p>
                            <p>
                                <span>Data: </span>
                                Mar-2020 - Presente
                            </p>
                        </div>

                    </div>

                    <a href="add_formacao.html" class="btn">+</a>
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

                        <div class="experiency">
                            <p>
                                <span>Cargo: </span> Estagiario
                            </p>
                            <p>
                                <span>Empresa: </span> Samba Tech Soluções
                            </p>
                            <p>
                                <span>Duração: </span>
                                Oct-2019 -> Mar-2020
                            </p>
                            <p>
                                <span>Descrição: </span>
                                Desenvolvedor de software
                            </p>
                        </div>
                        <a href="add_experiency.html" class="btn">+</a>
                    </div>
                
                
                </div>
                <!--  -->
                <div class="section cursos">
                    <h3 class="title">CURSOS PROFISSIONAIS</h3>
                    <div class="section-content">

                        <div class="course">
                            <p>
                                <span>Nome do Curso: </span> Desenvolvimento Web Completo
                            </p>
                            <p>
                                <span>Escola: </span> Tech School
                            </p>
                            <p>
                                <span>Data de Conclusão: </span>
                                Mar-2020
                            </p>
                        </div>

                    </div>
                    <a href="add_curso.html" class="btn">+</a>
                </div>
            </div>
        </div>
        