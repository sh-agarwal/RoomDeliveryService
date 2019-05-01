<!DOCTYPE HTML>

<?php
  include "../db_connection.php";
	session_start();

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

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
	</head>
	<body>

		<?php
		    $msg='';
		    $names = array();
		    $quantity = array();
		    $price = array();
		    $cp = array();
		    $preptime = array();
		    $profit=0;
		    $total=0;
		    $prep_total=0;
		    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit']) )
		    {
		       //$msg="Reached here".$_POST['qty1'];
		       $mysqli = OpenCon();
		       $j=1;
		       $i=$_SESSION['i'];
           $k=0;
           $sql_two = "SELECT * FROM item WHERE threshold >= stock AND name != 'coffee' AND name != 'tea'";

            /*initializing name of items in purchase list*/
             if ($res_two = $mysqli->query($sql_two)) {
                 if ($res_two->num_rows > 0) {
                     while ($row_two = $res_two->fetch_array())
                     {
                         $k++;
                         $names[$k] = $row_two['name'];
                     }
                     $res_two->free();
                 }
                 else {
                     echo "No matching records are found.";
                 }
              }

			        while ($j<=$i)
			        {
                  $quantity[$j] = $_POST['qty'.$j];
			            $sql = "UPDATE item SET stock=stock+'$quantity[$j]' WHERE name='".$names[$j]."'";
                  // echo  $quantity[$j];
                  // echo  $names[$j];
                  $res = $mysqli->query($sql);
						      if($res === true){
                      $msg="<strong><font color=green bold size='4pt'>Purchase successfull</font color></strong>";
						      }
                  else{
                      echo "ERROR: Could not execute $sql. " . $mysqli->error;
                  }
			            $j++;
			        }

			     $mysqli->close();
		    }
		?>




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
						<li ><a href="twocolumn1.php"><?php echo "Logged in as: ".$_COOKIE['username']; ?></a></li>
						<li><a href="index.php">Home</a></li>
            <li class="active"><a href="twocolumn1.php">Purchase</a></li>
						<li><a href="twocolumn2.php">Sales</a></li>
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
								<h2>Purchase List</h2>
								<h3><?php echo $msg; ?></h3>
							</header>


						</section>
					</div>

					 <div class="form-group">
                     <form name="add_name" id="add_name" action="twocolumn1.php" method="post">
                          <div class="table-responsive">
                               <table class="table table-bordered" id="dynamic_field">
                                    <tr>

                                         <td>Item</td>

                                         <td>Price (per unit)</td>
                                         <td>Stock</td>
                                         <td>Quantity</td>
                                    </tr>
                                    <?php
									$mysqli = OpenCon();
									$i=0;

									$sql = "SELECT * FROM item WHERE threshold >= stock AND name != 'coffee' AND name != 'tea'";
									if ($res = $mysqli->query($sql)) {
									    if ($res->num_rows > 0) {

									        while ($row = $res->fetch_array())
									        {
									            $i++;
                              $names[$i] = $row['name'];

									            echo "<tr>";
									            echo "<td>".$row['name']."</td>";

									            echo "<td>".$row['cp']."</td>";
									            echo "<td>".$row['stock']."</td>";
									            echo "<td><input type=\"number\" name=\"qty".$i."\" value=\"0\" class=\"form-control name_list\" min=\"0\" max=\"500\" /></td>";
									            echo "</tr>";
									        }
									        $res->free();
									    }
									    else {
									        echo "No matching records are found.";
									    }
									}
									$_SESSION['i']=$i;


									$mysqli->close();
									?>
                               </table>
                              <input type="submit" name="submit" id="submit" class="btn btn-info" value="Purchase" />
                              <!--  <input type="button"  value="Submit" />   -->
                          </div>
                     </form>
                </div>

				</div>
			</div>
		</div>

		<!-- <div id="marketing">
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
		</div> -->

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
