<?php


  echo form_open('', 'class="form-connection" id="connection"');


  echo '<span class="item-title"><h2></br>Se connecter</h2></span>';

  if(isset($error_message)) echo '<span class="item-title-error"><h2>'.$error_message.'</h2></span>';

  echo form_input(array(
  'type' => 'email',
  'name'  => 'email',
  'id'    => 'email',
  'placeholder' => 'E-mail',
  'class' => 'input-connection',
  'value' => set_value('email')
  ));   

  echo form_password(array(
  'type' => 'password',
  'name'  => 'password',
  'id'    => 'password',
  'placeholder' => 'Mot de passe',
  'class' => 'input-connection'
  ));   

  echo form_submit('submit', 'Se connecter',array(
  'class' => 'button-connection'
  ));

  echo '<span class="text">Pas de compte ?  <a class="link" href='.site_url('Visiteur/CreerUnCompte').'>Créez-en un.</a></span>';

  echo form_close();




?>