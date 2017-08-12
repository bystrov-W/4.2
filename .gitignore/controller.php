<?php

	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	include_once('db.php');
	
	$pdo = new PDO($dsn, $user, $pass, $opt);
	
	$pdo->query("SET NAMES utf8");
	//
	if (isset($_POST['add'])) {
		if (isset ($_POST['idForChanging']) && !empty ($_POST['idForChanging'])) {
			$description = isset($_POST['description']) ? $_POST['description'] : '';
			$idForChanging = isset($_POST['idForChanging']) ? $_POST['idForChanging'] : '';
			$action = $pdo->prepare('UPDATE tasks SET description = ? WHERE id = ?');
			$action->bindParam(1, $description, PDO::PARAM_STR);
			$action->bindParam(2, $idForChanging, PDO::PARAM_STR);
			$action->execute();
		} else {
			$description = isset($_POST['description']) ? $_POST['description'] : '';
			$date = date('Y/m/d H:i:s');
			$isDone = 0;
			$add = $pdo->prepare('INSERT INTO tasks (description, is_done, date) VALUES (?, ?, ?)');
			$add->bindParam(1, $description, PDO::PARAM_STR);
			$add->bindParam(2, $isDone, PDO::PARAM_INT);
			$add->bindParam(3, $date, PDO::PARAM_STR);
			$add->execute();
		}
	}
	
	//done
	
	function done($id) {
		global $pdo;
		$action = $pdo->prepare('UPDATE tasks SET is_done = 1 WHERE id = ?');
		$action->execute(array($id));
	}
	
	//delete
	function delete($id) {
		global $pdo;
		$action = $pdo->prepare('DELETE from tasks WHERE id = ?');
		$action->execute(array($id));
	}
	
	//change
	function change($id) {
		global $pdo;
		$action = $pdo->query('SELECT description FROM tasks WHERE id = ' . $id . '');
		while ($row = $action->fetch()) {
			return $value = $row['description'];
		}
	}
	
	
	//
	if (isset($_GET['action'])) {
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		if ($_GET['action'] == 'done') {
			done($id);
		} elseif ($_GET['action'] == 'delete') {
			delete($id);
		} elseif ($_GET['action'] == 'change') {
			change($id);
			$idForChanging = isset($_GET['id']) ? $_GET['id'] : '';
		}
	}
	
	//
	if (isset($_POST['sortOption'])) {
		if ($_POST['sortOption'] == '1') {
			$sortStyle = 'description';
		} else if ($_POST['sortOption'] == '2') {
			$sortStyle = 'is_done';
		} else if ($_POST['sortOption'] == '3') {
			$sortStyle = 'date';
		}
		$stmt = $pdo->query('SELECT * FROM tasks ORDER BY ' .$sortStyle . ' ASC');
	} else {
		$stmt = $pdo->query('SELECT * FROM tasks');
	}