<?php

if($this->session->userdata('role') != 'F'){
    redirect(base_url()."index.php/compte/connecter");
}
else {

echo("<br />");
echo("<br />");
echo("<br />");
echo("<br />");

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


if($qr != NULL)          
{
    echo ("<center>" . "<h3>" . "Intitule du quiz : " . $qr[0]['qiz_intitule'] . "<h3>" . "</center>");
    echo("<br />");
    echo ("<center>" . "<h4>" . "Intitule du match : " . $qr[0]['mtc_intitule'] . "<h4>" . "</center>");
}
else 
{
    echo ("<center>" . "<h4>" . "Pas d'intitule du match et/ou du quiz pour le match en question !" . "<h4>" . "</center>");
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
                    if($act['rps_bonnerep'] == 'B')
                    {
                        echo("<center>" . "<p class='rps_design_true'>" . chr($cptrps) . "." . " " . $act["rps_labelle"] .  "</p>" . "</center>");
                    }
                    else
                    {
                        echo("<center>" . "<p class='rps_design_false'>" . chr($cptrps) . "." . " " . $act["rps_labelle"] . "</p>" . "</center>");
                    }
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
echo "<br />";

echo("<center>" . "<h2>" . "<u>" . "Scores des joueurs" . "</h2>" . "</u>" . "</center>");

echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";


echo("<div class='container'>");
if($js != NULL) 
{
echo("<table class='table table-bordered tableau'>");
echo("<thead>");
echo("<tr>");
echo("<th scope='col'> Pseudo </th>");
echo("<th scope='col'> Score </th>");
echo("</tr>");
echo("</thead>");

echo("<tbody>");


foreach($js as $jorScore)
{
    echo("<tr>");
        echo("<td>".$jorScore["jor_pseudo"]."</td>");
        echo("<td>".$jorScore["jor_score"]."</td>");
    echo("</tr>");
}
echo("</tbody>");
echo("</table>");
}
echo("</div>");


echo "<br />";
echo "<br />";
echo "<br />";


echo("<center>" . "<h4>"  . "Taux de réussite global : " . $fs->ScoreM . "%" . "</h4>"  . "</center>");


echo("<br>");
echo("<br>");
echo("<br>");
echo("<br>");
    }
?>