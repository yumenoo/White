<?php
require("head.php");
require("./core/config.php");
?>

<title>ブログ一覧</title>


<!-- ページ毎にtitleとdescriptionを打ち替える -->
<meta property="og:url" content="https://kobewhiteningnavi.com/blog.html" />
<meta property="og:type" content="website" />
<meta property="og:title" content="ブログ一覧" />
<meta property="og:description" content="KOBEホワイトニングのブログ一覧です。" />
<meta property="og:image" content="https://kobewhiteningnavi.com/img/top_pc.jpg" />


</head>



<body>
<div class="wrap">
 <?php
 require("nav.php");
 ?>

<div class="box">
			<?php
			require("top_photo.php");
			?>
			<div class="box-center-t text-center">
				<h3 class="mt-3 white text-shadow">ブログ一覧</h3>
				<img src="./img/logo_top.png" class="img-fluid
				pcsize" alt="">
				</div>
			</div>

		</div>

<div>
		<section class="container text-center mt-5">

			<div class="row">
<?php
$sql="select*from post where cate like '%003%' order by date DESC";
$stmt=$dbh->query($sql);
$result=$stmt->fetchAll(PDO::FETCH_BOTH);
foreach($result as $row):
$row['code']=str_pad($row['code'],'7','0',STR_PAD_LEFT);

$article=strip_tags($row['article']);
$article=mb_substr($article,0,70,"UTF-8")." ...";
?>
				<div class="col-md-3">
					<div class="card mt-5">
					<a href="./blog_post_<?=$row['code']?>.html"><img src="./eyecatch/<?=$row['code']?>_thumb.jpg" class="card-img-top" alt="..." width="80%"></a>

						<h4 class="card-title m-0"><?=$row['title']?></h4>

						<h8 class="card-text"><?=$article?></h8>
						<div class="card-body">
							<a href="./blog_post_<?=$row['code']?>.html" class="btn btn-color mb-5">もっと見る</a>
						</div>
					</div>
				</div>
<?php endforeach;?>

			</div>



		</section>


 </div>





<?php
require("footer.php");
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</div>
</body>

</html>
