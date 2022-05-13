<?= $this->layout("template::template",[
    "title" => "EDITAR FORMACAO"
]);?>
    <!-- CONTENT -->

    <div class="edicao container">
            
    <a href="<?=URL?>/candidatos/<?=$id?>/perfil" class="btn mb-2"><-</a>
            <form class="flex-column-start" action="" method="post" enctype="multipart/form-data">
                <h3 class="title">Editar uma Formação</h3>

                
                <div class="section flex-column-start">
                    <div class="flex-row-start">
                        
                        <div class="form-input w-40">
                            <label for="nivel">Nivel</label>
                            <select name="nivel" id="">
                                <option value="medio" <?=($nivel=='medio')?"selected":''?>>Ensino Medio Completo</option>
                                <option value="licenciatura"<?=($nivel=='licenciatura')?"selected":''?>>Licenciatura</option>
                                <option value="mestrado"<?=($nivel=='mestrado')?"selected":''?>>Mestrado</option>
                            </select>
                        </div>
                        <div class="form-input w-40">
                            <label for="curso">Curso</label>
                            <input type="text" name="curso" value="<?=$curso?>" placeholder="Qual a sua area de formação" required id="">
                        </div>


                        <div class="form-input w-40">
                            <label for="escola">Escola</label>
                            <input type="text" name="escola" value="<?=$escola?>" placeholder="Onde voce estudou" required id="">
                        </div>

                        <div class="form-input w-50"></div>

                        <div class="form-input w-30">
                            <label for="inicio">Data de Inicio</label>
                            <input type="date" name="inicio" id="" required value="<?=$inicio?>">
                        </div>
                        <div class="form-input w-30">
                            <label for="fim">Data de Conclusao</label>
                            <input type="date" name="fim" id="" value="<?=$fim?>">
                        </div>
                        <div class="form-input w-50">
                            <label for="cursando"> <input type="checkbox" name="cursando" value="true"id=""> Ainda cursando</label>
                        </div>
                        <div class="form-input w-40">
                        </div>
                        
                        <div class="form-input w-10">
                            <button type="submit" class="btn btn-small ">Salvar</button>    
                        </div>
                        <div class="form-input w-10">
                            <a href="<?=URL?>/candidatos/<?=$id?>/formacao/<?=$id_formacao?>/eliminar" 
                            class="btn btn-small red">Eliminar</a>    
                        </div>
                        <p class="error"><?=$status?></p>
                        

                    </div>
                </div>




            </form>
        </div>

    <!--END CONTENT -->