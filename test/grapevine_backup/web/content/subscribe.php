<?php
  $apiKey         = '348c5684ff91775a0d0398e300e79190-us3'; // Edit me
  $listId         = '1c04a1e916'; // Edit me
  $double_optin   = true;
  $send_welcome   = true;
  $email_type     = 'html';
  $email          = $_POST['email'];
  $fname          = $_POST['fname'];
  $lname          = $_POST['lname'];

  // Replace us8 with your datacentre, usually found at end of api key
  $submit_url     = "http://us3.api.mailchimp.com/1.3/?method=listSubscribe";

  $data = array(
      'email_address'=>$email,
      'merge_vars' => array('FNAME'=>$fname, 'LNAME'=>$lname),
      'apikey'=>$apiKey,
      'id' => $listId,
      'double_optin' => $double_optin,
      'send_welcome' => $send_welcome,
      'email_type' => $email_type
  );
  $payload = json_encode($data);
   
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $submit_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));
   
  $result = curl_exec($ch);
  curl_close ($ch);
  $data = json_decode($result);

  if ($data->error){
    echo '<p>'.$data->error.'</p>';
  } else {
    echo "<p>Thanks, confirmation on its way!</p>";
  }
?>