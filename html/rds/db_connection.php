<?php
    if(!isset($_SERVER['HTTP_REFERER'])){
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        header('location:../../error/error.html');
        exit;
    }
?>
<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "password#123";
 $db = "db";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 return $conn;
 }

function CloseCon($conn)
 {
 $conn -> close();
 }

?>
