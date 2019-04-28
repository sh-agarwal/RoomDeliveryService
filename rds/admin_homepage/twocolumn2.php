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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
		<div id="header">
			<div class="container">

				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">RDS</a></h1>
					<h1><?php echo "Logged in as: ".$_COOKIE['username']; ?></h1>
				</div>

				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="index.php">Home</a></li>
            <li><a href="twocolumn1.php">Items</a></li>
						<li class="active"><a href="twocolumn2.php">Sales</a></li>
            <li><a href="twocolumn3.php">Queue</a></li>
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
					<div class="3u">
						<section>
							<header>
								<h2>Popular</h2>
							</header>
						</section>
						<section>
							<a href="#" class="image full"><img src="images/pics03.jpg" alt=""></a>
							<header>
								<h2>Delicious Parathas</h2>
							</header>
							<p>Simply Amazing.</p>
						</section>
						<section>
							<a href="#" class="image full"><img src="images/pics05.jpg" alt=""></a>
							<header>
								<h2>Refreshing Beverages</h2>
							</header>
							<p>Beat the Summer.</p>
						</section>
					</div>

					<div class="9u">
						<section>
							<header>
								<h2>Your Orders</h2>
								<h3><?php echo $msg; ?></h3>
							</header>


						</section>
					</div>

					 <div class="form-group">
                     <form name="add_name" id="add_name" action="twocolumn1.php" method="post">
                          <div class="table-responsive">
                               <table class="table table-bordered" id="dynamic_field">
                                    <tr>

                                         <td>Order Id</td>
                                         <td>Date</td>
                                         <td>Time</td>
                                         <td>Items</td>
                                         <td>Quantity</td>
                                         <td>Price</td>
                                         <td>Total Price</td>
                                         <td>Prep Time</td>
                                         <td>Status</td>

                                    </tr>
                                    <?php
									$mysqli = OpenCon();

									$user2=$_COOKIE['username'];

									$sql = "SELECT * FROM orders where username='".$user2."'";
									if ($res = $mysqli->query($sql)) {
									    if ($res->num_rows > 0) {

									        while ($row = $res->fetch_array())
									        {

									            $items=unserialize($row['items']);
									            $items_f="";
									            $round = count($items);
									            for($n = 1; $n <= $round; $n++){
    												$items_f=$items_f."\n".$items[$n];
    											}

    											$q=unserialize($row['quantity']);
									            $q_f="";
									            $round = count($q);
									            for($n = 1; $n <= $round; $n++){
    												$q_f=$q_f."\n".$q[$n];
    											}

    											$price=unserialize($row['price']);
									            $price_f="";
									            $round = count($price);
									            for($n = 1; $n <= $round; $n++){
    												$price_f=$price_f."\n".$price[$n];
    											}

    											$status;
    											$a = date('Y-m-d H:i:s');
    											$b = $row['date']." ".$row['time'];
    											$c = $row['date']." 00:".$row['preptime'].":00";
    											$newtimestamp = strtotime($b." + ".$row['preptime']." minute");
    											if (strtotime($a) > $newtimestamp )
    												$status="Delivered";
    											else
    												$status="Not Delivered";
    											//echo $newtimestamp;

               									//$b= new DateTime("2013-08-10 12:00");


									            echo "<tr>";
									            echo "<strong><td><a href=".$_SESSION['link']."?link=".$row['id'].">".$row['id']."</a></td></strong>";
									            echo "<td>".$row['date']."</td>";
									            echo "<td>".$row['time']."</td>";
									            echo "<td><pre>".$items_f."</pre></td>";
									            echo "<td><pre>".$q_f."</pre></td>";
									            echo "<td><pre>".$price_f."</pre></td>";
									            echo "<td>".$row['total']."</td>";
									            echo "<td>".$row['preptime']."</td>";
									            echo "<td>".$status."</td>";

									            echo "</tr>";
									        }
									        $res->free();
									    }
									    else {
									        echo "No past orders";
									    }
									}



									$mysqli->close();
									?>
                               </table>
                              <input type="button" name="submit" id="submit" class="btn btn-info" value="Refresh"><a href="twocolumn2.php"></a/>
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
