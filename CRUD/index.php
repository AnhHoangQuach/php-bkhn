<!DOCTYPE html>
<html>
<head>
	<title>CRUD App</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<?php require_once 'process.php';?>
	<?php if(isset($_SESSION['message'])): ?>
		<div class="alert alert-<?=$_SESSION['msg_type']?>">
			<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>
	<div class="container">
		<?php
			$mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
			$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error());
			//pre_r($result);
			?>

			<div class="row justify-content-center">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Location</th>
							<th colspan="2">Action</th>					
						</tr>
					</thead>
					<?php while($row = $result->fetch_assoc()): ?>
							<tr>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['location']; ?></td>
								<td>
									<a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
									<a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
								</td>
							</tr>
				<?php endwhile; ?>
				</table>
			</div>
			<?php
			function pre_r($array){
				echo '<pre>';
				print_r($array);
				echo '</pre>';
			}
		?>
		<div class="row justify-content-center">
			<form action="process.php" method="POST">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name;?>"placeholder="Enter your name">
				</div>
				<div class="form-group">
					<label>Location</label>
					<input type="text" name="location" class="form-control" value="<?php echo $location;?>" placeholder="Enter your location">
				</div>
				<div class="form-group">
					<?php if($update==true):?>
					<button type="submit" class="btn btn-primary" name="update">Update</button>\
					<?php else: ?>
					<button type="submit" class="btn btn-primary" name="save">Save</button>
					<?php endif; ?>
				</div>
			</form>
		</div>
	</div>
</body>
</html>