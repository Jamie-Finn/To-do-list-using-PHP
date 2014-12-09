<?php

// Store the items, keys or values inside of the session superglobal.
session_start();

// Simulates a user being logged in.
$_SESSION['user_id'] = 1;

// Connect to database through PDO.
$db = new PDO('mysql:host=HOST NAME GOES HERE;dbname=DATABASE NAME GOES HERE', 'USERNAME GOES HERE', 'PASSWORD GOES HERE');

// This shoud be handled using a proper authentication system as this is a simulation of a user being signed in.
if(!isset($_SESSION['user_id'])) {
	die('You are not signed in.');
}
