<?php
    session_start();
    if (!$_SESSION["logged"]) {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>

	<style>
	body {
	 width: 80%;
	 margin: 10vw auto;
	}

	.heading {
	 font-family: "Playfair Display", serif;
	 font-size: 10vw;
	}

	.subheading {
	 font-family: "Open Sans", sans-serif;
	 font-size: 1em;
	 line-height: 1.5;
	}

	@media screen and (min-width: 40em) {
	 body {
	   width: 50%;
	 }

	 .heading {
	   font-size: 6vw;
	 }

	 .subheading {
	   font-size: 1.75vw;
	 }
	}
	.underline--magical {
	 background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
	 background-repeat: no-repeat;
	 background-size: 100% 0.2em;
	 background-position: 0 88%;
	 transition: background-size 0.25s ease-in;
	}
	.underline--magical:hover {
	 background-size: 100% 88%;
	}
	</style>
	<title></title>
</head>
<body>
	<h1 class="heading">Welcome <span class="underline--magical"><?php echo $_SESSION['username']; ?>!</span></h1>
    <a href="logout.php"><h2 class="subheading"><span class="underline--magical">Logout!</span></h2></a> 
	<script src="main.js"></script>
</body>
</html>