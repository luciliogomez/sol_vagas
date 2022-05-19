<?=$this->layout("template::template",[
    "title" => "AProvar Candidato - {$candidato->getNome()}"
])?>

<div class="container flex-column-center w-100 mt-2">

    <div class="w-80 mb-2">
        <h4 class="text-size-small-1 text-center"> APROVAR CANDIDATO <?=$candidato->getNome()?> à vaga de <?=$vaga->getTitulo()?></h4>
    </div>
    <div class="w-80">
        <form action="" method="post" class="w-100 flex-column-center">
            <div class="form-input mb-2 w-50">
                <label for="mensagem">Mensagem</label>
                <textarea name="mensagem"  cols="30" rows="6" placeholder="Envie uma mensagem de felicitação"></textarea>
            </div>
            <div class="form-input w-30">
                <input type="submit" class="btn btn-medium" value="Aprovar e Enviar">
            </div>
        </form>
    </div>  

</div>