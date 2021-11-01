<?php

  if ( ! function_exists('afficher_form')) {
     function afficher_form($post_a = array(), $error_message = null) {
       echo form_open('', 'class="form-connection" id="connection"');

       echo '<span class="item-title"><h2></br>Creer un compte</h2></span>'; 

       if(isset($error_message)) echo '<span class="item-title-error"><h2></br>'.$error_message.'</h2></span>';
       
       echo form_input(array(
          'type' => 'email',
            'name'  => 'mel',
            'id'    => 'mel',
            'placeholder' => 'E-mail',
            'class' => 'input-connection',
            'required' => 'required',
            'value' => get_value_null($post_a, 'mel')
       ));   

       echo form_password(array(
          'type' => 'password',
            'name'  => 'motdepasse',
            'id'    => 'motdepasse',
            'placeholder' => 'Mot de passe',
            'class' => 'input-connection',
            'required' => 'required',
            'value' => get_value_null($post_a, 'motdepasse')
       ));

       echo form_input(array(
          'type' => 'text',
            'name'  => 'nom',
            'id'    => 'nom',
            'placeholder' => 'Nom',
            'class' => 'input-connection',
            'required' => 'required',
            'value' => get_value_null($post_a, 'nom')
       ));   

       echo form_input(array(
          'type' => 'text',
            'name'  => 'prenom',
            'id'    => 'prenom',
            'placeholder' => 'Prenom',
            'class' => 'input-connection',
            'required' => 'required',
            'value' => get_value_null($post_a, 'prenom')
       ));   

       echo form_input(array(
          'type' => 'text',
            'name'  => 'adresse',
            'id'    => 'adresse',
            'placeholder' => 'Adresse',
            'class' => 'input-connection',
            'required' => 'required',
            'value' => get_value_null($post_a, 'adresse')
       ));   

       echo form_input(array(
          'type' => 'text',
            'name'  => 'codepostal',
            'id'    => 'codepostal',
            'placeholder' => 'Code postal',
            'class' => 'input-connection',
            'required' => 'required',
            'value' => get_value_null($post_a, 'codepostal')
       ));   

       echo form_input(array(
          'type' => 'text',
            'name'  => 'ville',
            'id'    => 'ville',
            'placeholder' => 'Ville',
            'class' => 'input-connection',
            'required' => 'required',
            'value' => get_value_null($post_a, 'ville')
       ));   

       echo form_input(array(
          'type' => 'text',
            'name'  => 'telephonefixe',
            'id'    => 'telephonefixe',
            'placeholder' => 'Téléphone fixe',
            'class' => 'input-connection',
            'required' => 'required',
            'value' => get_value_null($post_a, 'telephonefixe')
       ));   

       echo form_input(array(
          'type' => 'text',
            'name'  => 'telephonemobile',
            'id'    => 'telephonemobile',
            'placeholder' => 'Téléphone mobile',
            'class' => 'input-connection',
            'required' => 'required',
            'value' => get_value_null($post_a, 'telephonemobile')
       ));    

       echo form_submit('submit', 'Creer un compte',array(
            'class' => 'button-connection'
       ));

       echo '<span class="text">Vous avez déjà un compte ?  <a class="link" href='.site_url('Visiteur/SeConnecter').'>Connectez vous.</a></span>';

       echo form_close();
   }
  }

  if ( ! function_exists('get_value_null')) {
     function get_value_null($v_array = array(), $key = '159') {
        if(array_key_exists($key, $v_array)) return $v_array[$key];
        else return null;
     }
   }

   if($this->input->post('submit') != null){
    $result_insert = $this->ModeleClient->insert_client($this->input->post());
    if(isset($result_insert)) afficher_form($this->input->post(), $result_insert);
    else redirect('Visiteur/SeConnecter');
   }else{
      afficher_form($this->input->post());
   }

?>