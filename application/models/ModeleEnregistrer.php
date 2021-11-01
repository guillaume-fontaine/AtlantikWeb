<?php
class ModeleEnregistrer extends CI_Model {

   public function __construct() {

      $this->load->database();

   }

   public function insertIntoEnregistrer($noReservation = 0, $lettreCategorie = null, $noType = 0, $quantite = 0){
    if($noReservation == 0 || $lettreCategorie == null || $noType == 0 || $quantite == 0) return false;
    $this->db->insert("enregistrer", 
      array("noreservation" => $noReservation,
            "lettrecategorie" => $lettreCategorie,
            "notype" => $noType, 
            "quantite" => $quantite));
   }

   public function getEnregistrerByNoReservation($noReservation = 0){
      $query = $this->db->select('`libelle`, `quantite`')
          ->from('`enregistrer`, `type`')
          ->where('noreservation = '.intval($noReservation).' and enregistrer.notype = type.notype and enregistrer.lettrecategorie = type.lettrecategorie ')
          ->get()
          ->result();
      return $query; 
   }
} 