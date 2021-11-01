<?php
class ModeleClient extends CI_Model {

   public function __construct() {

      $this->load->database();

   }

   public function is_valid_email($email = null){
   	  if(!isset($email))return false;
   	  $requete = $this->db->get_where('client', array('mel' => $email));
      return $requete->num_rows() < 1; 
   }

   public function is_valid_email_noclient($email = null, $noclient = 0){
      if(!isset($email))return false;
      $requete = $this->db->get_where('client', array('mel' => $email, 'noclient !=' => $noclient));
      return $requete->num_rows() < 1; 
   }

   public function insert_client($insert_data = null){

   	if(!isset($insert_data))return 'Les valeur insérez ne peuvent etre null';
   	if(!$this->is_valid_email($insert_data['mel']))return 'L\'email '.$insert_data['mel'].' n\'est pas disponible';
   	if(isset($insert_data['submit']))unset($insert_data['submit']);
      $requete = $this->db->insert('client', $insert_data);
      return null;
   }

   public function get_user($email = null, $mdp = null){
   	$query = $this->db->select('`noclient`, `nom`, `prenom`, `adresse`, `codepostal`, `ville`, `telephonefixe`, `telephonemobile`, `mel`')
          ->from('client')
          ->where(array('mel' => $email, 'motdepasse' => $mdp))
          ->get()
          ->result();

      return $query; 
   }

   public function get_user_noclient($noclient = 0, $mdp = null){
    $query = $this->db->select('`noclient`, `nom`, `prenom`, `adresse`, `codepostal`, `ville`, `telephonefixe`, `telephonemobile`, `mel`')
          ->from('client')
          ->where(array('noclient' => $noclient, 'motdepasse' => $mdp))
          ->get()
          ->result();

      return $query; 
   }

  public function update_client($insert_data = null){
    if(!isset($insert_data))return 'Les valeur insérez ne peuvent etre null';
    if(!$this->is_valid_email_noclient($insert_data['mel'], $this->session->noclient))return 'L\'email '.$insert_data['mel'].' n\'est pas disponible';
    if(isset($insert_data['submit']))unset($insert_data['submit']);
    if(isset($insert_data['motdepasse']) && $insert_data['motdepasse'] == null)unset($insert_data['motdepasse']);
    if(isset($insert_data['password']))unset($insert_data['password']);
    $this ->db->where('noclient', $this->session->noclient);
      $requete = $this->db->update('client', $insert_data);
      return null;
   }

} 