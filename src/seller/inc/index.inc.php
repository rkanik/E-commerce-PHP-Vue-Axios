<?php

   function getSellerStatus($conn){
      if(isset($_SESSION['selStatus']) && $_SESSION['selStatus'] == 'SignedIn'){
         $SQL = "SELECT * FROM profile_sellers WHERE _id=:id";
         $pdo = $conn->prepare($SQL);
         $pdo->bindParam(':id',$_SESSION['selId']);
         $pdo->execute();
         $res = $pdo->fetch(PDO::FETCH_OBJ);
         if(!empty($res)){
            return array('st'=>'SignedIn','data'=>$res);
         }else{
            return 'SomethingWrong';
         }
      }else{
         return 'SignedOut';}}
   function getRecentPosts( $conn ){
      $SQL = "SELECT * FROM posts WHERE seller_id=:s_id AND queued=0 ORDER BY updated_at LIMIT 10";
      $pdo = $conn->prepare($SQL);
      $pdo->bindParam(':s_id', $_POST['id']);
      $pdo->execute();
      $r = $pdo->fetchAll(PDO::FETCH_ASSOC);
      if( !empty($r) ){
         foreach ($r as $i=>$k ) {
            $SQL = "SELECT * FROM imgur_images WHERE post_id=:pid";
            $st = $conn->prepare($SQL);
            $st->bindParam(':pid',$k['_id']);
            $st->execute();
            $src = $st->fetchAll(PDO::FETCH_OBJ);
            $r[$i]['src'] = $src;
         }
         return $r;
      }else{
         return 'No Post Found!';}}
   function getQueuedPost( $conn ){
      $seller_id = $_POST['sid'];
      $SQL="SELECT * FROM posts WHERE seller_id='$seller_id' AND queued=1";
      $st=$conn->prepare($SQL);
      $st->execute();
      $r = $st->fetchAll(PDO::FETCH_ASSOC);
      if( !empty($r) ){
         //$srcArr = array(); 
         foreach ($r as $i=>$k ) {
            $SQL = "SELECT * FROM imgur_images WHERE post_id=:pid";
            $st = $conn->prepare($SQL);
            $st->bindParam(':pid',$k['_id']);
            $st->execute();
            $src = $st->fetch(PDO::FETCH_OBJ);
            $r[$i]['src'] = $src->src;
            //array_push($srcArr,$src->src);
         }
         return $r;
      }else{return null;}}
   function saveImageSrc($conn){
      $strSrc = $_POST['imgSrc'];
      $pid = $_POST['_id'];
      $srces = explode(',',$strSrc);
      foreach ($srces as $src) {
         $SQL = "INSERT INTO imgur_images(post_id,src) VALUES('$pid','$src')";
         $conn->exec($SQL);
      }
      return 'Inserted';}
   function savePost( $conn ){
      $SQL = "INSERT INTO posts(_id,mcat_id,scat_id,seller_id,pName,price,a_price,pDesc,updated_at)
      VALUES(:_id,:mcat_id,:scat_id,:sel_id,:n,:price,:a_price,:d,:udp_at)";
      $stmt = $conn->prepare($SQL);
      $stmt->bindParam(':_id',$_POST['_id']);
      $stmt->bindParam(':mcat_id',$_POST['mcat_id']);
      $stmt->bindParam(':scat_id',$_POST['scat_id']);
      $stmt->bindParam(':sel_id',$_POST['seller_id']);
      $stmt->bindParam(':n',$_POST['name']);
      $stmt->bindParam(':price',$_POST['price']);
      $stmt->bindParam(':a_price',$_POST['a_price']);
      $stmt->bindParam(':d',$_POST['desc']);
      $stmt->bindParam(':udp_at',$_POST['udp_at']);
      $stmt->execute();
      return 'Inserted';}
   function getProductSubCategories( $conn ){
      $title = $_POST['title'];
      $SQL = "SELECT * FROM product_categories WHERE title=:t";
      $stmt = $conn->prepare($SQL);
      $stmt->bindParam(':t',$title);
      $stmt->execute();
      $res = $stmt->fetch(PDO::FETCH_OBJ);
      if( !empty($res)){
         $id = $res->_id;
         $SQL = "SELECT * FROM product_sub_categories WHERE pc_id=$id";
         $stmt = $conn->prepare($SQL);
         $stmt->execute();
         $r = $stmt->fetchAll(PDO::FETCH_OBJ);
         if( !empty($r)){
            return $r;
         }else{
            return null;
         }
      }else{
         return null;}}
   function getProductCategories( $conn ){
      $SQL = "SELECT * FROM product_categories";
      $stmt = $conn->prepare($SQL);
      $stmt->execute();
      $r = $stmt->fetchAll(PDO::FETCH_OBJ);
      if( !empty($r)){
         return $r;
      }else{
         return null;}}
   function getCategories($conn){
      $SQL = "SELECT * FROM seller_cats";
      $stmt = $conn->prepare($SQL);
      $stmt->execute();
      $r = $stmt->fetchAll(PDO::FETCH_OBJ);
      if( !empty($r)){
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
      case 'getPCats':
         $r = getProductCategories($conn);
         if( $r != null ){$res['err'] = false;$res['pcats'] = $r;}
         else{$res['err'] = true ;}break;
      case 'getPSCats':
         $r = getProductSubCategories($conn);
         if( $r != null ){$res['err'] = false;$res['pcsats'] = $r;}
         else{$res['err'] = true ;}break;
      case 'savePost':
         $res['pmess'] = savePost($conn);
         $res['smess'] = saveImageSrc($conn );
         break;
      case 'queuedPost':
         $res['mess'] = getQueuedPost($conn);
         break;
      case 'getRecentPosts':
         $res['mess'] = getRecentPosts($conn);
         break;
      case 'getStatus':
         $res = getSellerStatus($conn);
         break;
      case 'signout':
         session_unset();session_destroy();
         $res = 'SignedOut';
         break;
         default:
         $res['err'] = true ;
         break;
   }

   header("Content-type: application/json");
   echo json_encode($res);
   $conn=null;
?>