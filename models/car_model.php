<?php

function get_all_cars($conn)
{
    return mysqli_query($conn,
        "SELECT cars.*, users.full_name AS manager_name
         FROM cars
         LEFT JOIN users ON cars.manager_id=users.id
         ORDER BY cars.id DESC");
}

function get_available_cars($conn)
{
    return mysqli_query($conn,
        "SELECT * FROM cars
         WHERE status='available'
         AND maintenance_status='ready'
         ORDER BY id DESC");
}

function get_car_by_id($conn,$id)
{
    $stmt=mysqli_prepare($conn,"SELECT * FROM cars WHERE id=?");
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

function create_car($conn,$manager_id,$brand,$model,$year,$plate,$type,$seats,$rate,$description)
{
    $status="available";
    $maintenance="ready";

    $stmt=mysqli_prepare($conn,
        "INSERT INTO cars
        (manager_id,brand,model,car_year,plate_number,car_type,seats,daily_rate,description,status,maintenance_status)
        VALUES(?,?,?,?,?,?,?,?,?,?,?)");

    mysqli_stmt_bind_param($stmt,"ississidsss",
        $manager_id,$brand,$model,$year,$plate,$type,$seats,$rate,$description,$status,$maintenance);

    return mysqli_stmt_execute($stmt);
}

function update_car($conn,$id,$brand,$model,$year,$plate,$type,$seats,$rate,$description)
{
    $stmt=mysqli_prepare($conn,
        "UPDATE cars SET brand=?,model=?,car_year=?,plate_number=?,car_type=?,seats=?,daily_rate=?,description=?
         WHERE id=?");

    mysqli_stmt_bind_param($stmt,"ssissidsi",
        $brand,$model,$year,$plate,$type,$seats,$rate,$description,$id);

    return mysqli_stmt_execute($stmt);
}

function update_car_status($conn,$id,$status)
{
    $stmt=mysqli_prepare($conn,"UPDATE cars SET status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt,"si",$status,$id);
    return mysqli_stmt_execute($stmt);
}

function update_maintenance_status($conn,$id,$status)
{
    $stmt=mysqli_prepare($conn,
        "UPDATE cars SET maintenance_status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt,"si",$status,$id);
    return mysqli_stmt_execute($stmt);
}

function search_cars($conn,$keyword)
{
    $search="%".$keyword."%";

    $stmt=mysqli_prepare($conn,
        "SELECT * FROM cars
         WHERE brand LIKE ?
         OR model LIKE ?
         OR plate_number LIKE ?
         OR car_type LIKE ?
         ORDER BY id DESC");

    mysqli_stmt_bind_param($stmt,"ssss",$search,$search,$search,$search);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

function count_cars($conn)
{
    return mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT COUNT(*) total FROM cars"))['total'];
}

function count_available_cars($conn)
{
    return mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT COUNT(*) total FROM cars
         WHERE status='available' AND maintenance_status='ready'"))['total'];
}

?>
