<?php

function db_connect () {

	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$database = 'lc_zenday';

	$mysqli = new mysqli( $host, $user, $pass, $database );

	if ( $mysqli->connect_errno ) {
		return FALSE;
	} else {
		return $mysqli;
	}
}
