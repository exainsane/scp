<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/mail.css") ?>">
	</head>
	<body class="pt">
		<header>
			<h3>Marva Security Checkpoint Notification <span class="right">Point Key Request</span></h3>
		</header>
		<article>
			<h5 class="header">Point Key Request Invoice</h5>			
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
					<td style="width:150px;">Request ID</td>
					<td>:</td>
					<td>#<?php echo $data->id ?></td>
				</tr>
				<tr>
					<td style="width:150px;">Point ID</td>
					<td>:</td>
					<td><?php echo $data->point_id ?></td>
				</tr>
				<tr>
					<td style="width:150px;">Point Name</td>
					<td>:</td>
					<td><?php echo $pdata->point_name ?></td>
				</tr>
				<tr>
					<td style="width:150px;">Requested At</td>
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
					<td><b>Rp. 750.000</b></td>					
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