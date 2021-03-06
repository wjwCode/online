<?php
include("include/session.php");
global $database;
?>
<html>
<title>Talent Hunt:userinfo</title>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<style>

</style>
<body>

<?php
/* Requested Username error checking */
$req_user = trim($_GET['user']);
if(!$req_user || strlen($req_user) == 0 ||
   !eregi("^([0-9a-z])+$", $req_user) ||
   !$database->usernameTaken($req_user)){
   die("Username not registered");
}

/* Logged in user viewing own account */
if(strcmp($session->username,$req_user) == 0){
   echo "<h1>我的账户</h1>";
}
/* Visitor not viewing own account */
else{
   echo "<h1>用户信息</h1>";
}

/* Display requested user information */
$req_user_info = $database->getUserInfo($req_user);

/* Username */
echo "<b>用户名: ".$req_user_info['username']."</b><br>";

/* Email */
echo "<b>电子邮件:</b> ".$req_user_info['email']."<br>";
/* Branch*/
echo "<b>系别:<b> ".$database->getbranname($req_user_info['branch_id'])."<br>";

/**
 * Note: when you add your own fields to the users table
 * to hold more information, like homepage, location, etc.
 * they can be easily accessed by the user info array.
 *
 * $session->user_info['location']; (for logged in users)
 *
 * ..and for this page,
 *
 * $req_user_info['location']; (for any user)
 */

/* If logged in user viewing own account, give link to edit */
if(strcmp($session->username,$req_user) == 0){
   echo "<br><a href=\"useredit.php\">编辑用户信息</a><br>";
}

/* Link back to main */
echo "<br>返回 [<a href=\"./\">主菜单</a>]<br>";

?>

</body>
</html>
