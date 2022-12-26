<?php

if($this->session->userdata('role') != 'F'){
	redirect(base_url()."index.php/compte/connecter");
}
else {

echo("<br>");
echo("<br>");
echo("<br>");
echo("<br>");


echo("<center>"."<u>"."<h1>"."Gestion des matchs"."</h1>"."</u>"."</center>");

echo("<br>");
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
        echo("<th scope='col'> Intitule du quiz </th>");
        echo("<th scope='col'> Auteur du quiz </th>");
        echo("<th scope='col'> Intitulé du match / Auteur / Code du match / Dates de début et de fin </th>");
        echo("<th scope='col'> Etat du match </th>");
        echo("<th scope='col'> RAZ du match </th>");
        echo("<th scope='col'> Suppression du match </th>");
        echo("<th scope='col'> Activation / Désactivation </th>");

        echo("</tr>");
        echo("</thead>");

        echo("<tbody>");

        
        
        foreach($infosP as $infosAll)
        {
          echo("<tr>");


         
            if($infosAll["qiz_intitule"] == NULL)
            {
              echo("<td>"."Pas d'intitulé de quiz !"."</td>");
            }
            else if($this->db_model->VerifyQuiz($infosAll["qiz_id"]) == 0)
            {
              echo("<td>"."Quiz incomplet !"."</td>");
            }
            else
            {
              echo("<td>".$infosAll["qiz_intitule"]."</td>");
            }

            if($infosAll["qiz_intitule"] == NULL)
            {
              echo("<td>"."Le quiz n'a pas de créateur !"."</td>");
            }
            else if($this->db_model->VerifyQuiz($infosAll["qiz_id"]) == 0)
            {
              echo("<td>"."Quiz incomplet !"."</td>");
            }
            else
            {
              echo("<td>".$infosAll["pseudoqiz"]."</td>");
            }


            $site = site_url('match/generer/'.$infosAll["codemtc"]);
            $corrige = site_url('match/corriger/'.$infosAll["codemtc"]);

            if($this->db_model->getMtcOfUser($infosAll["codemtc"], $this->session->userdata('pseudo')) != NULL)
            {
              if($infosAll["mtc_datefin"] == NULL)
              {
                echo("<td>".$infosAll["mtc_intitule"]. " / ". $infosAll["pseudomtc"] . " / " . "<a href = $site>" . $infosAll["codemtc"]. "</a>" . " / " . "Date de début : " . $infosAll["mtc_datedeb"] . " / " . "Date de fin : " . "NULL" . "</td>"); 
              }
              else
              {
                echo("<td>".$infosAll["mtc_intitule"]. " / ". $infosAll["pseudomtc"] . " / " . "<a href = $site>" . $infosAll["codemtc"]. "</a>" . " / " . "Date de début : " . $infosAll["mtc_datedeb"] . " / " . "Date de fin : " . $infosAll["mtc_datefin"] . "</td>"); 
              }
            }
            else if($this->db_model->getMatchOfUserNotNull($infosAll["codemtc"], $this->session->userdata('pseudo')) != NULL)
            {
              if($infosAll["mtc_datefin"] == NULL)
              {
                echo("<td>".$infosAll["mtc_intitule"]. " / ". $infosAll["pseudomtc"] . " / " . "<a href = $corrige>" . $infosAll["codemtc"]. "</a>" . " / " . "Date de début : " . $infosAll["mtc_datedeb"] . " / " . "Date de fin : " . "NULL" . "</td>"); 
              }
              else
              {
                echo("<td>".$infosAll["mtc_intitule"]. " / ". $infosAll["pseudomtc"] . " / " . "<a href = $corrige>" . $infosAll["codemtc"]. "</a>" . " / " . "Date de début : " . $infosAll["mtc_datedeb"] . " / " . "Date de fin : " . $infosAll["mtc_datefin"] . "</td>"); 
              }
            }
            else
            {
              if($infosAll["mtc_datefin"] == NULL)
              {
                echo("<td>".$infosAll["mtc_intitule"]. " / ". $infosAll["pseudomtc"] . " / " .  $infosAll["codemtc"] . " / " . "Date de début : " . $infosAll["mtc_datedeb"] . " / " . "Date de fin : " . "NULL" . "</td>"); 
              }
              else
              {
                echo("<td>".$infosAll["mtc_intitule"]. " / ". $infosAll["pseudomtc"] . " / " .  $infosAll["codemtc"] . " / " . "Date de début : " . $infosAll["mtc_datedeb"] . " / " . "Date de fin : " . $infosAll["mtc_datefin"] . "</td>"); 
              }

            }

            echo("<td>".$infosAll["mtc_activation"]."</td>");


            if($this->db_model->getMtcOfUserALL($infosAll["codemtc"], $this->session->userdata('pseudo')) != NULL)
            {

            $RAZ = site_url('match/reinitialiser/'.$infosAll["codemtc"]);
            $SUPPR = site_url('match/supprimer/'.$infosAll["codemtc"]);
            $ETAT = site_url('match/activer/'.$infosAll["codemtc"].'/'.$infosAll["mtc_activation"]);

            echo("<td>" . "<a href=$RAZ>" . "<input class='btn btn-primary bg-dark' type='submit' name='submit' value='RAZ' />" . "</a>" . "</td>");
            echo("<td>" . "<a href=$SUPPR>" . "<input class='btn btn-primary bg-dark' type='submit' name='submit' value='Suppression' />" . "</a>" . "</td>");
            echo("<td>" . "<a href=$ETAT>" . "<input class='btn btn-primary bg-dark' type='submit' name='submit' value='Activation / Désactivation' />" . "</a>" . "</td>");
            }
            else
            {
              echo("<td>" ."Remise à zéro impossible, ce n'est pas votre match !" . "</td>");
              echo("<td>" ."Suppression impossible, ce n'est pas votre match !" . "</td>");
              echo("<td>" ."Activation / Désactivation impossible, ce n'est pas votre match !" . "</td>");
            }



 


          echo("</tr>");
        }
        echo("</tbody>");
        echo("</table>");
        }
        echo("</div>");


        echo("<br>");
        echo("<br>");

        $back = site_url('match/creer');
        echo("<center>" . "<a href='$back'>" . "<input class='btn btn-primary bg-dark' type='submit' name='submit' value='Créer un match !' />" . "</a>" . "</center>"); 


        echo("<br>");
        echo("<br>");
}

?>








