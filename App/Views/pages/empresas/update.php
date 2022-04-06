<?php $this->layout("template::template",[
    "titulo"      => "{$titulo}",
    "top"         => "{$top}",
    "description" => "{$description}",
    "url"         => URL
]);?>
<div class="row ">
    <form action="" method="post">
        <div class="row">
            <input type="hidden" name="id" id="" value="<?=$id?>">
            <input type="hidden" name="nivel" id="" value="<?=$nivel?>">
            <input type="hidden" name="old_senha" value="<?=$senha?>">
            <div class="col s12 m6 input-field">
                <input type="text" name="nome" id="" value="<?=$nome?>">
                <label for="nome">Nome</label>
            </div>

            <div class="col s12 m6  input-field">
                <input type="email" name="email" id="" value="<?=$email?>">
                <label for="nome">Email</label>
            </div>
            <div class="col s12 m6 input-field">
                <input type="password" name="senha" id="" >
                <label for="nome">Nova Senha</label>
            </div>
            
            <div class="col s12 m3  input-field">
                <?php if($niveis == true): ?>
                <select name="nivel" id="">
                    <option value="admin" <?php if($nivel=='admin'):echo'selected';endif; ?> >Admin</option>
                    <option value="user"  <?php if($nivel=='user'):echo'selected';endif; ?>>User</option>
                </select>
                <?php endif;?>
            </div>
        </div>
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="update" id="" value="SALVAR ALTERAÇÕES" class="btn green">
                <a href="<?= URL ?>/" class="btn red">VOLTAR</a>
            </div>

            <?=$status?>
        </div>
    </form>
</div>