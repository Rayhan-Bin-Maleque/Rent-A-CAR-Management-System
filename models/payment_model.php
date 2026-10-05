<?php

function create_payment($conn,$booking_id,$customer_id,$amount,$method,$transaction_id)
{
    $status="paid";
    $receipt=generate_receipt_code();

    $stmt=mysqli_prepare($conn,
        "INSERT INTO payments
        (booking_id,customer_id,amount,payment_method,transaction_id,payment_status,receipt_code,payment_date)
        VALUES(?,?,?,?,?,?,?,NOW())");

    mysqli_stmt_bind_param($stmt,"iidssss",
        $booking_id,$customer_id,$amount,$method,$transaction_id,$status,$receipt);

    return mysqli_stmt_execute($stmt);
}

function get_booking_payment($conn,$booking_id)
{
    $stmt=mysqli_prepare($conn,
        "SELECT * FROM payments WHERE booking_id=? ORDER BY id DESC LIMIT 1");
    mysqli_stmt_bind_param($stmt,"i",$booking_id);
    mysqli_stmt_execute($stmt);

    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

function get_customer_payments($conn,$customer_id)
{
    $stmt=mysqli_prepare($conn,
        "SELECT payments.*,bookings.booking_code,cars.brand,cars.model
         FROM payments
         JOIN bookings ON payments.booking_id=bookings.id
         JOIN cars ON bookings.car_id=cars.id
         WHERE payments.customer_id=?
         ORDER BY payments.id DESC");

    mysqli_stmt_bind_param($stmt,"i",$customer_id);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}

function get_all_payments($conn)
{
    return mysqli_query($conn,
        "SELECT payments.*,users.full_name AS customer_name,
                bookings.booking_code,cars.brand,cars.model
         FROM payments
         JOIN users ON payments.customer_id=users.id
         JOIN bookings ON payments.booking_id=bookings.id
         JOIN cars ON bookings.car_id=cars.id
         ORDER BY payments.id DESC");
}

function total_payments($conn)
{
    return mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT IFNULL(SUM(amount),0) total FROM payments
         WHERE payment_status='paid'"))['total'];
}

?>
