<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
    <nav class="navbar navbar-expand-sm bg-dark justify-content-center">
        <a class="navbar-brand" href="#" style="color:white">Form demo</a>
    </nav>
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Firstname</th>
                <th>Mobile Number</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <?php 

            $sql = "Select * from users";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $name = $row["name"];
                $mobile = $row["mobile"];
                $email = $row["email"];

                echo '<tr>
                <td>'.$name.'</td>
                <td>'.$mobile.'</td>
                <td>'.$email.'</td>
            </tr>';
            }
            ?>
            </tbody>
    </table>
    </div>
</div>
</body>
</html>