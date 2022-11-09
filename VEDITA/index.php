<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="css/collector.css?v=77">
		<title>Task vedita</title>
		</head>
	<body>
		<div class="template">
            <header class="header">	
			    <?php include("php/components/header.php"); ?>
            </header>
			<div class="content">
                <?php include("php/data/load_table.php"); ?>
			</div>
			<footer class="footer">	
				<?php include("php/components/footer.php"); ?>
			</footer>
		</div>
	</body>
	<script src="js/collector.js"></script>
</html>