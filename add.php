<?php

require_once 'app/init.php';

// Check if name is available and then store it in a variable which includes the trim function to get rid of whitespace.
if(isset($_POST['name'])) {
	$name = trim($_POST['name']);

	// Check if the value in the variable is not empty to prevent an empty item being stored in the database.
	if(!empty($name)) {
		$addedQuery = $db->prepare("
			INSERT INTO items (name, user, done, created)
			VALUES (:name, :user, 0, NOW())
		");

		$addedQuery->execute([
			'name' => $name,
			'user' => $_SESSION['user_id']
		]);
	}
}

// Redirects the user back to index.php regardless of any errors that occur in the above statements.
header('Location: index.php');