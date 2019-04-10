<?php
   function initiateDashboard($conn){
      $data = array();

      $q = "SELECT COUNT(created_at) FROM `profile_sellers`";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['t_sel'] = $res;

      $q = "SELECT COUNT(created_at) FROM `users`";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['t_user'] = $res;

      $q = "SELECT COUNT(_id) FROM `posts` WHERE queued=0";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['t_post'] = $res;

      $q = "SELECT SUM(price) as price,SUM(ordered) as ordered,SUM(a_price) AS a_price,SUM(d_price) as d_price FROM posts WHERE ordered>0 AND queued=0";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_OBJ);
      $t_earn = null;
      if($res->d_price<=0){$t_earn = $res->price*$res->ordered;}
      else{$t_earn = $res->d_price*$res->ordered;}
      $data['t_earnd'] = $t_earn;
      $t_rev = $t_earn - ($res->a_price*$res->ordered);
      $data['t_rev'] = number_format((float)$t_rev, 2, '.', '');
      $data['t_rev_com'] = number_format((float)(($t_rev/100)*30), 2, '.', '');
      $data['t_rev_sel'] = number_format((float)(($t_rev/100)*70), 2, '.', '');

      $q = "SELECT SUM(ordered) FROM `posts`";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['t_selled'] = $res;

      $q = "SELECT COUNT(_id) FROM `posts` WHERE d_price>0";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['t_off'] = $res;

      $q = "SELECT COUNT(_id) FROM `posts` WHERE queued=1";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['t_queued'] = $res;

      $q = "SELECT COUNT(created_at) FROM `profile_sellers` WHERE `created_at`>=DATE_SUB(NOW(), INTERVAL 1 DAY)";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['seller_today'] = $res;

      $q = "SELECT COUNT(created_at) FROM `users` WHERE `created_at`>=DATE_SUB(NOW(), INTERVAL 1 DAY)";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['user_today'] = $res;

      $q = "SELECT COUNT(created_at) FROM `posts` WHERE `created_at`>=DATE_SUB(NOW(), INTERVAL 1 DAY)";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['post_today'] = $res;

      $q = "SELECT COUNT(created_at) FROM `posts` WHERE `created_at`>=DATE_SUB(NOW(), INTERVAL 1 DAY) AND ordered>0";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['sell_today'] = $res;

      return $data;
   }
   function getSellerCounts($conn){
      $data = array();

      $q = "SELECT COUNT(created_at) FROM `profile_sellers`";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['inTotal'] = $res;

      $q = "SELECT COUNT(created_at) FROM `profile_sellers` WHERE `created_at`>=DATE_SUB(NOW(), INTERVAL 1 DAY)";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['inDay'] = $res;

      $q = "SELECT COUNT(created_at) FROM `profile_sellers` WHERE `created_at`>=DATE_SUB(NOW(), INTERVAL 1 WEEK )";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['inWeek'] = $res;

      $q = "SELECT COUNT(created_at) FROM `profile_sellers` WHERE `created_at`>=DATE_SUB(NOW(), INTERVAL 1 MONTH)";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['inMonth'] = $res;

      $q = "SELECT COUNT(created_at) FROM `profile_sellers` WHERE `created_at`>=DATE_SUB(NOW(), INTERVAL 1 YEAR)";
      $pdo= $conn->prepare($q);$pdo->execute();
      $res = $pdo->fetch(PDO::FETCH_COLUMN);
      $data['inYear'] = $res;

      return $data;}
   function getSellersInfo($conn){
      $SQL = "SELECT * FROM profile_sellers LIMIT 10";
      $pdo = $conn->prepare($SQL);
      $pdo->execute();
      $res = $pdo->fetchAll(PDO::FETCH_OBJ);
      if(!empty($res)){
         return $res;
      }else{
         return 'Noting Found';}}
   function acceptQueuedPost( $conn ){
      $id = $_POST['id'];
      $SQL = "UPDATE posts SET queued=0 WHERE _id='$id'";
      $conn->exec($SQL);
      return 'Updated';}
   function getQueuedPost( $conn ){
      $SQL="SELECT * FROM posts WHERE queued=1 ORDER BY created_at asc";
      $st=$conn->prepare($SQL);
      $st->execute();
      $r = $st->fetchAll(PDO::FETCH_ASSOC);
      if( !empty($r) ){
         foreach ($r as $i=>$k ) {
            $SQL = "SELECT * FROM imgur_images WHERE post_id=:pid";
            $st = $conn->prepare($SQL);
            $st->bindParam(':pid',$k['_id']);
            $st->execute();
            $src = $st->fetchAll(PDO::FETCH_OBJ);
            $r[$i]['src'] = $src;

            $mcat_id = $k['mcat_id'];
            $SQL = "SELECT title FROM product_categories WHERE _id=$mcat_id";
            $pdo = $conn->prepare($SQL);$pdo->execute();
            $res = $pdo->fetch(PDO::FETCH_OBJ);
            $r[$i]['Cat'] = $res->title ;

            $scat_id = $k['scat_id'];
            $SQL = "SELECT title FROM product_sub_categories WHERE _id=$scat_id";
            $pdo = $conn->prepare($SQL);$pdo->execute();
            $res = $pdo->fetch(PDO::FETCH_OBJ);
            $r[$i]['subCat'] = $res->title ;
         }
         return $r;
      }else{return null;}}
   function getSubCategories($conn,$id){
      $SQL = "SELECT * FROM user_sub_cats WHERE m_id=$id";
      $stmt = $conn->prepare($SQL);
      $stmt->execute();
      $r = $stmt->fetchAll(PDO::FETCH_OBJ);
      if( !empty($r)){
         return $r ;
      }else{
         return null ;}}
   function getCategories($conn){
      $SQL = "SELECT * FROM user_main_cats";
      $stmt = $conn->prepare($SQL);
      $stmt->execute();
      $r = $stmt->fetchAll(PDO::FETCH_OBJ);
      if( !empty($r)){
         return $r;
      }else{
         return null;}}
   function addCategory($conn){
      $title = $_POST['title'];$class = $_POST['fo_aw_class'];
      $SQL = "INSERT INTO main_categories(title,fo_aw_class) VALUES('$title','$class')";
      try {$conn->exec($SQL);return 'Inserted';}catch (PDOException $e) {return 'InsertionError';}}
   function addSubCategory($conn){
      $mName = $_POST['mName'];
      $SQL = "SELECT * FROM main_categories WHERE title = '$mName'";
      $stmt = $conn->prepare($SQL);
      $stmt->execute();
      $res = $stmt->fetch(PDO::FETCH_OBJ);
      if( !empty($res) ){
         $subs = $_POST['titles'];
         $arr = explode(',',$subs);
         $m_id = $res->_id;
         foreach( $arr as $sub ) {
            $SQL = "INSERT INTO sub_categories(title,m_id) VALUES('$sub','$m_id')";
            $conn->exec($SQL);
         }
         return 'Inserted';
      }else{
         echo 'null';}}

   ob_start();
   session_start();
   require('../../inc/db.inc.php');
   $res = array('err' => false);
   $a =  null ;
   if( isset($_GET['action'])){
      $a = $_GET['action'];
   }
   switch ($a) {
      case'getCats':$r=getCategories($conn);if($r!=null){$res['err']=false;$res['cats']=$r;}else{$res['err']=true;}break;case'getSubCats':$r=getSubCategories($conn,$_GET['id']);if($r!=null){$res['err']=false;$res['subs']=$r;}else{$res['err']=true;}break;case'addUserCat':$r=addCategory($conn);if($r=='Inserted'){$res['err']=false;$res['mess']=$r;}else{$res['err']=true;$res['mess']=$r;}break;case'addUserSubCat':$r=addSubCategory($conn);$res['mess']=$r;break;case'queuedPost':$res['mess']=getQueuedPost($conn);break;case'acceptPost':$res['mess']=acceptQueuedPost($conn);break;
      case 'CheckStatus':
         if( isset($_SESSION['adst']) && $_SESSION['adst'] == 'sin'){
            $res['err'] = false ;
            $res['mess'] = 'Signedin';
         }else{
            $res['err'] = true ;
            $res['mess'] = 'SignedOut';
         }
         break;
      case 'SignOut':
         session_unset();
         session_destroy();
         $res['mess'] = 'SignedOut';
         break;
      case 'getSellers':
         $res = getSellersInfo($conn);
         break;
      case 'getSellerCounts':
         $res = getSellerCounts($conn);
         break;
      case 'initiateDashboard':
         $res['data'] = initiateDashboard($conn);
         if( $res['data'] != null ){
            $res['s'] = true ; 
         }
         break;
      default:
         $res['err'] = true ;
         break;
   }
       
   header("Content-type: application/json");
   echo json_encode($res);
?>