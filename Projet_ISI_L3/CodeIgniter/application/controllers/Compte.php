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
// matchs de l'Application Serveur
// ********************************
// A noter :
//
// - Fonction qui affiche les 
// données d'un match
//
// - Fonction qui permet à un 
// formateur/aministrateur de se
// connecter
////////////////////////////////////


defined('BASEPATH') OR exit('No direct script access allowed');

class Compte extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url');
    }
    
    public function connecter()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pseudo', 'pseudo', 'required|callback_check_session_login', array('required' => 'Veuillez saisir un pseudo !'));
        $this->form_validation->set_rules('mdp', 'mdp', 'required|callback_check_session_login', array('required' => 'Veuillez saisir un mot de passe !'));


        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/haut');
            $this->load->view('menu_visiteurs_general');
            $this->load->view('compte_connecter');
            $this->load->view('templates/bas');
        }
        else
        {
            $pseudo = htmlspecialchars(addslashes($this->input->post('pseudo')));
            $mdp = htmlspecialchars(addslashes($this->input->post('mdp')));
    

            if($this->db_model->VerifyCpt($pseudo, $mdp) != NULL)
            {
                $role = $this->db_model->getCptInfos($pseudo);
                $roleAF = $role->pfl_role;

                if($roleAF == 'A')
                {   

                    $session_data = array('pseudo' => $pseudo,  'role' => $roleAF );
        
                    $this->session->set_userdata($session_data);
                    $this->load->view('templates/haut');
                    $this->load->view('menu_administrateur');
                    $this->load->view('espace_admin');
                    $this->load->view('templates/bas');  
                }
                elseif($roleAF == 'F')
                {
                    $session_data = array('pseudo' => $pseudo,  'role' => $roleAF );
        
                    $this->session->set_userdata($session_data);
                    $this->load->view('templates/haut');
                    $this->load->view('menu_formateur');
                    $this->load->view('espace_formateur');
                    $this->load->view('templates/bas');   
                }
            }
            else
            {
                $data['erreur'] = 'Identifiants erronés ou inexistants !';

                $this->load->view('templates/haut');
                $this->load->view('menu_visiteurs_general');
                $this->load->view('compte_connecter');
                $this->load->view('erreur_formulaire_compte', $data);
                $this->load->view('templates/bas');
            }
        }
    }


    public function check_session_login()
    {
        if(htmlspecialchars(addslashes($this->input->post('pseudo'))) == '' && htmlspecialchars(addslashes($this->input->post('mdp'))) == '')
        {
            $this->form_validation->set_message('check_session_login', 'Veuillez remplir tous les champs !');
            return false;
        }

        return true;
    }

    public function lister()
    {
        $username = $this->session->userdata('pseudo');
        $data['infosP'] = $this->db_model->getPflInfosALL();

        $this->load->view('templates/haut');
        $this->load->view('menu_administrateur');
        $this->load->view('profils_ensemble_administrateur', $data);
        $this->load->view('templates/bas'); 
    }

}
?>

