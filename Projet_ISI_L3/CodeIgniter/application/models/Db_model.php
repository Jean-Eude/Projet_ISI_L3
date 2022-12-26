<?php

////////////////////////////////////
// Nom du fichier : Db_model.php
// Auteur : E.COMBOT
// Date de création : Novembre 2022
// Version : V2.2
// ********************************
// Description :
//
// Fichier qui liste toutes les 
// requêtes nécessaires pour 
// à l'Application Serveur
// ********************************
// A noter :
// - Fonctions triées par catégories
////////////////////////////////////


class Db_model extends CI_Model {

	// ***************************** //
	// ******* Constructeur ******* //
	// *************************** //


	public function __construct()
	{
		$this->load->database();
	}


	// ************************************* //
	// ***** Gestion CRUD des actualités ***** //
	// *********************************** //

	// fonction qui récupère l'ensemble des actualités
	public function get_all_actualites()
	{
		$query = $this->db->query("SELECT * FROM T_ACTU_act JOIN T_COMPTE_cpt USING(pfl_id) ORDER BY act_date desc LIMIT 5;");    		// 
		return $query->result_array();
	}


	// ************************************ //
	// ***** Gestion CRUD des matchs ***** //
	// ********************************** //


	// fonction qui vérifie si un code existe
	public function CodeExist($mtcCode)
	{
		$query = $this->db->query("SELECT mtc_code FROM T_MATCH_mtc WHERE mtc_code IN (SELECT mtc_code FROM T_MATCH_mtc WHERE mtc_code = '".$mtcCode."');");
		return $query->row();
	}

	// fonction qui récupère tout les éléments d'un match
	public function AllElementsOfMtc($mtcCode)
	{
		$query = $this->db->query("SELECT qst_id, rps_id, qst_labelle, qst_ordre, qst_etat, rps_labelle, rps_bonnerep, qiz_id, qiz_intitule, mtc_intitule, mtc_datedeb, mtc_datefin, mtc_correction FROM T_REPONSE_rps JOIN T_QUESTION_qst USING(qst_id) JOIN T_QUIZ_qiz USING(qiz_id) JOIN T_MATCH_mtc USING(qiz_id) WHERE mtc_code = '".$mtcCode."';");
		return $query->result_array();
	}

	///////////////////////////////////////////////////////////////////


	// fonction qui vérifie si un code existe en post
	public function CodeExistPost()
	{
		$this->load->helper('url');
 		$codemtc=htmlspecialchars(addslashes($this->input->post('codemtc')));

 		$query = $this->db->query("SELECT mtc_code FROM T_MATCH_mtc WHERE mtc_code IN (SELECT mtc_code FROM T_MATCH_mtc WHERE mtc_code = '".$codemtc."');");
		return $query->row();
	}

	// fonction qui récupère tout les éléments d'un match en post
	public function AllElementsOfMtcPost()
	{
		$this->load->helper('url');
 		$codemtc=htmlspecialchars(addslashes($this->input->post('codemtc')));

		$query = $this->db->query("SELECT qst_id, rps_id, qst_labelle, qst_ordre, qst_etat, rps_labelle, rps_bonnerep, qiz_id, qiz_intitule, mtc_intitule, mtc_datedeb, mtc_datefin, mtc_correction FROM T_REPONSE_rps JOIN T_QUESTION_qst USING(qst_id) JOIN T_QUIZ_qiz USING(qiz_id) JOIN T_MATCH_mtc USING(qiz_id) WHERE mtc_code = '".$codemtc."';");
		return $query->result_array();
	}

	// fonction qui récupère tout les éléments d'un match
	public function get_MtcIntitPost()
	{
		$this->load->helper('url');
 		$codemtc=htmlspecialchars(addslashes($this->input->post('codemtc')));

		$query = $this->db->query("SELECT mtc_intitule FROM T_MATCH_mtc WHERE mtc_code = '".$codemtc."';");
		return $query->row();
	}

	// fonction qui vérifie qu'un match n'est pas désactivé
	public function VerifyIfMtcNotDPost()
	{
		$this->load->helper('url');
 		$codemtc=htmlspecialchars(addslashes($this->input->post('codemtc')));

		$query = $this->db->query("SELECT mtc_code FROM T_MATCH_mtc WHERE mtc_activation = 'D' AND mtc_code = '".$codemtc."';");
		return $query->row();
	}

	// fonction qui vérifie qu'un match n'est pas désactivé en post
	public function VerifyIfMtcNotStartedPost()
	{
		$this->load->helper('url');
 		$codemtc=htmlspecialchars(addslashes($this->input->post('codemtc')));

		$query = $this->db->query("SELECT mtc_code FROM T_MATCH_mtc WHERE NOW() < mtc_datedeb AND mtc_datefin is NULL AND mtc_code = '".$codemtc."';");
		return $query->row();
	}

	// fonction qui récupère l'id d'un match en post
	public function IdOfMtcFromCodePost()
	{
		$this->load->helper('url');
 		$codemtc=htmlspecialchars(addslashes($this->input->post('codemtc')));

		$query = $this->db->query("SELECT mtc_id FROM T_MATCH_mtc WHERE mtc_code = '".$codemtc."';");
		return $query->row();
	}

	// fonction qui MAJ la date de fin d'un match à NOW()
	public function UpdateAfterMtc($codemtc)
	{
		$this->load->helper('url');

		$query = $this->db->query("UPDATE T_MATCH_mtc SET mtc_datefin = NOW() WHERE mtc_code = '".$codemtc."';");
		return ($query);
	}

	// fonction qui MAJ la date de début et la date de fin (---> déclenchement du RAZ d'un match)
	public function UpdatebeforeRAZ($codemtc)
	{
		$this->load->helper('url');

		$query = $this->db->query("UPDATE T_MATCH_mtc SET mtc_datedeb = NOW() - 10, mtc_datefin = NOW()-5 WHERE mtc_code = '".$codemtc."';");
		return ($query);
	}

	public function UpdateforRAZ($codemtc)
	{
		$this->load->helper('url');

		$query = $this->db->query("UPDATE T_MATCH_mtc SET mtc_datedeb = NOW() + INTERVAL 1 DAY, mtc_datefin = NULL WHERE mtc_code = '".$codemtc."';");
		return ($query);
	}

	// fonction qui MAJ l'état d'un match
	public function UpdateforState($etat, $codemtc)
	{
		$this->load->helper('url');

		if($etat == 'A')
		{
			$query = $this->db->query("UPDATE T_MATCH_mtc SET mtc_activation = 'D' WHERE mtc_code = '".$codemtc."';");
		}
		else
		{
			$query = $this->db->query("UPDATE T_MATCH_mtc SET mtc_activation = 'A' WHERE mtc_code = '".$codemtc."';");
		}

		return ($query);
	}

	// fonction qui delete un match (avoir fait un raz d'abord)
	public function UpdateforDelete($codemtc)
	{
		$this->load->helper('url');

		$query = $this->db->query("DELETE FROM T_MATCH_mtc WHERE mtc_code = '".$codemtc."';");			
		return ($query);
	}

/*
	// fonction qui insère un nouveau match 
	public function CreateAMatch($intitule, $idquiz, $idpfl)
	{
		$this->load->helper('url');
		$this->load->helper('string');

		$randomString = random_string('alnum', 8);



		$query = $this->db->query("INSERT INTO T_MATCH_mtc VALUES(NULL, '".$intitule."', '".$randomString."', 'D', 'D', NOW(), NULL, $idpfl, $idquiz);");			
		return ($query);
	}
*/

	// fonction qui insère un nouveau match via la procédure
	public function CreateAMatchCALL($intitule, $idquiz, $idpfl)
	{
		$this->load->helper('url');
		$this->load->helper('string');

		$randomString = random_string('alnum', 8);

		$query = $this->db->query("Call CreateMtc('".$randomString."', 'D', 'D', $idpfl, $idquiz, '".$intitule."');");
	}

	///////////////////////////////////////////////////////////////////


	// fonction qui retourne le nombre total de matchs
	public function countNbMatch()
	{
		$this->db->from("T_MATCH_mtc");    		 			//  == count(*)     // 
		return $query = $this->db->count_all_results();	

		//$query = $this->db->query('SELECT * FROM T_MATCH_mtc');
		//return $query->num_rows();
	}

	// fonction qui retourne le match d'un formateur
	public function getMatchOfUser($username)
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT * FROM T_MATCH_mtc JOIN T_COMPTE_cpt USING(pfl_id) WHERE cpt_pseudo = '".$username."' AND mtc_activation = 'A' AND NOW() > mtc_datedeb AND mtc_datefin is NULL;");
		return $query->result_array();
	}

	// fonction qui retourne la lettre de correction d'un match
	public function getActivationOfMtc($code)
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT ActivationOfMtc('".$code."') as Active;");
		return $query->row();
	}


	// ************************************* //
	// ***** Gestion CRUD des joueurs ***** //
	// *********************************** //


	// fonction qui insère un joueur en post
	public function InsertJorPost($mtcid)
	{
		$this->load->helper('url');
 		$pseudojor=htmlspecialchars(addslashes($this->input->post('pseudojor')));

		$query = $this->db->query("INSERT INTO T_JOUEUR_jor VALUES(NULL, '".$pseudojor."', 0, '" .$mtcid."');");
		return ($query);
	}

	// fonction qui vérifie si le joueur existe en post
	public function VerifyIfJorExistPost()
	{
		$this->load->helper('url');
 		$codemtc=htmlspecialchars(addslashes($this->input->post('codemtc')));
 		$pseudojor=htmlspecialchars(addslashes($this->input->post('pseudojor')));

		$query = $this->db->query("SELECT jor_pseudo FROM T_JOUEUR_jor WHERE jor_pseudo IN (SELECT jor_pseudo FROM T_JOUEUR_jor JOIN T_MATCH_mtc USING(mtc_id) WHERE mtc_code = '".$codemtc."' AND jor_pseudo = '".$pseudojor."');");
		return $query->row();
	}

	// fonction qui retourne le score d'un joueur d'un match
	public function getFinalScoresByJor($code)
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT jor_pseudo, jor_score FROM T_JOUEUR_jor JOIN T_MATCH_mtc USING(mtc_id) WHERE mtc_code = '".$code."';");
		return $query->result_array();
	}

	// fonction qui retourne le score moyen d'un match
	public function getFinalScore($code)
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT ScoreMoyenOfaMtc('".$code."') as ScoreM;");
		return $query->row();
	}


	
	// ********************************** //
	// ***** Gestion CRUD des quiz ***** //
	// ******************************** //


	// fonction qui retourne l'intitulé d'un quiz en post
	public function get_QizIntitPost()
	{
		$this->load->helper('url');
 		$codemtc=htmlspecialchars(addslashes($this->input->post('codemtc')));

		$query = $this->db->query("SELECT qiz_intitule FROM T_QUIZ_qiz JOIN T_MATCH_mtc USING(qiz_id) WHERE mtc_code = '".$codemtc."';");
		return $query->row();
	}

	// fonction qui retourne si un quiz est désactivé ou non en post
	public function VerifyIfQizNotDPost()
	{
		$this->load->helper('url');
 		$codemtc=htmlspecialchars(addslashes($this->input->post('codemtc')));

		$query = $this->db->query("SELECT mtc_code FROM T_MATCH_mtc JOIN T_QUIZ_qiz USING(qiz_id) WHERE qiz_activation = 'D' AND mtc_code = '".$codemtc."';");
		return $query->row();
	}

	// fonction qui retourne si un quiz est désactivé ou non en post
	public function get_allquizmtc()
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT vw1.qiz_intitule, vw1.qiz_id, vw1.cpt_pseudo as pseudoqiz, vw2.mtc_intitule, vw2.cpt_pseudo as pseudomtc, vw2.mtc_code as codemtc, vw2.mtc_datedeb, vw2.mtc_datefin, vw2.mtc_activation FROM qizLink vw1, mtcLink vw2 WHERE vw1.qiz_id = vw2.qiz_id;");
		return $query->result_array();
	}

	// fonction qui retourne le, les matchs du formateur connecté
	public function getMtcOfUser($codemtc, $user)
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT * FROM mtcLink WHERE cpt_pseudo = '".$user."' AND mtc_activation = 'A' AND NOW() > mtc_datedeb AND mtc_datefin is NULL AND mtc_code = '".$codemtc."';");
		return $query->row();
	}

	// fonction qui retourne le match d'un formateur dont la date de fin != NULL
	public function getMatchOfUserNotNull($codemtc, $user)
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT * FROM mtcLink WHERE cpt_pseudo = '".$user."' AND mtc_datefin is not NULL AND mtc_code = '".$codemtc."';");
		return $query->row();
	}

	// fonction qui retourne le match d'un formateur
	public function getMtcOfUserALL($codemtc, $user)
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT * FROM T_MATCH_mtc JOIN T_COMPTE_cpt USING(pfl_id) WHERE cpt_pseudo = '".$user."' AND mtc_code = '".$codemtc."';");
		return $query->row();
	}

	// Retourne tous les quiz
	public function get_allquiz()
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT * FROM T_QUIZ_qiz;");
		return $query->result_array();
	}

	// Retourne tous les quiz
	public function VerifyQuiz($qizid)
	{
		$this->load->helper('url');

		$query = $this->db->query("SELECT qst_id FROM T_QUESTION_qst WHERE qiz_id = $qizid;");
		return $query->num_rows();
	}

	// ************************************* //
	// ***** Gestion CRUD des comptes ***** //
	// *********************************** //


	// fonction qui vérifie l'association login/mdp et statut actif == (calcul l'empreinte du mdp en sha256)
	public function VerifyCpt($username, $mdp)
	{
		$this->load->helper('url');
		
		$salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
		$password = $salt.$mdp;


		$query = $this->db->query("SELECT * FROM T_PROFIL_pfl JOIN T_COMPTE_cpt USING(pfl_id) WHERE cpt_pseudo = '".$username."' and cpt_mdp = SHA2('".$password."', 256) and pfl_etat = 'A';");

		return $query->row();
	}	

	// fonction qui retourne les informations d'un profil  return ->row()
	public function getCptInfos($username)
	{
		$this->load->helper('url');
		
		$query = $this->db->query("SELECT * FROM T_PROFIL_pfl JOIN T_COMPTE_cpt USING(pfl_id) WHERE cpt_pseudo = '".$username."';");

		return $query->row();
	}	


	// ************************************* //
	// ***** Gestion CRUD des profils ***** //
	// *********************************** //


	// fonction qui retourne les infos informations d'un profil  return ->result_array()
	public function getPflInfos($username)
	{
		$this->load->helper('url');
		
		$query = $this->db->query("SELECT * FROM T_PROFIL_pfl JOIN T_COMPTE_cpt USING(pfl_id) WHERE cpt_pseudo = '".$username."';");

		return $query->result_array();
	}

	// fonction qui retourne les infos informations d'un profil  return ->result_array()
	public function getidofUser($username)
	{
		$this->load->helper('url');
		
		$query = $this->db->query("SELECT pfl_id FROM T_PROFIL_pfl JOIN T_COMPTE_cpt USING(pfl_id) WHERE cpt_pseudo = '".$username."';");

		return $query->row();
	}	
	

	// fonction qui récupère toutes les informations de tous les profils
	public function getPflInfosALL()
	{
		$this->load->helper('url');
		
		$query = $this->db->query("SELECT * FROM T_PROFIL_pfl JOIN T_COMPTE_cpt USING(pfl_id)");

		return $query->result_array();
	}	

	// fonction qui met à jour le mot de passe d'un compte
	public function updateCptMDP($username, $password)
	{
		$this->load->helper('url');

		$query = $this->db->query("UPDATE T_COMPTE_cpt SET cpt_mdp = '".$password."' WHERE cpt_pseudo = '".$username."';");

		return ($query);
	}	


	// ************************************** //
	// ***** Gestion CRUD des réponses ***** //
	// ************************************ //


	// fonction qui sélectionne la bonne réponse
	public function getgoodrps($codemtc)
	{
		$this->load->helper('url');
		
		$query = $this->db->query("SELECT rps_labelle FROM T_REPONSE_rps JOIN T_QUESTION_qst USING(qst_id) JOIN T_QUIZ_qiz USING(qiz_id) JOIN T_MATCH_mtc USING(qiz_id) WHERE rps_bonnerep = 'B' AND mtc_code = '".$codemtc."';");

		return $query->result_array();
	}	

	// fonction qui récupère le nombre de questions d'un match
	public function getnumberqstmtc($code)
	{
		$this->load->helper('url');
		
		$query = $this->db->query("SELECT COUNT(qst_id) as nbQst  FROM T_QUESTION_qst JOIN T_QUIZ_qiz USING(qiz_id) JOIN T_MATCH_mtc USING(qiz_id) WHERE mtc_code = '".$code."';");

		return $query->row();
	}	

	// fonction qui ajoute + 1 au score du joueur
	public function updateScore($pseudojor, $score)
	{
		$this->load->helper('url');
		
		$query = $this->db->query("UPDATE T_JOUEUR_jor SET jor_score = $score WHERE jor_pseudo = '".$pseudojor."';");

		return ($query);
	}	
}

?>