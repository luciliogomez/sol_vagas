<?=$this->layout("template::template",[
    "title"  => "Convidar Para Entrevista"
]);
?>

<div class="container mt-1">
    <div>
        <h2>ENVIAR CONVITE PARA ENTREVISTA</h2>
    </div>

    <div class="mt-1 mb-2 br-4 blue pa-1 rad-3 w-50">
        <h4 class="text-white">Candidato : <span><?=$candidato->getNome()?></span></h4>
        <h4 class="text-white">Vaga : <span><?=$vaga->getTitulo()?> </span></h4>
    </div>

    <div class="w-100">
        <form action="" method="post" class="">
           <div class="flex-row-start flex-wrap w-100">
                <div class="form-input w-30 mr-2 mb-2">
                     <label for="data">Data da entrevista</label>
                     <input type="date" name="data" required value="<?=(isset($data)?$data:'')?>">
                </div>
                <div class="form-input w-30 mr-2 mb-2">
                     <label for="hora">Hora da entrevista</label>
                     <input type="time" name="hora" required value="<?=(isset($hora)?$hora:'')?>">
                </div>
                <div class="w-30"></div>
                <div class="form-input w-30 mr-2 mb-2">
                    <label for="modalidade">Modalidade de entrevista</label>
                    <select name="modalidade" id="">
                        <option value="1">Presencial</option>
                        <option value="2" value="<?=(isset($modalidade) && $modalidade=='2'?'selected':'')?>">Online</option>
                    </select>
                </div>
                <div class="form-input w-30 mb-2">
                    <label for="endereco">Local de Entrevista</label>
                    <input type="text" name="endereco" id="" value="<?=(isset($endereco)?$endereco:'')?>"placeholder="Endereço da Empresa">
                </div>
                <div class="form-input w-50 ">
                     <label for="corpo">Corpo do Email</label>
                     <textarea name="corpo" id="" cols="30" rows="5" required><?=(isset($corpo)?$corpo:'')?></textarea>
                </div>
                <div class="w-40"></div>
                <div class=" w-100 mt-1 mb-1">
                    <p class="text-size-small-1 text-dark-grey ">Destinatario: <?=$candidato->getEmail()?></p>
                </div>
                <div class="form-input w-10 ">
                    <input type="submit" class="btn btn-medium blue" value="Enviar">
                </div>
                <div class="form-input w-10 mr-10">
                    <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/candidaturas/<?=$candidatura['id']?>/show"
                    class="btn btn-medium red">Cancelar</a>
                </div>
                <div class="w-40"><p><?=$status?></p></div>
                
           </div>
        </form>
    </div>
</div>