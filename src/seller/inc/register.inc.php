<?php

   function CheckEmailIfExists($conn){
      $SQL='SELECT email FROM profile_sellers WHERE email=:em';
      $pdo = $conn->prepare($SQL);
      $pdo->bindParam(':em',$_POST['email']);
      $pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      if( !empty($res) ){return 'Exists';}
      else{return 'continue';}
   }

   function CompleteRegistration($conn){
      $sql = "INSERT INTO profile_sellers(_id,firstName,lastName,email,password,shopName,phone,district,zip,address) VALUES(:id,:fn,:ln,:em,:ps,:sh,:ph,:ds,:zp,:ad)";
      $stmt = $conn->prepare($sql);
      $hashed = password_hash($_POST['password'],PASSWORD_DEFAULT);
      $stmt->bindParam(':fn',$_POST['firstName']);$stmt->bindParam(':ln',$_POST['lastName']);
      $stmt->bindParam(':em',$_POST['email']);$stmt->bindParam(':sh',$_POST['shopName']);
      $stmt->bindParam(':ph',$_POST['phone']);$stmt->bindParam(':ds',$_POST['district']);
      $stmt->bindParam(':zp',$_POST['zip']);$stmt->bindParam(':ad',$_POST['address']);
      $stmt->bindParam(':ps',$hashed);$stmt->bindParam(':id',$_POST['id']);
      try {$stmt->execute();
         if(!isset($_SESSION)){session_start();}
         $_SESSION['selStatus']='SignedIn';
         $_SESSION['selId'] = $_POST['id'];
         return 'Registered';
      }
      catch(\Throwable $th){return $th;}
   }

   require('../../inc/db.inc.php');
   $res = array('error' => false);
   $action =  null ;

   if (isset($_GET['action'])) {
      $action = $_GET['action'];
   }

   // if ($DHE4IBIe27 == 'MEJ7seUv0q') {
   //    $sql = "SELECT * FROM profile_sellers";
   //    $stmt = $conn->prepare($sql);
   //    $stmt->execute();
   //    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

   //    $users = array();

   //    if( !empty($result) ){
   //       //var_dump($result);
   //       foreach ($result as $row ) {
   //          array_push($users,$row);
   //       }
   //    }
   //    $res['users'] = $users;
   // }
   if( $action == 'comReg' ){
      $res = CompleteRegistration($conn);
   }else if ($action =='checkEmail') {
      $res = CheckEmailIfExists($conn);
   }

header("Content-type: application/json");
echo json_encode($res);
?>