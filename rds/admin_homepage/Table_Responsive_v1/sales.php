<?php
   ob_start();
   session_start();

  include "db_connection.php";
?>
<!doctype html>
<html lang="en">
<head>
	<!-- <title>Table V01</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">

	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css"> -->
</head>
<body>

	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Date</th>
								<th class="column2">Order ID</th>
								<th class="column3">Name</th>
								<th class="column4">Price</th>
								<th class="column5">Quantity</th>
								<th class="column6">Total</th>
							</tr>
						</thead>
						<tbody>
                        <?php

                           $msg = '';
                           $conn = OpenCon();
                           echo "HEY OH";
                           echo "Werer fine";
                           if($res = $conn->query("SELECT * FROM orders")){
                                while($row = $res->fetch_assoc()){
                        ?>
                        <tr>
                          <td class="column1"><?php echo $row['date'] . " " . $row['time']?></td>
                          <td class="column2"><?php echo $row['id'] ?></td>
                          <td class="column3"><?php echo $row['items'] ?></td>
                          <td class="column4"><?php echo $row['total'] ?></td>
                          <td class="column5">1</td>
                          <td class="column6"><?php echo $row['total'] ?></td>
                        </tr>

                        <?php
                                }
                           }
                           else {
                             echo "\nERROR: Cannot execute sql query";
                            }
                           CloseCon($conn);
                        ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
