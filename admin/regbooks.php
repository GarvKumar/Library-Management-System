<?php
	require('functions.php');
	session_start();
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
	$book_name = "";
	$author = "";
	$category = "";
	$book_no = "";
	$price = "";
	$book_stock="";
	$query = "select books.book_name,books.book_no,books.book_price,books.book_stock,authors.author_name from books left join authors on books.author_id = authors.author_id";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		#side_bar{
  			background-color: whitesmoke;
  			padding: 50px;
  			width: 300px;
  			height: 450px;
  		}
		  .srch{
			  padding-left:1000px;
		  }
  	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Library Management System(LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></span></font>
			<ul class="nav navbar-nav navbar-right">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="view_profile.php">View Profile</a>
						<a class="dropdown-item" href="edit_profile.php"> Edit Profile</a>
						<a class="dropdown-item" href="change_password.php">Change Password</a>
					</div>
				</li>
				<li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
	<div class="container-fluid">
		<ul class="nav navbar-nav navbar-center">
			<li class="nav-item">
				<a href="admin_dashboard.php" class="nav-link">Dashboard</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown">Book</a>
				<div class="dropdown-menu">
					<a href="" class="dropdown-item">Add New Book</a>
					<a href="" class="dropdown-item">Manage Books</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown">Category</a>
				<div class="dropdown-menu">
					<a href="" class="dropdown-item">Add New Category</a>
					<a href="" class="dropdown-item">Manage Category</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown">Author</a>
				<div class="dropdown-menu">
					<a href="" class="dropdown-item">Add New Author</a>
					<a href="" class="dropdown-item">Manage Authors</a>
				</div>
			</li>
			<li class="nav-item">
				<a href="" class="nav-link">Issue Book</a>
			</li>
			<li class="nav-item">
				<a href="" class="nav-link">Return Book</a>
			</li>
		</ul>
	</div>
</nav>
<span><marquee>This is library Management System. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
<div class="srch">
	<form class="navbar-form" method="post" name="form1">
			<input  type="text" name="search" placeholder="search books.." required="">
			<button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">Search	</button>
	</form>
</div>
<center><h2>List Of Registered Books</h2></center>
<?php
	if(isset($_POST['submit']))
	{
		$q=mysqli_query($db,"SELECT * from books where book_name like '%$_POST[search]%'");
		if(mysqli_num_rows($q)==0)
		{
			echo "Sorry! No book found. Try searching again.";
		}
		else{
			echo "<table class='table table-bordered table-hover'>";
				echo "<tr style='background-color:#6db6b9e6;'>";					
					echo "<th>"; echo "Name"; echo "</th>";
					echo "<th>"; echo "Author"; echo "</th>";
					echo "<th>"; echo "Price"; echo "</th>";
					echo "<th>"; echo "Number"; echo "</th>";
					echo "<th>"; echo "Books stock"; echo "</th>";
				echo "</tr>";
				while($row=mysqli_fetch_assoc($q))
				{
					echo "<tr>";					
					echo "<td>"; echo $row['book_name']; echo "</td>";
					echo "<td>"; echo $row['author_name']; echo "</td>";
					echo "<td>"; echo $row['book_price']; echo "</td>";
					echo "<td>"; echo $row['book_no']; echo "</td>";
					echo "<td>"; echo $row['book_stock']; echo "</td>";
					echo "</tr>";
				}
			echo "</table>";
			}
	}
	else{
		
		echo "<table class='table table-bordered table-hover'>";
			echo "<tr style='background-color:#6db6b9e6;'>";				
				echo "<th>"; echo "Name"; echo "</th>";
				echo "<th>"; echo "Author"; echo "</th>";
				echo "<th>"; echo "Price"; echo "</th>";
				echo "<th>"; echo "Number"; echo "</th>";
				echo "<th>"; echo "Books stock"; echo "</th>";
			echo "</tr>";
			$query_run=mysqli_query($connection,$query);
			while($row=mysqli_fetch_assoc($query_run))
			{
				echo "<tr>";
				echo "<td>"; echo $row['book_name']; echo "</td>";
				echo "<td>"; echo $row['author_name']; echo "</td>";
				echo "<td>"; echo $row['book_price']; echo "</td>";
				echo "<td>"; echo $row['book_no']; echo "</td>";
				echo "<td>"; echo $row['book_stock']; echo "</td>";
				echo "</tr>";
			}
		echo "</table>";
	}
	
?>	
<div class="text-right">
					<button onclick="window.print();" class="btn btn-primary">Print</button>	</div>
</body>
<html>		

