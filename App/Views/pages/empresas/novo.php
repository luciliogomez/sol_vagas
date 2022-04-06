<?php $this->layout("template::template",[
    "titulo"      => "Novo Usuario",
    "top"         => "Utilizador",
    "description" => "ADICIONAR UTILIZADOR",
    "url"         => URL
]);?>
<div class="row ">
    <form action="" method="post">
        <div class="row">

            <div class="col s12 m4 input-field">
                <input type="text" name="nome" id="">
                <label for="nome">Nome</label>
            </div>

            <div class="col s12 m4  input-field">
                <input type="email" name="email" id="">
                <label for="nome">Email</label>
            </div>
            <div class="col s12 m3  input-field">
                <select name="nivel" id="">
                    <option value="" disabled selected>Escolha o Nivel</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
        </div>
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="add" id="" value="ADICIONAR" class="btn green">
                <a href="<?= URL ?>/" class="btn red">VOLTAR</a>
            </div>

            <?= $status ?>
        </div>
    </form>
</div>