
<br>
<br>
<br>

<br>


<?php



echo("<center>". "<u>" ."<h1>" . "Résultats" . "</h1>" . "</u>" . "</center>");

echo("<br>");
echo("<br>");
echo("<br>");

echo("<center>"."<h2>" . "Vous avez réussi " . $SI . "/" . $nbQ->nbQst . " " . "réponses !" . "</h2>" . "</center>");
echo("<br>");

echo("<br>");
echo("<br>");
echo("<center>" . "<h3>" . "Votre taux de réussite est de " . $SF . "%" . "</h3>" . "</center>");
echo("<br>");
echo("<br>");
echo("<br>");
echo("<br>");


if($corr->Active == 'A')
{
	echo form_open('joueur_resultat');
	$site = site_url('joueur/corriger');
	$accueil = site_url('accueil/afficher');
    echo("<input type='hidden' name='codemtc' value='$codep' />" . "<br />");

	echo("<center>"."<a href='$site'>" . "<input  class='btn btn-primary bg-dark' type='submit' name='submit' value='Voir le corrigé' />" . "</a>" . "</center>");
	echo form_close();
	echo("<br>");
	echo("<br>");
	echo("<center>"."<a href='$accueil'>" . "<input  class='btn btn-primary bg-dark' type='submit' name='submit' value='Accueil' />" . "</a>" . "</center>");
}
else
{
	$accueil = site_url('accueil/afficher');

	echo("<center>"."<a href='$accueil'>" . "<input  class='btn btn-primary bg-dark' type='submit' name='submit' value='Accueil'/>" . "</a>" . "</center>");
}

echo("<br>");
echo("<br>");



?>


