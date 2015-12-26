<?php
require_once('githubConfig.php');
ini_set('allow_url_fopen', 1);
/* require_once('githubApi.php');    */
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(isset($_GET['code']))
    {
            $code = $_GET['code'];
            $post = http_build_query(array(
                'client_id' => $config['client_id'],
                'redirect_url' => $config['redirect_url'],
                'client_secret' => $config['client_secret'],
                'code' => $code,
            ));
            
            $context = stream_context_create(
                array(
                    "http" => array(
                        "method" => "POST",
                        'header'=> "Content-type: application/x-www-form-urlencoded\r\n" .
                                    "Content-Length: ". strlen($post) . "\r\n".
                                    "Accept: application/json" ,  
                        "content" => $post,
                    )
                )
            );
            
            $json_data = file_get_contents("https://github.com/login/oauth/access_token", false, $context);
            $r = json_decode($json_data , true);
            $access_token = $r['access_token'];
            $scope = $r['scope']; 
            
            $url = "https://api.github.com/user?access_token=".$access_token."";
            $options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
            $context  = stream_context_create($options);
            $data = file_get_contents($url, false, $context); 
            $user_data  = json_decode($data, true);
            /* $username = $user_data['login']; */
            
            
            $url = "https://api.github.com/user/emails?access_token=".$access_token."";
            $options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
            $context  = stream_context_create($options);
            $emails =  file_get_contents($url, false, $context);
            $email_data = json_decode($emails, true);
            $email_id = $email_data[0]['email'];
            /* $email_primary = $email_data[0]['primary']; */
            /* $email_verified = $email_data[0]['verified']; */
            $github_data=array();
            $github_data['email']   = $email_id;
            $github_data['name']    = $user_data['name'];
            $github_data['company'] = $user_data['company'];
            $github_data['blog']    = $user_data['blog'];
            $github_data['location']= $user_data['location'];
            $github_data['id']      = $user_data['id'];
            $github_data['login']   = $user_data['login'];
            $github_data['avatar_url']  = $user_data['avatar_url'];
            $github_data['url']         = $user_data['url'];
            
            $_SESSION['github_data'] = $github_data;
            
            header("location: home.php");
    }
    else
    {
        $url = "https://github.com/login/oauth/authorize?client_id=".$config['client_id']."&redirect_uri=".$config['redirect_url']."&scope=user";
        header("Location: $url");
    }
}
?>