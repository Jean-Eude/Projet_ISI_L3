<?php

if($this->session->userdata('role') != 'F'){
	redirect(base_url()."index.php/compte/connecter");
}

?>

<?php echo form_open('match_creer');?>


    <br>
    <br>
    <br>

    <br>
    <br>
    <br>
    <center> <h2> <u> Création d'un nouveau match </u> </h2> </center>
    <br>
    <br>
    <br>
    <br>
    <center> <input  class="form-control col-sm-2" type="input" name="intitule" placeholder="Intitulté du match" /> <br/></center>

<?php
    echo("<center>");
 	  echo("<div class='form-group col-3'>");
    echo("<select name='idquiz' class='form-control'>");
      foreach($quiz as $quizid)
    	{
        echo("<option value='".$quizid["qiz_id"]."'>".$quizid["qiz_intitule"]."</option>");
    	}
    echo("</select>");
  	echo("</div>");
    echo "<br />";
    echo "<br />";
  ?>


    <br>
    <center> <input  class="btn btn-primary bg-dark" type="submit" name="submit" value="Créer un Match" /> </center>
    <br>
    <br>



	<?php if (validation_errors())
  {
    echo("<center>");
    echo "<div class='alert alert-danger col-4'>" . "<center>" . "</center>";
    echo ("<center>" . "<b>"  . validation_errors() . "</b>" . "</center>");
    echo '</div>';   
    echo("</center>");                              
  }

?>