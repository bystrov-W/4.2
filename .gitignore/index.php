<?php

	include_once('controller.php');
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Список дел</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
	<div class="section">
		<div class="container">
			<div class="row">
			<h1>Список дел</h1>
				<div class="col-sm-6">
				<form role="form" action="/4.2/" method="post">
					<div class="form-group">
						<label for="text">Название</label>
						<input type="text" class="form-control" name="description" value="<?php if (isset($_GET['action']) && $_GET['action'] == 'change'){echo change($id);} ?>">
						<input type="hidden" name="idForChanging" value="<?php if (isset($_GET['action']) && $_GET['action'] == 'change'){echo $idForChanging;} ?>">
					</div>
					<button type="submit" class="btn btn-success" name="add">Сохранить</button>
				</form>
				</div>
				<div class="col-sm-6">
				<form role="form" action="/4.2/" method="post">
					<div class="form-group">
						<label for="text">Сортировать по</label>
						<select class="form-control" name="sortOption">
							<option value="1">задаче</option>
							<option value="2">статусу</option>
							<option value="3">дате добавления</option>
						</select>
					</div>
					<button type="submit" class="btn btn-success" name="sort">Сортировать</button>
				</form>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-sm-12">
					<table class="table">
						<tr>
							<th>Задача</th>
							<th>Статус</th>
							<th>Дата добавления</th>
							<th></th>
						</tr>
					<?php
						while ($row = $stmt->fetch())
							{
								if ($row['is_done'] == 0) {
									$status = 'Не выполнено';
								} else {
									$status = 'Выполнено';
								}
								?>
								<tr>
									<td><?php echo $row['description']; ?></td>
									<td><?php echo $status; ?></td>
									<td><?php echo $row['date']; ?></td>
									<td><span><a href="?action=change&id=<?php echo $row['id']; ?>">Изменить</a></span>
									&nbsp;&nbsp;&nbsp;
									<span><a href="?action=done&id=<?php echo $row['id']; ?>">Выполнить</a></span>
									&nbsp;&nbsp;&nbsp;
									<span><a href="?action=delete&id=<?php echo $row['id']; ?>">Удалить</a></td>
							<?php
							}
							?>
					</table>

	</body>
</html>