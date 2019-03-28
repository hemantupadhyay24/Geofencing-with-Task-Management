<!DOCTYPE html>
<?php
	include 'DB.php';
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Import Excel sheet of TimeTable</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To Database">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">
	</head>
	<body>

	<!-- Navbar
    ================================================== -->

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
			</di		v>
		</div>
	</div>

	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
				<form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<legend>Import CSV/Excel file</legend>
						<div class="control-group">
							<div class="control-label">
								<label>CSV/Excel File:</label>
							</div>
							<div class="controls">
								<input type="file" name="file" id="file" class="input-large">
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
							<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="span3 hidden-phone"></div>
		</div>


		<table class="table table-bordered">
			<thead>
				  	<tr>

				  		<th>DAY</th>
				  		<th>SUBJECT</th>
				  		<th>TEACHER_ID</th>
				  		<th>TIME_SLOT</th>
						<th>CLASSROOM</th>
						<th>YEAR</th>
						<th>DIVISION</th>
						<th>BATCH</th>


				  	</tr>
				  </thead>
			<?php
				$SQLSELECT = "SELECT * FROM TIME_TABLE";
				$result_set =  mysql_query($SQLSELECT, $conn);
				while($row = mysql_fetch_array($result_set))
				{
				?>

					<tr>
						<td><?php echo $row['DAY']; ?></td>
						<td><?php echo $row['SUBJECT']; ?></td>
						<td><?php echo $row['TEACHER_ID']; ?></td>
						<td><?php echo $row['TIME_SLOT']; ?></td>
						<td><?php echo $row['CLASSROOM']; ?></td>
						<td><?php echo $row['YEAR']; ?></td>
						<td><?php echo $row['DIVISION']; ?></td>
						<td><?php echo $row['BATCH']; ?></td>
					</tr>
				<?php
				}
			?>
		</table>
	</div>

	</div>

	</body>
</html>
