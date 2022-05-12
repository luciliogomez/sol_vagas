<?= $this->layout("template::template",[
    "title" => "ADICIONAR FORMACAO"
]);?>
    <!-- CONTENT -->

    <div class="edicao container">
            
            <form class="flex-column-start" action="" method="post" enctype="multipart/form-data">
                <h3 class="title">Adicionar uma Formação</h3>

                
                <div class="section flex-column-start">
                    <div class="flex-row-start">
                        
                        <div class="form-input w-40">
                            <label for="nivel">Nivel</label>
                            <select name="nivel" id="">
                                <option value="medio">Ensino Medio Completo</option>
                                <option value="licenciatura">Licenciatura</option>
                                <option value="mestrado">Mestrado</option>
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
                        
                        <div class="form-input w-30">
                            <button type="submit" class="btn btn-medium ">Salvar</button>    
                        </div>
                        <p class="error"><?=$status?></p>
                        

                    </div>
                </div>




            </form>
        </div>

    <!--END CONTENT -->