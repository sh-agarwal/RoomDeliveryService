<!DOCTYPE HTML>

<?php
  include "../db_connection.php";
	session_start();
	$_SESSION['link']="./invoice.php";

?>

<html>
	<head>
		<title>RDS</title>
		<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="style2.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
           <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
		<script src="js/skel.min.js"></script>
<!-- 		<script src="js/skel-panels.min.js"></script> -->
		<script src="js/init.js"></script>


		<noscript>
			<link rel="stylesheet" type="text/css" href="css/skel-noscript.css" />
			<link rel="stylesheet" type="text/css" href="css/style.css" />
			<link rel="stylesheet" type="text/css" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
		<style>


tr:nth-child(even) {background-color: #f2f2f2;}
/*.header1: {background-color: #000000;color: rgb(255,255,255);}*/
</style>
	</head>
	<body >

		<?php
		    $msg='';

		    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit']) )
		    {
		       //$msg="Reached Here";
		       $mysqli = OpenCon();




						$name=$_POST['name'];
						$preptime=$_POST['preptime'];
						$stock=$_POST['stock'];
						$threshold=$_POST['threshold'];
						$price=$_POST['rate'];
						$cp=$_POST['cp'];
						$status;
						if($stock>$threshold)
							$status=1;
						else
							$status=0;
						$val=true;

						//Checking if name already exists
						$sql = "SELECT * FROM item";
									if ($res = $mysqli->query($sql)) {
									    if ($res->num_rows > 0) {

									        while ($row = $res->fetch_array())
									        {

									        	if($row['name']==$name)
									        	{
									        		$val=false;
									        		$msg="<strong><font color=red size='4pt'>Item name already present</font color></strong>";
									        	}


									        }
									        $res->free();
									    }
									    else {
									        echo "No items present in items table.";
									        $val=false;
									    }
									}

						if($val==true)
						{
							$sql = "INSERT INTO item (`name`, `preptime`, stock, threshold, `status`, price, cp)
					              VALUES('$name',$preptime,$stock,$threshold,$status,$price,$cp)";

							    if ($mysqli->query($sql) ==  false)
							    {
							    	$val=false;
							    	$msg="<strong><font color=red size='4pt'>Item could not be added</font color></strong>";
							    }
						}

						if($val==true)
						{
							$msg="<strong><font color=green size='4pt'>Item successfully added</font color></strong>";

						}




		    }

		?>

		<!-- Header -->
		<div id="header" bgcolor="#E6E6FA">
			<div class="container">

				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">RDS</a></h1>
					
				</div>

				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li ><a href="index.php"><?php echo "Logged in as: ".$_COOKIE['username']; ?></a></li>
						<li class="active"><a href="index.php">Items</a></li>
            <li><a href="twocolumn1.php">Purchase</a></li>
						<li ><a href="twocolumn2.php">Sales</a></li>
            <li ><a href="twocolumn3.php">Queue</a></li>
						<li><a href="../index.php">Logout</a></li>
					</ul>
				</nav>

			</div>
		</div>
		<!-- Header -->

		<div id="banner">&nbsp;</div>

		<div id="featured">
			<div class="container">
				<div class="row">
					<div class="9u">
						<section>
							<header>
								<h2>Items</h2>

							</header>


						</section>
					</div>

					 <table class="table table-bordered" id="dynamic_field">
                                    <tr>

                                         

                                    	<th bgcolor="#000000"><strong><font color="#fff">Name</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Stock</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Rate</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Threshold</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Cost Price</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Prep Time</font></strong></th>
                                    	

                                         



                                         <!-- <td><strong>Name</strong></td>
                                         <td><strong>Stock</strong></td>
                                         <td><strong>Rate</strong></td>
                                         <td><strong>Threshold</strong></td>

                                         <td><strong>Cost Price</strong> </td>
                                         <td><strong>Prep Time</strong></td> -->


                                    </tr>

                                    <?php
									$mysqli = OpenCon();


									//$user2=$_COOKIE['username'];

									$sql = "SELECT * FROM item";
									if ($res = $mysqli->query($sql)) {
									    if ($res->num_rows > 0) {

									        while ($row = $res->fetch_array())
									        {


									            echo "<tr>";
									            echo "<strong><td>".$row['name']."</td></strong>";
									            echo "<td>".$row['stock']."</td>";
									            echo "<td>".$row['price']."</td>";

									            echo "<td>".$row['threshold']."</td>";
									            echo "<td>".$row['cp']."</td>";
									            echo "<td>".$row['preptime']."</td>";

									            echo "</tr>";
									        }
									        $res->free();
									    }
									    else {
									        echo "No items are there";
									    }
									}









									$mysqli->close();
									?>
                               </table>

					 <div class="form-group">
                     <form name="add_name" id="add_name" action="index.php" method="post">
                          <div class="table-responsive">


                               <h2>Add new item</h2>
                               <h3><?php echo $msg; ?></h3>
                               <table class="table table-bordered" id="dynamic_field2">
                                    <tr>

                                         <th bgcolor="#000000"><strong><font color="#fff">Name</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Stock</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Rate</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Threshold</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Cost Price</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Prep Time</font></strong></th>
                                    	



                                         <!-- <td><strong>Name</strong></td>
                                         <td><strong>Stock</strong></td>
                                         <td><strong>Rate</strong></td>
                                         <td><strong>Threshold</strong></td>

                                         <td><strong>Cost Price</strong> </td>
                                         <td><strong>Prep Time</strong></td> -->
                                    </tr>




									            <td><input type="text" name="name" placeholder ="Enter item name" class="form-control name_list" required="required" pattern="[A-Za-z' ']+"/></td>
									            <td><input type="number" name="stock" value="0" class="form-control name_list" min="0" /></td>
									            <td><input type="number" name="rate" value="0" class="form-control name_list" min="0" /></td>
									            <td><input type="number" name="threshold" value="0" class="form-control name_list" min="0" /></td>
									            <td><input type="number" name="cp" value="0" class="form-control name_list" min="0" /></td>
									            <td><input type="number" name="preptime" value="0" class="form-control name_list" min="0" /></td>
									            </tr>


                               </table>






                              <input type="submit" name="submit" id="submit" class="btn btn-info" value="Add" />
                              <!--  <input type="button"  value="Submit" />   -->
                          </div>
                     </form>
                </div>

				</div>
			</div>
		</div>


		<div id="marketing">
			<div class="container">
				<div class="row">
					<div class="3u">
						<section>
							<header>
								<h2>New Range</h2>
							</header>
							<ul class="style1">
								<li class="first"><img src="images/pics06.jpg" width="220" height="160" alt="">
									<p>Hot and fresh steam cooked traditional momos. </p>
								</li>
								<li><img src="images/pics07.jpg" width="220" height="160" alt="">
									<p>A somasa a day, keeps doctor away! </p>
								</li>
								<li><img src="images/pics08.jpg" width="220" height="160" alt="">
									<p>Fritter made in healthy sunflower oil. </p>
								</li>
							</ul>
						</section>
					</div>
					<div class="3u">
						<section>
							<header>
								<h2></h2>
							</header>
							<ul class="style1">

							</ul>
						</section>
					</div>
					<div class="6u">
						<section>

							<header>
								<h2>Coming Soon...</h2>
							</header>
							<a href="#" class="image full"><img src="images/pics12.jpg" alt=""></a>
							<p>Doritos is an American brand of flavored tortilla chips produced since 1964 by Frito-Lay, a wholly owned subsidiary of PepsiCo. The original Doritos were not flavored. The first flavor was Taco, released in 1967, though other flavors have since debuted for the company.</p>
						</section>
					</div>
				</div>
			</div>
		</div>

		<div id="main">
			<div class="container">
				<div class="row">
					<div class="8u">
						<section>
							<header>

								<h2>Core 2 Canteen</h2>
							<a href="#" class="image full"><img src="images/map.png" alt=""></a>
							</header>
							<p>We started in 1999 shortly after starting of Institute which makes us one of the oldest caterers in the Institute.</p>
							<p>We have been awarded various certificates in fields of cleanliness, quality and services.</p>
							<p>We are dedicated towards providing around the clock quality and prompt service. If you have any feedback, contact 0361-258-0000</p>
						</section>
					</div>
					<div class="4u">
						<section>
							<header>
								<h2>Important Links</h2>
							</header>
							<ul class="style">
								<li><a href="http://www.iitg.ac.in">IITG Webpage</a></li>
								<li><a href="https://intranet.iitg.ernet.in">IITG Webpage (Intranet)</a></li>
								<li><a href="https://www.office.com">Outlook</a></li>

							</ul>
						</section>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
