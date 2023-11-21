<?php
session_start();
if(isset($_SESSION["user"]))
{
header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">

</head>
<body>
     <!-- Header iframe -->
  <iframe src="header.html" scrolling="no"></iframe>

    <div class="container">
        <?php
        if(isset($_POST["login"]))
        {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user)
            {
                if(password_verify($password, $user["password"]))
                {
                session_start();
                $_SESSION["user"] = "yes";
                header("Location: index.php");
                die();
                }else{
                    echo "<div class='alert alert-success'>Password does not match.</div>";
                }
            }else{
                    echo "<div class='alert alert-success'>Email does not match.</div>";
                }
        }
        ?>
         <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="login" value="Login">
            </div>
            </form>
            <div><p>Not registered yet?</p><a href="registration.php">Register Here</a> </div>
            </div>

            <!-- footer iframe -->
  <iframe src="footer.html" scrolling="no"></iframe>
</body>
</html>