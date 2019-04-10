<?php
if(!isset($_SESSION)){session_start();}
ob_start();
require('../../inc/db.inc.php');
$res = array('err' => false);

   $action = null ;
   if( isset($_GET['action']) ){
      $action = $_GET['action'];
   }

   // On Created 
   // Ckecking if already signed in
   if( $action == 'CheckStatus'){
      if( isset($_SESSION['adst']) && $_SESSION['adst'] == 'sin'){
         $res['err'] = false ;
         $res['mess'] = 'Signedin';
      }else{
         $res['err'] = true ;
         $res['mess'] = 'SignedOut';
      }
   }

   // ISSET ACTION = SIGNIN USER
   else if ($action == 'SigninAdmin') {
      $sql = "SELECT userName,password FROM auth WHERE userName = :usr";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':usr',$_POST['userName']);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);

      if( !empty($result)){
         $passCheck = password_verify($_POST['password'],$result->password);
         if( $passCheck == false ){
            $res['err'] = true;
            $res['mess'] = 'Invalid username or password';
         }else{
            if(!isset($_SESSION)){session_start();}
            $_SESSION['adst'] = 'sin';
            $res['err'] = false;
            $res['mess'] = 'SignedIn';
         }
      }else{
         $res['err'] = true;
         $res['mess'] = 'User Not Found!';
      }
   }

header("Content-type: application/json");
echo json_encode($res);
$conn=null;
?>