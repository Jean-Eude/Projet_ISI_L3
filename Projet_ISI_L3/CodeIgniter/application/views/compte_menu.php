<?php




if($this->session->userdata('role') != 'A'){
	redirect(base_url()."index.php/compte/connecter");
}
else {
	echo $this->session->userdata('pseudo');
}


?>


