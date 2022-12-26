<?php echo form_open('mtc_choisir'); ?>


    <center> <h4> <label for="mdp"> Code du Match </label> </h4> </center>
    <br>
    <center> <input  class="form-control col-sm-2" type="input" name="codemtc" /> <br/> </center>
    <center> <input  class="btn btn-primary bg-dark" type="submit" name="submit" value="Participer au match !" /> </center>

    <br>

</form>


<?php if (validation_errors()){
    echo("<center>");
    echo "<div class='alert alert-danger col-4'>" . "<center>" . "</center>";
    echo ("<center>" . "<b>"  . validation_errors() . "</b>" . "</center>");
    echo '</div>';   
    echo("</center>");                              
}
?>

