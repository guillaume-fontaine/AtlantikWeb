<?php

echo form_open('', 'class="form-connection" id="connection"');

  echo '<span class="item-title"><h2></br>Liaison '.$arrayTraversee[0]->depart.'-'.$arrayTraversee[0]->arrivee.'</br>Traversée n°'.$arrayTraversee[0]->notraversee.' le '.date("d-m-Y", strtotime($arrayTraversee[0]->dateheuredepart)).' à '.date("g:i", strtotime($arrayTraversee[0]->dateheuredepart)).'</br>Saisir les informations relatives à la réservation</h2></span>'; 

  if(isset($error_message)) echo '<span class="item-title-error"><h2></br>'.$error_message.'</h2></span>';

  echo '<table class="table-responsive">
  <thead>
  <tr>
  <th>Type</th>
  <th>Tarif</th>
  <th>Quantite</th>
  </tr>
  </thead>
  <tbody>';

  foreach ($arrayTarif as $tarif){
  echo '<tr>
    <td>'.$tarif->libelle.'</td>          
    <td>'.$tarif->tarif.'</td>
    <td>';
    echo form_input(array(
    'type' => 'number',
      'name'  => $tarif->lettrecategorie.$tarif->notype,
      'id'    => $tarif->lettrecategorie.$tarif->notype,
      'placeholder' => 'Nombre de place',
      'class' => 'input-connection',            
      'min' => 0
  )); 
    echo'</td>       
    </tr>';
  }

  echo'</tbody>
  </table>';  

  echo form_submit('submit', 'Réserver',array(
      'class' => 'button-connection'
  ));

  echo form_close();

/*
   if($this->input->post('submit') != null){
    $array_quantite_categorie = array();
    $count_place = 0;
    $total_tarif = 0;
    foreach($arrayTarif as $tarif){
      $array_quantite_categorie[$tarif->lettrecategorie] = 0;
    }
    foreach($arrayTarif as $tarif) {
      if($this->input->post($tarif->lettrecategorie.$tarif->notype) != null){
        $array_quantite_categorie[$tarif->lettrecategorie] += $this->input->post($tarif->lettrecategorie.$tarif->notype); 
        $count_place += $this->input->post($tarif->lettrecategorie.$tarif->notype);       
        $total_tarif += $this->input->post($tarif->lettrecategorie.$tarif->notype) * $tarif->tarif;
      } 
    }
   
    $echec = false;
    foreach($array_quantite_categorie as $key => $value){
      if($value > $arrayQuantite[$key] && !$echec) $echec = true;
    }
    if($count_place <= 0){
      afficher_form($arrayTraversee, $arrayTarif, "Veuillez prendre au minimum une place");
    }else if($echec){
      afficher_form($arrayTraversee, $arrayTarif, "Vous avez sélectioner trop de place");
    }else{
      $this->session->set_userdata('reservation', $this->input->post());
      $this->session->set_userdata('montantTotal', $total_tarif);
      $this->session->set_userdata('notraversee', $noTraversee);
      redirect('Client/CompteRenduReservation');
      //to do renvoyer sur une page et insérez la reser
    }
   }else{
      afficher_form($arrayTraversee, $arrayTarif);
   }
*/
?>