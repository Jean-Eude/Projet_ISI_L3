<?php


    echo("<br>");
    echo("<br>");
    echo("<br>");
    echo("<br>");
    echo("<br>");
    echo("<br>");

    echo("<center>"."<u>"."<h2>"."Donneés de l'ensemble des profils"."</h2>"."</u>"."<center>");


    echo("<br>");
    echo("<br>");
    echo("<br>");
    echo("<br>");


    echo("<div class='container'>");
        if($infosP != NULL) 
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
        
        foreach($infosP as $infosAll)
        {
            echo("<tr>");
                echo("<td>".$infosAll["cpt_pseudo"]."</td>");
                echo("<td>".$infosAll["pfl_prenom"]."</td>");
                echo("<td>".$infosAll["pfl_nom"]."</td>");
                echo("<td>".$infosAll["pfl_email"]."</td>");
                echo("<td>".$infosAll["pfl_datecrea"]."</td>");
                echo("<td>".$infosAll["pfl_datenaiss"]."</td>");
                if($infosAll["pfl_role"] == 'A')
                {
                    echo("<td>"."Administrateur"."</td>");
                }
                if($infosAll["pfl_role"] == 'F')
                {
                    echo("<td>"."Formateur"."</td>");
                }
                if($infosAll["pfl_etat"] == 'A')
                {
                    echo("<td>"."Activé"."</td>");
                }
                if($infosAll["pfl_etat"] == 'D')
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
    
?>