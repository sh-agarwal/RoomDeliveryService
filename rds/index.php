<?php
   //ob_start();
   session_start();

  include "db_connection.php";
?>



<html>
<head>
<title>RDS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/png" href="./images/icons/favicon.ico"/>
    <meta name="theme-color" content="#8B008B">
<meta name="msapplication-navbutton-color" content="#000000">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<body>

    <div>
      <?php
         $msg = '';

         if (isset($_POST['login']) && !empty($_POST['username'])
            && !empty($_POST['password'])) {

              $user = $_POST['username'];

              $pass = $_POST['password'];
              //$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
              //echo password_hash($pass, PASSWORD_DEFAULT);
              $conn = OpenCon();
              if ($res = $conn->query("SELECT * FROM user WHERE username='$user'"))  {
                $row = $res->fetch_assoc();
                if ($res->num_rows > 0 && password_verify($pass, $row['password'])) {
                  //$_SESSION['valid'] = true;
                  //$_SESSION['timeout'] = time();
                  //$_SESSION['username'] = $user;
                	setcookie('valid', true, time() + (86400 * 30), "/");
                	setcookie('time', time(), time() + (86400 * 30), "/");
                	setcookie('username', $user, time() + (86400 * 30), "/");
                  //$_COOKIE['valid'] = true;
                  //$_COOKIE['timeout'] = time();
                  //$_COOKIE['username'] = $user;

                  if($row['admin']==1){
                    header( 'Location: ./admin_homepage/index.php' );
                  }
                  else{
                    header( 'Location: ./homepage/index.php' );
                  }
                  $res->free();
                }
                else {
                    $msg = 'Wrong username or password';
                }
              }
              else {
                echo "\nERROR: Cannot execute sql query";
               }
                 // $res = $conn->query("SELECT username FROM user WHERE username = $user  AND password = $pass");
                 // $row = $res->fetch_assoc();
                 // echo "{$row['username']}";
                 // $res->free();
               CloseCon($conn);
         }

      ?>
    </div> <!-- /container -->

    <div class = "loginbox">
    <img src="avatar.png" class="avatar">
        <h1>Room Delivery Service</h1>
        <form  role = "form"
           action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
           ?>" method = "post">
           <h4><?php echo $msg; ?></h4>
            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <button type = "submit" name = "login">Login</button>

            <a href="./signup.php">Don't have an account? Sign up</a>
        </form>

    </div>

</body>
</head>
</html>
