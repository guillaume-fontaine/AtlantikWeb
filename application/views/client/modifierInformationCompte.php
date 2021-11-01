<?php

  if ( ! function_exists('afficher_form')) {
     function afficher_form($post_a = array(), $error_message = null) {
       echo form_open('', 'class="form-connection" id="connection"');

       echo '<span class="item-title"><h2></br>Modifier des informations</h2></span>'; 

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
            'name'  => 'password',
            'id'    => 'password',
            'placeholder' => 'Mot de passe actuel',
            'class' => 'input-connection',
            'required' => 'required'
       ));   

       echo form_password(array(
          'type' => 'password',
            'name'  => 'motdepasse',
            'id'    => 'motdepasse',
            'placeholder' => 'Nouveau mot de passe (Non obligatoire)',
            'class' => 'input-connection'
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

       echo form_submit('submit', 'Modifer les informations',array(
            'class' => 'button-connection'
       ));

       echo form_close();
   }
  }

  if ( ! function_exists('get_value_null')) {
     function get_value_null($v_array = array(), $key = '159') {
        return $v_array->userdata($key);
     }
   }

   if($this->input->post('submit') != null){

    $result = $this->ModeleClient->get_user_noclient($this->session->noclient, $this->input->post('password'));
    if(count($result) == 0){
      afficher_form($this->session, 'Le mot de passe est incorrect');
    }else if(count($result) == 1){
      $result_insert = $this->ModeleClient->update_client($this->input->post());
      if(isset($result_insert)) afficher_form($this->session, $result_insert);
      else {        
        $this->session->log = true;
        $this->session->set_userdata(json_decode(json_encode($this->ModeleClient->get_user_noclient($this->session->noclient, $this->input->post('password'))[0]),true));
        redirect('Visiteur/');
      }
    }else{
      afficher_form($this->session, 'Un problème est survenue');
    }
    //$result_insert = $this->ModeleClient->insert_client($this->input->post());
    //if(isset($result_insert)) afficher_form($this->input->post(), $result_insert);
    //else redirect('Visiteur/SeConnecter');
   }else{
      afficher_form($this->session);
   }

?>