<?= $this->layout("template::template",[
    "title" => $empresa->getNome()
]);?>


    <!-- CONTENT -->

    <div class="edicao container">
            
            <form class="flex-column-start" action="" method="post" enctype="multipart/form-data">
                <h3 class="title">Perfil da Empresa</h3>
                <input type="hidden" name="old_foto" value="<?=$empresa->getLogo()?>">

                <div class="section flex-row-start-start w-100">
                    <div class="w-20 ">
                        <figure class="picture">
                        <?php if(empty($empresa->getLogo())):?>
                            <i class="fa fa-user" ></i>
                        <?php else:?>
                            <img src="<?=URL."/uploads/".$empresa->getLogo()?>" alt="">
                        <?php endif;?>
                        </figure>
                        <div class="w-100">
                            <div class="form-input">
                                <label for="foto">Escolha a Logo</label>
                                <input type="file" name="foto">
                            </div>
                        </div>
                    </div>
                    <div class="flex-row-start w-70">
                        
                        <div class="form-input w-40">
                            <label for="nome">Nome</label>
                            <input type="text" placeholder="Nome da Empresa" 
                            name="nome" required value="<?=$empresa->getNome()?>">
                        </div>

                        <div class="form-input w-40">
                            <label for="email">Email</label>
                            <input type="email" placeholder="Ex: empresa@gmail.com"  
                            name="email" required value="<?=$empresa->getEmail()?>">
                        </div>

                        <div class="form-input w-30">
                            <label for="phone">Telefone</label>
                            <input type="text" placeholder="(+244) 923458964"  
                            name="telefone" required value="<?=$empresa->getTelefone()?>">
                        </div>


                        <div class="form-input w-30">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" value="<?=$empresa->getCidade()?>">
                        </div>
                        <div class="form-input w-20">
                            <label for="area">Ano de Fundação</label>
                            <input type="number" name="ano" required value="<?=$empresa->getAnoFundacao()?>">
                        </div>
                    </div>
                </div>
                
                <div class="section flex-column-start w-100">
                    <div class="flex-row-start">
                        <!-- <div class="form-input w-40"></div> -->
                        <div class="form-input w-60 mb-1">
                            <label for="resumo">Resumo</label>
                            <textarea name="resumo" cols="30" rows="7" 
                            placeholder="Fale um pouco sobre a empresa"><?=$empresa->getDescricao()?></textarea>
                        </div>
                        <div class="form-input w-30 mb-0"></div>
                        <div class="form-input w-15">
                            <button type="submit" class="btn">SALVAR</button>
                        </div>
                        <div class="form-input w-20 mr-5">
                            <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/perfil" class="btn red">VOLTAR</a>
                        </div>
                        <p class=""><?=$status?></p>
                    </div>
                    
                </div>




            </form>
        </div>

    <!--END CONTENT -->