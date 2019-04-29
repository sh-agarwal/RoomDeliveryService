<?php
   ob_start();
   session_start();

  include "db_connection.php";
?>
<html>
<head>
<title>RDS</title>
    <link rel="stylesheet" type="text/css" href="style_signup.css">
    <link rel="icon" type="image/png" href="./images/icons/favicon.ico"/>
<body>
    <div>
      <?php
        //$msg = $_SESSION['username'];
        $in_user = $_POST['username'];
        $in_first = $_POST['firstname'];
        $in_last = $_POST['lastname'];
        $in_dep = $_POST['department'];
        $in_type = $_POST['type'];
        $in_address = $_POST['address'];
        $in_email = $_POST['email'];
        $in_contact = $_POST['contact'];
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register']) &&  !empty($in_user) &&  !empty($in_first)
        &&  !empty($in_last) &&  !empty($in_dep) &&  !empty($in_type) &&  !empty($in_address) &&  !empty($in_email)
        && !empty($in_contact))
        {
          // echo "checking.." . $in_user . "<br>";
          // echo "Hello World!<br>";
          $conn = OpenCon();
          $hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
          //echo $hash_pass . "<br>";
          $q = "INSERT INTO user (username, firstname, lastname, department, type, address, admin, password, email, contact)
                VALUES ('$in_user', '$in_first', '$in_last', '$in_dep', '$in_type', '$in_address', 0, '$hash_pass', '$in_email', 1)";
          if($conn->query($q) == true){
            $msg = "Registration successfull";
          }
          else {
            $msg = "Error: <br>" . $conn->error;
          }
          CloseCon($conn);
        }
        else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register'])){
          $msg = 'Fill up all fields';
        }
      ?>
    </div>
    <div class="signupbox" >

        <h1>Sign Up</h1>
        <form role = "form"
           action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
           ?>" method = "post">
           <h4><?php echo $msg; ?></h4>
            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Username">

            <p>First Name</p>
            <input type="text" name="firstname" placeholder="Enter First Name">
            <p>Last Name</p>
            <input type="text" name="lastname" placeholder="Enter Last Name">

            <p>Address</p>
            <input type="text" name="address" placeholder="Enter Address">
            <p>Email</p>
            <input type="text" name="email" placeholder="Enter Email">
            <p>Contact number</p>
            <input type="text" name="contact" placeholder="Enter Contact number">
            <p>Department</p>
            <input type="radio" name="department" value="CSE" checked> CSE<br>
            <input type="radio" name="department" value="EEE"> EEE<br>
            <input type="radio" name="department" value="DD"> DD
            <p>Type</p>
            <input type="radio" name="type" value="Student" checked> Student<br>
            <input type="radio" name="type" value="Faculty"> Faculty
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <button type = "submit" name = "register">Register</button>
            <a href="./index.php">Login</a>
        </form>

    </div>

</body>
</head>
</html>
