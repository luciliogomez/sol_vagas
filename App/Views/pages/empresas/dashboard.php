<?=$this->layout("template::template",[
    "title" => "DASHBOARD"
]);

?>
    <!-- CONTENT -->
    <div class="dashboard container">
           <div class="cards flex-row-space-between">
               <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/perfil" class="card-link">
                   <div class="card flex-row-start" >
                       <div class="card-image">
                           <figure>
                               <i class="fa fa-user"></i>
                           </figure>
                       </div>
                       <div class="card-content flex-column-start">
                           <h4 class="card-title">Perfil</h4>
                           <p class="card-text">Perfil da Empresa</p>
                       </div>
                   </div>
               </a>

               <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/candidaturas" class="card-link">
                   <div class="card flex-row-start">
                       <div class="card-image">
                           <figure>
                               <i class="fa fa-user"></i>
                           </figure>
                       </div>
                       <div class="card-content flex-column-start">
                           <h4 class="card-title">Candidaturas</h4>
                           <p class="card-number">7</p>
                       </div>
                   </div>
               </a>


               <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/vagas" class="card-link">
                   <div class="card flex-row-start">
                       <div class="card-image">
                           <figure>
                               <i class="fa fa-user"></i>
                           </figure>
                       </div>
                       <div class="card-content flex-column-start">
                           <h4 class="card-title">Vagas</h4>
                           <p class="card-text">Vagas publicadas</p>
                       </div>
                   </div>
               </a>

           </div>
            
            <!-- PUT YOUR CONTENT HERE -->
            <?= $this->section("content") ?>
            <!-- END CONTENT -->

           <div class="section content container white flex-row-space-between mb-5" >
               <div class="picture w-50">
                   <figure >
                       <img src="<?=ASSETS?>/img/3.jpg" alt="">
                   </figure>
               </div>
               <div class="text w-45 flex-column-start">
                   <h2 class="text-dark-grey text-size-big mb-2">Publique uma vaga e encontra o candidato perfeito para 
                       sua empresa
                   </h2>
                   <a href="<?=URL?>/empresas/<?=$empresa->getId()?>/vagas/nova" class="btn">Publicar Vaga</a>
               </div>
           </div>
       </div>

   <!--END CONTENT -->