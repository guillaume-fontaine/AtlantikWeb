<?php
class ModeleTarifer extends CI_Model {

   public function __construct() {

      $this->load->database();

   }

   public function getTarif(){
      $requete = $this->db->get('tarifer');
      return $requete->result(); 
   }

   public function getTarifByNoPort($pNoLiaison){
      $requete = $this->db->get_where('tarifer', array('noliaison' => $pNoLiaison));
      return $requete->result(); 
   }

   public function getTarifByNoPortNow($pNoLiaison){
      $query = $this->db->select('tarifer.`noperiode`, `lettrecategorie`, `notype`, `noliaison`, `tarif`')
          ->from('`tarifer`, `periode`')
          ->where('periode.noperiode = tarifer.noperiode and datefin > \' '.date("Y-m-d").'\' and noliaison = '.intval($pNoLiaison))
          ->get()
          ->result();
      return $query; 
   }

   public function getTarifAndLibelle($noTraversee = 0){
      $query = $this->db->select('type.lettrecategorie, type.notype, libelle, tarif')
          ->from('`tarifer`, `traversee`, `periode`, `type`')
          ->where("traversee.notraversee = ".intval($noTraversee)." and tarifer.noliaison = traversee.noliaison and tarifer.noperiode = periode.noperiode and traversee.dateheuredepart BETWEEN periode.datedebut and periode.datefin and type.lettrecategorie = tarifer.lettrecategorie and type.notype = tarifer.notype")
          ->get()
          ->result();
      return $query; 
   }
} 