<?php
  // Login Facebook
  require_once( 'Facebook/autoload.php' );
  require_once( 'fb-connect.php' );
  include_once('../../../wp-load.php');


  $helper = $fb->getRedirectLoginHelper();

  if (isset($_GET['state'])) {
      $helper->getPersistentDataHandler()->set('state', $_GET['state']);
  }

  try {
    $accessToken = $helper->getAccessToken();
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  if (! isset($accessToken)) {
    if ($helper->getError()) {
      header('HTTP/1.0 401 Unauthorized');
      echo "Error: " . $helper->getError() . "\n";
      echo "Error Code: " . $helper->getErrorCode() . "\n";
      echo "Error Reason: " . $helper->getErrorReason() . "\n";
      echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
      header('HTTP/1.0 400 Bad Request');
      echo 'Bad request';
    }
    exit;
  }
  // Logged in
  $me = $response->getGraphUser();

  if(!empty($me['email'])){
    $isEmailExists = email_exists($me['email']);
    $input['email'] = $me['email'];
    $input['password'] = $me['email'];
    
    if ($isEmailExists === false) {
      setcookie("ulg", secured_encrypt($input), time() + (86400 * 30), "/"); // 86400 = 1 day;
    }
  }
  
?>

<script>
if (window.location.hostname === 'localhost') {
    location.href = window.location.origin+'/opal/register2';
  } else {
    location.href = window.location.origin+'/register2';
  }
</script>