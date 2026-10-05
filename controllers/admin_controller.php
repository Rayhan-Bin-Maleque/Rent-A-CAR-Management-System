<?php

function admin_controller($action)
{
    global $conn;

    require_role("admin");

    if($action === "dashboard")
    {
        $users=get_all_users($conn);
        $cars=count_cars($conn);
        $bookings=count_bookings($conn);
        $revenue=total_payments($conn);

        require "views/admin/dashboard.php";
        return;
    }

    if($action === "users")
    {
        $users=get_all_users($conn);
        require "views/admin/users.php";
        return;
    }

    if($action === "add_user")
    {
        if(is_post())
        {
            if(create_user(
                $conn,
                clean($_POST['full_name'] ?? ''),
                trim($_POST['email'] ?? ''),
                clean($_POST['phone'] ?? ''),
                $_POST['password'] ?? '',
                $_POST['role'] ?? 'customer'
            ))
            {
                set_message("success","User added successfully.");
            }
            else
            {
                set_message("error","Could not add user.");
            }

            redirect("index.php?page=admin&action=users");
        }

        require "views/admin/add_user.php";
        return;
    }

    if($action === "toggle_user")
    {
        $id=(int)($_GET['id'] ?? 0);
        $user=get_user_by_id($conn,$id);

        if($user)
        {
            $new_status=$user['status']==='active' ? 'inactive' : 'active';
            update_user_status($conn,$id,$new_status);
            set_message("success","User status updated.");
        }

        redirect("index.php?page=admin&action=users");
    }

    if($action === "cars")
    {
        $cars=get_all_cars($conn);
        require "views/admin/cars.php";
        return;
    }

    if($action === "bookings")
    {
        $bookings=get_all_bookings($conn);
        require "views/admin/bookings.php";
        return;
    }

    if($action === "payments")
    {
        $payments=get_all_payments($conn);
        require "views/admin/payments.php";
        return;
    }

    if($action === "logs")
    {
        $logs=get_all_logs($conn);
        require "views/admin/logs.php";
        return;
    }

    redirect("index.php?page=admin&action=dashboard");
}

?>
