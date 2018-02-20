<?php
require "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>XXX - Video</title>
</head>
<section style="width:100%;">
	<?php	
	if(isset($_GET['v'])){
		$id = $_GET['v'];
	}
		$sql = $pdo->prepare("SELECT * FROM video WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
		
		if($sql->rowCount() > 0) {
			$videos = $sql->fetchAll();
		}
		
		foreach($videos as $video):
	?>
    	<h3><?php echo $video['titulo']; ?></h3>
        <video src="assets/videos/<?php echo $video['url']; ?>" controls></video>
        <h5><?php echo utf8_encode($video['descricao']); ?></h5>
        <h6>Views: <?php echo str_replace(",",".",number_format($video['views'])); ?></h6>
        <h6>Like: <?php echo $video['like']; ?> - Dislike: <?php echo $video['dislike']; ?></h6>
        <h6>Atriz Principal: <?php echo $video['atriz']; ?></h6>
        <h6>Categoria: <?php echo str_replace(",",", ",$video['categoria']); ?></h6>
        <a href="video.php?v=<?php echo $video['id']; ?>">
        <img width="300" src="assets/miniaturas/<?php echo $video['miniatura']; ?>" />
        </a>
    <?php
		endforeach;
		$sql = $pdo->prepare("SELECT * FROM video WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
		$upviews = intval($video['views']) + 1;
		$sql = $pdo->prepare("UPDATE video SET views = :upviews");
		$sql->bindValue(":upviews", $upviews);
		$sql->execute();
	?>
    <h3>Comentários</h3>
    <?php
		$sql = $pdo->prepare("SELECT * FROM comentarios WHERE id_video = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
		
		if($sql->rowCount() > 0) {
			$coment = $sql->fetchAll();
		
		foreach($coment as $c):
	?>
    	<h4><?php echo $c['nome_user']; ?></h4>
        <p><?php echo utf8_encode($c['coment']); ?></p>
    <?php endforeach; } else {
		echo "<a href='comentario.php'>Seja o primeiro a comentar</a>";	
	}
	?>
</section>
<body>
</body>
</html>