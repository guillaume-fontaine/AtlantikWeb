<?php
class ModelePort extends CI_Model {

   public function __construct() {

      $this->load->database();

   }

   public function getPort(){
      $requete = $this->db->get('port');
      return $requete->result(); 
   }

   public function getPortByNoSecteur($pNoSecteur){
      $requete = $this->db->get_where('port', array('nosecteur' => $pNoSecteur));
      return $requete->result(); 
   }

   public function getPortByNoPort($pNoPort){
      $requete = $this->db->get_where('port', array('noport' => $pNoPort));
      return $requete->result(); 
   }
} 
