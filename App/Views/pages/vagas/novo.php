<?=$this->layout("template::template",[
    "title" => "Publicar Vaga"
]);
?>
    <!-- CONTENT -->

    <div class="edicao container mt-2">
            
    <a href="<?=URL?>/empresas/<?=$id_empresa?>/dashboard" class="btn mb-1 mt-0"><-</a>
            <form class="flex-column-start" action="" method="post" enctype="multipart/form-data">
                <h3 class="title">Publicar Nova Vaga</h3>
                <input type="hidden" name="id_empresa" value="<?=$id_empresa?>">
                
                <div class="section flex-column-start">
                    <div class="flex-row-start">
                        <div class="form-input w-30">
                            <label for="titulo">Titulo</label>
                            <input type="text" placeholder="Titulo da Vaga" 
                            name="titulo" required id="" value="<?=isset($titulo)?$titulo:''?>">
                        </div>
                        <div class="form-input w-30">
                            <label for="area">Area de Actuação</label>
                            <select name="area" id="">
                                <option value="ti" <?=(isset($area)&&$area=='ti'?'selected':'')?> >Tecnologias de Informação</option>
                                <option value="Saúde" <?=(isset($area)&&$area=='Saúde'?'selected':'')?> >Saúde</option>
                                <option value="economia" <?=(isset($area)&&$area=='economia'?'selected':'')?>>Economia & Finanças</option>
                                <option value="Educação" <?=(isset($area)&&$area=='educacao'?'selected':'')?>>Educação</option>
                                <option value="mecanica" <?=(isset($area)&&$area=='mecanica'?'selected':'')?>>Mecanica</option>
                            </select>
                        </div>
                        
                        <div class="form-input w-30">
                            <label for="formato">Tipo</label>
                            <select name="formato" id="">
                                <option value="estagio" <?=(isset($formato)&&$formato=='estagio'?'selected':'')?>>Estágio</option>
                                <option value="meioperiodo" <?=(isset($formato)&&$formato=='meio-periodo'?'selected':'')?>>Meio Período</option>
                                <option value="fulltime" <?=(isset($formato)&&$formato=='fulltime'?'selected':'')?>>Full-Time</option>
                            </select>
                        </div>

                        <div class="form-input w-30">
                            <label for="modalidade">Modalidade</label>
                            <select name="modalidade" id="" >
                                <option value="presencial" <?=(isset($modalidade)&&$modalidade=='presencial'?'selected':'')?>>Presencial</option>
                                <option value="remoto" <?=(isset($modalidade)&&$modalidade=='remoto'?'selected':'')?>>Remoto</option>
                            </select>
                        </div>
                        <div class="form-input w-30">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" required id="" value="<?=(isset($cidade)?$cidade:'')?>" >
                        </div>
                        <div class="form-input w-15">
                            <label for="salario_min">Salario Min</label>
                            <input type="number"  min="0" name="salario_min" id="" value="<?=(isset($salario_min)?$salario_min:0)?>" >
                        </div>
                        <div class="form-input w-15">
                            <label for="salario_max">Salario Max</label>
                            <input type="number" min="0" name="salario_max" id="" value="<?=(isset($salario_max)?$salario_max:0)?>" >
                        </div>
                        <div class="form-input w-30">
                            <label for="nivel">Escolaridade Minima</label>
                            <select name="nivel" id="">
                                <option value="medio" <?=(isset($nivel)&&$nivel=='medio'?'selected':'')?>>Ensino Medio Completo</option>
                                <option value="licenciatura" <?=(isset($nivel)&&$nivel=='licenciatura'?'selected':'')?>>Licenciatura</option>
                                <option value="mestrado" <?=(isset($nivel)&&$nivel=='mestrado'?'selected':'')?>>Mestrado</option>
                            </select>
                        </div>
                        <div class="form-input w-30">
                            <label for="anos">Anos de Experiencia</label>
                            <input type="number" name="anos" id="" min='0' value="<?=(isset($anos)?$anos:'0')?>">
                        </div>
                        <div class="form-input w-30">
                            <label for="fim">Data limite de Oferta</label>
                            <input type="date" name="fim" id="" value="<?=$fim?>" >
                        </div>
                        <div class="form-input w-45">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" cols="30" rows="7" required placeholder="Descrição da vaga, actividades, responsabilidades,etc"><?=isset($descricao)?$descricao:''?></textarea>
                        </div>
                        <div class="form-input w-45">
                            <label for="habilidades">Habilidades</label>
                            <textarea name="habilidades" cols="30" rows="7" required placeholder="Habilidades Necessárias, Oque o candidato precisa saber"><?=isset($habilidades)?$habilidades:''?></textarea>
                        </div>
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