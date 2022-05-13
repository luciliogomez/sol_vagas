<?= $this->layout("template::template",[
    "title" => "Adicionar Experiencia"
]);?>
    <!-- CONTENT -->

    <div class="edicao container">
            
    <a href="<?=URL?>/candidatos/<?=$id?>/perfil" class="btn mb-2"><-</a>
            <form class="flex-column-start" action="" method="post" enctype="multipart/form-data">
                <h3 class="title">Descreva sua experiência</h3>

                
                <div class="section flex-column-start">
                    <div class="flex-row-start">
                        
                        <div class="form-input w-40">
                            <label for="cargo">Cargo</label>
                            <input type="text" placeholder="Seu Cargo " name="cargo" required id="" value="<?=$cargo?>">
                        </div>
                        <div class="form-input w-40">
                            <label for="empresa">Empresa</label>
                            <input type="text" placeholder="Empresa em que trabalhou"  name="empresa" required id="" value="<?=$empresa?>">
                        </div>
                        <div class="form-input w-25">
                            <label for="inicio">Data de Inicio</label>
                            <input type="date" name="inicio" id="" value="<?=$inicio?>">
                        </div>
                        <div class="form-input w-25">
                            <label for="fim">Data de Término</label>
                            <input type="date" name="fim" id="" <?=$fim?>>
                        </div>
                        <div class="form-input w-50">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" cols="30" rows="7" placeholder="Seu trabalho na empresa, suas actividades,etc"><?=$descricao?></textarea>
                        </div>
                        <div class="form-input w-30"></div>
                        <div class="form-input w-30">
                            <button type="submit" class="btn btn-medium ">Salvar</button>    
                        </div>
                        <p class="error">
                            <?=$status?>
                        </p>
                        

                    </div>
                </div>




            </form>
        </div>

    <!--END CONTENT -->
