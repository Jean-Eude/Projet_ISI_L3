<?php

if($this->session->userdata('role') != 'F'){
	redirect(base_url()."index.php/compte/connecter");
}
else {

	echo("<br>");
	echo("<br>");

	echo("<center>"."<u>"."<h2>"."Donneés de votre profil"."</h2>"."</u>"."<center>");


	echo("<br>");
	echo("<br>");
	echo("<br>");
	echo("<br>");


echo("<div class='container'>");
	if($infos != NULL) 
	{
    echo("<table class='table table-bordered tableau'>");
    echo("<thead>");
    echo("<tr>");
    echo("<th scope='col'> Pseudo </th>");
    echo("<th scope='col'> Prénom </th>");
    echo("<th scope='col'> Nom </th>");
    echo("<th scope='col'> Email </th>");
    echo("<th scope='col'> Date de création </th>");
    echo("<th scope='col'> Date de naissance </th>");
    echo("<th scope='col'> Rôle </th>");
    echo("<th scope='col'> Etat </th>");
    echo("</tr>");
    echo("</thead>");

    echo("<tbody>");
    
    foreach($infos as $infosA)
    {
        echo("<tr>");
        	echo("<td>".$infosA["cpt_pseudo"]."</td>");
        	echo("<td>".$infosA["pfl_prenom"]."</td>");
        	echo("<td>".$infosA["pfl_nom"]."</td>");
        	echo("<td>".$infosA["pfl_email"]."</td>");
        	echo("<td>".$infosA["pfl_datecrea"]."</td>");
        	echo("<td>".$infosA["pfl_datenaiss"]."</td>");
        	if($infosA["pfl_role"] == 'A')
        	{
        		echo("<td>"."Administrateur"."</td>");
        	}
        	if($infosA["pfl_role"] == 'F')
        	{
        		echo("<td>"."Formateur"."</td>");
        	}
        	if($infosA["pfl_etat"] == 'A')
        	{
        		echo("<td>"."Activé"."</td>");
        	}
        	if($infosA["pfl_etat"] == 'D')
        	{
        		echo("<td>"."Désactivé"."</td>");
        	}
        echo("</tr>");
    }
    echo("</tbody>");
    echo("</table>");
	}
	echo("</div>");

	echo("<br>");
	echo("<br>");
	echo("<br>");
	echo("<br>");
}
?>



 <a href="<?php echo site_url('formateur/modifier')?>"><input  class="btn btn-primary bg-dark"  type="submit" name="submit" value="Modifier" /></a>


 <br>
 <br>
 <br>
 <br>