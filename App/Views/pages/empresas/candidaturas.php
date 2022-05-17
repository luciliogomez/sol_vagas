<?=$this->layout("template::template",[
    "title" => "Candidaturas"
]);
?>
<?php 

?>
    <!-- CONTENT -->

    <div class="dashboard container" >
    <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/dashboard" class="btn mb-2"><-</a>
           <div class="candidaturas container white mb-0 " >
                   <h2>Candidaturas</h2>
                   <div class="filtro">

                        <form action="" method="post">
                            <div class=" flex-row-end">
                                <div class="form-input mr-1">
                               <label for="vaga">Selecione a Vaga</label>
                               <select name="vaga" id="">
                                   <option value="1">Desenvolvedor Backend</option>
                                   <option value="2">Programador Java</option>
                                   <option value="3">UX/UI Designer</option>
                               </select>
                           </div>
                           <div class="form-input mr-1">
                               <label for="status">Status</label>
                               <select name="status" id="">
                                   <option value="1">Pendente</option>
                                   <option value="2">Entrevista</option>
                                   <option value="3">Reprovado</option>
                                   <option value="4">Aprovado</option>
                                   <option value="4">Todos</option>
                               </select>
                           </div>
                           <div class="form-input">
                               <button type="submit" class="btn btn-medium mt-20" name="f" >FILTRAR</button>
                           </div>
                       </div>
                        </form>
                   </div>

                   <div class="mt-5">
                       <div class="  flex-row-space-between mb-2 bb-1 pb-1 pt-1 bt-1">
                           <div class="w-20"> <h3>Candidato</h3></div>
                           <div class="w-20"> <h3>Vaga</h3></div>
                           <div class="w-20"> <h3>Data</h3></div>
                           <div class="w-20"> <h3>Status</h3></div>
                           <div class="w-20"> <h3>--</h3></div>
                       </div>
                       <?php foreach($candidaturas as $candidatura): ?>
                       <div class="text-dark-grey mb-2  flex-row-space-between">
                           <div class="w-20"> <h3><?=$candidatura['nome']?></h3></div>
                           <div class="w-20"> <h3><?=$candidatura['titulo']?></h3></div>
                           <div class="w-20"> <h3><?=$candidatura['data_limite']?></h3></div>
                           <div class="w-20"> <h3><?=$candidatura['estado']?></h3></div>
                           <div class="w-20"> <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/candidaturas/<?=$candidatura['id']?>" class="btn ">Ver Candidatura</a> </div>
                       </div>
                       <?php endforeach; ?>
                        <div class="">
                            <?=$links?>
                        </div>
                        
                   </div>
           </div>
       </div>

   <!--END CONTENT -->
