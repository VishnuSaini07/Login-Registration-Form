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
     <title>Registeration</title>
</head>

<body>
     <div class="container">
          <form class="shadow-lg rounded" action="register.php" method="post">
               <h1 class="mb-3 fw-bold">Registeration</h1>
               <?php
               if (isset($_POST['submit'])) {
                    $fullName = $_POST['fullname'];
                    $userName = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    $errors = array();

                    if (empty($fullName) or empty($userName) or empty($email) or empty($password)) {
                         array_push($errors, "All fields are required");
                    }

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                         array_push($errors, "Email is not valid");
                    }

                    if (strlen($password) < 8) {
                         array_push($errors, "Password must be atleast 8 characters long");
                    }

                    require_once 'database.php';
                    $sql = "SELECT * from users WHERE email = '$email' ";
                    $result = mysqli_query($conn, $sql);
                    $rowCount = mysqli_num_rows($result);

                    if ($rowCount > 0) {
                         array_push($errors, "Email already exists!");
                    }

                    if (count($errors) > 0) {
                         foreach ($errors as $error) {
                              echo "<div class='alert alert-danger p-1 mb-3'>$error</div>";
                         }
                    } else {
                         // we will insert the data into database
                         $sql = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)";
                         $stmt = mysqli_stmt_init($conn);
                         $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                         if ($prepareStmt) {
                              mysqli_stmt_bind_param($stmt, 'ssss', $fullName, $userName, $email, $passwordHash);
                              mysqli_stmt_execute($stmt);
                              echo "<div class='alert alert-success'>Register Successfully</div>";
                         } else {
                              die("Something went wrong");
                         }
                    }
               }
               ?>

               <div class="mb-3">
                    <label for="InputFullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="fullname" id="InputFullName">
               </div>

               <div class="mb-3">
                    <label for="InputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="InputUsername">
               </div>

               <div class="mb-3">
                    <label for="InputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="InputEmail">
               </div>

               <div class="mb-3">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="InputPassword">
               </div>

               <button type="submit" name="submit" class="btn btn-primary w-100 mb-2">Sign Up</button>

               <p class="ms-auto fs-6">Already have an account?
                    <a href="login.php" class="text-decoration-none">Click here</a>
               </p>
          </form>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>