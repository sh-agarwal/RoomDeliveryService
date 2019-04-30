<?php
  include "../db_connection.php";
	session_start();
	//$_SESSION['link']="./invoice.php";

?> 

<?php
									
									//Fetching first name and last name
									$mysqli = OpenCon(); 
									
									$id=$_GET['link'];
								  
									$sql = "SELECT * FROM orders where id='".$id."'"; 
									if ($res = $mysqli->query($sql)) { 
									    if ($res->num_rows > 0) { 
									        
									        while ($row = $res->fetch_array())  
									        { 
									           
									            setcookie('firstname',$row['firstname']);
									            setcookie('lastname',$row['lastname']);
									            setcookie('id',$id);
									            setcookie('date',$row['date']);
									            setcookie('total',$row['total']);


									            
									            
									            
									        } 
									        $res->free(); 
									    } 
									    else { 
									        echo "Error"; 
									    } 
									} 
									
									

									$mysqli->close();
									?> 

<html>
	<head>
		<meta http-equiv="refresh" content="0.5">
		<meta charset="utf-8">
		<title>RDS</title>
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="script.js"></script>
	</head>
	<body>
		<header>
			<h1>Invoice</h1>
			
				<p>Room Delivery Service</p>
				<p>Ground floor, Core-2<br>IITG-781039</p>
				<p>(0361) 258-0000</p>
			
			<span><img alt="" src="logo.png"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			
				<p><?php echo $_COOKIE['firstname'] ?><br><?php echo $_COOKIE['lastname'] ?></p>
			
			<table class="meta">
				<tr>
					<th><span contenteditable>Invoice #</span></th>
					<td><?php echo $_COOKIE['id'] ?></td>
				</tr>
				<tr>
					<th><span contenteditable>Date</span></th>
					<td><?php echo $_COOKIE['date'] ?></td>
				</tr>
				<tr>
					<th><span contenteditable>Amount Due</span></th>
					<td><span id="prefix" >Rs.</span><span><?php echo $_COOKIE['total'] ?></span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span contenteditable>Item</span></th>
						<th><span contenteditable>Rate</span></th>
						<th><span contenteditable>Quantity</span></th>
						<th><span contenteditable>Price</span></th>
					</tr>
				</thead>
				<tbody>
					<?php
									$mysqli2 = OpenCon(); 
									
									$id=$_COOKIE['id'];
								  
									$sql = "SELECT * FROM orders where id='".$id."'"; 
									if ($res = $mysqli2->query($sql)) { 
									    if ($res->num_rows > 0) { 
									        
									        while ($row = $res->fetch_array())  
									        { 
									           
									            $items=unserialize($row['items']);
									            

    											$q=unserialize($row['quantity']);
									            

    											$price=unserialize($row['price']);

    											$temp;
									            

									            $round = count($price);
									            for($n = 1; $n <= $round; $n++){ 
									            	$temp=$price[$n]*$q[$n];
    												
    												echo "<tr>"; 
									            echo "<td>".$items[$n]."</td>"; 
									            echo "<td><span data-prefix>Rs.</span>".$price[$n]."</td>"; 
									            echo "<td>".$q[$n]."</td>"; 
									            echo "<td><span data-prefix>Rs.</span><span>".$temp."</span></td>"; 
									 
									            
									            echo "</tr>"; 




    											}

    											


									            
									        } 
									        $res->free(); 
									    } 
									    else { 
									        echo "No record found"; 
									    } 
									} 
									
									

									$mysqli2->close();
									?> 
					
				</tbody>
			</table>



			
			<table class="balance">
				<tr>
					<th><span >Total</span></th>
					<td><span data-prefix>Rs.</span><span><?php echo $_COOKIE['total'] ?></span></td>
				</tr>
				<tr>
					<th><span >Amount Paid</span></th>
					<td><span data-prefix>Rs.</span><span >0.00</span></td>
				</tr>
				<tr>
					<th><span >Balance Due</span></th>
					<td><span data-prefix>Rs.</span><span><?php echo $_COOKIE['total'] ?></span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1>Additional Notes</h1>
			<div >
				<p><center>Delaying payment for more than 24 Hours may result in fine.</center></p>
			</div>
		</aside>
	</body>
</html>