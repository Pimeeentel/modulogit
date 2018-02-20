<?php
require "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>XXX</title>
</head>
<section style="width:100%;">
	<?php	
		$sql = $pdo->prepare("SELECT * FROM video");
		$sql->execute();
		
		if($sql->rowCount() > 0) {
			$videos = $sql->fetchAll();
		}
		
		foreach($videos as $video):
	?>
    	<h3><?php echo $video['titulo']; ?></h3>
        <h5><?php echo utf8_encode($video['descricao']); ?></h5>
        <h6>Views: <?php echo $video['views']; ?></h6>
        <h6>Like: <?php echo $video['like']; ?> - Dislike: <?php echo $video['dislike']; ?></h6>
        <h6>Atriz Principal: <?php echo $video['atriz']; ?></h6>
        <h6>Categoria: <?php echo explode(",",$video['categoria']); ?></h6>
        <a href="video.php?v=<?php echo $video['id']; ?>">
        <img width="300" src="assets/miniaturas/<?php echo $video['miniatura']; ?>" />
        </a>
    <?php
		endforeach;
	?>
</section>
<body>
</body>
</html>