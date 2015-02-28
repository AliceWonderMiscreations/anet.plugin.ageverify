<?php
require_once('site.configuration.inc.php');
header('Content-Type: text/plain');
if(isset($_POST['csrf'])) {
  $token = $_POST['csrf'];
  if(isset($_SESSION['csrfkey'])) {
    $key = $_SESSION['csrfkey'];
    if(validateCSRF($pdo, $key, $token)) {
      $_SESSION['anet.agev'] = 'true';
    }
  }
}
print('success');
exit
?>