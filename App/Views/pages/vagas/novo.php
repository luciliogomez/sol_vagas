<?php $this->layout("template::template",[
    "top"         => "{$top}",
    "description" => "{$description}",
    "titulo"      => "{$titulo}",
    "url"         => URL
]); ?>
<div class="row ">
    <form action="" method="post">
        <div class="row">

            <div class="col s12 m5 input-field">
                <input type="text" name="nome" id="">
                <label for="nome">Nome</label>
            </div>

            <div class="col s12 m5 push-m1 input-field">
                <input type="email" name="email" id="">
                <label for="nome">Email</label>
            </div>
        </div>
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="add" id="" value="ADICIONAR" class="btn green">
                <a href="<?= $url ?>/" class="btn red">VOLTAR</a>
            </div>

            <?= $status ?>
        </div>
    </form>
</div>