<?php

if($this->session->userdata('role') != 'A'){
	redirect(base_url()."index.php/compte/connecter");
}

?>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

            <center><u><h1>ESPACE D'ADMINISTRATION</h1></u></center>

            <br>
            <br>
            <br>
            <br>
<?php
    echo("<center>". "<h3>" . "Bienvenue sur votre espace de gestion : " . $this->session->userdata('pseudo') . "</h3>" . "</center>");
?>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

