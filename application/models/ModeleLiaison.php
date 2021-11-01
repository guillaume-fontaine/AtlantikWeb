<?php
class ModeleLiaison extends CI_Model {

   	public function __construct() {

      $this->load->database();

   	}

   	public function getLiaison(){
      $requete = $this->db->get('liaison');
      return $requete->result(); 
   	}

    public function getLiaisonWithNomPortAndNomSecteur(){
      $query = $this->db->select('secteur.nom, liaison.noliaison, liaison.distance, p1.nom as nom_port_depart, p2.nom as nom_port_arrivee')
          ->from('port as p1,port as p2,liaison, secteur')
          ->where('p1.noport = liaison.noport_depart and p2.noport = liaison.noport_arrivee and secteur.nosecteur = p1.nosecteur')
          ->order_by('secteur.nom', 'ASC')
          ->get()
          ->result();

      return $query; 
    }

    public function getLiaisonWithNomPortByNoSecteur($noSecteur = 0){
      $query = $this->db->select('liaison.noliaison, p1.nom as nom_port_depart, p2.nom as nom_port_arrivee')
          ->from('port as p1 ,port as p2, liaison')
          ->where('p1.noport = liaison.noport_depart and p2.noport = liaison.noport_arrivee and p1.nosecteur = '.intval($noSecteur))
          ->get()
          ->result();
      return $query; 
    }

} 