<?php

	$connect = new PDO("mysql:host = localhost; dbname = simple_chat; charset = utf-8", 'root', '');

	if (isset($_POST['username'])) {
		$username = $_POST['username'];
		$comment = $_POST['comment'];
		$date = date('Y-m-d H:i:s');
		$query = $connect -> query("INSERT INTO simple_chat.comments (username, comment, date) VALUES ('$username', '$comment', '$date')");

	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Simple Chat-Template</title>
	<link rel="stylesheet" href="css/simple-chat-template.css">
</head>
<body>
	<h1>Шаблон простой чат комнаты:</h1>
	<form action="" method="POST">
		<input type="text" name="username" placeholder="Введите ваше имя" required>
		<textarea name="comment" cols="30" rows="5" placeholder="Ваш комментарий" required></textarea>
		<input type="submit" value="Отправить">		
	</form>

<?php
		if ($query) {
			echo "<p>Запись успешно сохранена в БД</p>";
		} else {
			echo "<pre>";
			var_dump($connect -> errorInfo());
			echo "</pre>";
		}
?>		

	<hr class="custom-style">

	<h2>Оставленные сообщения:</h2>

<?php

	$comments = $connect -> query("SELECT * FROM simple_chat.comments ORDER BY date DESC");
	$comments = $comments -> fetchAll(PDO::FETCH_ASSOC);

	if ($comments) {

	foreach ($comments as $comment) {
?>
		<p><?="{$comment['date']} {$comment['username']} оставил(а) комментарий '{$comment['comment']}'"?></p>

 <? }} else {?>	

	 	<p>Пока ничего нет :(</p>

 <? } ?>

</body>
</html>
