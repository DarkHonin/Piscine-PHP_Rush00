<?php

$t_parts = [
    "nav"=>"templates/navbar.php",
    "content"=>"templates/content.php",
    "infobar"=>"templat/infobar.php"
];


include "core/database_utils.php";

$connection = new r00\DB("localhost", "root", "password", "R00");

?>