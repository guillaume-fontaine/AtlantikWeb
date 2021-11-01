<?php
class ModeleType extends CI_Model {

   public function __construct() {

      $this->load->database();

   }

   public function getType(){
      $requete = $this->db->get('type');
      return $requete->result(); 
   }

} 