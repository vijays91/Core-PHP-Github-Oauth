<?php
session_start();
if (isset($_SESSION['github_data'])) {
// Redirection to application home page.
header("location: home.php");
}
//HTML Code
?>
<a href="github_login.php">Login with Github</a>