<?php
session_start();
include('db.php'); //Database Connection.
if (!isset($_SESSION['github_data'])) {
    // Redirection to application index page.
    header("location: index.php");
} else
{

$userdata=$_SESSION['github_data'];
$email = $userdata['email'];
$fullName = $userdata['name'];
$company = $userdata['company'];
$blog = $userdata['blog'];
$location = $userdata['location'];
$github_id = $userdata['id'];
$github_username = $userdata['login'];
$profile_image = $userdata['avatar_url'];
$github_url = $userdata['url'];

$q=mysqli_query($connection,"SELECT id FROM github_users WHERE email='$email'");
if(mysqli_num_rows($q) == 0)
{
$count=mysqli_query($connection,"INSERT INTO github_users(email,fullname,company,blog,location,github_id,github_username,profile_image,github_url) VALUES('$email','$fullName','$company','$blog','$location','$github_id','$github_username','$profile_image','$github_url')");
}
print_r($userdata); // Full data
echo "<a href='logout.php'>Logout</a>";
}
?>