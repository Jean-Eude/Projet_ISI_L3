<?php echo form_open('cpt_connecter'); ?>

    <br>
    <br>
    <br>
    <center> <h2> <u> Connexion à l'espace de gestion </u> </h2> </center>
    <br>
    <br>
    <br>
    <br>
    <center> <input  class="form-control col-sm-2" type="input" name="pseudo" placeholder="Login" /> <br/></center>
    <center> <input  class="form-control col-sm-2" type="password" name="mdp" placeholder="Mot de passe"/> <br/> </center>
        <br>
    <center> <input  class="btn btn-primary bg-dark" type="submit" name="submit" value="Se connecter" /> </center>
    <br>
    <br>
    <br>
    <br>
    <br>


<?php if (validation_errors()){
    echo("<center>");
    echo "<div class='alert alert-danger col-4'>" . "<center>" . "</center>";
    echo ("<center>" . "<b>"  . validation_errors() . "</b>" . "</center>");
    echo '</div>';   
    echo("</center>");                              
}
?>
