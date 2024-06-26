<?php include('../config/constant.php'); ?>

<html>
    <head>
        <title>Login Food Order System</title>
        <link rel="stylesheet" href="../css/Admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1>Login</h1>

                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo "<br />" . nl2br($_SESSION['login']);
                        unset($_SESSION['login']);
                    }

                    if(isset($_SESSION['no-login-message']))
                    {
                        echo "<br />" . nl2br($_SESSION['no-login-message']);
                        unset($_SESSION['no-login-message']);
                    }
                ?>
                <br>

                <!-- Login Form Starts here -->
                    <form action="" method="POST">
                        Username: <br>
                        <input type="text" name="username" placeholder="Enter Username" required="required" /> <br><br>

                        Password: <br>
                        <input type="password" name="password" placeholder="Enter Password" required="required" /> <br><br>

                        <button type="submit" name="submit" class="btn-primary">Let me in.</button>
                    </form>
                <!-- Login Form Ends here -->
                <br>

            <p>Created By - <a href="www.lomyuen.com">Lom Yuen</a></p>

        </div>

    </body>
</html>

<?php 
    // Check whether the Submit Button is Clicked or Not
    if(isset($_POST['submit']))
    {
        // Process for Login
        // 1. Get the Data from Login Form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // 2. SQL to Check whether the User with Username and Password Exists or Not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Execute the Query
        $res = mysqli_query($conn, $sql);

        // 4. Count Rows to Check whether the User Exists or Not
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            // User Available and Login Success
            $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user'] = $username; // To Check whether the User is Logged in or Not and Logout will unset it

            // Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // User not Available and Login Fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";

            // Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }

    }
?>