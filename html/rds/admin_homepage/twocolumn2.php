<!DOCTYPE HTML>
<?php
if(!isset($_SERVER['HTTP_REFERER'])){

    header('location:../../error/error.html');
    exit;
}
?>
<?php
  include "../db_connection.php";
	session_start();
	$_SESSION['link']="./invoice.php";

?>

<html>
	<head>
		<title>RDS</title>
		<meta name="theme-color" content="#000000">
<meta name="msapplication-navbutton-color" content="#000000">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>

		<style>


tr:nth-child(even) {background-color: #f2f2f2;}
/*.header1: {background-color: #000000;color: rgb(255,255,255);}*/
</style>

	</head>
	<body>

		<!-- Header -->
		<div id="header">
			<div class="container">

				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">RDS</a></h1>

				</div>

				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li ><a href="twocolumn2.php"><?php echo "Logged in as: ".$_COOKIE['username']; ?></a></li>
						<li><a href="index.php">Items</a></li>
            <li><a href="twocolumn1.php">Purchase</a></li>
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
					<div class="9u">
						<section>
							<header>
								<h2>Sales</h2>
                <h4> <?php echo $msg; ?> </h4>
							</header>


						</section>
					</div>

					 <div class="form-group">
             <form role = "form"
                action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">

                <button type = "submit" name = "daily" value = "daily" class="btn btn-info">Daily</button>
                <label>&nbsp&nbsp</label>
                <button type = "submit" name = "monthly" value = "monthly" class="btn btn-info">Monthly</button><br><br>
                <label>From :  </label>
                <input type="date" name="start_date" placeholder="Start Date"><br>
                <label>&nbsp&nbsp&nbsp&nbsp To :  </label>
                <input type="date" name="end_date" placeholder="End Date">
                <label>&nbsp&nbsp</label>
                <button type = "submit" name = "period" value = "period" class="btn btn-info">Choose Period</button>
                <br><br><br>
              </form>
                     <form name="add_name" id="add_name" action="twocolumn1.php" method="post">
                          <div class="table-responsive">
                               <table class="table table-bordered" id="dynamic_field">
                                    <tr>

                                         <th bgcolor="#000000"><strong><font color="#fff">Date</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Time</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Items</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Quantity</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Price</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Total Price</font></strong></th>
                                    	<th bgcolor="#000000"><strong><font color="#fff">Profit</font></strong></th>




<!--
                                         <td>Date</td>
                                         <td>Time</td>
                                         <td>Items</td>
                                         <td>Quantity</td>
                                         <td>Price</td>
                                         <td>Total Price</td>
                                         <td>Profit</td> -->

                                    </tr>

                <?php
                  $msg = '';
									$mysqli = OpenCon();

									$user2=$_COOKIE['username'];

                  $period = $_POST['radio'];
                  $today = date('Y-m-d');

                  if(isset($_POST['daily'])){
                    $yesterday = new DateTime($today);
                    $yesterday->sub(new DateInterval('P1D'));
                    $yesterday = $yesterday->format('Y-m-d');

                    $sql = "SELECT * FROM orders WHERE date between '$yesterday' and
                    DATE_ADD('$today',INTERVAL 1 DAY)";
                  }
                  else if(isset($_POST['monthly'])){
                    $last_month = new DateTime($today);
                    $last_month->sub(new DateInterval('P1M'));
                    $last_month = $last_month->format('Y-m-d');
                    // echo $last_month;
                    // echo $today;
                    $sql = "SELECT * FROM orders WHERE date between '$last_month' and
                    DATE_ADD('$today',INTERVAL 1 DAY)";
                  }
                  else{
                    $period_beg = $_POST['start_date'];
                    //echo $period_beg;
                    $period_end = $_POST['end_date'];
                    //echo $period_end;
                    $sql = "SELECT * FROM orders WHERE date between '$period_beg' and
                    DATE_ADD('$period_end',INTERVAL 1 DAY)";
                  }
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
									            echo "<td>".$row['date']."</td>";
									            echo "<td>".$row['time']."</td>";
									            echo "<td><pre>".$items_f."</pre></td>";
									            echo "<td><pre>".$q_f."</pre></td>";
									            echo "<td><pre>".$price_f."</pre></td>";
									            echo "<td>".$row['total']."</td>";
									            echo "<td>".$row['profit']."</td>";

									            echo "</tr>";
									        }
									        $res->free();
									    }
									    else {
									        echo "No sales in given period";
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
