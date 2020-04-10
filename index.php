<div style="background-image: url('img.jpg');">
<?php
    include('config.php');
    session_start();
    if(isset($_POST['Login'])) {
        //login
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM `users` WHERE user='$username' and password='".md5($password)."'";
	    $result = mysqli_query($conn,$query) or die(mysql_error());
	    $rows = mysqli_num_rows($result);
        if($rows==1) {
            $_SESSION['logged'] = true;
	        $_SESSION['username'] = $username;
	        header("Location: dashboard.php");
        }
        else {
            $error = "Username or Password incorrect.";
	    }
    }
    elseif (isset($_POST['Register'])) {
        //register
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $query = "SELECT * FROM `users` WHERE user='$username'";
        $result = mysqli_query($conn,$query);
        if ($result && $result->num_rows > 0) {
            $error = " Username taken.";
        }
        else {
            $query = "SELECT * FROM `users` WHERE email='$email'";
            $result = mysqli_query($conn,$query);
            if ($result && $result->num_rows > 0) {
                $error = " Email already in use.";
            }
            else {
                if (strcmp($password,$cpassword) != 0) {
                    $error = " Passwords not same.";
                }
                else {
                    $tested = 1;
                }
            }
        }
        if(isset($tested)) {
            $query = "INSERT INTO `users` (`user`, `email`, `password`) VALUES ('$username', '$email', '".md5($password)."')";
            $result = mysqli_query($conn,$query);
            if ($result && $result->num_rows) {
                $success = "User created.";
            }
        }
        

    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>INT301</title>
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <script src="main.js" type="application/x-javascript"></script>
	<link href="style.css" media="all" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<body>
	<div class="main">
		<a href="index.html">
		<h1>Enter the system</h1></a>
		<div class="main-navlsrow">
            <?php if(isset($success)) { ?>
                <div class="alert alert-success" role="alert">
                    <p>Account created. You may login now.</p>
                </div>
            <?php } ?>
            <?php if(isset($error)) { ?>
                <div class="alert alert-danger" role="alert">
                    <p><?php echo $error; ?></p>
                </div>
            <?php } ?>
			<div class="login-form login-form-left">
				<div class="agile-row">
					<h2>Already a student? Login</h2>
					<div class="login-box-top">
						<form action="" method="post">
							<p>User Name</p><input class="name" name="username" required="" type="text">
							<p>Password</p><input class="password" name="password" required="" type="password">
                            <label class="anim"><input class="checkbox" type="checkbox"> <span>Remember me ?</span></label>
                            <input type="submit" name="Login" value="Sign In">
						</form>
					</div>
				</div>
			</div>
			<div class="login-form box-right">
				<div class="agile-row">
					<h3>Are you new? Register</h3>
					<div class="login-box-top">
						<form action="" method="post">
							<p>User Name</p><input class="name" name="username" required="" type="text">
							<p>Email</p><input class="email" name="email" required="" type="email">
							<p>Password</p><input class="password" name="password" required="" type="password">
							<p>Confirm Password</p><input class="password" name="cpassword" required="" type="password">
                            <input type="submit" name="Register" value="Sign Up">
						</form>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="copyright">
		<p>© 2020 Shivam</p>
	</div>
</body>
</html>
