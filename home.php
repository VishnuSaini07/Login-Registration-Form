<?php
session_start();
if (!isset($_SESSION['email'])) {
     header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
     <title>Dashboard</title>
</head>

<body>
     <div class="container">
          <div class="card" style=" width: 500px; padding: 20px">
               <h3>Hello, <?php echo $_SESSION['email'] ?> </h3>
               <a href="logout.php" class="btn btn-primary">Logout</a>
          </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>