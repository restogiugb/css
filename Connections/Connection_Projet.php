<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Connection_Projet = "localhost";
$database_Connection_Projet = "gestion_restau";
$username_Connection_Projet = "root";
$password_Connection_Projet = "";
$Connection_Projet = mysql_pconnect($hostname_Connection_Projet, $username_Connection_Projet, $password_Connection_Projet) or trigger_error(mysql_error(),E_USER_ERROR); 
?>