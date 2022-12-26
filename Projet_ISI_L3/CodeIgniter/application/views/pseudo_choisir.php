<?php echo form_open('pseudo_choisir') ?>

<?php 
    $code =  htmlspecialchars(addslashes($this->input->post('codemtc')));   

    echo("<br>");
    echo("<center>" . "<h4>" . "<label for='mdp'>" . " Pseudo du joueur " . "</label>" . "</h4>" . "</center>");
    echo("<br>");
    echo("<center>" . "<input  class='form-control col-sm-2' type='input' name='pseudojor' />" . "<br />" . "</center>");
    echo("<input type='hidden' name='codemtc' value='$code' />" . "<br />");
    echo("<center>" . "<input class='btn btn-primary bg-dark' type='submit' name='submit' value='Commencer le match !' />" . "</center>");
    echo("</form>");
    echo("<br>");
    echo("<br>");
    echo("<br>");

?>

<?php if (validation_errors()){
    echo("<center>");
    echo "<div class='alert alert-danger col-4'>" . "<center>" . "</center>";
    echo ("<center>" . "<b>"  . validation_errors() . "</b>" . "</center>");
    echo '</div>';   
    echo("</center>");                              
}