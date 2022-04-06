<?php $this->layout("template::template",[
    "top" => "{$top}",
    "titulo"=> "{$title}",
    "description"=> "{$description}",
    "url" => "{$url}"
]);?>
<div class="row ">
    <form action="" method="post">
        <div class="row">
                <input type="hidden" name="id" id="" value="<?=$id?>">
            <div class="col s12 m5 input-field">
                <input type="text" name="nome" id="" value="<?=$nome?>">
                <label for="nome">Nome</label>
            </div>

            <div class="col s12 m5 push-m1 input-field">
                <input type="email" name="email" id="" value="<?=$email?>">
                <label for="nome">Email</label>
            </div>
        </div>
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="save" id="" value="GUARDAR" class="btn green">
                <a href="<?=$url?>/lista" class="btn red">VOLTAR</a>
            </div>
            <div class="col s12 center">
            <?=$status?>
            </div>
        </div>
    </form>
</div>