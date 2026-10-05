<?php

function redirect($url)
{
    header("Location: ".$url);
    exit();
}

function e($data)
{
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

function require_login()
{
    if(!isset($_SESSION['user']))
    {
        redirect("index.php?page=auth&action=login");
    }
}

function require_role($role)
{
    require_login();

    if(
        !isset($_SESSION['user']['role']) ||
        $_SESSION['user']['role'] != $role
    )
    {
        redirect("index.php?page=auth&action=login");
    }
}

function current_user()
{
    return $_SESSION['user'] ?? null;
}

function is_post()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function clean($data)
{
    return trim(htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8'));
}

function set_message($type, $message)
{
    $_SESSION['message'] = [
        "type"=>$type,
        "text"=>$message
    ];
}

function show_message()
{
    if(isset($_SESSION['message']))
    {
        $msg=$_SESSION['message'];

        echo "<div class='alert ".e($msg['type'])."'>".e($msg['text'])."</div>";

        unset($_SESSION['message']);
    }
}

function generate_booking_code()
{
    return "RENT-" . date("Y") . "-" .
        strtoupper(substr(md5(uniqid('', true)), 0, 8));
}

function generate_transaction_id()
{
    return "TXN-" . strtoupper(substr(md5(uniqid('', true)), 0, 10));
}

function generate_receipt_code()
{
    return "REC-" . date("Ymd") . "-" .
        strtoupper(substr(md5(uniqid('', true)), 0, 7));
}

function rental_days($pickup, $return)
{
    $start = strtotime($pickup);
    $end = strtotime($return);

    return max(1, (int)ceil(($end-$start)/86400));
}

?>
