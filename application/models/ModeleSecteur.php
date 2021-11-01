<?php
class ModeleSecteur extends CI_Model {

   public function __construct() {

      $this->load->database();

   }

   public function getSecteur(){
      $requete = $this->db->get('secteur');
      return $requete->result(); 
   }

} 