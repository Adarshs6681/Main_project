<?php
	include'config.php';
  session_start();
  $user_id = $_SESSION['user_id'];
?>
	<!DOCTYPE html>
	<html>

	<head>
		<style>
			table {
				border-collapse: collapse;
				border-spacing: 0;
				width: 100%;
				border: 1px solid #ddd;
			}

			th,
			td {
				text-align: left;
				padding: 8px;
			}

			tr:nth-child(even) {
				background-color: #f2f2f2
			}
		</style>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="home.css">

		<div class="header">
		
		</div>

	</head>

	<body>

		<!-- End Header -->



		<div class="categories">
			<div class="small-container">

				<h2 align="center" style="color:#1552ad">MY ORDERS</h2>
				<?php
				$query = "SELECT * FROM appointments where user_id=$user_id;";
				$query_exe=mysqli_query($conn,$query);

				$no = mysqli_num_rows($query_exe);
				if ($no == 0) {
					echo "&quot;No records here!!&quot;";
				} else {
				?>
					<!-- <table class="table">
						<thead>
							<tr>
								<th>Date</th>
								<th>Equipment</th>
								<th>Image</th>
								<th>Quantity</th>
								<th>Price</th>




							</tr>
						</thead> -->
					<!-- <tbody> -->
					<div>
						<div class="c2" style="width:625px; height:25px;margin-left: 22%;margin-top:4%;">
							<h3 style="margin-left:25px;">Order summary</h3>
						</div>
						<?php
						$total = 0;

						while ($row1 = mysqli_fetch_array($query_exe)) {
						?>
							<div class=conta-1 style="margin-top:25px;margin-left: 22%;">

								<!-- <a href="product_details.php?id=<?php echo $row1['pettype'] ?>"> -->
								<div class="c3">
									<div class="oimage" style="margin-left: 10px;margin-top:5px;">
										<h5>Symptoms:&nbsp; <?php echo $row1['symptoms']; ?></h5>
										
									</div>
									<div class="odetails">
										<h3><?php echo $row1['placed_on']; ?></h3>
										<div class="odetails-col-2">
											<h5>OrderId:&nbsp; <?php echo $row1['Date']; ?></h5>


										</div>
										<h5>Size: &nbsp; Medium</h5>
										<h5>Color: &nbsp; Blue</h5>
										<h5>Quantity:&nbsp; <?php echo $row1[3]; ?></h5>
										<div class="odetails-col-2">
											<h5>Payment Status:</h5>
											<?php if ($row1[7] == "Not paid") { ?>
												<p class="offred"><?php echo $row1[7]; ?></p><br>
										</div><br><?php } else { ?>
										<p class="off"><?php echo $row1[7]; ?></p><br>
									</div><br><?php } ?>
								<div class="odetails-col-2">
									<h5>Delivery Status:</h5>
									<p class="off"><?php echo $row1[6]; ?></p><br>
								</div>
								<div style="margin-top:20px;">
									<!-- <a class="btn2" href="delgpo.php?id=<?php echo $row1[0]; ?>">Remove</a>
                                     -->
								</div>

								</div>
							</div>
							<!-- </a> -->
					</div>
				<?php }
				?>

				<br>
			<?php

				}
			?>
			</div>
		</div>
		</div>

		<!-- End Main -->
		<!-- Footer -->
	</body>

	</html>
