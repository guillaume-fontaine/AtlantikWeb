<div class="box-reservation">
<span class="item-title"><h2></br>Vos réservations</h2></span>
	<table class="table-responsive pagination" data-pagecount="4">
   <thead>
    <tr>
      <th>n° de réservation</th>
      <th>Date réservation</th>
      <th>Départ</th>
      <th>Arrivée</th>
      <th>Date départ</th>
      <th>Total</th>
      <th>Payé</th>
    </tr>
   </thead>
   <tbody>
<?php
foreach ($arrayReservation as $reservation){
    echo '<tr class="link-table">
          <td>'.$reservation->noreservation.'</td>          
          <td>'.date("d-m-Y", strtotime($reservation->dateheure)).'</td>
          <td>'.$reservation->pdepart.'</td>
          <td>'.$reservation->parrivee.'</td>
          <td>'.date("d-m-Y", strtotime($reservation->dateheuredepart)).'</td> 
          <td>'.$reservation->montanttotal.'</td>
          <td>';
          if($reservation->paye == 1) echo 'oui';
          else echo 'non';
          echo'</td>          
          </tr>';
          //<td> <a class="text" href='.site_url($this->router->fetch_class().'/AfficherTarifsPourUnereservation/').$reservation->noreservation.'>'.$reservation->noreservation.'</a> </td>
  }

?>
</tbody>
 </table>
 <div id="pagin">
 </div>
</div>