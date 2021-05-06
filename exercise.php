<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Изучение неправильных глаголов</title>
		<link rel="stylesheet" href="css/style.css" />
		<script src="js/script.js"></script>
	</head>
	<body onload="setup_handlers(); timer();">
		<?php include('tmpl/topmenu.tpl') ?>

		<div class="main-page-wrapper">
			<div class="card">
				<div id="timer">0:00:00</div>
				<?php
					require('tmpl/database.tpl');
					if (array_key_exists('id', $_GET)) {
						$taskid = (int)$_GET['id'];
					}
					else {
						$taskid = 0;
					}
					if (array_key_exists('type', $_GET)) {
						$ex_type = (int)$_GET['type'];
						if ($ex_type == 0) {
							require('tmpl/exercise/irrverbs.tpl');
						}
						elseif ($ex_type == 1) {
							# ...
						}
						else {
							$ex_type = 0;
							require('tmpl/exercise/irrverbs.tpl');
						}
					}
					else {
						$ex_type = 0;
						require('tmpl/exercise/irrverbs.tpl');
					}
					$userid = 0;
					if (array_key_exists('userid', $_COOKIE)) {
						$userid = (int)$_COOKIE['userid'];
					}
					print(
						'<a href="#" class="round-button" id="ex-next" onclick="send_result(event,'.
						$ex_type.','.$userid.','.$taskid.');">Далее</a>'
					);
				?>
			</div>
		</div>
	</body>
</html>
