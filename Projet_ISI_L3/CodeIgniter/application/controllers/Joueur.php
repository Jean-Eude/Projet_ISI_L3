<?php


////////////////////////////////////
// Nom du fichier : Joueur.php
// Auteur : E.COMBOT
// Date de création : Novembre 2022
// Version : V2.2
// ********************************
// Description :
//
// Fichier qui liste toutes les 
// fonctions relatives aux joueurs 
// de l'application serveur
// ********************************
// A noter :
//
// - Fonction qui permet de choisir 
// le pseudo d'un joueur pour un  
// match particulier
////////////////////////////////////


defined('BASEPATH') OR exit('No direct script access allowed');

class Joueur extends CI_Controller {


    // **************************** //
    // ******* Constructeur ****** //
    // ********* Joueur ********* //
    // ************************* //


    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url');
    }


    // *********************************** //
    // ******* Fonction choisir() ******* //
    // ********************************* //

    
    public function choisir()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pseudojor', 'pseudojor', 'required|alpha_numeric', array('required' => 'Veuillez saisir un pseudo !'));
        $this->form_validation->set_message('alpha_numeric', 'Le pseudo que vous venez d\'entrer contient des caractères spéciaux');

        if ($this->form_validation->run() == FALSE)   // Si quelque chose est entrer dans le formulaire
        {
            $data['code'] = htmlspecialchars(addslashes($this->input->post('codemtc')));

            $this->load->view('templates/haut');
            $this->load->view('menu_visiteurs_general');
            $this->load->view('pseudo_choisir.php', $data);
            $this->load->view('templates/bas');
        }
        else
        {   
            if($this->db_model->VerifyIfJorExistPost() == NULL) 
            {
                $data['match'] = $this->db_model->CodeExistPost();
                $data['qr'] = $this->db_model->AllElementsOfMtcPost();


                // id du match pour insertion d'un joueur 

                $mtcid = $this->db_model->IdOfMtcFromCodePost();
                $this->db_model->InsertJorPost($mtcid->mtc_id);
                $data['pseudojor'] = htmlspecialchars(addslashes(htmlspecialchars(addslashes($this->input->post('pseudojor')))));

                $this->load->view('templates/haut');
                $this->load->view('menu_visiteurs_general');
                $this->load->view('questionnaire_match_afficher', $data);            
                $this->load->view('templates/bas');
            }
            else
            {
                $data['code'] = $this->input->get('codemtc');

                if($this->db_model->VerifyIfJorExistPost() != NULL)
                {
                    $data['erreur'] = 'Pseudo déjà utilisé !';
                }

                $this->load->view('templates/haut');
                $this->load->view('menu_visiteurs_general');
                $this->load->view('pseudo_choisir', $data);          
                $this->load->view('erreur_formulaire_pseudo', $data);    
                $this->load->view('templates/bas');
            }
        }
    }


    public function jouer()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');


        $code = htmlspecialchars(addslashes($this->input->post('codemtc')));
        $pseu = htmlspecialchars(addslashes($this->input->post('psdo')));

       
        $nbQst = $this->db_model->getnumberqstmtc($code);
        $score = 0.0;
        $i = 1;

        
        $repV = $this->db_model->getgoodrps($code);

        foreach ($repV as $rep1) {
            $rep = htmlspecialchars(addslashes($this->input->post($i)));
            if($rep1['rps_labelle']==$rep)
            {
                $score++;
            }

            $i++;
        }

        $scoreFinal = ($score/$nbQst->nbQst) * 100;
        $this->db_model->updateScore($pseu, $score);


        $data['SI'] = $score;
        $data['SF'] = $scoreFinal;
        $data['nbQ'] = $nbQst;
        $data['corr'] = $this->db_model->getActivationOfMtc($code);
        $data['codep'] = $code;


        $this->load->view('templates/haut');
        $this->load->view('menu_visiteurs_general');
        $this->load->view('score_joueurs', $data);          
        $this->load->view('templates/bas');
    }


    public function corriger()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');


        $code = htmlspecialchars(addslashes($this->input->post('codemtc')));


        $data['match'] = $this->db_model->CodeExist($code);
        $data['qr'] = $this->db_model->AllElementsOfMtc($code);

        $this->load->view('templates/haut');
        $this->load->view('menu_visiteurs_general');
        $this->load->view('resultat_matchs_joueur', $data);            
        $this->load->view('templates/bas');
    }

}
?>