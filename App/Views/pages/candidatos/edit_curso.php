<?= $this->layout("template::template",[
    "title" => "EDITAR CURSO"
]);?>


    <!-- CONTENT -->

    <div class="edicao container">
            
    <a href="<?=URL?>/candidatos/<?=$id?>/perfil" class="btn mb-2"><-</a>
            <form class="flex-column-start" action="" method="post" enctype="multipart/form-data">
                <h3 class="title">Descreva seu curso</h3>

                
                <div class="section flex-column-start">
                    <div class="flex-row-start">
                        
                        <div class="form-input w-40">
                            <label for="nome">Curso</label>
                            <input type="text" placeholder="Nome do curso " 
                            name="nome" required value="<?=$nome?>" >
                        </div>
                        <div class="form-input w-40">
                            <label for="escola">Escola</label>
                            <input type="text" placeholder="Onde fez o curso"  
                            name="escola" required id="" value="<?=$escola?>">
                        </div>
                        <div class="form-input w-30 ">
                            <label for="conclusao">Data de Conlusão</label>
                            <input type="date" name="conclusao" id="" value="<?=$conclusao?>" required>
                        </div>
                        <div class="form-input w-50">
                            <label for="certificado">Inclua o certificado</label>
                            <input type="file" name="certificado"  placeholder="Seu certificado" >
                        </div>
                        <div class="w-10"></div>
                        <div class="form-input w-10">
                            <button type="submit" class="btn btn-small ">Salvar</button>    
                        </div>
                        <div class="form-input w-10">
                            <a href="<?=URL?>/candidatos/<?=$id?>/curso/<?=$id_curso?>/eliminar" 
                            class="btn btn-small red">Eliminar</a>    
                        </div>
                        <p class="error"><?=$status?></p>

                    </div>
                </div>




            </form>
        </div>

    <!--END CONTENT -->

