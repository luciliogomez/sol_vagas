<?=$this->layout("template::template",[
    "title" => "Perfil da Empresa"
])?>



    <!-- CONTENT -->
    <div class="perfil companie container flex-row-space-between" >
            <div class="basic-info">
                <div class="picture">
                    <figure class="no-border">
                        <img src="img/c1.png" alt="" class="no-border">
                    </figure>
                </div>
                <div class="presentation">
                    <h3 class="name"><?=$empresa->getNome()?></h3>
                    <h4 class="title">Empresa de Software</h4>
                </div>
                <div class="links flex-column-start">
                    <a href="editar_perfil_empresa.html" class="btn">Editar perfil</a>
                    <a href="dashboard_empresa.html" class="btn">Voltar ao dashboard</a>
                </div>
                <div class="contacts flex-column-start">
                    <span><i class="fa fa-envelope"></i> geral.sambatec@gmail.com</span>
                    <span><i class="fa fa-phone"></i> 943812726</span>
                </div>
            </div>
            <div class="general-info flex-column-start">
                <div class="warning">
                    <p class="text-center "> Mantenha seu Perfil sempre actualizado!</p>
                </div>
                <div class="section resume">
                    <h3 class="title">Descrição da Empresa</h3>
                    <div class="section-content">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Odit excepturi fugiat nesciunt corporis vitae voluptas? Enim, sunt est minima, 
                            rem, maxime suscipit amet quae iusto voluptatibus rerum dolores nobis recusandae!
                        </p>
                    </div>
                </div>
                
                <!--  -->
                <div class="section information">
                    <h3 class="title">INFORMAÇÕES</h3>
                    <div class="section-content flex-row-space-between-wrap">
                        <div class="info flex-row-space-between">
                            <div class="picture">
                                <figure>
                                    <i class="fa fa-calendar"></i>
                                </figure>
                            </div>
                            <div class="text flex-column-start ">
                                <h3>Ano de Fundação</h3>
                                <h2>2005</h2>
                            </div>  
                        </div>
                        <div class="info flex-row-space-between">
                            <div class="picture">
                                <figure>
                                    <i class="fa fa-map-marker"></i>
                                </figure>
                            </div>
                            <div class="text flex-column-start ">
                                <h3>Localização</h3>
                                <h2>Luanda</h2>
                            </div>  
                        </div>
                        <div class="info flex-row-space-between">
                            <div class="picture">
                                <figure>
                                    <i class="fa fa-laptop"></i>
                                </figure>
                            </div>
                            <div class="text">
                                <h3>Site</h3>
                                <h2>www.sambatec.com</h2>
                            </div>  
                        </div>
                        <div class="info flex-row-space-between">
                            <div class="picture">
                                <figure>
                                    <i class="fa fa-linkedin"></i>
                                </figure>
                            </div>
                            <div class="text">
                                <h3>Linkedin</h3>
                                <h2>www.linkedin.com/u/sambatec-23111</h2>
                            </div>  
                        </div>
                    
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
        
    <!--END CONTENT -->