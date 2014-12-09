<?php

require_once 'app/init.php';

$itemsQuery = $db->prepare("
	SELECT id, name, done
	FROM items
	WHERE user = :user
");

//executes the above query to prevent SQL inject and the need to escape manually.
$itemsQuery->execute([
	'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>To do list</title>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
		<link rel="stylesheet" href="css/main.css">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div class="list">
			<h1 class="header">To do list.</h1>

			<!-- Checks if there is any items in the database and preform checks to determine what should be displayed -->
			<?php if(!empty($items)): ?>
			<ul class="items">
				<?php foreach($items as $item): ?>
					<li>
						<span class="item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']; ?></span>
						<?php if(!$item['done']): ?>
							<a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Mark as done</a>
							<a href="mark.php?as=delete&item=<?php echo $item['id']; ?>" class="done-button">Remove item</a>
						<?php else: ?>
							<a href="mark.php?as=notdone&item=<?php echo $item['id']; ?>" class="done-button">Undo done item</a>
							<a href="mark.php?as=delete&item=<?php echo $item['id']; ?>" class="done-button">Remove item</a>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php else: ?>
				<p>No items have been added yet.</p>
			<?php endif; ?>

			<form class="item-add" action="add.php" method="post">
				<input type="text" name="name" placeholder="Type in a new item here." class="input" autocomplete="off" required>
				<input type="submit" value="Add" class="submit">
			</form>

		</div>
	</body>
</html>