<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {



	public function __construct() {

      parent::__construct();
      if($this->session->log == true){
	    $this->navBar = array("Visiteur/SeDeconnecter" => 'Se Déconnecter',
	  						  "Visiteur/ToutesLesLiaisons" => 'Toutes les liaisons',
	  						  "Visiteur/VisualiserLesHorairesDeTraversees" => 'Horaires de traversées',
	  						  "Client/afficherHistoriqueReservations" => 'Afficher l\'historique des réservations',
	  						  "Client/modifierInformationCompte" => 'Modifer les informations du compte');   
      }else{
	    redirect('Visiteur/');
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
       $this->load->model('ModeleReservation');
       $this->load->model('ModeleEnregistrer');

    } 

	public function index()	{
      	redirect('Visiteur/');
	}

	public function reserveeUneTraversee($noTraversee = 0){
		$array_quantite_categorie = array();
		$arrayQuantite = array();
		$arrayTarif = $this->ModeleTarifer->getTarifAndLibelle($noTraversee);
		$char = 65;
		foreach($this->ModeleTraversee->getQuantiteByNoTraversee($noTraversee) as $quantite){
			$arrayQuantite[chr($char)] = $quantite->value;
			$char++;
		}

		$donnee = array("arrayTraversee" => $this->ModeleTraversee->getTraverseeByNoTraversee($noTraversee),
				        "arrayTarif" => $this->ModeleTarifer->getTarifAndLibelle($noTraversee));

		if($this->input->post('submit') != null){
		    $array_quantite_categorie = array();
		    $count_place = 0;
		    $total_tarif = 0;
		    foreach($arrayTarif as $tarif){
		      $array_quantite_categorie[$tarif->lettrecategorie] = 0;
		    }
		    foreach($arrayTarif as $tarif) {
		      if($this->input->post($tarif->lettrecategorie.$tarif->notype) != null){
		        $array_quantite_categorie[$tarif->lettrecategorie] += $this->input->post($tarif->lettrecategorie.$tarif->notype); 
		        $count_place += $this->input->post($tarif->lettrecategorie.$tarif->notype);       
		        $total_tarif += $this->input->post($tarif->lettrecategorie.$tarif->notype) * $tarif->tarif;
		      } 
		    }
		   
		    $echec = false;
		    foreach($array_quantite_categorie as $key => $value){
		      if($value > $arrayQuantite[$key] && !$echec) $echec = true;
		    }
		    if($count_place <= 0){
		      $donnee["error_message"] = "Veuillez prendre au minimum une place";
		    }else if($echec){		     
		      $donnee["error_message"] = "Vous avez sélectioner trop de place";
		    }else{
		      $this->session->set_userdata('reservation', $this->input->post());
		      $this->session->set_userdata('montantTotal', $total_tarif);
		      $this->session->set_userdata('notraversee', $noTraversee);
		      redirect('Client/CompteRenduReservation');
		      //to do renvoyer sur une page et insérez la reser
		    }
	    }

		$this->load->view('templates/Entete', 
			array("titleHeader" => 'Atlantik',"navbar" => $this->navBar));
		$this->load->view('client/reserveeUneTraversee', $donnee);
		$this->load->view('templates/PiedDePage');
	}


	public function compteRenduReservation($noReservation = 0){
		if($this->session->notraversee != null && $this->session->montantTotal != null && $this->session->reservation){
			$noReservations = $this->ModeleReservation->insertIntoReservation($this->session->notraversee, $this->session->noclient, $this->session->montantTotal, 0, "Later");
			foreach($this->ModeleTarifer->getTarifAndLibelle($this->session->notraversee) as $tarif){
				if(isset($this->session->reservation[$tarif->lettrecategorie.$tarif->notype]) && $this->session->reservation[$tarif->lettrecategorie.$tarif->notype] != null){
					$this->ModeleEnregistrer->insertIntoEnregistrer($noReservations, $tarif->lettrecategorie, $tarif->notype, $this->session->reservation[$tarif->lettrecategorie.$tarif->notype]);
				}
			}

			$this->session->unset_userdata('reservation');
	      	$this->session->unset_userdata('montantTotal');
	      	$this->session->unset_userdata('notraversee');
	      	redirect('Client/CompteRenduReservation/'.$noReservations);
		}else{
			if($noReservation == 0)redirect('Visiteur');
			$this->load->view('templates/Entete', 
			array("titleHeader" => 'Atlantik',"navbar" => $this->navBar));
			if($this->ModeleReservation->is_true_client($this->session->noclient, $noReservation)){
				$this->load->view('client/compteRenduReservation', 
				array("arrayReservation" => $this->ModeleReservation->getDataCompterenduReservation($this->session->noclient, $noReservation),
					  "arrayEnregistrer" => $this->ModeleEnregistrer->getEnregistrerByNoReservation($noReservation),
					  "noReservation" => $noReservation));
			}else{
				redirect('Visiteur');
			}
		$this->load->view('templates/PiedDePage');
		}		

	}

	public function afficherHistoriqueReservations(){
		$this->load->view('templates/Entete', 
			array("titleHeader" => 'Atlantik',"navbar" => $this->navBar));
		$this->load->view('client/afficherHistoriqueReservations',
			array("arrayReservation" => $this->ModeleReservation->getAllReservationByClient($this->session->noclient)));
		$this->load->view('templates/PiedDePage');

	}

	public function modifierInformationCompte(){
		$this->load->view('templates/Entete', 
			array("titleHeader" => 'Atlantik',"navbar" => $this->navBar));
		$this->load->view('client/modifierInformationCompte');
		$this->load->view('templates/PiedDePage');
	}

}
