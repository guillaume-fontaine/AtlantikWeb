<?php
class ModelePeriode extends CI_Model {

   public function __construct() {

      $this->load->database();

   }

   public function getPeriode(){
      $requete = $this->db->get('periode');
      return $requete->result(); 
   }

   public function getPeriodeCount(){
      $requete = $this->db->get('periode');
      return $requete->num_rows(); 
   }

   public function getPeriodeNow(){
      $requete = $this->db->get_where('periode', array('datefin > ' => date("Y-m-d")));
      return $requete->result(); 
   }

   public function getPeriodeCountNow(){
      $requete = $this->db->get_where('periode', array('datefin > ' => date("Y-m-d")));
      return $requete->num_rows(); 
   }

}
