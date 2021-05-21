<div class="col-sm-3">
<a href="blog.html" class="btn btn-sm btn-block bg-navy text-white mb-3">ブログ TOP</a>


<?php
$sql = "select * from post where code!='$_GET[code]' and cate like '%003%' order by date DESC limit 5";
$stmt=$dbh->query($sql);
$result=$stmt->fetchAll(PDO::FETCH_BOTH);


foreach($result as $row):
$row['code']=str_pad($row['code'],'7','0',STR_PAD_LEFT);
$img_url="";
$img="";

$article=strip_tags($row['article']);
$article=mb_substr($article,0,70,"UTF-8")." ...";


$img_url="eyecatch/$row[code].jpg";
if(is_file($img_url)){$img=$img_url;}

$img_url="eyecatch/$row[code].png";
if(is_file($img_url)){$img=$img_url;}

$img_url="eyecatch/$row[code].gif";
if(is_file($img_url)){$img=$img_url;}

if(empty($img)){$img="eyecatch/0_eye.png";}

$cate=$cate_list[$row['cate']];
list($date)=explode(" ",$row['date']);
?>
<div>
<small><?=$cate?><?=$date?></small>
<div class="mb-2">
<a href="blog_post_<?=$row['code']?>.html"><img src="<?=$img?>" class="img-fluid"></a>
</div>
<div class="mb-2"><a href="blog_post_<?=$row['code']?>.html" style="color:#3B4D7C;"><?=$row['title']?></a></div>
</div>

<div><small><?=$article?></small></div>
<hr>

<?php endforeach; ?>


</div>
