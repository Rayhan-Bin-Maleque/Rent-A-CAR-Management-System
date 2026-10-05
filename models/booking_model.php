<?php

function create_booking($conn,$customer_id,$car_id,$pickup,$return_date,$pickup_location)
{
    $car=get_car_by_id($conn,$car_id);

    if(!$car) return false;

    $days=rental_days($pickup,$return_date);
    $total=$days*$car['daily_rate'];
    $code=generate_booking_code();
    $status="pending";

    $stmt=mysqli_prepare($conn,
        "INSERT INTO bookings
        (customer_id,car_id,pickup_date,return_date,pickup_location,rental_days,total_amount,booking_code,status)
        VALUES(?,?,?,?,?,?,?,?,?)");

    mysqli_stmt_bind_param($stmt,"iisssidss",
        $customer_id,$car_id,$pickup,$return_date,$pickup_location,$days,$total,$code,$status);

    return mysqli_stmt_execute($stmt);
}

function get_booking_by_id($conn,$id)
{
    $stmt=mysqli_prepare($conn,
        "SELECT bookings.*,users.full_name AS customer_name,users.email,
                cars.brand,cars.model,cars.plate_number,cars.daily_rate
         FROM bookings
         JOIN users ON bookings.customer_id=users.id
         JOIN cars ON bookings.car_id=cars.id
         WHERE bookings.id=?");

    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);

    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

function get_customer_bookings($conn,$customer_id)
{
    $stmt=mysqli_prepare($conn,
        "SELECT bookings.*,cars.brand,cars.model,cars.plate_number,cars.car_type
         FROM bookings
         JOIN cars ON bookings.car_id=cars.id
         WHERE bookings.customer_id=?
         ORDER BY bookings.id DESC");

    mysqli_stmt_bind_param($stmt,"i",$customer_id);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

function get_all_bookings($conn)
{
    return mysqli_query($conn,
        "SELECT bookings.*,users.full_name AS customer_name,users.email,
                cars.brand,cars.model,cars.plate_number
         FROM bookings
         JOIN users ON bookings.customer_id=users.id
         JOIN cars ON bookings.car_id=cars.id
         ORDER BY bookings.id DESC");
}

function get_manager_bookings($conn,$manager_id)
{
    $stmt=mysqli_prepare($conn,
        "SELECT bookings.*,users.full_name AS customer_name,users.email,
                cars.brand,cars.model,cars.plate_number
         FROM bookings
         JOIN users ON bookings.customer_id=users.id
         JOIN cars ON bookings.car_id=cars.id
         WHERE cars.manager_id=?
         ORDER BY bookings.id DESC");

    mysqli_stmt_bind_param($stmt,"i",$manager_id);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

function update_booking_status($conn,$id,$status)
{
    $stmt=mysqli_prepare($conn,
        "UPDATE bookings SET status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt,"si",$status,$id);
    return mysqli_stmt_execute($stmt);
}

function update_booking_operation($conn,$id,$field,$value)
{
    $allowed=['pickup_verified','return_verified','staff_note'];

    if(!in_array($field,$allowed,true)) return false;

    $sql="UPDATE bookings SET $field=? WHERE id=?";
    $stmt=mysqli_prepare($conn,$sql);

    if($field==='staff_note')
        mysqli_stmt_bind_param($stmt,"si",$value,$id);
    else
        mysqli_stmt_bind_param($stmt,"ii",$value,$id);

    return mysqli_stmt_execute($stmt);
}

function find_booking_by_code($conn,$code)
{
    $stmt=mysqli_prepare($conn,
        "SELECT bookings.*,users.full_name AS customer_name,users.email,
                cars.brand,cars.model,cars.plate_number
         FROM bookings
         JOIN users ON bookings.customer_id=users.id
         JOIN cars ON bookings.car_id=cars.id
         WHERE bookings.booking_code=? LIMIT 1");

    mysqli_stmt_bind_param($stmt,"s",$code);
    mysqli_stmt_execute($stmt);

    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

function cancel_booking($conn,$id,$customer_id)
{
    $status="cancelled";

    $stmt=mysqli_prepare($conn,
        "UPDATE bookings SET status=?
         WHERE id=? AND customer_id=? AND status IN('pending','approved')");

    mysqli_stmt_bind_param($stmt,"sii",$status,$id,$customer_id);
    return mysqli_stmt_execute($stmt);
}

function count_bookings($conn)
{
    return mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT COUNT(*) total FROM bookings"))['total'];
}

function count_customer_bookings($conn,$customer_id)
{
    $stmt=mysqli_prepare($conn,
        "SELECT COUNT(*) total FROM bookings WHERE customer_id=?");
    mysqli_stmt_bind_param($stmt,"i",$customer_id);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))['total'];
}

function count_pending_bookings($conn)
{
    return mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT COUNT(*) total FROM bookings WHERE status='pending'"))['total'];
}

function booking_revenue($conn)
{
    return mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT IFNULL(SUM(total_amount),0) total
         FROM bookings WHERE status IN('approved','picked_up','returned')"))['total'];
}

?>
