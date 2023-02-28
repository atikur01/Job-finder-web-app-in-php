<?php
require "dbconnect.php";
//error_reporting(0);
if (!empty($_POST)) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT id, firstname, lastname , email, password FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $storedPassword = $row["password"];
            if ($password == $storedPassword) {
                session_start();
                $_SESSION["id"] = $row["id"];
                $_SESSION["firstname"] = $row["firstname"];
                $_SESSION["lastname"] = $row["lastname"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["valid"] = true;
                unset($_POST);
                header("Location: index.php");
            }
        }
    }
    else{
        echo <<<EOL
                <div class="alert alert-danger text-center" role="alert">
                Wrong Email or Password!
                </div>
                EOL;

    }
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="login.php" method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address" name="email" required />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" name="password" required/>
                                            </div>
                                            <div class="form-group">
                                                
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">   
                                                <button class="btn btn-primary"  type="submit">Login</button>
                                                <a class="small" href="password.html">Forgot Password?</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
