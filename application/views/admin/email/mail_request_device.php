<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/mail.css") ?>">
	</head>
	<body class="dev">
		<header>
			<h3>Marva Security Checkpoint Notification <span class="right">Device Key Request</span></h3>
		</header>
		<article>
			<h5 class="header">Device Key Request Notification</h5>			
			<p>				
				Hi admin, administrator from PT A requested a new point key. <br>
				For further information, check the admin page at <a href="<?php echo site_url("admin/point_keys") ?>" class="linkbtn">Here</a>
			</p>
			<table>
				<tr>
					<td colspan="3"><b class="highlight">Information</b></td>
				</tr>
				<tr>
					<td>Request ID</td>
					<td>:</td>
					<td>#<?php echo $data->id ?></td>
				</tr>
				<tr>
					<td>Point ID</td>
					<td>:</td>
					<td><?php echo $data->user_id ?></td>
				</tr>
				<tr>
					<td>User Name</td>
					<td>:</td>
					<td><?php echo $pdata->username ?></td>
				</tr>
				<tr>
					<td>Name</td>
					<td>:</td>
					<td><?php echo $pdata->firstname." ".$pdata->lastname ?></td>
				</tr>
				<tr>
					<td>Requested At</td>
					<td>:</td>
					<td><?php echo $data->request_time ?></td>
				</tr>
			</table>
		</article>
		<footer>
			<h5>Copyright &copy; 2017 Exairie | Marva Cipta Indonesia</h5>
		</footer>
	</body>
</html>