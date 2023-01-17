<?php require "includes/header.php"; ?>
<?php require "config.php"; ?>

<?php

//check fot the submit

//take the data and do the query

//execute the query

//fetch the data

//check for the row count

//and use the password_verify function


if (isset($_SESSION['username'])) {
  header("location: index.php");
}


if (isset($_POST['submit'])) {
  if ($_POST['email'] == '' or $_POST['password'] == '') {
    echo "some inputs are empty";
  } else {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = $conn->query("SELECT * FROM users WHERE email = '$email'");

    $login->execute();

    $data = $login->fetch(PDO::FETCH_ASSOC);


    if ($login->rowCount() > 0) {

      if (password_verify($password, $data['mypassword'])) {


        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];

        header("location: index.php");
      } else {
        echo "email or password is wrong";
      }
    } else {
      echo "email or password is wrong";
    }
  }
}



?>


<main class="form-signin w-50 m-auto">
    <form method="POST" action="login.php">
        <h1 class="h3 mt-5 fw-normal text-center">Please login in</h1>

        <div class="form-floating pt-5 pb-0">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>

        <div class="form-floating pt-5 pb-2">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <h6 class="mt-3">Don't have an account <a href="register.php">Create your account</a></h6>
    </form>
</main>
<?php require "includes/footer.php"; ?>