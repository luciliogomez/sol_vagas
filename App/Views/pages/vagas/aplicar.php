<?php $this->layout("template::template",[
    "title" => "Vaga - " . $vaga->getTitulo()
]); ?>


<div class="vaga-info container flex-row-center mb-5">
    <div class="w-70 ">
        <h2 class="mb-5 text-size-normal text-center">Deseja Candidatar-se a vaga de <?=$vaga->getTitulo()?> disponilizada por <?=$vaga->getEmpresa()?> ?</h2>
        <div class="">
            <form action="" method="post" class="flex-row-center mb-5">
                <input type="submit" class="btn green btn-small mr-2" value="Sim">
                <a href="<?=URL?>/vagas/<?=$vaga->getId()?>/ver" class="btn red btn-small">Cancelar</a>
            </form>
        </div>
        <div>
            <p><?=$status?></p>
        </div>
    </div>            
</div>
    