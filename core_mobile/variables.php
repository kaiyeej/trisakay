<?php

/** Core Path **/
define("view", "pages/");


/** Database connection **/

// offline


/*define("host", "localhost");
define("username", "root");
define("password", "");
define("database", "count_me_in_db");*/



// online
define("host", "localhost");
define("username", "u981310152_trisakay_root");
define("password", "triSakay123!");
define("database", "u981310152_trisakay");
/** Auth **/

define("table", "tbl_users");
define("user_session_id", "user_id");
define("passwordHashing", true);
define("error_message", "Your Credentials did not matched");

/** Function / Classes **/

//inside dir
define("VALUE", serialize(array("auth.php", "my_functions.php")));
