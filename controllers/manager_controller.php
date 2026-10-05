<?php

function manager_controller($action)
{
    global $conn;

    require_role("manager");

    $manager_id=$_SESSION['user']['id'];

    if($action === "dashboard")
    {
        $cars=get_all_cars($conn);
        $bookings=get_manager_bookings($conn,$manager_id);
        $pending=count_pending_bookings($conn);
        $revenue=booking_revenue($conn);

        require "views/manager/dashboard.php";
        return;
    }

    if($action === "cars")
    {
        $cars=get_all_cars($conn);
        require "views/manager/cars.php";
        return;
    }

    if($action === "add_car")
    {
        if(is_post())
        {
            if(create_car(
                $conn,$manager_id,
                clean($_POST['brand'] ?? ''),
                clean($_POST['model'] ?? ''),
                (int)($_POST['car_year'] ?? 0),
                clean($_POST['plate_number'] ?? ''),
                clean($_POST['car_type'] ?? ''),
                (int)($_POST['seats'] ?? 0),
                (float)($_POST['daily_rate'] ?? 0),
                clean($_POST['description'] ?? '')
            ))
            {
                set_message("success","Car added successfully.");
                redirect("index.php?page=manager&action=cars");
            }

            set_message("error","Could not add car.");
        }

        require "views/manager/add_car.php";
        return;
    }

    if($action === "edit_car")
    {
        $id=(int)($_GET['id'] ?? 0);
        $car=get_car_by_id($conn,$id);

        if(!$car)
        {
            set_message("error","Car not found.");
            redirect("index.php?page=manager&action=cars");
        }

        if(is_post())
        {
            if(update_car(
                $conn,$id,
                clean($_POST['brand'] ?? ''),
                clean($_POST['model'] ?? ''),
                (int)($_POST['car_year'] ?? 0),
                clean($_POST['plate_number'] ?? ''),
                clean($_POST['car_type'] ?? ''),
                (int)($_POST['seats'] ?? 0),
                (float)($_POST['daily_rate'] ?? 0),
                clean($_POST['description'] ?? '')
            ))
            {
                set_message("success","Car updated successfully.");
                redirect("index.php?page=manager&action=cars");
            }

            set_message("error","Could not update car.");
        }

        require "views/manager/edit_car.php";
        return;
    }

    if($action === "car_status")
    {
        $id=(int)($_GET['id'] ?? 0);
        $status=$_GET['status'] ?? 'available';

        if(in_array($status,['available','rented','inactive'],true))
        {
            update_car_status($conn,$id,$status);
            set_message("success","Car status updated.");
        }

        redirect("index.php?page=manager&action=cars");
    }

    if($action === "bookings")
    {
        $bookings=get_manager_bookings($conn,$manager_id);
        require "views/manager/bookings.php";
        return;
    }

    if($action === "update_booking")
    {
        $id=(int)($_GET['id'] ?? 0);
        $status=$_GET['status'] ?? 'pending';

        if(in_array($status,['approved','rejected'],true))
        {
            update_booking_status($conn,$id,$status);

            $booking=get_booking_by_id($conn,$id);

            if($booking && $status==='approved')
                update_car_status($conn,$booking['car_id'],'rented');

            if($booking && $status==='rejected')
                update_car_status($conn,$booking['car_id'],'available');

            set_message("success","Booking status updated.");
        }

        redirect("index.php?page=manager&action=bookings");
    }

    if($action === "finance")
    {
        $bookings=get_manager_bookings($conn,$manager_id);
        require "views/manager/finance.php";
        return;
    }

    if($action === "statistics")
    {
        $bookings=get_manager_bookings($conn,$manager_id);
        $cars=get_all_cars($conn);
        require "views/manager/statistics.php";
        return;
    }

    redirect("index.php?page=manager&action=dashboard");
}

?>
