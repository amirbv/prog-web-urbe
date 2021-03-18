<?php

require_once( './header.php' );

unset( $_SESSION );
session_unset();
session_destroy();
header( "Location: ./login.php" );
exit();
