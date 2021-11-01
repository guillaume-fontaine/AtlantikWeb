<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visiteur extends CI_Controller {



	public function __construct() {

      parent::__construct();
      if($this->session->log == true){
	    $this->navBar = array("Visiteur/SeDeconnecter" => 'Se Déconnecter',
	  						  "Visiteur/ToutesLesLiaisons" => 'Toutes les liaisons',
	  						  "Visiteur/VisualiserLesHorairesDeTraversees" => 'Horaires de traversées',
	  						  "Client/afficherHistoriqueReservations" => 'Afficher l\'historique des réservations',
	  						  "Client/modifierInformationCompte" => 'Modifer les informations du compte');   
      }else{
	    $this->navBar = array("Visiteur/SeConnecter" => 'Se Connecter',
	  						  "Visiteur/ToutesLesLiaisons" => 'Toutes les liaisons',
	  						  "Visiteur/VisualiserLesHorairesDeTraversees" => 'Horaires de traversées');      	
      }
       $this->load->model('ModelePort');
       $this->load->model('ModeleLiaison');
       $this->load->model('ModeleSecteur');
       $this->load->model('ModeleTarifer');
       $this->load->model('ModeleCategorie');
       $this->load->model('ModeleType');
       $this->load->model('ModelePeriode');
       $this->load->model('ModeleClient');
       $this->load->model('ModeleTraversee');

    } 

	public function index()	{
		$this->load->view('templates/Entete', 
			array("titleHeader" => 'Atlantik',"navbar" => $this->navBar));
		$this->load->view('visiteur/defaultPage');
		$this->load->view('templates/PiedDePage');
		echo password_hash("test", PASSWORD_DEFAULT);
	}

	public function seConnecter(){

		$donnee = array();

		if($this->input->post('submit') != null){
	    	$result = $this->ModeleClient->get_user($this->input->post('email'), $this->input->post('password'));
	    	if(count($result) == 0){
	    		$donnee['error_message'] = 'L\'email ou le mot de passe sont incorrect';
	    	}else if(count($result) == 1){
	      		$this->session->log = true;
	      		$this->session->set_userdata(json_decode(json_encode($result[0]),true));
	      		redirect('Visiteur/');
	   		}else{
	      		$donnee['error_message'] = 'Un problème est survenue';
	    	}
	  	}		

		$this->load->view('templates/Entete', 
			array("titleHeader" => 'Atlantik',"navbar" => $this->navBar));
		$this->load->view('visiteur/connectionPage', $donnee);
		$this->load->view('templates/PiedDePage');
	}

	public function toutesLesLiaisons(){
		$this->load->view('templates/Entete', 
			array("titleHeader" => 'Atlantik',"navbar" => $this->navBar));
		$this->load->view('visiteur/toutesLesLiaisonsPage',
			array("listTouteLesLiaisons" => $this->ModeleLiaison->getLiaisonWithNomPortAndNomSecteur()));
		$this->load->view('templates/PiedDePage');
	}

	public function afficherTarifsPourUneLiaison($noLiaison){
		$this->load->view('templates/Entete', 
			array("titleHeader" => 'Atlantik',"navbar" => $this->navBar));
		$this->load->view('visiteur/afficherTarifsPourUneLiaison',
			array("listCategorie" => $this->ModeleCategorie->getCategorie(),
				  "listType" => $this->ModeleType->getType(),
				  "listPeriode" => $this->ModelePeriode->getPeriodeNow(),
				  "nombrePeriode" => $this->ModelePeriode->getPeriodeCountNow(),
				  "listTarifParLiaison" => $this->ModeleTarifer->getTarifByNoPortNow($noLiaison)));
		$this->load->view('templates/PiedDePage');
	}

	public function creerUnCompte(){
		$this->load->view('templates/Entete', 
			array("titleHeader" => 'Atlantik',"navbar" => $this->navBar));		
		$this->load->view('visiteur/creerUnCompte');
		$this->load->view('templates/PiedDePage');
	}

	public function visualiserLesHorairesDeTraversees($noSecteur = 1){
		$this->load->view('templates/Entete', 
			array("titleHeader" => 'Atlantik',"navbar" => $this->navBar));
		$this->load->view('visiteur/visualiserLesHorairesDeTraversees',
			array("listSecteur" => $this->ModeleSecteur->getSecteur(),
				  "noSecteur" => $noSecteur,
				  "listLiaison" => $this->ModeleLiaison->getLiaisonWithNomPortByNoSecteur($noSecteur)));
		$this->load->view('templates/PiedDePage');
	}

	public function seDeconnecter(){
		$this->session->sess_destroy();
      	redirect('Visiteur/');
	}

	public function horaireTraverseeData($noLiaison = 0, $date = null){
		$arrayData = array();
		foreach ($this->ModeleTraversee->getTraversee($noLiaison,$date) as $traversee) {
			$tempArray = array();
			array_push($tempArray, $traversee->notraversee);
			array_push($tempArray, $traversee->dateheuredepart);
			array_push($tempArray, $traversee->nom);
			foreach($this->ModeleTraversee->getQuantite($traversee->notraversee, $traversee->nobateau) as $quantite){
				array_push($tempArray, $quantite->value);
			}
			array_push($arrayData, $tempArray);
		}
		echo json_encode($arrayData);
	}


}
