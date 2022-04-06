<?php $this->layout("template::template",[
    "top" => "Utilizadores",
    "description" => "LISTA DE UTILIZADORES",
    "titulo"      => "UTILIZADORES",
    "url"         => URL
]); ?>
<div class="row">
    <a href="novo-usuario" class="btn blue">NOVO USUARIO</a>
</div>
<div class="row " >

    
    <div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                    <?php foreach($headers as $header): ?>
                        <th><?=$header?></th>
                    <?php endforeach;?>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id'] ?></td>
                            <td><?= $usuario['nome'] ?></td>
                            <td><?= $usuario['email'] ?></td>
                            <td><?= $usuario['nivel'] ?></td>
                            <td>
                                <a href="<?= URL ?>/usuario/<?=$usuario['id']?>/edit" class="btn btn-floating orange">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= URL ?>/usuario/<?=$usuario['id']?>/delete" class="btn btn-floating red">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    
    <ul class="pagination center">
        <?= $links ?>
    </ul>
    
</div>
<div class="center">
    <?= $status ?>
</div>