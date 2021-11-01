<?php
class ModeleReservation extends CI_Model {

   public function __construct() {

      $this->load->database();

   }

   public function insertIntoReservation($noTraversee = 0, $noClient = 0, $montantTotal = null, $paye = 0, $modeReglement = null){
    if($noTraversee == 0 || $noClient == 0 || $montantTotal == null) return false;
    $this->db->insert("reservation", 
      array("notraversee" => $noTraversee,
            "noclient" => $noClient,
            "dateheure" => date("Y-m-d H:i:s"), 
            "montanttotal" => $montantTotal, 
            "paye" => $paye, 
            "modereglement" => $modeReglement));
    return $this->db->insert_id();
   }

   public function getDataCompterenduReservation($noClient = 0, $noReservation = 0){
      $query = $this->db->select('reservation.`notraversee`, traversee.noliaison, p1.nom as pdepart, p2.nom as parrivee, traversee.dateheuredepart, `montanttotal`, `paye`, `modereglement`')
          ->from('`reservation`, `traversee`, liaison, port as p1, port as p2')
          ->where('noclient = '.intval($noClient).' and noreservation = '.intval($noReservation).' and reservation.notraversee = traversee.notraversee and traversee.noliaison = liaison.noliaison and p1.noport = liaison.noport_depart and p2.noport = liaison.noport_arrivee')
          ->get()
          ->result();
      return $query; 
   }

   public function is_true_client($noClient = 0, $noReservation = 0){
      $query = $this->db->select('reservation.`notraversee`, traversee.noliaison, p1.nom as pdepart, p2.nom as parrivee, traversee.dateheuredepart, `montanttotal`, `paye`, `modereglement`')
          ->from('`reservation`, `traversee`, liaison, port as p1, port as p2')
          ->where('noclient = '.intval($noClient).' and noreservation = '.intval($noReservation).' and reservation.notraversee = traversee.notraversee and traversee.noliaison = liaison.noliaison and p1.noport = liaison.noport_depart and p2.noport = liaison.noport_arrivee')
          ->get();
      return $query->num_rows() == 1;
   }

   public function getAllReservationByClient($noClient = 0){
      $query = $this->db->select('`noreservation`, `dateheure`, p1.nom as pdepart, p2.nom as parrivee, `dateheuredepart`, `montanttotal`, `paye`')
          ->from('`reservation`, `traversee`, `liaison`, `port` as p1, `port` as p2')
          ->where('noclient = '.intval($noClient).' and reservation.notraversee = traversee.notraversee and traversee.noliaison = liaison.noliaison and p1.noport = liaison.noport_depart and p2.noport = liaison.noport_arrivee')
          ->get()
          ->result();
      return $query;
   }
} 