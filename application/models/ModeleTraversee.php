<?php
class ModeleTraversee extends CI_Model {

   public function __construct() {

      $this->load->database();

   }

   public function getTraversee($noLiaison = 0, $date = null){
      $query = $this->db->select('traversee.notraversee, traversee.dateheuredepart, bateau.nom, bateau.nobateau')
          ->from('`traversee`, `bateau`')
          ->where("traversee.nobateau = bateau.nobateau and traversee.noliaison = ".intval($noLiaison)." and traversee.dateheuredepart between '".$date." 00:00:00' and '".$date." 23:59:59'")
          ->get()
          ->result();
      return $query; 
   }

   public function getQuantite($noTraversee = 0, $noBateau = 0){
      $this->db->query("call create_temporary_table_place_restante(".intval($noTraversee).",".intval($noBateau).");");
      $query = $this->db->select('value')
      ->from('get_place_restante_out')
      ->get()
      ->result();
      return $query;
   }

   public function getQuantiteByNoTraversee($noTraversee = 0){
    if ($noTraversee == 0)return null;
    $data = $this->getNoTraverseeAndNoBateau($noTraversee);
      $this->db->query("call create_temporary_table_place_restante(".intval($data[0]->notraversee).",".intval($data[0]->nobateau).");");
      $query = $this->db->select('value')
      ->from('get_place_restante_out')
      ->get()
      ->result();
      return $query;
   }

   public function getNoTraverseeAndNoBateau($noTraversee = 0){
    $query = $this->db->select('traversee.notraversee, traversee.nobateau')
          ->from('`traversee`')
          ->where("traversee.notraversee = ".intval($noTraversee))
          ->get()
          ->result();
      return $query;
   }

   public function getTraverseeByNoTraversee($noTraversee = 0){
    $query = $this->db->select('traversee.notraversee, traversee.dateheuredepart, portdep.nom as \'depart\', portarr.nom as \'arrivee\'')
          ->from('`traversee`, `liaison`, port as portdep, port as portarr')
          ->where("traversee.notraversee = ".intval($noTraversee)." and traversee.noliaison = liaison.noliaison and portdep.noport = liaison.noport_depart and portarr.noport = liaison.noport_arrivee")
          ->get()
          ->result();
      return $query; 
   }

}
