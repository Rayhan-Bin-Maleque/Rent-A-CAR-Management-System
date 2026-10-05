<?php

function login_user($conn, $email, $password)
{
    $stmt=mysqli_prepare($conn,
        "SELECT * FROM users WHERE email=? AND status='active' LIMIT 1");
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);

    $user=mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if($user && password_verify($password,$user['password_hash']))
    {
        return $user;
    }

    return false;
}

function get_all_users($conn)
{
    return mysqli_query($conn,
        "SELECT id,full_name,email,phone,role,status,created_at
         FROM users ORDER BY id DESC");
}

function get_user_by_id($conn,$id)
{
    $stmt=mysqli_prepare($conn,"SELECT * FROM users WHERE id=?");
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

function create_user($conn,$name,$email,$phone,$password,$role)
{
    $hash=password_hash($password,PASSWORD_DEFAULT);

    $stmt=mysqli_prepare($conn,
        "INSERT INTO users(full_name,email,phone,password_hash,role)
         VALUES(?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt,"sssss",$name,$email,$phone,$hash,$role);
    return mysqli_stmt_execute($stmt);
}

function update_user_status($conn,$id,$status)
{
    $stmt=mysqli_prepare($conn,"UPDATE users SET status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt,"si",$status,$id);
    return mysqli_stmt_execute($stmt);
}

function delete_user($conn,$id)
{
    $stmt=mysqli_prepare($conn,"DELETE FROM users WHERE id=?");
    mysqli_stmt_bind_param($stmt,"i",$id);
    return mysqli_stmt_execute($stmt);
}

function count_users_by_role($conn,$role)
{
    $stmt=mysqli_prepare($conn,"SELECT COUNT(*) total FROM users WHERE role=?");
    mysqli_stmt_bind_param($stmt,"s",$role);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))['total'];
}

?>
