<div class="main">
<div class="resultat">
<?php
   echo form_input(array(
      'type' => 'date',
      'name'  => 'date',
      'id'    => 'date',
      'placeholder' => 'Sélectionnez une date',
      'class' => 'input-connection'
   ));   
   $arrayLiaison = array();
   foreach ($listLiaison as $liaison){
   	$arrayLiaison[$liaison->noliaison] = $liaison->nom_port_depart.' - '.$liaison->nom_port_arrivee;
   }

   echo form_dropdown('liaison', $arrayLiaison, null, array("class" => 'select-',"id" => "liaison"));
   echo '<button class="button-connection" id="myBtn" type="submit" value="submit">Rechercher</button>
   <div id="eachTable"></div>';
?>
</div>
<aside class="liaison">
	<?php
	foreach ($listSecteur as $secteur) {
		if($noSecteur == $secteur->nosecteur)
		echo '<a href="'.site_url('Visiteur/VisualiserLesHorairesDeTraversees/').$secteur->nosecteur.'" class="portAside active">'.$secteur->nom.' </a>';
	else
		echo '<a href="'.site_url('Visiteur/VisualiserLesHorairesDeTraversees/').$secteur->nosecteur.'" class="portAside">'.$secteur->nom.' </a>';
	}
	?>
</aside>
</div>