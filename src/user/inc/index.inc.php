<?php
   function updateProfile($conn){
      $SQL="UPDATE `users` SET firstName=:fn,lastName=:ln,gender=:gn,updated_at=:upat WHERE _id=:id";
      $pdo=$conn->prepare($SQL);
      $pdo->bindParam(':fn',$_POST['firstName']);$pdo->bindParam(':ln',$_POST['lastName']);
      $pdo->bindParam(':gn',$_POST['gender']);$pdo->bindParam(':id',$_POST['_id']);
      $pdo->bindParam(':upat',$_POST['updated_at']);

      // $SQL2 = "SELECT * FROM `user_addresses` WHERE u_id=:u_id";
      // $pdo2 = $conn->prepare($SQL2);$pdo2->bindParam(':u_id',$_POST['_id']);
      // $pdo2->execute();$res = $pdo2->fetch(PDO::FETCH_ASSOC);
      // if(empty($res)){
      //    $SQL2="INSERT INTO `user_addresses`(street,city,state,zip,country,u_id) VALUES(:str,:ci,:st,:zi,:co,:u_id)";
      //    $pdo2=$conn->prepare($SQL2);
      //    $pdo2->bindParam(':str',$_POST['street']);$pdo2->bindParam(':ci',$_POST['city']);
      //    $pdo2->bindParam(':st',$_POST['state']);$pdo2->bindParam(':zi',$_POST['zip']);
      //    $pdo2->bindParam(':co',$_POST['country']);$pdo2->bindParam(':u_id',$_POST['_id']);
      //    $pdo2->execute();
      // }else{
         $SQL2="UPDATE `user_addresses` SET street=:str,city=:ci,state=:st,zip=:zi,country=:co WHERE u_id=:u_id";
         $pdo2=$conn->prepare($SQL2);
         $pdo2->bindParam(':str',$_POST['street']);$pdo2->bindParam(':ci',$_POST['city']);
         $pdo2->bindParam(':st',$_POST['state']);$pdo2->bindParam(':zi',$_POST['zip']);
         $pdo2->bindParam(':co',$_POST['country']);$pdo2->bindParam(':u_id',$_POST['_id']);
         $pdo2->execute();
      // }
      // $SQL2 = "SELECT * FROM `user_phones` WHERE u_id=:u_id";
      // $pdo2 = $conn->prepare($SQL2);$pdo2->bindParam(':u_id',$_POST['_id']);
      // $pdo2->execute();$res = $pdo2->fetch(PDO::FETCH_ASSOC);
      // if(empty($res)){
      //    $SQL2="INSERT INTO `user_phones`(phone,u_id) VALUES(:ph,:u_id)";
      //    $pdo2=$conn->prepare($SQL2);$pdo2->bindParam(':ph',$_POST['phone']);$pdo2->bindParam(':u_id',$_POST['_id']);
      //    $pdo2->execute();
      // }else{
         $SQL2="UPDATE `user_phones` SET phone=:ph WHERE u_id=:u_id";
         $pdo2=$conn->prepare($SQL2);$pdo2->bindParam(':ph',$_POST['phone']);$pdo2->bindParam(':u_id',$_POST['_id']);
         $pdo2->execute();
      //}
      $pdo->execute();
      return 'SUC';
   }
   function getPostCatName($conn,$id){
      $SQL = "SELECT title FROM product_categories WHERE _id=:id";
      $st = $conn->prepare($SQL);$st->bindParam(':id',$id);
      $st->execute();$mcat = $st->fetch(PDO::FETCH_COLUMN);
      return $mcat ;
   }
   function getPostSubCatName($conn,$id){
      $SQL = "SELECT title FROM product_sub_categories WHERE _id=:id";
      $st = $conn->prepare($SQL);$st->bindParam(':id',$id);
      $st->execute();$scat = $st->fetch(PDO::FETCH_COLUMN);
      return $scat ;
   }
   function getPostImages($conn,$id){
      $SQL = "SELECT src FROM imgur_images WHERE post_id=:pid";
      $st = $conn->prepare($SQL);$st->bindParam(':pid',$id);
      $st->execute();$src = $st->fetchAll(PDO::FETCH_COLUMN);
      return $src ;
   }
   function getItems($conn){
      $SQL = "SELECT * FROM posts WHERE queued=0 ORDER BY updated_at LIMIT 10";
      $pdo = $conn->prepare($SQL);
      $pdo->bindParam(':s_id', $_POST['id']);
      $pdo->execute();
      $r = $pdo->fetchAll(PDO::FETCH_ASSOC);
      if( !empty($r) ){
         foreach ($r as $i=>$k ) {
            $r[$i]['src'] = getPostImages($conn,$k['_id']);
            $r[$i]['mcat'] = getPostCatName($conn,$k['mcat_id']);
            $r[$i]['scat'] = getPostSubCatName($conn,$k['scat_id']);
         }
         return $r;
      }else{
         return 'No Post Found!';}}

   function initiateProfile($conn){
      if( isset($_SESSION['usStatus']) && $_SESSION['usStatus'] == 'SignedIn'){
         $SQL = "SELECT u._id,u.firstName,u.lastName,u.email,u.userName,u.date_of_birth,u.gender,u.pro_src,ua.street,ua.city,ua.state,ua.zip,ua.country,up.phone FROM users u INNER JOIN user_addresses ua ON u._id=ua.u_id INNER JOIN user_phones up ON u._id=up.u_id WHERE u._id= :id";
         $pdo = $conn->prepare($SQL);
         $pdo->bindParam(':id',$_SESSION['usId']);
         $pdo->execute();$res = $pdo->fetch(PDO::FETCH_OBJ);
         return $res ;
      }
      else{
         return 'SignedOut';
      }
   }
   function SignOutUser(){
      session_unset();session_destroy();
      return 'SignedOut';
   }
   function getSubCategories($conn,$id){
      $SQL = "SELECT title FROM user_sub_cats WHERE m_id=$id";
      $pdo = $conn->prepare($SQL);
      $pdo->execute();
      $res = $pdo->fetchAll(PDO::FETCH_COLUMN);
      if(!empty($res)){
         return $res;
      }else{
         return null;
      }
   }
   function getCategories($conn){
      $SQL = "SELECT * FROM user_main_cats";
      $stmt = $conn->prepare($SQL);
      $stmt->execute();
      $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if( !empty($r)){
         foreach( $r as $index => $val ){
            $sub = getSubCategories($conn,$val['_id']);
            if( $sub != null ){
               $r[$index]['sub']=$sub;
            }else{
               $r[$index]['sub']=[];
            }
         }
         //var_dump($r);
         return $r;
      }else{
         return null;}}


   ob_start();
   if(!isset($_SESSION)){session_start();}
   require('../../inc/db.inc.php');
   $res = array('err' => false);
   $a =  null ;
   if( isset($_GET['action'])){
      $a = $_GET['action'];
   }
   switch ($a) {
      case 'getCats':
         $r = getCategories($conn);
         if( $r != null ){$res['err'] = false;$res['cats'] = $r;}
         else{$res['err'] = true ;}break;
      case 'initiateProfile':
         $res = initiateProfile($conn);
         break;
      case 'signout':
         $res = SignOutUser();
         break;
      case 'getItems':
         $res = getItems($conn);
         break;
      case 'updateProfile':
         $res = updateProfile($conn);
         break;
      default:
         break;
   }

header("Content-type: application/json");
echo json_encode($res);
$conn=null;