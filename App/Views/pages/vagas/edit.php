<?=$this->layout("template::template",[
    "title" => "Editar Vaga"
]);
?>
    <!-- CONTENT -->

    <div class="edicao container mt-2">
            
    <a href="<?=URL?>/empresas/<?=$vaga->getIdEmpresa()?>/dashboard" class="btn mb-1 mt-0"><-</a>
            <form class="flex-column-start" action="" method="post" enctype="multipart/form-data">
                <h3 class="title">Publicar Nova Vaga</h3>
                <input type="hidden" name="id_empresa" value="<?=$vaga->getIdEmpresa()?>">
                
                <div class="section flex-column-start">
                    <div class="flex-row-start">
                        <div class="form-input w-30">
                            <label for="titulo">Titulo</label>
                            <input type="text" placeholder="Titulo da Vaga" 
                            name="titulo" required id="" value="<?=$vaga->getTitulo()?>">
                        </div>
                        <div class="form-input w-30">
                            <label for="area">Area de Actuação</label>
                            <select name="area" id="">
                                <option value="ti" <?=(isset($vaga)&&$vaga->getArea()=='ti'?'selected':'')?> >Tecnologias de Informação</option>
                                <option value="Saúde" <?=(isset($vaga)&&$vaga->getArea()=='Saúde'?'selected':'')?> >Saúde</option>
                                <option value="economia" <?=(isset($vaga)&&$vaga->getArea()=='economia'?'selected':'')?>>Economia & Finanças</option>
                                <option value="Educação" <?=(isset($vaga)&&$vaga->getArea()=='educacao'?'selected':'')?>>Educação</option>
                                <option value="mecanica" <?=(isset($vaga)&&$vaga->getArea()=='mecanica'?'selected':'')?>>Mecanica</option>
                            </select>
                        </div>
                        
                        <div class="form-input w-30">
                            <label for="formato">Tipo</label>
                            <select name="formato" id="">
                                <option value="estagio" <?=(isset($vaga)&&$vaga->getFormato()=='estagio'?'selected':'')?>>Estágio</option>
                                <option value="meioperiodo" <?=(isset($vaga)&&$vaga->getFormato()=='meio-periodo'?'selected':'')?>>Meio Período</option>
                                <option value="fulltime" <?=(isset($vaga)&&$vaga->getFormato()=='fulltime'?'selected':'')?>>Full-Time</option>
                            </select>
                        </div>

                        <div class="form-input w-30">
                            <label for="modalidade">Modalidade</label>
                            <select name="modalidade" id="" >
                                <option value="presencial" <?=(isset($vaga)&&$vaga->getModalidade()=='presencial'?'selected':'')?>>Presencial</option>
                                <option value="remoto" <?=(isset($vaga)&&$vaga->getModalidade()=='remoto'?'selected':'')?>>Remoto</option>
                            </select>
                        </div>
                        <div class="form-input w-30">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" required id="" value="<?=(isset($vaga)?$vaga->getCidade():'')?>" >
                        </div>
                        <div class="form-input w-15">
                            <label for="salario_min">Salario Min</label>
                            <input type="number"  min="0" name="salario_min" id="" value="<?=(isset($vaga)?$vaga->getSalarioMin():0)?>" >
                        </div>
                        <div class="form-input w-15">
                            <label for="salario_max">Salario Max</label>
                            <input type="number" min="0" name="salario_max" id="" value="<?=(isset($vaga)?$vaga->getSalarioMax():0)?>" >
                        </div>
                        <div class="form-input w-30">
                            <label for="nivel">Escolaridade Minima</label>
                            <select name="nivel" id="">
                                <option value="medio" <?=(isset($vaga)&&$vaga->getEducacao()=='medio'?'selected':'')?>>Ensino Medio Completo</option>
                                <option value="licenciatura" <?=(isset($vaga)&&$vaga->getEducacao()=='licenciatura'?'selected':'')?>>Licenciatura</option>
                                <option value="mestrado" <?=(isset($vaga)&&$vaga->getEducacao()=='mestrado'?'selected':'')?>>Mestrado</option>
                            </select>
                        </div>
                        <div class="form-input w-30">
                            <label for="anos">Anos de Experiencia</label>
                            <input type="number" name="anos" id="" min='0' value="<?=(isset($vaga)?$vaga->getAnos():'0')?>">
                        </div>
                        <div class="form-input w-30">
                            <label for="fim">Data limite de Oferta</label>
                            <input type="date" name="fim" id="" value="<?=$vaga->getDataLimite()?>" >
                        </div>
                        <div class="form-input w-45">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" cols="30" rows="7" 
                            required placeholder="Descrição da vaga, actividades, responsabilidades,etc"><?=isset($vaga)?$vaga->getDescricao():''?></textarea>
                        </div>
                        <div class="form-input w-45">
                            <label for="habilidades">Habilidades</label>
                            <textarea name="habilidades" cols="30" rows="7" 
                            required placeholder="Habilidades Necessárias, Oque o candidato precisa saber"><?=isset($vaga)?$vaga->getHabilidades():''?></textarea>
                        </div>
                        <div class="form-input w-30">
                               <label for="estado">Estado da Vaga</label>
                               <select name="estado" id="">
                                   <option value="1">Aberta</option>
                                   <option value="0" <?=((isset($vaga))&& ($vaga->getEstado()=='0'))?'selected':''?>>Fechada</option>
                               </select>
                        </div>
                        <div class="w-50"></div> 
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