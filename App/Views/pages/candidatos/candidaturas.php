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
                        <?php if(empty($candidatura['logotipo'])):?>
                            <i class="fa fa-building-o" ></i>
                        <?php else:?>
                            <img src="<?=URL."/uploads/".$candidatura['logotipo']?>" alt="">
                        <?php endif;?>
                        </figure>
                    </div>
                    <div class="middle">
                        <h4 class="titulo"><?=$candidatura['titulo']?></h4>
                        <h5 class="empresa mb-2"><i class="fa fa-building-o"></i> <?=$candidatura['nome']?></h5>
                        <h6 class="text-size-small-1 text-dark-grey">Status: <?=$candidatura['estado']?></h6>
                    </div>
                    <div class="end flex-column-center">
                    <?php if($candidatura['vaga_estado']==0):?>
                        <p class="fechado">Vaga Fechada</span></p>
                    <?php else:?>
                        <p> Oferta aberta até </br> <span><?=$candidatura['data_limite']?></span></p>
                    <?php endif;?>
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
