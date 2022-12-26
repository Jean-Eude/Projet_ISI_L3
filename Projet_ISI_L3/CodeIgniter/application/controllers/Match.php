<?php

////////////////////////////////////
// Nom du fichier : Match.php
// Auteur : E.COMBOT
// Date de création : Novembre 2022
// Version : V2.2
// ********************************
// Description :
//
// Fichier qui liste toutes les 
// fonctions relatives à un/aux 
// matchs de l'application serveur
// ********************************
// A noter :
//
// - Fonction qui affiche les 
// données d'un match
//
// -Fonction qui gère un match (côté
// formateur)
////////////////////////////////////


defined('BASEPATH') OR exit('No direct script access allowed');

class Match extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url');
    }
    
    public function afficher($mtcCode = FALSE)
    {
        if ($mtcCode == FALSE)
        { 
            $url=base_url(); header("Location:$url");}
        else
        {
            $data['code'] = $mtcCode;
            $data['match'] = $this->db_model->CodeExist($mtcCode);
            $data['qr'] = $this->db_model->AllElementsOfMtc($mtcCode);


            $this->load->view('templates/haut');
            $this->load->view('menu_visiteurs_general');
            $this->load->view('questionnaire_match_joueur', $data);            
            $this->load->view('templates/bas');
        }
    }

    public function gerer()
    {            
        $username = $this->session->userdata('pseudo');
            
        // Fonction qui liste les différents codes de matchs (->formulaire)
        $data['infosP'] = $this->db_model->get_allquizmtc();

        $this->load->view('templates/haut');
        $this->load->view('menu_formateur');
        $this->load->view('gestion_matchs_formateur', $data);            
        $this->load->view('templates/bas');
    }

    public function generer($mtcCode)
    {
        if ($mtcCode == FALSE)
        { 
            $url=base_url(); 
            redirect($url."compte/gerer");
        }
        else
        {
            $username = $this->session->userdata('pseudo');

            $data['code'] = $mtcCode;
            $data['match'] = $this->db_model->CodeExist($mtcCode);
            $data['qr'] = $this->db_model->AllElementsOfMtc($mtcCode);


            $this->load->view('templates/haut');
            $this->load->view('menu_formateur');
            $this->load->view('jouer_match_formateur', $data);            
            $this->load->view('templates/bas');
        }
    }


    public function terminer($mtcCode)
    {
        if ($mtcCode == FALSE)
        { 
            $url=base_url(); 
            redirect($url."compte/gerer");
        }
        else
        {
            $username = $this->session->userdata('pseudo');

            $data['code'] = $mtcCode;
            $data['match'] = $this->db_model->CodeExist($mtcCode);
            $data['qr'] = $this->db_model->AllElementsOfMtc($mtcCode);
            $data['js'] = $this->db_model->getFinalScoresByJor($mtcCode);
            $data['fs'] = $this->db_model->getFinalScore($mtcCode);
            $this->db_model->UpdateAfterMtc($mtcCode);

            $this->load->view('templates/haut');
            $this->load->view('menu_formateur');
            $this->load->view('resultat_matchs_formateur', $data);            
            $this->load->view('templates/bas');
        }
    }


    public function corriger($mtcCode)
    {
        if ($mtcCode == FALSE)
        { 
            $url=base_url(); 
            redirect($url."compte/gerer");
        }
        else
        {
            $username = $this->session->userdata('pseudo');

            $data['code'] = $mtcCode;
            $data['match'] = $this->db_model->CodeExist($mtcCode);
            $data['qr'] = $this->db_model->AllElementsOfMtc($mtcCode);
            $data['js'] = $this->db_model->getFinalScoresByJor($mtcCode);
            $data['fs'] = $this->db_model->getFinalScore($mtcCode);

            $this->load->view('templates/haut');
            $this->load->view('menu_formateur');
            $this->load->view('resultat_matchs_formateur', $data);            
            $this->load->view('templates/bas');
        }
    }




    public function reinitialiser($codedel)
    {
        $this->db_model->UpdatebeforeRAZ($codedel);
        $this->db_model->UpdateforRAZ($codedel);
        redirect(base_url()."index.php/match/gerer");
    }


    public function activer($codemtc, $etat)
    {
        $this->db_model->UpdateforState($etat, $codemtc);
        redirect(base_url()."index.php/match/gerer");
    }

    public function supprimer($codemtc)
    {
        $this->db_model->UpdatebeforeRAZ($codemtc);
        $this->db_model->UpdateforRAZ($codemtc);
        $this->db_model->UpdateforDelete($codemtc);
        redirect(base_url()."index.php/match/gerer");
    }

    public function creer()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('intitule', 'intitule', 'required', array('required' => 'Veuillez saisir un intitulé de match !'));
        $this->form_validation->set_rules('idquiz', 'idquiz', 'required', array('required' => 'Veuillez séléctionner un quiz !'));
    
 

        if ($this->form_validation->run() == FALSE)   // Si quelque chose est entrer dans le formulaire
        {
            $username = $this->session->userdata('pseudo');
            $data['quiz'] = $this->db_model->get_allquiz();


            $this->load->view('templates/haut');
            $this->load->view('menu_formateur');
            $this->load->view('creer_match', $data);
            $this->load->view('templates/bas');
        }
        else
        {
            $intitule = htmlspecialchars(addslashes($this->input->post('intitule')));
            $idquiz = htmlspecialchars(addslashes($this->input->post('idquiz')));

            if($this->db_model->VerifyQuiz($idquiz) == 0)
            {
                $username = $this->session->userdata('pseudo');
                $data['quiz'] = $this->db_model->get_allquiz();
                $data['erreur'] = "Erreur lors de la création du match, le quiz choisi ne possède aucune question !";

                $this->load->view('templates/haut');
                $this->load->view('menu_formateur');
                $this->load->view('creer_match', $data);
                $this->load->view('erreur_creation_match', $data);
                $this->load->view('templates/bas'); 
            }
            else
            {
                $username = $this->session->userdata('pseudo');
                
                // Fonction qui liste les différents codes de matchs (->formulaire)
                $data['infosP'] = $this->db_model->get_allquizmtc();

                $idpfl = $this->db_model->getidofUser($username);
                $idpflF = $idpfl->pfl_id;

                $this->db_model->CreateAMatchCALL($intitule, $idquiz, $idpflF);

                $this->load->view('templates/haut');
                $this->load->view('menu_formateur');
                $this->load->view('gestion_matchs_formateur', $data);            
                $this->load->view('templates/bas');
            }
        }
    }
}
?>