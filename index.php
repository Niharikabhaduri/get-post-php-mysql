<?php
    include("database.php");

        $nameMsg = "";
        $emailMsg = "";
        $mobileMsg = "";
        $pwdMsg = "";

        $name = $email = $mobile = $hash = $password = "";
        

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($_POST["name"])){
            $nameMsg = "This field is required";
        }else if(!preg_match("/^[a-zA-Z- ']*$/",$_POST["name"] )){
            $nameMsg = "Only letters and white spaces allowed";
        } else {
            $name = $_POST["name"];
        }
        
        if(empty($_POST["email"])){
            $emailMsg = "This field is required";
        }else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $emailMsg = "This is not valid email";
        }else {
            $email = $_POST["email"];
        }

        if(empty($_POST["mobile"])){
            $mobileMsg = "This wasn't a correct mobile number";
        }else if(!preg_match("/^([+]\d{2})?\d{10}$/",$_POST["mobile"] )){
            $mobileMsg = "This is not valid input";
        }else {
            $mobile = $_POST["mobile"];
        }
        

        $password = $_POST["password"];
        
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);


        if(empty($password)){
            $pwdMsg = "This is required field";
        }else if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
        $pwdMsg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
        } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        }
        

        if(!empty($name) && !empty($email) && !empty($mobile) && !empty($hash) ){
            $sql = "insert into `users` ( name, email, mobile, password )
                        values('$name', '$email', '$mobile', '$hash')";
            $result = mysqli_query($conn, $sql);
        }

    }
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
    <a class="navbar-brand" href="getUsers.php" style="color:white">Form demo</a>
    </nav>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name">
                    <span><?php echo "{$nameMsg}"?></span>
                </div>
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your Email" name="email">
                    <span><?php echo "{$emailMsg}"?></span>
                </div>
                <div class="mb-3 mt-3">
                    <label for="mobile" class="form-label">Mobile Number:</label>
                    <input type="number" class="form-control" id="mobile" placeholder="Enter your Mobile Number" name="mobile">
                    <span><?php echo "{$mobileMsg}"?></span>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                    <span><?php echo "{$pwdMsg}"?></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>