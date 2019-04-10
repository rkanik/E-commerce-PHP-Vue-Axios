<?php
if(!isset($_SESSION)){session_start();}
ob_start();

   function checkUserNameAndEmail( $conn ){
      $un=$_POST['userName'];$em=$_POST['email'];
      $SQL = "SELECT userName,email FROM users WHERE userName=:un OR email=:em";
      $pdo = $conn->prepare($SQL);
      $pdo->bindParam(':un',$un);
      $pdo->bindParam(':em',$em);
      $pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_OBJ);
      if( !empty($res) ){
         if( $res->userName == $un ){return 'dun';}
         else if( $res->email == $em ){return 'dem';}
      }
   }
   function registerUser($conn){
      $SQL = "INSERT INTO users(_id,firstName,lastName,email,userName,password) VALUES(:id,:fn,:ln,:em,:un,:ps)";
      $hashedP = password_hash($_POST['password'],PASSWORD_DEFAULT);
      $pdo = $conn->prepare($SQL);
      $pdo->bindParam(':id',$_POST['id']);$pdo->bindParam(':fn',$_POST['firstName']);
      $pdo->bindParam(':ln',$_POST['lastName']);$pdo->bindParam(':em',$_POST['email']);
      $pdo->bindParam(':un',$_POST['userName']);$pdo->bindParam(':ps',$hashedP);
      try {
         $SQL2 = "INSERT INTO user_addresses(u_id) VALUES(:id)";
         $pdo2 = $conn->prepare($SQL2);$pdo2->bindParam(':id',$_POST['id']);
         $pdo2->execute();
         $SQL2 = "INSERT INTO user_phones(u_id) VALUES(:id)";
         $pdo2 = $conn->prepare($SQL2);$pdo2->bindParam(':id',$_POST['id']);
         $pdo2->execute();
         $pdo->execute();
         return 'Registered';
      } catch (\Throwable $th) {
         return $th;
         return checkUserNameAndEmail($conn);}}

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
         $res['err'] = false ;
         $res['mess'] = 'Signedin';
      }else{
         $res['err'] = true ;
         $res['mess'] = 'SignedOut';
      }
   }

   // On Created 
   // Ckeck for userName and email if exist
   if( $action == 'register'){
      $r = registerUser($conn);
      if($r == 'Registered' ){
         if(!isset($_SESSION)){session_start();}
         $_SESSION['usStatus']='SignedIn';
         $_SESSION['usId'] = $_POST['id'];
         $res = $r;
      }else{
         $res = $r;
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