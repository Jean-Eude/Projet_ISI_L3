<?php

if($this->session->userdata('role') != 'F'){
	redirect(base_url()."index.php/compte/connecter");
}
else
{
	echo form_open('forma_modifier'); 

    echo("<br>");
    echo("<br>");
    echo("<br>");
    echo("<br>");
    echo("<br>");
    echo("<center>"."<h2>"."<u>"."Modification des données du profil"."</u>"."</h2>"."</center>");
    echo("<br>");
    echo("<br>");
    echo("<br>");
    echo("<br>");


    echo("<center>"."<input  class='form-control col-sm-2' type='input' name='nom' placeholder='Nom' value='".$infos->pfl_nom."' />"."<br/>"."</center>");
    echo("<center>"."<input  class='form-control col-sm-2' type='input' name='prenom' placeholder='Prénom'value='".$infos->pfl_prenom."' />"."<br/>"."</center>");


    echo("<center>"."<input  class='form-control col-sm-2' type='input' name='mdp' placeholder='Mot de passe'/>"."<br/>"."</center>");
    echo("<center>"."<input  class='form-control col-sm-2' type='password' name='cfmdp' placeholder='Confirmation du mot de passe'/>"."<br/>"."</center>"); 

    echo("<br>");

    $site = site_url('formateur/afficher');


    echo("<center>"."<input class='btn btn-primary bg-dark' type='submit' name='submitOK' value='Valider'/>"."</center>"); 
    echo("<center>". "<a href= '".$site."'>"."<input class='btn btn-primary bg-dark' type='button' name='submit' value='Annuler' />"."</a>"."</center>");


    echo("<br>");
    echo("<br>");
    echo("<br>");
    echo("<br>");
    echo("<br>");


	if (validation_errors())
	{
    	echo("<center>");
    	echo "<div class='alert alert-danger col-4'>" . "<center>" . "</center>";
    	echo ("<center>" . "<b>"  . validation_errors() . "</b>" . "</center>");
    	echo '</div>';   
    	echo("</center>");                              
	}
}
