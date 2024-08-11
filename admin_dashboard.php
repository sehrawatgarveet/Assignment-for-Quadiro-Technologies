<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: admin_login.php');
    exit();
}
include('config.php');

$totalCarsQuery = "SELECT COUNT(*) as total_cars FROM cars";
$totalCarsResult = mysqli_query($conn, $totalCarsQuery);
$totalCars = mysqli_fetch_assoc($totalCarsResult)['total_cars'];

$carsQuery = "SELECT * FROM cars";
$carsResult = mysqli_query($conn, $carsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Admin Dashboard</h2>
        <p>Total Cars: <?php echo $totalCars; ?></p>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car Name</th>
                    <th>Manufacturing Year</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($car = mysqli_fetch_assoc($carsResult)) { ?>
                    <tr>
                        <td><?php echo $car['id']; ?></td>
                        <td><?php echo $car['car_name']; ?></td>
                        <td><?php echo $car['manufacturing_year']; ?></td>
                        <td><?php echo $car['price']; ?></td>
                        <td>
                            <a href="edit_car.php?id=<?php echo $car['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_car.php?id=<?php echo $car['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="add_car.php" class="btn btn-success">Add New Car</a>
    </div>
</body>
</html>
