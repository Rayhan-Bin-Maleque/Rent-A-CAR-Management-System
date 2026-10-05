<?php

function auth_controller($action)
{
    global $conn;

    if($action === "login")
    {
        if(is_post())
        {
            $email=trim($_POST['email'] ?? '');
            $password=$_POST['password'] ?? '';

            $user=login_user($conn,$email,$password);

            if($user)
            {
                $_SESSION['user']=[
                    'id'=>$user['id'],
                    'name'=>$user['full_name'],
                    'email'=>$user['email'],
                    'role'=>$user['role']
                ];

                create_log($conn,$user['id'],$user['role'],
                    "User logged in",$_SERVER['REMOTE_ADDR'] ?? '');

                redirect("index.php?page=".$user['role']."&action=dashboard");
            }

            set_message("error","Invalid email or password.");
        }

        require "views/auth/login.php";
        return;
    }

    if($action === "register")
    {
        if(is_post())
        {
            $name=clean($_POST['full_name'] ?? '');
            $email=trim($_POST['email'] ?? '');
            $phone=clean($_POST['phone'] ?? '');
            $password=$_POST['password'] ?? '';

            if(create_user($conn,$name,$email,$phone,$password,'customer'))
            {
                set_message("success","Registration successful. Please login.");
                redirect("index.php?page=auth&action=login");
            }

            set_message("error","Registration failed. Email may already exist.");
        }

        require "views/auth/register.php";
        return;
    }

    if($action === "logout")
    {
        if(isset($_SESSION['user']))
        {
            create_log($conn,$_SESSION['user']['id'],
                $_SESSION['user']['role'],"User logged out",
                $_SERVER['REMOTE_ADDR'] ?? '');
        }

        session_destroy();
        redirect("index.php?page=auth&action=login");
    }

    redirect("index.php?page=auth&action=login");
}

?>
