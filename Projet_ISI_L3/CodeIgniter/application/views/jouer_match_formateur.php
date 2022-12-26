<?php

if($this->session->userdata('role') != 'F'){
	redirect(base_url()."index.php/compte/connecter");
}
else {

echo("<br>");
echo("<br>");
echo("<br>");
echo("<br>");

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
    echo ("<center>" . "<h4>" . "Intitule du quiz : " . $qr[0]['qiz_intitule'] . "<h4>" . "</center>");
    echo("<br />");
    echo ("<center>" . "<h3>" . "Intitule du match : " . $qr[0]['mtc_intitule'] . "<h3>" . "</center>");
    echo("<br />");
}
else 
{
    echo ("<center>" . "<h4>" . "Pas d'intitule du match et/ou du quiz pour le match en question !" . "<h4>" . "</center>");
}

if($qr[0]['mtc_datefin'] == NULL)
{
    echo ("<center>" . "<h3>" . "Date de début du match : " . $qr[0]['mtc_datedeb'] . " " . " / " . " " . "Date de fin du match : " . "NULL" . "<h3>" . "</center>");
}
else
{
    echo ("<center>" . "<h3>" . "Date de début du match : " . $qr[0]['mtc_datedeb'] . " " . " / " . " " . "Date de fin du match : " . $qr[0]['mtc_datefin'] . "<h3>" . "</center>");
}


echo "<br />";
echo "<br />";


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
                    echo("<center>" . "<p class='rps_design'>" . chr($cptrps) . "." . " " . $act["rps_labelle"] . "<p>" . "</center>");

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


$Corr = site_url('match/terminer/'.$match->mtc_code);

echo("<input type='hidden' name='codemtc' value='$match->mtc_code' />" . "<br />");
echo("<center>" . "<a href=$Corr>" . "<input class='btn btn-primary bg-dark' type='submit' name='submit' value='Terminer le match !' />" . "</a>" . "</center>");

echo "<br />";
echo "<br />";
}
?>
       