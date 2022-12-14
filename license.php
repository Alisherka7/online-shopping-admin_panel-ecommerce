<?php include 'session.php'; ?>
<?php include 'public/menubar.php'; ?>

<?php 

	$sql	 = "SELECT * FROM tbl_license ORDER BY id DESC LIMIT 1";
    $result  = mysqli_query($connect, $sql);
    $data    = mysqli_fetch_assoc($result);

    if (isset($_POST['revoke_license'])) {
		$sql_delete = "DELETE FROM tbl_license";
   		$delete = mysqli_query($connect, $sql_delete);
	   	if ($delete) {
                $success =<<<EOF
                    <script>
                        alert('Your License has been revoked.');
                        window.location = 'logout.php';
                    </script>
EOF;
                echo $success;
                exit;
	   } else {
	      echo "Error deleting record: " . mysqli_error($connect);
	   }
	   mysqli_close($connect);   		
    }

?>


<!--content area start-->
<div id="content" class="pmd-content content-area dashboard">

	<!--tab start-->
	<div class="container-fluid full-width-container">
	
		<h1 class="section-title" id="services"></h1>
			
		<!--breadcrum start-->
		<ol class="breadcrumb text-left">
		  <li><a href="dashboard.php">Dashboard</a></li>
		  <li class="active">License</li>
		</ol><!--breadcrum end-->
	
		<div class="section"> 
			
			<div class="pmd-card pmd-z-depth">
				<div class="pmd-card-body">

					<div class="group-fields clearfix row">
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
							<div class="lead">LICENSE</div>
						</div>
					</div>

					<div class="table-responsive"> 
						<form method="post">
							<table class='table table-offset'>

								<tr>
									<td width="15%">Item ID</td>
									<td width="1%">:</td>
									<td><?php echo $data['item_id']; ?></td>
								</tr>

								<tr>
									<td>Item Name</td>
									<td>:</td>
									<td><?php echo $data['item_name']; ?></td>
								</tr>

								<tr>
									<td>Buyer</td>
									<td>:</td>
									<td><?php echo $data['buyer']; ?></td>
								</tr>

								<tr>
									<td>Purchase Code</td>
									<td>:</td>
									<td><?php echo $data['purchase_code']; ?></td>
								</tr>

								<tr>
									<td>License Type</td>
									<td>:</td>
									<td><?php echo $data['license_type']; ?></td>
								</tr>

								<tr>
									<td>Purchase Date</td>
									<td>:</td>
									<td><?php echo $data['purchase_date']; ?></td>
								</tr>

								<tr>
									<td></td>
									<td></td>
									<td><button type="submit" name="revoke_license" class="btn pmd-ripple-effect btn-danger pull-right" onclick="return confirm('Are you sure want to revoke this license?')">REVOKE LICENSE</button></td>
								</tr>

							</table>
						</form>
					</div>
				</div>
			</div>

		</div>
			
	</div><!-- tab end -->

</div><!--end content area-->

<?php include 'public/footer.php'; ?>