<?= $this->layout("template::template",[
    "title" => "ADICIONAR CURSO"
]);?>


    <!-- CONTENT -->

    <div class="edicao container">
            
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
                        <div class="form-input w-25">
                            <label for="conclusao">Data de Conlusão</label>
                            <input type="date" name="conclusao" id="" value="<?=$conclusao?>" required>
                        </div>
                        <div class="form-input w-50">
                            <label for="certificado">Inclua o certificado</label>
                            <input type="file" name="certificado"  placeholder="Seu certificado" required>
                        </div>
                        <div class="form-input w-30">
                            <button type="submit" class="btn btn-medium ">Salvar</button>    
                        </div>
                        <p class="error" ><?=$status?> </p>

                    </div>
                </div>




            </form>
        </div>

    <!--END CONTENT -->

