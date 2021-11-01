<?php
class ModeleCategorie extends CI_Model {

   public function __construct() {

      $this->load->database();

   }

   public function getCategorie(){
      $requete = $this->db->get('categorie');
      return $requete->result(); 
   }

} 