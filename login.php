<?php
session_start();
if (isset($_SESSION['email'])) {
	header('Location: home.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<title>Login</title>
</head>

<body>
	<div class="container">
		<form class="shadow-lg rounded" action="login.php" method="post">
			<h1 class="mb-3 fw-bold">Login</h1>

			<?php
			if (isset($_POST['login'])) {
				$email = $_POST['email'];
				$password = $_POST['password'];

				require_once 'database.php';
				$sql = "SELECT * FROM users WHERE email = '$email'";
				$result = mysqli_query($conn, $sql);
				$user = mysqli_fetch_array($result, MYSQLI_ASSOC);

				if ($user) {
					if (password_verify($password, $user['password'])) {
						session_start();
						$_SESSION['email'] = $email;
						header('Location: home.php');
						die();
					} else {
						echo "<div class='alert alert-danger'>Password does not match!</div>";
					}
				} else {
					echo "<div class='alert alert-danger'>Email does not exists!</div>";
				}
			}
			?>

			<div class="mb-3">
				<label for="exampleInputEmail" class="form-label">Email address</label>
				<input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
			</div>

			<div class="mb-3">
				<label for="exampleInputPassword" class="form-label">Password</label>
				<input type="password" class="form-control" name="password" id="exampleInputPassword">
			</div>

			<button type="submit" name="login" class="btn btn-primary w-100 mb-3">Submit</button>

			<p class="ms-auto fs-6">Create an account?
				<a href="register.php" class="text-decoration-none">Click here</a>
			</p>
		</form>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>