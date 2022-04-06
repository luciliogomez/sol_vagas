<?php $this->layout("template::template",[
    "top" => "{$top}",
    "description" => "{$description}",
    "titulo"      => "{$titulo}",
    "url"         => "{$url}"
]); ?>
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
                    <?php foreach($clientes as $cliente): ?>
                        <tr>
                            <td><?= $cliente['id'] ?></td>
                            <td><?= $cliente['nome'] ?></td>
                            <td><?= $cliente['email'] ?></td>
                            <td>
                                <a href="<?=$url?>/cliente/<?=$cliente['id']?>/edit" class="btn btn-floating orange">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?=$url?>/cliente/<?=$cliente['id']?>/delete" class="btn btn-floating red">
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
       <!-- /<?php //foreach($links as $link): ?> -->
            <?=$links?>
        <!-- <?php //endforeach;?> -->
    
    </ul>
    
</div>
<div class="center">
    <?= $status ?>
</div>