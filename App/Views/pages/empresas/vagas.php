<?=$this->layout("template::template",[
    "title" => "Vagas"
]);
?>
<?php 

?>
    <!-- CONTENT -->

    <div class="dashboard container" >
    <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/dashboard" class="btn mb-2"><-</a>
    <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/vagas/nova" class="btn mb-2">Publicar Vaga</a>
           <div class="candidaturas container white mb-0 " >
                   <h2>Vagas</h2>
                   <div class="filtro">

                        <form action="" method="post">
                            <div class=" flex-row-end">
                                <div class="form-input mr-1">
                               <label for="estado">Selecione o Estado</label>
                               <select name="estado" id="">
                                   <option value="1">Aberta</option>
                                   <option value="0" <?=((isset($estado))&& ($estado=='0'))?'selected':''?>>Fechada</option>
                               </select>
                           </div>
                           
                           <div class="form-input">
                               <button type="submit" class="btn btn-medium mt-20 " name="f" >Filtrar</button>
                           </div>
                           <div>
                               <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/vagas" class="btn btn-medium mt-20 red ">Limpar</a>
                           </div>
                       </div>
                        </form>
                   </div>

                   <div class="mt-5">
                       <div class="  flex-row-space-between mb-2 bb-1 pb-1 pt-1 bt-1">
                           <div class="w-20"> <h3>Nº</h3></div>
                           <div class="w-20"> <h3>Titulo</h3></div>
                           <div class="w-20"> <h3>Modalidade</h3></div>
                           <div class="w-20"> <h3>Data Limite</h3></div>
                           <div class="w-20"> <h3>Status</h3></div>
                           <div class="w-20"> <h3>--</h3></div>
                       </div>
                       <?php foreach($vagas as $vaga): ?>
                       <div class="text-dark-grey mb-2  flex-row-space-between">
                           <div class="w-20"> <h3><?=$vaga['id']?></h3></div>
                           <div class="w-20"> <h3><?=$vaga['titulo']?></h3></div>
                           <div class="w-20"> <h3><?=$vaga['modalidade']?></h3></div>
                           <div class="w-20"> <h3><?=$vaga['data_limite']?></h3></div>
                           <div class="w-20"> <h3><?=trnslt_estado_vaga($vaga['estado'])?></h3></div>
                           <div class="w-20"> 
                                <a href="<?=URL?>/vagas/<?=$vaga['id']?>/ver" class="btn ">
                                    <i class="fa fa-eye"></i>
                                </a> 
                                <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/vagas/<?=$vaga['id']?>/editar" class="btn green">
                                    <i class="fa fa-edit"></i>
                                </a> 
                            </div>
                       </div>
                       <?php endforeach; ?>
                        <div class="">
                            <?=$links?>
                        </div>
                        
                   </div>
           </div>
       </div>

   <!--END CONTENT -->
