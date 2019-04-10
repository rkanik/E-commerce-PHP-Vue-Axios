<?php
if(!isset($_SESSION)){session_start();}
ob_start();

   function checkEmail( $conn ){
      $email=$_POST['email'];$ps=$_POST['password'];
      $SQL = "SELECT _id,email,password FROM profile_sellers WHERE email=:em";
      $pdo = $conn->prepare($SQL);
      $pdo->bindParam(':em',$email);
      $pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_OBJ);
      if( !empty($res) ){
         if( password_verify($ps,$res->password) ){
            if(!isset($_SESSION)){session_start();}
            $_SESSION['selStatus']='SignedIn';
            $_SESSION['selId'] = $res->_id;
            return 'SignedIn';
         }else{
            return 'wrongPass';
         }
      }else{return 'userNotFound';}}

   require('../../inc/db.inc.php');
   $res = array('err' => false);

   $action = null ;
   if( isset($_GET['action']) ){
      $action = $_GET['action'];
   }

   // On Created 
   // Ckecking if already signed in
   if( $action == 'checkStatus'){
      if( isset($_SESSION['selStatus']) && $_SESSION['selStatus'] == 'SignedIn'){
         $res['err'] = false ;$res['mess'] = 'Signedin';}
      else{$res['err'] = true ;$res['mess'] = 'SignedOut';}}

   // ISSET ACTION = SIGNIN USER
   else if ($action == 'signin') {
      $res = checkEmail($conn);
   }

header("Content-type: application/json");
echo json_encode($res);
$conn=null;
?>