
  <table class="table-responsive">
   <thead>
    <tr>
      <th>Secteur</th>
      <th>Code Liaison</th>
      <th>Distance en milles marin</th>
      <th>Port de départ</th>
      <th>Port d’arrivée</th>
    </tr>
   </thead>
   <tbody>
<?php

  foreach ($listTouteLesLiaisons as $liaison){
    echo '<tr class="link-table">
          <td>'.$liaison->nom.'</td>
          <td> <a class="text" href='.site_url('Visiteur/AfficherTarifsPourUneLiaison/').$liaison->noliaison.'>'.$liaison->noliaison.'</a> </td>
          <td>'.$liaison->distance.'</td>
          <td>'.$liaison->nom_port_depart.'</td>
          <td>'.$liaison->nom_port_arrivee.'</td>         
          </tr>';
  }
   
?>
</tbody>
 </table>