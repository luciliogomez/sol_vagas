<?php $this->layout("candidatos::dashboard",[
    "title" => " - Candidaturas"
]); 
?>

<!-- candidaturas -->
<div class="candidaturas white">
    <h2 class=" text-dark-grey"> Minhas Candidaturas</h2>
    <div class="vagas">
        <div class="articles flex-columm-center w-80">
            <?php foreach($candidaturas as $candidatura): ?>

            <a href="<?=URL?>/vagas/<?=$candidatura['id_vaga']?>/ver" class="vaga-horizontal">
                <article class="flex-row-start">
                    <div class="start">
                        <figure>
                            <img src="img/c1.png" alt="">
                        </figure>
                    </div>
                    <div class="middle">
                        <h4 class="titulo"><?=$candidatura['titulo']?></h4>
                        <h5 class="empresa"><i class="fa fa-building-o"></i> <?=$candidatura['nome']?></h5>
                    </div>
                    <div class="end flex-column-center">
                        <p> Oferta aberta até </br> <span><?=$candidatura['data_limite']?></span></p>
                    </div>
                
                </article>
            </a>
        <?php endforeach; ?>


        <div class="pagination ">
                <?=$links?>
            </div>
        </div>

    
    </div>
</div>
</div>

<!--END CONTENT -->
