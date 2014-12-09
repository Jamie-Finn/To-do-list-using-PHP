<?php

require_once 'app/init.php';

// Check if the action and item are set and then have the ability to switch to be able to add different actions.
if(isset($_GET['as'], $_GET['item'])) {
	$as 	= $_GET['as'];
	$item 	= $_GET['item'];

	switch($as) {
		case 'done':
			$doneQuery = $db->prepare("
				UPDATE items
				SET done = 1
				WHERE id = :item
				AND user = :user
			");

			$doneQuery->execute([
				'item' => $item,
				'user' => $_SESSION['user_id']
			]);
		break;
		case 'notdone':
			$doneQuery = $db->prepare("
				UPDATE items
				SET done = 0
				WHERE id = :item
				AND user = :user
			");

			$doneQuery->execute([
				'item' => $item,
				'user' => $_SESSION['user_id']
			]);
		break;
		case 'delete':
			$doneQuery = $db->prepare("
				DELETE FROM items
				WHERE id = :item
				AND user = :user
			");

			$doneQuery->execute([
				'item' => $item,
				'user' => $_SESSION['user_id']
			]);
		break;
	}
}

header('Location: index.php');