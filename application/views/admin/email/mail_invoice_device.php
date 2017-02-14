<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/mail.css") ?>">
	</head>
	<body class="dev">
		<header>
			<h3>Marva Security Checkpoint Notification <span class="right">Device Key Request</span></h3>
		</header>
		<article>
			<h5 class="header">Device Key Request Invoice</h5>			
			<p>				
				Hi administrator, you requested a new point key recently. <br>
				After receiving this email, please complete the payment to the desired account and notify us soon.<br>
				As for the payment detail, you can look below.
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
				<tr>
					<td colspan="3">
						<strong class="highlight">Invoice Detail</strong>						
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:right">Accepted Payment Amount</td>
					<td><b>Rp. 500.000</b></td>					
				</tr>
				<tr>
					<td colspan="2" style="text-align:right">Send Payment To</td>
					<td><b>BNI</b>0373912218</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:right">Confirmation To</td>
					<td>087870980562 | rnugraha305@gmail.com</td>
				</tr>
			</table>
		</article>
		<footer>
			<h5>Copyright &copy; 2017 Exairie | Marva Cipta Indonesia</h5>
		</footer>
	</body>
</html>