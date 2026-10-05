<?php

function add_maintenance($conn,$car_id,$staff_id,$maintenance_type,$description,$cost)
{
    $status="completed";

    $stmt=mysqli_prepare($conn,
        "INSERT INTO maintenance
        (car_id,staff_id,maintenance_type,description,cost,status,maintenance_date)
        VALUES(?,?,?,?,?,?,CURDATE())");

    mysqli_stmt_bind_param($stmt,"iissds",
        $car_id,$staff_id,$maintenance_type,$description,$cost,$status);

    return mysqli_stmt_execute($stmt);
}

function get_maintenance_records($conn)
{
    return mysqli_query($conn,
        "SELECT maintenance.*,cars.brand,cars.model,cars.plate_number,
                users.full_name AS staff_name
         FROM maintenance
         JOIN cars ON maintenance.car_id=cars.id
         JOIN users ON maintenance.staff_id=users.id
         ORDER BY maintenance.id DESC");
}

function get_car_maintenance($conn,$car_id)
{
    $stmt=mysqli_prepare($conn,
        "SELECT maintenance.*,users.full_name AS staff_name
         FROM maintenance
         JOIN users ON maintenance.staff_id=users.id
         WHERE maintenance.car_id=?
         ORDER BY maintenance.id DESC");

    mysqli_stmt_bind_param($stmt,"i",$car_id);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

?>
