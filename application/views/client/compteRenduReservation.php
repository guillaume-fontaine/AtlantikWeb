<div class="box-reservation">
<span class="item-title"><h2></br>Compte rendu de votre réservation</h2></span>
<?php
$reservation = $arrayReservation[0];
echo'<span class="text-reservation"><h4> Liaison '.$reservation->pdepart.' - '.$reservation->parrivee.'</h4>';
echo'<h4> Traversée n°'.$reservation->notraversee.' le '.date("d-m-Y", strtotime($reservation->dateheuredepart)).' à '.date("g:i", strtotime($reservation->dateheuredepart)).'</h4></span>';

echo'<span class="text-reservation"><h4> Réservation enregitrée sous le n°'.$noReservation.'</h4>';
echo'<h4> '.$this->session->nom.' '.$this->session->adresse.' '.$this->session->codepostal.' '.$this->session->ville.'</h4></span>';

echo'<span class="text-reservation">';
foreach ($arrayEnregistrer as $enregistrer) {
	echo'<h4> '.$enregistrer->libelle.' : '.$enregistrer->quantite.'</h4>';
}
echo'</span>';

echo'<span class="text-reservation"><h4> Montant total à régler : '.$reservation->montanttotal.'</h4>';
echo'<h4> Modalités de règlement : '.$reservation->modereglement.'</h4></span>';

?>
</div>

