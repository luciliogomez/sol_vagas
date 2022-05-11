<?= $this->layout("template::template",[
    "title" => $nome
]);?>


    <!-- CONTENT -->

    <div class="edicao container">
            
            <form class="flex-column-start" action="" method="post" enctype="multipart/form-data">
                <h3 class="title">Sobre Você</h3>

                <div class="section flex-column-start w-100">
                    <figure class="picture ">
                        <?php if(!isset($foto)):?>
                            <i class="fa fa-user" ></i>
                        <?php else:?>
                            <img src="<?=URL."/uploads/".$foto?>" alt="">
                        <?php endif;?>
                    </figure>
                    <div class="w-30">
                        <div class="form-input">
                            <label for="foto">Escolha sua Foto</label>
                            <input type="file" name="foto">
                        </div>
                    </div>
                </div>
                
                <div class="section flex-column-start">
                    <div class="flex-row-start">
                        
                        <div class="form-input w-35">
                            <label for="nome">Nome</label>
                            <input type="text" placeholder="Seu Nome Completo" 
                            name="nome" required id="" value="<?= $nome?>">
                        </div>
                        <div class="form-input w-30">
                            <label for="email">Email</label>
                            <input type="email" placeholder="Seu Email"  
                            name="email" id="" required value="<?= $email?>">
                        </div>
                        <div class="form-input w-20">
                            <label for="telefone">Telefone</label>
                            <input type="text" placeholder="(+244) 923458964"  
                            name="telefone" required id="" value="<?= $telefone?>">
                        </div>
                        <div class="form-input w-35">
                            <label for="titulo">Profissão</label>
                            <input type="text" placeholder="(Ex: Engenheiro, Advogado)"  
                            name="titulo" required id="" value="<?= $titulo?>">
                        </div>
                        <div class="form-input w-30">
                            <label for="estado">Estado Actual</label>
                            <select name="estado" id="">
                                <option value=1 <?= ($estado==1 )?'selected':'' ?> >Trabalhando</option>
                                <option value='0' <?= ($estado==0 )?'selected':'' ?>>Desempregado</option>
                            </select>
                        </div>
                        <div class="form-input w-20">
                            <label for="ingles">Nivel de Ingles</label>
                            <select name="ingles" id="">
                                <option value="basico" <?= ($ingles=='basico' )?'selected':'' ?>>Basico</option>
                                <option value="intermediario" <?= ($ingles=='medio' )?'selected':'' ?>>Intermediario</option>
                                <option value="avancado" <?= ($ingles=='avancado' )?'selected':'' ?>>Avançado</option>
                            </select>
                        </div>
                        <div class="form-input w-35">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" id="" value="<?= $cidade?>">
                        </div>
                        <div class="form-input w-50"></div>
                        
                        <div class="form-input w-50">
                            <label for="resumo">Resumo</label>
                            <textarea name="resumo" cols="30" rows="7" placeholder="Fale um pouco sobre você"><?= $resumo?></textarea>
                        </div>


                    </div>
                </div>


                <input type="submit" value="Guardar" class="btn btn-medium">

            </form>
            <p>
                <?=$status?>
            </p>
        </div>