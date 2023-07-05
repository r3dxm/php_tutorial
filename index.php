<?php
include("database.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <h2>Welcome to Book</h2>
    <label>username : </label>
    <input type="text" name="username" /><br>
    <label>password : </label>
    <input type="password" name="password" /><br>
    <input type="submit" name="submit" value="register" />
  </form>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

  if (empty($username)) {
    echo "please enter a username";
  } else if (empty($password)) {
    echo "please enter a password";
  } else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user, password) VALUES ('$username', '$hash')";
    try {
      mysqli_query($con, $sql);
      echo "you are now registered";
    } catch (mysqli_sql_exception $e) {
      echo "user already exists";
    }
  }
}
mysqli_close($con);
?>