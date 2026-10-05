<?php

function ajax_controller($action)
{
    global $conn;

    if($action === "search_cars")
    {
        require_role("customer");

        $result=search_cars($conn,trim($_GET['keyword'] ?? ''));

        while($car=mysqli_fetch_assoc($result))
        {
            if($car['status']!=='available' || $car['maintenance_status']!=='ready')
                continue;

            echo "<tr>";
            echo "<td>".e($car['brand']." ".$car['model'])."</td>";
            echo "<td>".e($car['car_type'])."</td>";
            echo "<td>".e($car['car_year'])."</td>";
            echo "<td>".e($car['seats'])."</td>";
            echo "<td>".CURRENCY." ".e($car['daily_rate'])."</td>";
            echo "<td><span class='status confirmed'>Available</span></td>";
            echo "<td><a class='small-btn btn-primary' href='index.php?page=customer&action=book&car_id=".$car['id']."'>Book</a></td>";
            echo "</tr>";
        }

        exit;
    }

    if($action === "search_logs")
    {
        require_role("admin");

        $result=search_logs($conn,trim($_GET['keyword'] ?? ''));

        while($row=mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>".e($row['full_name'])."</td>";
            echo "<td>".e($row['email'])."</td>";
            echo "<td>".e($row['role'])."</td>";
            echo "<td>".e($row['action'])."</td>";
            echo "<td>".e($row['ip_address'])."</td>";
            echo "<td>".e($row['created_at'])."</td>";
            echo "</tr>";
        }

        exit;
    }

    exit;
}

?>
