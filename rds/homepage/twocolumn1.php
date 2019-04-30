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
		<style>


tr:nth-child(even) {background-color: #f2f2f2;}
/*.header1: {background-color: #000000;color: rgb(255,255,255);}*/
</style>
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
		       $val=false;
		       if($i>=$j)
		       		$val=true;
		       $sql = "SELECT * FROM item"; 
									if ($res = $mysqli->query($sql)) { 
									    if ($res->num_rows > 0) { 
									        
									        while ($row = $res->fetch_array())  
									        { 
									            

									        	if($j<=$i && $val==true)
									        	{
									        		if($_POST['qty'.$j]>$row['stock'])
									            	{
									            		$msg="<strong><font color=red size='4pt'>Quantity for item ".$j." exceeds available stock. Kindly order again.</font color></strong>";
									            		$val=false;	
									            	}
									        	}
									 

									            	$j++;
								
									        } 
									        $res->free(); 
									    } 
									    else { 
									        echo "No matching records are found."; 
									        $val=false;
									    } 
									} 
		       
		       	if($val==true)
		       	{
		       		$j=1;
		       		$sql = "SELECT * FROM item"; 
									if ($res = $mysqli->query($sql)) { 
									    if ($res->num_rows > 0) { 
									        $val=false;
									        while ($row = $res->fetch_array())  
									        { 
									            
												
												if($j<=$i)
									        	{
									        		
									        		$quantity[$j]=$_POST['qty'.$j];
									        		if($quantity[$j]>0)
									        			$val=true;
									        		$price[$j]=$row['price'];
									        		$cp[$j]=$row['cp'];
									        		$preptime[$j]=$row['preptime'];
									        		if($_POST['qty'.$j]!= null && $_POST['qty'.$j]!= "")
									        			$_POST['qty'.$j]=$row['stock']-$_POST['qty'.$j];
									        		else
									        			$_POST['qty'.$j]=$row['stock'];
									        		$names[$j]=$row['name'];
									        	}
									 

									            	$j++;
									        } 
									        $res->free(); 
									    } 
									    else { 
									        echo "No matching records are found."; 
									        $val=false;
									    } 
									} 

					
									   
		       	}

		       	$contact;
		       	$firstname;
		       	$lastname;
		       	$address;

		       	if($val==true)
		       	{

		       		
		       		//Getting user's info

		       		$sql = "SELECT * FROM user WHERE username='".$_COOKIE['username']."'"; 
									if ($res = $mysqli->query($sql)) { 
									    if ($res->num_rows > 0) { 
									        
									        while ($row = $res->fetch_array())  
									        { 
									            
									        	$firstname=$row['firstname'];
									        	$lastname=$row['lastname'];
									        	$address=$row['address'];
									        	$contact=$row['contact'];
									        	
								
									        } 
									        $res->free(); 
									    } 
									    else { 
									        echo "No matching records are found."; 
									        $val=false;
									    } 
									} 
		       

					}

					$temp=0;

					if($val==true)		//Inserting new entry in orders table
					{
						
						$d=date("Y-m-d");
						$t=date("H:i:s");
						$items_f=serialize($names);
						$quantity_f=serialize($quantity);
						$price_f=serialize($price);
						$j=1;
						$user_temp=$_COOKIE['username'];
						while($j<=$i)	//total price ,profit and prep_time
						{
							$total+=($price[$j]*$quantity[$j]);
							$temp+=($cp[$j]*$quantity[$j]);	
							$prep_total+=($preptime[$j]*$quantity[$j]);
							$j++;
						}
						$profit=$total-$temp;
						$prep_total+=2;
						//$msg=$t;

						$sql = "INSERT INTO orders (`date`, `time`, username, items, quantity, price, total, profit, address, preptime, contact, status, firstname, lastname) 
					              VALUES('$d','$t','$user_temp','$items_f','$quantity_f','$price_f',$total,$profit,'$address',$prep_total,$contact,0,'$firstname','$lastname')"; 
							   
							    if ($mysqli->query($sql) ==  false)
							    {
							    	echo "ERROR: Could not able to execute $sql. "
							           .$mysqli->error; 
							          $val=false;
							    } 
							
							    
						} 
					
						

		       	

		       	if($val==true)		//Updating items stock and status
		       	{
		       		$j=1;
		       		
									        
									        while ($j<=$i)  
									        { 
									            

									            $sql = "UPDATE item SET stock=".$_POST['qty'.$j]." WHERE name='".$names[$j]."'"; 
												if($mysqli->query($sql) == false){ 
												
												    echo "ERROR: Could not able to execute $sql. "  
												                                        . $mysqli->error; 
												                                       $val=false;
												} 

									 

									            	$j++;
									        } 



		       	}


		       	if($val==true)
		       	{

		       		$j=1;
		       		$sql = "SELECT * FROM item"; 
									if ($res = $mysqli->query($sql)) { 
									    if ($res->num_rows > 0) { 
									        
									        while ($row = $res->fetch_array())  
									        { 
									            

									        	if(($row['name']=="tea"||$row['name']=="coffee")&&$val==true)
									        	{	//Tea and coffee should never run out
									        		if($row['stock']<=$row['threshold'])
									            	{	//Update status
									            	
									            		$sql2 = "UPDATE item SET stock=100 WHERE name='".$row['name']."'"; 
														if($mysqli->query($sql2) == false){ 
														
														    echo "ERROR: Could not able to execute $sql. "  
														                                        . $mysqli->error; 
														                                       $val=false;
														} 	
									            	}
									        	}


									        	else{
									        	if($j<=$i && $val==true)
									        	{
									        		if($row['stock']<=$row['threshold'])
									            	{	//Update status
									            	
									            		$sql2 = "UPDATE item SET status=1 WHERE name='".$row['name']."'"; 
														if($mysqli->query($sql2) == false){ 
														
														    echo "ERROR: Could not able to execute $sql. "  
														                                        . $mysqli->error; 
														                                       $val=false;
														} 	
									            	}
									        	}}
									 

									            	$j++;
								
									        } 
									        $res->free(); 
									    } 
									    else { 
									        echo "No matching records are found."; 
									        $val=false;
									    } 
									} 
		       



		       	}

		       	if($val==true)
		       	{
		       		$msg="<strong><font color=green bold size='4pt'>Order Successfully placed</font color></strong>";
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
					
				</div>
				
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li ><a href="twocolumn1.php"><?php echo "Logged in as: ".$_COOKIE['username']; ?></a></li>
						<li><a href="index.php">Home</a></li>
						<li class="active"><a href="twocolumn1.php">Order</a></li>
						<li><a href="twocolumn2.php">My Orders</a></li>
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
								<h2>Order</h2>
								<h3><?php echo $msg; ?></h3>
							</header>
							
							
						</section>
					</div>

					 <div class="form-group">  
                     <form name="add_name" id="add_name" action="twocolumn1.php" method="post">  
                          <div class="table-responsive">  
                               <table class="table table-bordered" id="dynamic_field">  
                                    <tr  > 
                                         <th bgcolor="#000000"><strong><font color="#fff">Item</font></strong></th>
                                         <th bgcolor="#000000"><strong><font color="#fff">Rate</font></strong></th>
                                         <th bgcolor="#000000"><strong><font color="#fff">Stock</font></strong></th>
                                         <th bgcolor="#000000"><strong><font color="#fff">Quantity</font></strong></th>
                                         <!-- <th bgcolor="#000000"><font color="#fff">Rate</font></th>
                                         <th bgcolor="#000000"><font color="#fff">Stock</font></th>
                                         <th bgcolor="#000000"><font color="#fff">Quantity</font></th> -->
                                         
                                        <!--  <th  >Item</th>  
                                         
                                         <th>Price (per unit)</th>
                                         <th>Stock</th>
                                         <th>Quantity</th>  -->
                                    </tr>  
                                    <?php
									$mysqli = OpenCon(); 
									$i=0;
								  
									$sql = "SELECT * FROM item"; 
									if ($res = $mysqli->query($sql)) { 
									    if ($res->num_rows > 0) { 
									        
									        while ($row = $res->fetch_array())  
									        { 
									            $i++;
									            echo "<tr>"; 
									            echo "<td>".$row['name']."</td>"; 
									            
									            echo "<td>".$row['price']."</td>";
									            echo "<td>".$row['stock']."</td>"; 
									            echo "<td><input type=\"number\" name=\"qty".$i."\" value=\"0\" class=\"form-control name_list\" min=\"0\" max=\"".$row['stock']."\" /></td>";
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
                              <input type="submit" name="submit" id="submit" class="btn btn-info" value="Order" />
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

