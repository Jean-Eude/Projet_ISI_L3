            <!-- start banner Area -->
            <section class="banner-area" id="home">
                <!-- Start Header Area -->
                <header class="default-header">
                    <nav class="navbar navbar-expand-lg  navbar-dark">
                        <div class="container-fluid">
                            <div class="collapse navbar-collapse justify-content-start align-items-center " id="navbarSupportedContent">
                                <ul class="navbar-nav h3">
                                    <li><a href="<?php echo site_url('administrateur/afficher')?>">E-Quizine</a></li>
                                </ul>
                            </div>  
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="text-dark lnr lnr-menu"></span>
                            </button>

                            <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarSupportedContent">


                                <ul class="navbar-nav">
                                     <a href="<?php echo site_url('administrateur/lister')?>"><input  class="btn btn-primary bg-dark"  type="submit" name="submit" value="Profil" /></a> 
                                </ul>
                                <ul class="navbar-nav">
                                     <a href="<?php echo site_url('compte/lister')?>"><input  class="btn btn-primary bg-dark"  type="submit" name="submit" value="Comptes" /></a> 
                                </ul>
                                <ul class="navbar-nav">
                                     <li><a href="<?php echo site_url('administrateur/detruire')?>"><input  class="btn btn-primary bg-dark"  type="submit" name="submit" value="Déconnexion" /></a></li>   
                                </ul>
                            </div>                      
                        </div>
                    </nav>
                </header>
                <!-- End Header Area -->                
            </section>



