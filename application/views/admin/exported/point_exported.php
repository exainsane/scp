<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/mail.css") ?>">
	</head>
	<body class="dev">
		<header>
			<h3>Marva Security Checkpoint <span class="right">Checkpoint QR</span></h3>
		</header>
		<article>
			<h5 class="header">Point Name : <b><?php echo $pdata->point_name ?></b></h5>			
			<p>				
				Scan this QR Code with <b>Security Checkpoint &reg;</b>
			</p>
			<table>
				<tr>
					<td rowspan="2">
						<img id="qr" src="data:image/png;base64,<?php echo $img ?>" alt="">
					</td>
					<td>
						Use in-app QR Scanner to verify that you have passed this checkpoint. Checkpoint data will be synced to database as soon as possible.						
					</td>
				</tr>
				<tr>
					<td>Point coordinate : <i><?php echo $pdata->point_lat ?>, <?php echo $pdata->point_long ?></i></td>
				</tr>
			</table>
		</article>
		<footer>
			<h5>Copyright &copy; 2017 Exairie | Marva Cipta Indonesia</h5>
		</footer>
	</body>
</html>