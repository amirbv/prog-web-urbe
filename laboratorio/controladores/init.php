<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

require_once( CONTROLLERS . 'phpmailer/autoload.php' );

require_once( CONTROLLERS . 'database.php' );
require_once( CONTROLLERS . 'functions.php' );

$dbh = db_connect();
$mail = new PHPMailer( true );

if ( $dbh == false ) {
	die( 'Error de base de datos' );
}

if ( !isLoggedIn() ) {

	$server_request = $_SERVER[ 'REQUEST_URI' ];
	$_server_request = explode( '/', $server_request );

	if ( $_server_request[ count( $_server_request ) - 1 ] != 'login.php' ) {
		header( "Location: " . ROOTPATH . "login.php" );
		exit();
	}
}
