<?php
require_once("head.php");
require("./core/config.php");
require("info.php");

// このページのURL
$http = empty($_SERVER["HTTPS"]) ? "http://" : "https://";
$domain=$http.$_SERVER["HTTP_HOST"];
$page_url=$http.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];



$img_url="eyecatch/$_GET[code].jpg";
if(is_file($img_url)){$img=$img_url;}

$img_url="eyecatch/$_GET[code].png";
if(is_file($img_url)){$img=$img_url;}

$img_url="eyecatch/$_GET[code].gif";
if(is_file($img_url)){$img=$img_url;}

if(empty($img)){$img="";}



try{
$sql = 'select * from category_post';
$stmt=$dbh->query($sql);
$result=$stmt->fetchAll(PDO::FETCH_BOTH);

foreach($result as $row){
$cate_list[$row['cate_code']]=$row['cate_name'];
}


}catch(Exception $e){
print "エラー : ".htmlspecialchars($e->getMessage(),ENT_QUOTES,"UTF-8");
die();
}



if($_GET['code']){

  try{
    $sql = "select*from post where code='$_GET[code]'";
    $stmt=$dbh->query($sql);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

    $row['code']=str_pad($row['code'],'7','0',STR_PAD_LEFT);
    $code=htmlspecialchars_decode($row['code']);
    $cate=htmlspecialchars_decode($row['cate']);
    $title=htmlspecialchars_decode($row['title']);
    $article=$row['article'];
    $date=htmlspecialchars_decode($row['date']);
    list($date)=explode(" ",$date);
    $contributor=$row['contributor'];

    $og_description=strip_tags($row['article']);
    $og_description=mb_substr($og_description,0,70,"UTF-8")." ...";

  }catch(Exception $e){

    print "エラー : ".htmlspecialchars($e->getMessage(),ENT_QUOTES,"UTF-8");
    die();

  }

}
?>
<!-- OGP -->
<meta property="og:title" content="<?=$title?>">
<meta property="og:type" content="article" />
<meta property="og:url" content="<?=$page_url?>">
<meta property="og:image" content="<?=$domain?>/<?=$img?>">
<meta property="og:site_name"  content="<?=$site_name?>" />
<meta property="og:description" content="<?=$og_description?>">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?=$title?>" />
<meta name="twitter:url" content="<?=$page_url?>" />
<meta name="twitter:description" content="<?=$og_description?>" />
<meta name="twitter:image" content="<?=$domain?>/<?=$img?>" />

<title><?=$title?> | <?=$site_name?></title>
<style>
.post p{font-size:0.9rem;line-height:180%;letter-spacing:0.1rem;}
.post h4{color:#3B4D7C;font-size:120%;line-height:150%;margin-bottom:1.5rem;}
.post a{color:#D368B2;}
.post a:hover{color:#0d6efd;}
.post img{max-width:100%;height:auto;}
</style>
</head>
<body>
<?php
require_once("nav.php");
?>
<div class="container pt-4">


<div class="row">

<div class="col-sm-9 mb-5">

<h3><?=$title?></h3>
 <div class="border-b pb-2"></div>
 <div>
 	<p style="font-size:0.7rem;">By KOBEホワイトニング Posted <?=$date?></p>
 </div>

<?php
$img_url="eyecatch/$row[code].jpg";
if(is_file($img_url)){$img=$img_url;}

$img_url="eyecatch/$row[code].png";
if(is_file($img_url)){$img=$img_url;}

$img_url="eyecatch/$row[code].gif";
if(is_file($img_url)){$img=$img_url;}

if(empty($img)){$img="";}


if(is_file($img)){
print<<<DISP
<img src="$img" class="mb-3 img-fluid">
DISP;
}
?>


<div class="mt-5 post mb-5">
<?=$article?>
</div>


<?php
if(!empty($contributor)){

  $sql = "select*from staff where code='$contributor'";
  $stmt=$dbh->query($sql);
  $staff=$stmt->fetch(PDO::FETCH_ASSOC);

  print<<<DISP
  <div class="border-b-d"></div>

  <div class="row">
    <div class="col-md-2 p-2 text-center">
      <img src="staff/{$contributor}_2.jpg" class="img-fluid pcsize" style="border-radius:50%;" alt="">
      <img src="staff/{$contributor}_2.jpg" class="img-fluid spsize" style="border-radius:50%; width:80%;" alt="">
    </div>

    <div class="col-md-10 p-2 pcsize">
      <h5>$staff[position]</h5>
      <h5>$staff[extra01]</h5>
      <h5>$staff[staff_name] $staff[extra02]</h5>
    </div>

    <div class="col-md-10 p-2 spsize text-center">
      <h5>$staff[position]</h5>
      <h5>$staff[extra01]</h5>
      <h5>$staff[staff_name] $staff[extra02]</h5>
    </div>

  </div>

  <div class="border-b-d"></div>
  DISP;
  }
?>

<div class="mt-5">
				<a href="./blog.html">
				<div class="border-tb py-2 w-40 text-center">
					<h5 class="m-0">ブログ一覧へ　▶︎</h5>
				</div>
				</a>
			</div>

</div>

<?php
require_once("blog_post_side.php");
?>



</div>



</div>
<?php
require("footer.php");
?>
