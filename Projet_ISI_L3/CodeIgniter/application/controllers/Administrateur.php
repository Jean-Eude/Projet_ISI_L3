<?php

// Nom du fichier : Administrateur.php
// Auteur : E.COMBOT
// Date de création : Novembre 2022
// Version : V2.2
// ********************************
// Description :
//
// Fichier qui liste toutes les 
// fonctions relatives à un/aux 
// administrateurs de l'application 
// serveur
// ********************************
// A noter :
//
// -Fonction qui permet d'afficher 
// l'accueil de l'espace formateur
//
// -Fonction qui permet de lister  
// les informations du profil
//
// -Fonction qui permet de modifier
// les données du profil
//
// -Fonction qui permet de détruire
// la session actuelle
////////////////////////////////////

defined('BASEPATH') OR exit('No direct script access allowed');

class Administrateur extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url');
    }
    
    public function afficher()
    {
        $this->load->view('templates/haut');
        $this->load->view('menu_administrateur');
        $this->load->view('espace_admin');
        $this->load->view('templates/bas');   
    }

    public function lister()
    {
        $username = $this->session->userdata('pseudo');
        $data['infos'] = $this->db_model->getPflInfos($username);

        $this->load->view('templates/haut');
        $this->load->view('menu_administrateur');
        $this->load->view('profil_administrateur', $data);
        $this->load->view('templates/bas');   
    }

    public function modifier()
    {        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom', 'nom', 'required', array('required' => 'Veuillez saisir un nom !'));
        $this->form_validation->set_rules('prenom', 'prenom', 'required', array('required' => 'Veuillez saisir un prénom !'));
        $this->form_validation->set_rules('mdp', 'mdp', 'required', array('required' => 'Veuillez saisir un mot de passe !'));
        $this->form_validation->set_rules('cfmdp', 'cfmdp', 'required|matches[mdp]', array('required' => 'Veuillez confirmer le mot de passe !'));
        $this->form_validation->set_message('matches', 'Confirmation du mot de passe erronée, veuillez réessayer !');


        if ($this->form_validation->run() == FALSE)   // Si quelque chose est entrer dans le formulaire
        {
            $username = $this->session->userdata('pseudo');
            $data['infos'] = $this->db_model->getCptInfos($username);

            $this->load->view('templates/haut');
            $this->load->view('menu_administrateur');
            $this->load->view('modification_infos_compte', $data);
            $this->load->view('templates/bas');
        }
        else
        {
            $username = $this->session->userdata('pseudo');

            $mdpnew = htmlspecialchars(addslashes($this->input->post('mdp')));
            $cfmdpnew = htmlspecialchars(addslashes($this->input->post('cfmdp')));


            // Hachage du 1er mot de passe 
            $salt1 = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
            $password1 = hash('sha256', $salt1.$mdpnew);

            // Hachage du 2eme mot de passe 
            $salt2 = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
            $password2 = hash('sha256', $salt2.$cfmdpnew);



            if($password1 != $password2)
            {
                $data['infos'] = $this->db_model->getCptInfos($username);

                $this->load->view('templates/haut');
                $this->load->view('menu_administrateur');
                $this->load->view('modification_infos_compte', $data);
                $this->load->view('templates/bas'); 
            } 
            else
            {
                $this->db_model->updateCptMDP($username, $password1);
                $data['infos'] = $this->db_model->getPflInfos($username);

                $this->load->view('templates/haut');
                $this->load->view('menu_administrateur');
                $this->load->view('profil_administrateur', $data);
                $this->load->view('templates/bas');       
            }
        } 
    }

    public function detruire()
    {        
        $this->session->sess_destroy();
        redirect(base_url()."index.php/accueil/afficher");
    }
}
?>

