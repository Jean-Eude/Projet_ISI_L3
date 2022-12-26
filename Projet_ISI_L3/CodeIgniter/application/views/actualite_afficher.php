	            <section class="default-banner active-blog-slider">
                    <div class="item-slider relative" style="background: url(<?php echo base_url();?>style/img/Marianne.jpg);background-size: cover;"> 
                        <div class="overlay" style="background: rgba(0,0,0,.3)"></div>
                        <div class="container">
                            <div class="row fullscreen justify-content-center align-items-center">
                                <div class="col-md-10 col-12">
                                    <div class="banner-content text-center">
                                        <h3 class="text-white mb-20 text-uppercase">Découvrez l'Histoire de la France !</h3>
                                        <p class="text-white">A l'aide de différents quiz, découvrez la France comme vous ne l'avez jamais vu !<br><br></p>
                                        <a href="#" class="text-uppercase header-btn">Découvrez la dès maintenant!</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="item-slider relative" style="background: url(<?php echo base_url();?>style/img/NPB.jpg);background-size: cover;">
                        <div class="overlay" style="background: rgba(0,0,0,.3)"></div>
                        <div class="container">
                            <div class="row fullscreen justify-content-center align-items-center">
                                <div class="col-md-10 col-12">
                                    <div class="banner-content text-center">
                                        <h3 class="text-white mb-20 text-uppercase">Découvrez l'Histoire de la France !</h3>
                                        <p class="text-white">A l'aide de différents quiz, découvrez la France comme vous ne l'avez jamais vu !<br><br></p>
                                        <a href="#" class="text-uppercase header-btn">Découvrez la dès maintenant!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-slider relative" style="background: url(<?php echo base_url();?>style/img/Cr.jpg);background-size: cover;">
                        <div class="overlay" style="background: rgba(0,0,0,.3)"></div>
                        <div class="container">
                            <div class="row fullscreen justify-content-center align-items-center">
                                <div class="col-md-10 col-12">
                                    <div class="banner-content text-center">
                                        <h3 class="text-white mb-20 text-uppercase">Découvrez l'Histoire de la France !</h3>
                                        <p class="text-white">A l'aide de différents quiz, découvrez la France comme vous ne l'avez jamais vu !<br><br></p>
                                        <a href="#" class="text-uppercase header-btn">Découvrez la dès maintenant!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-slider relative" style="background: url(<?php echo base_url();?>style/img/Jf.jpg);background-size: cover;"> 
                        <div class="overlay" style="background: rgba(0,0,0,.3)"></div>
                        <div class="container">
                            <div class="row fullscreen justify-content-center align-items-center">
                                <div class="col-md-10 col-12">
                                    <div class="banner-content text-center">
                                        <h3 class="text-white mb-20 text-uppercase">Découvrez l'Histoire de la France !</h3>
                                        <p class="text-white">A l'aide de différents quiz, découvrez la France comme vous ne l'avez jamais vu !<br><br></p>
                                        <a href="#" class="text-uppercase header-btn">Découvrez la dès maintenant !</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
			<!-- Start about Area -->
			<section class="section-gap info-area" id="about">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-40 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Pourquoi E-Quizine ?</h1>
							</div>
						</div>
					</div>					
					<div class="single-info row mt-40">
						<div class="col-lg-6 col-md-12 mt-120 text-center no-padding info-left">
							<div class="info-thumb">
								<img src="<?php echo base_url();?>style/img/jacobin.jpg" class="img-fluid" alt="">
							</div>
						</div>
						<div class="col-lg-6 col-md-12 no-padding info-rigth">
							<div class="info-content">
								<h2 class="pb-30">Non ce n'est pas une application de cuisine !<br></h2>
								<p>
									Si avez cru un seul instant que nous allions vous parlez de cuisine, vous êtes tombés dans le panneau !									
								</p>
								<br>
								<p>
									Cette application conçu par Evan Combot à pour but de proposer différents quiz sur l'Histoire et plus particulièrement sur l'Histoire de la France. 									
								</p>
								<br>
								<p>
									Vous apprendrez au travers de différent quiz les différentes époques qui ont construit la France, ses grands évènements, ses illustres personnes qui ont rythmé l'Histoire de France au fil des siècles.
								</p>
								</div>
						</div>
						<div class="info_oeu">
							<p>Le lit de justice du 12 septembre 1715, Dumesnil Louis-Michel</p>
						</div>
					</div>
				</div>
			</section>
			<!-- End about Area -->
			
			
			<!-- Start logo Area -->
			<section class="logo-area">
				<div class="container">
					<div class="row">
						
					</div>
				</div>	
			</section>
			<!-- End logo Area -->	



<?php


echo("<center>" . "<h1>" . $titreActu . "</h1>" . "</center>");


echo("<br />");
echo("<hr class='line'>");
echo("<br />");
echo("<br />");


echo("<div class='container'>");

if($allactu != NULL) 
{
    echo("<table class='table table-bordered tableau'>");
    echo("<thead>");
    echo("<tr>");
    echo("<th scope='col'> Titre </th>");
    echo("<th scope='col'> Description </th>");
    echo("<th scope='col'> Date </th>");
    echo("<th scope='col'> Posté par </th>");
    echo("</tr>");
    echo("</thead>");

    echo("<tbody>");
    
    foreach($allactu as $acti)
    {
        echo("<tr>");
        	echo("<td>".$acti["act_titre"]."</td>");
            if($acti["act_desc"] == NULL)
            {
                echo("<td>"."<center>" ."NULL". "</center>" ."</td>");
            }
            else
            {
                echo("<td>".$acti["act_desc"]."</td>");
            }
        	echo("<td>".$acti["act_date"]."</td>");
        	echo("<td>".$acti["cpt_pseudo"]."</td>");
        echo("</tr>");
    }
    echo("</tbody>");
    echo("</table>");
}
else
{
    echo "<br />";
    echo("<center >" . "<p class='error_actu'>" . "Aucune actualité pour l'instant !" . "</p>" . "</center>");
}

echo("<br />");
echo("<br />");
echo("<br />");

echo("</div>");


echo("<center>" . "<h1>" . $titreMatch . "</h1>" . "</center>");

echo("<br />");
echo("<hr class='line'>");
echo("<br />");
echo("<br />");

echo("<center>" ."<p class='desc'>" . "Rejoindre un match (Code du match requis !)" . "<p>" . "</center>");

echo("<br />");
echo("<br />");

if(isset($nbMtc))            // isset() vérifie si c'est NULL ou pas
{
    if($nbMtc == 0)
    {
        echo("<center>" . "<p class='error_actu'>" . "Aucun match pour l'instant !" . "</p>" . "</center>");
        echo("<br />");
        echo("<br />");
        echo("<br />");
    }
}




?>
