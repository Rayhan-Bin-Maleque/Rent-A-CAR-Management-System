<?php

function staff_controller($action)
{
    global $conn;

    require_role("staff");

    $staff_id=$_SESSION['user']['id'];

    if($action === "dashboard")
    {
        $bookings=get_all_bookings($conn);
        $maintenance=get_maintenance_records($conn);
        require "views/staff/dashboard.php";
        return;
    }

    if($action === "bookings")
    {
        $bookings=get_all_bookings($conn);
        require "views/staff/bookings.php";
        return;
    }

    if($action === "verify")
    {
        $booking=null;

        if(is_post())
        {
            $code=trim($_POST['booking_code'] ?? '');
            $booking=find_booking_by_code($conn,$code);

            if(!$booking)
                set_message("error","Booking code not found.");
        }

        require "views/staff/verify.php";
        return;
    }

    if($action === "pickup")
    {
        $id=(int)($_GET['id'] ?? 0);
        $booking=get_booking_by_id($conn,$id);

        if($booking && $booking['status']==='approved')
        {
            update_booking_operation($conn,$id,'pickup_verified',1);
            update_booking_status($conn,$id,'picked_up');
            update_car_status($conn,$booking['car_id'],'rented');
            set_message("success","Vehicle pickup verified.");
        }

        redirect("index.php?page=staff&action=verify");
    }

    if($action === "return")
    {
        $id=(int)($_GET['id'] ?? 0);
        $booking=get_booking_by_id($conn,$id);

        if($booking && $booking['status']==='picked_up')
        {
            update_booking_operation($conn,$id,'return_verified',1);
            update_booking_status($conn,$id,'returned');
            update_car_status($conn,$booking['car_id'],'available');
            set_message("success","Vehicle return verified.");
        }

        redirect("index.php?page=staff&action=verify");
    }

    if($action === "maintenance")
    {
        $cars=get_all_cars($conn);
        $maintenance=get_maintenance_records($conn);
        require "views/staff/maintenance.php";
        return;
    }

    if($action === "add_maintenance")
    {
        if(is_post())
        {
            $car_id=(int)($_POST['car_id'] ?? 0);
            $ok=add_maintenance(
                $conn,
                $car_id,
                $staff_id,
                clean($_POST['maintenance_type'] ?? ''),
                clean($_POST['description'] ?? ''),
                (float)($_POST['cost'] ?? 0)
            );

            if($ok)
            {
                update_maintenance_status($conn,$car_id,'ready');
                set_message("success","Maintenance record added.");
            }
            else
            {
                set_message("error","Could not save maintenance record.");
            }

            redirect("index.php?page=staff&action=maintenance");
        }

        redirect("index.php?page=staff&action=maintenance");
    }

    if($action === "payments")
    {
        $payments=get_all_payments($conn);
        require "views/staff/payments.php";
        return;
    }

    redirect("index.php?page=staff&action=dashboard");
}

?>
