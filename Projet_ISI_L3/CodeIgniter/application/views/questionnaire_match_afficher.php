<?php
if(isset($match))           // isset() vérifie si c'est NULL ou pas
{
    echo("<center>" . "<h2>" . "Code du match : " . "<u>" . $match->mtc_code . "</u>" . "<h2>" . "</center>");
}
else 
{
    echo ("<center>" . "<h2>" . "Code de match non existant, veuillez saisir le code fourni par votre formateur !" . "<h2>" . "</center>");
}


// Pour récupérer la valeur d'un post : $this->input->post('codemtc');
echo("<br />");
echo("<br />");
echo("<br />");
echo("<br />");


if($qr != NULL)           // isset() vérifie si c'est NULL ou pas
{
    echo ("<center>" . "<h3>" . "Intitule du quiz : " . $qr[0]['qiz_intitule'] . "<h3>" . "</center>");
    echo("<br />");
    echo ("<center>" . "<h4>" . "Intitule du match : " . $qr[0]['mtc_intitule'] . "<h4>" . "</center>");
}
else 
{
    echo ("<center>" . "<h4>" . "Pas d'intitule du match et/ou du quiz pour le match en question !" . "<h4>" . "</center>");
}

echo("<br />");
if($qr[0]['mtc_datefin'] != NULL)
{
    echo ("<center>" . "<h4>" . "Date de début : " . $qr[0]['mtc_datedeb'] . " / " . "Date de fin : " . $qr[0]['mtc_datefin'] . "<h4>" . "</center>");
}
else
{
    echo ("<center>" . "<h4>" . "Date de début : " . $qr[0]['mtc_datedeb'] . " / " . "Date de fin : " . "NULL" . "<h4>" . "</center>");
}

echo "<br />";
echo "<br />";

echo ("<center>" . "<h4 class='rps_design_false'>" . "Valider question par question / 1 seule réponse par question possible" . "<h4>" . "</center>");



echo "<br />";
echo "<br />";


echo form_open('joueur_jouer');

$rpsG=0;
$cptqst=1;
$cptrps=833;


if($qr != NULL) 
{
    foreach($qr as $a)
    {
        if (!isset($traite[$a["qst_id"]]))
        {
            $mtci=$a["qst_id"];
            
            echo("<br>");
            echo("<br>");
            echo("<center>" . "<b class='qst_design'>" . $cptqst . "." . " " . $a["qst_labelle"] . "</b>" . "</center>");     
            echo("<br>");

            foreach($qr as $act)
            {
                if(strcmp($mtci,$act["qst_id"])==0)
                {
                    echo("<br>");
              
                    echo("<center>" . "<p class='rps_design'>" .  "<input class='form-check-input' type='radio' name='$cptqst' value='".$act["rps_labelle"]."'>" . " " . " " . chr($cptrps) . "." . " " . $act["rps_labelle"] . "<p>" . "</center>");


                    $cptrps++;
                }
            }

            $traite[$a["qst_id"]]=1;

            $cptrps=833;
            $cptqst++;
        }
    }
}


echo "<br />";
echo "<br />";


echo("<input type='hidden' name='psdo' value='$pseudojor' />" . "<br />");
echo("<input type='hidden' name='codemtc' value='$match->mtc_code' />" . "<br />");
echo("<center>"."<input class='btn btn-primary bg-dark' type='submit' name='submit' value='Valider !'/>"."</center>");

echo form_close();

echo "<br />";
echo "<br />";

if (validation_errors()){
    echo("<center>");
    echo "<div class='alert alert-danger col-4'>" . "<center>" . "</center>";
    echo ("<center>" . "<b>"  . validation_errors() . "</b>" . "</center>");
    echo '</div>';   
    echo("</center>"); 
}

?>

