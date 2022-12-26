<?php


////////////////////////////////////
// Nom du fichier : Accueil.php
// Auteur : E.COMBOT
// Date de création : Novembre 2022
// Version : V2.2
// ********************************
// Description :
//
// Fichier qui liste toutes les 
// fonctions relatives à l'accueil 
// de l'application serveur
// ********************************
// A noter :
//
////////////////////////////////////



defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller {


    // **************************** //
    // ******* Constructeur ****** //
    // ********* Accueil ******** //
    // ************************* //


    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url');
    }


    // ************************************ //
    // ******* Fonction afficher() ******* //
    // ********************************** //

    
    public function afficher()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('codemtc', 'codemtc', 'required', array('required' => 'Veuillez saisir un code de match !'));


        if ($this->form_validation->run() == FALSE)   // Si quelque chose est entrer dans le formulaire
        {
            if($this->db_model->countNbMatch() == 0)
            {
                $data['titreActu'] = 'Actualités : ';
                $data['titreMatch'] = 'Match : ';
                $data['allactu'] = $this->db_model->get_all_actualites();
                $data['nbMtc'] = $this->db_model->countNbMatch();

                $this->load->view('templates/haut');
                $this->load->view('menu_visiteurs_general');
                $this->load->view('actualite_afficher', $data);
                $this->load->view('templates/bas');   
            }
            else
            {
                $data['titreActu'] = 'Actualités : ';
                $data['titreMatch'] = 'Match : ';
                $data['allactu'] = $this->db_model->get_all_actualites();
                $data['nbMtc'] = $this->db_model->countNbMatch();

                $this->load->view('templates/haut');
                $this->load->view('menu_visiteurs_general');
                $this->load->view('actualite_afficher', $data);
                $this->load->view('formulaire_match', $data);
                $this->load->view('templates/bas');   
            }
        }
        else
        {        
            if($this->db_model->CodeExistPost() == NULL || $this->db_model->VerifyIfQizNotDPost() != NULL || $this->db_model->VerifyIfMtcNotDPost() != NULL || $this->db_model->VerifyIfMtcNotStartedPost() != NULL) 
            {
                $data['titreActu'] = 'Actualités : ';
                $data['titreMatch'] = 'Match : ';

                if($this->db_model->CodeExistPost() == NULL)
                {
                    $data['erreur'] = 'Code de match non existant, veuillez saisir le code fourni par votre formateur !';
                }
                elseif($this->db_model->VerifyIfQizNotDPost() != NULL)
                {
                    $data['erreur'] = 'Quiz du match désactivé !';
                }
                elseif($this->db_model->VerifyIfMtcNotDPost() != NULL || $this->db_model->VerifyIfMtcNotStartedPost() != NULL)
                {
                    $data['erreur'] = 'Match désactivé ou non démarré !';
                }
                

                $data['allactu'] = $this->db_model->get_all_actualites();
                $data['nbMtc'] = $this->db_model->countNbMatch();

                $this->load->view('templates/haut');
                $this->load->view('menu_visiteurs_general');
                $this->load->view('actualite_afficher', $data);
                $this->load->view('formulaire_match', $data);
                $this->load->view('erreur_formulaire_match', $data);
                $this->load->view('templates/bas');
            }
            else
            {
                $data['code'] = htmlspecialchars(addslashes($this->input->post('codemtc')));

                $this->load->view('templates/haut');
                $this->load->view('menu_visiteurs_general');
                $this->load->view('pseudo_choisir', $data);            
                $this->load->view('templates/bas');
            }


            /*
            $data['match'] = $this->db_model->CodeExistPost();
            $data['qr'] = $this->db_model->AllElementsOfMtcPost();
            $data['intitmtc'] = $this->db_model->get_MtcIntitPost();
            $data['intitqiz'] = $this->db_model->get_QizIntitPost();


            $this->load->view('templates/haut');
            $this->load->view('menu_visiteurs_general');
            $this->load->view('questionnaire_match_afficher', $data);            
            $this->load->view('templates/bas');
            */
        }
    }
}
?>
