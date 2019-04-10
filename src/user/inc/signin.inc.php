<?php
if(!isset($_SESSION)){session_start();}
ob_start();

   function checkUserNameAndEmail( $conn ){
      $em_or_un=$_POST['em_or_un'];$ps=$_POST['password'];
      $SQL = "SELECT _id,userName,email,password FROM users WHERE userName=:un OR email=:em";
      $pdo = $conn->prepare($SQL);
      $pdo->bindParam(':un',$em_or_un);
      $pdo->bindParam(':em',$em_or_un);
      $pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_OBJ);
      if( !empty($res) ){
         if($res->userName==$em_or_un || $res->email == $em_or_un){
            if( password_verify($ps,$res->password) ){
               if(!isset($_SESSION)){session_start();}
               $_SESSION['usStatus']='SignedIn';
               $_SESSION['usId'] = $res->_id;
               return 'SignedIn';
            }else{
               return 'wrongPass';
            }
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
      if( isset($_SESSION['usStatus']) && $_SESSION['usStatus'] == 'SignedIn'){
         $res['err'] = false ;$res['mess'] = 'Signedin';}
      else{$res['err'] = true ;$res['mess'] = 'SignedOut';}}

   // ISSET ACTION = SIGNIN USER
   else if ($action == 'signin') {
      $res = checkUserNameAndEmail($conn);
   }

header("Content-type: application/json");
echo json_encode($res);
$conn=null;
?>