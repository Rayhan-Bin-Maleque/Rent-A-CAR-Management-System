<?php

function customer_controller($action)
{
    global $conn;

    require_role("customer");

    $customer_id=$_SESSION['user']['id'];

    if($action === "dashboard")
    {
        $cars=get_available_cars($conn);
        $bookings=get_customer_bookings($conn,$customer_id);
        $payments=get_customer_payments($conn,$customer_id);

        require "views/customer/dashboard.php";
        return;
    }

    if($action === "cars")
    {
        $cars=get_available_cars($conn);
        require "views/customer/cars.php";
        return;
    }

    if($action === "book")
    {
        $car_id=(int)($_GET['car_id'] ?? $_POST['car_id'] ?? 0);
        $car=get_car_by_id($conn,$car_id);

        if(!$car || $car['status']!=='available' || $car['maintenance_status']!=='ready')
        {
            set_message("error","This car is not currently available.");
            redirect("index.php?page=customer&action=cars");
        }

        if(is_post())
        {
            $pickup=$_POST['pickup_date'] ?? '';
            $return=$_POST['return_date'] ?? '';
            $location=clean($_POST['pickup_location'] ?? '');

            if(!$pickup || !$return || strtotime($return) <= strtotime($pickup))
            {
                set_message("error","Please select a valid rental period.");
            }
            elseif(create_booking($conn,$customer_id,$car_id,$pickup,$return,$location))
            {
                set_message("success","Booking request submitted successfully.");
                redirect("index.php?page=customer&action=bookings");
            }
            else
            {
                set_message("error","Booking could not be created.");
            }
        }

        require "views/customer/book.php";
        return;
    }

    if($action === "bookings")
    {
        $bookings=get_customer_bookings($conn,$customer_id);
        require "views/customer/bookings.php";
        return;
    }

    if($action === "cancel")
    {
        $id=(int)($_GET['id'] ?? 0);

        if(cancel_booking($conn,$id,$customer_id))
            set_message("success","Booking cancelled.");
        else
            set_message("error","Booking could not be cancelled.");

        redirect("index.php?page=customer&action=bookings");
    }

    if($action === "payment")
    {
        $booking_id=(int)($_GET['booking_id'] ?? $_POST['booking_id'] ?? 0);
        $booking=get_booking_by_id($conn,$booking_id);

        if(!$booking || $booking['customer_id']!=$customer_id)
        {
            set_message("error","Booking not found.");
            redirect("index.php?page=customer&action=bookings");
        }

        $existing=get_booking_payment($conn,$booking_id);

        if(is_post())
        {
            $method=$_POST['payment_method'] ?? '';
            $transaction=$_POST['transaction_id'] ?? '';

            if($method==='online' && trim($transaction)==='')
            {
                set_message("error","Transaction ID is required for online payment.");
            }
            else
            {
                if($method==='offline') $transaction=generate_transaction_id();

                if(create_payment(
                    $conn,$booking_id,$customer_id,
                    $booking['total_amount'],$method,$transaction
                ))
                {
                    set_message("success","Payment completed successfully.");
                    redirect("index.php?page=customer&action=receipt&booking_id=".$booking_id);
                }
            }
        }

        require "views/customer/payment.php";
        return;
    }

    if($action === "receipt")
    {
        $booking_id=(int)($_GET['booking_id'] ?? 0);
        $booking=get_booking_by_id($conn,$booking_id);

        if(!$booking || $booking['customer_id']!=$customer_id)
        {
            set_message("error","Receipt not found.");
            redirect("index.php?page=customer&action=bookings");
        }

        $payment=get_booking_payment($conn,$booking_id);

        require "views/customer/receipt.php";
        return;
    }

    redirect("index.php?page=customer&action=dashboard");
}

?>
