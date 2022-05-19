<?=$this->layout("template::template",[
    "title" => "Enviar Convite "
])?>


<div class="conteiner flex-column-center">
    <h2 class="mt-2">ENVIO DE CONVITE</h2>
    <div class="mt-4 mb-2">
        <?=$status?>
    </div>
    <div>
        <a href="<?=URL?>/empresas/<?=$id_empresa?>/candidaturas/<?=$id_candidatura?>/show" class="btn btn-medium blue mb-4">Voltar</a>
    </div>

</div>