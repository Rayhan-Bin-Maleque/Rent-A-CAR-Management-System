<?php

function create_log($conn,$user_id,$role,$action,$ip_address)
{
    $stmt=mysqli_prepare($conn,
        "INSERT INTO activity_logs(user_id,role,action,ip_address)
         VALUES(?,?,?,?)");

    mysqli_stmt_bind_param($stmt,"isss",$user_id,$role,$action,$ip_address);
    return mysqli_stmt_execute($stmt);
}

function get_all_logs($conn)
{
    return mysqli_query($conn,
        "SELECT activity_logs.*,users.full_name,users.email
         FROM activity_logs
         JOIN users ON activity_logs.user_id=users.id
         ORDER BY activity_logs.id DESC");
}

function search_logs($conn,$keyword)
{
    $search="%".$keyword."%";

    $stmt=mysqli_prepare($conn,
        "SELECT activity_logs.*,users.full_name,users.email
         FROM activity_logs
         JOIN users ON activity_logs.user_id=users.id
         WHERE users.full_name LIKE ?
            OR users.email LIKE ?
            OR activity_logs.role LIKE ?
            OR activity_logs.action LIKE ?
            OR activity_logs.ip_address LIKE ?
         ORDER BY activity_logs.id DESC");

    mysqli_stmt_bind_param($stmt,"sssss",
        $search,$search,$search,$search,$search);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

?>
