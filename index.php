<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Изучение английского языка онлайн!</title>
		<link rel="stylesheet" href="css/style.css" />
		<script src="js/script.js"></script>
	</head>
	<body onload="setup_handlers();">
		<?php
			require('tmpl/database.tpl');
			session_start();
			if (array_key_exists('verbs_arr', $_SESSION)) {
				unset($_SESSION['verbs_arr']);
				unset($_SESSION['verbs_cnt']);
				unset($_SESSION['verb_num']);
			}
			require_once('tmpl/dialogs.tpl');
			require('tmpl/topmenu.tpl');
		?>

		<div class="main-page-wrapper">
			<div class="irrverbs-big-block card">
				<h1 id="exercise-caption-wrapper">
					<span id="exercise-caption">Изучение неправильных глаголов</span>
				</h1>
				<a href="exercise.php?type=0" class="round-button">Старт!</a>
			</div>
			<div class="irrverbs-cards">
				<div class="irrverbs-forteacher card">
					<div class="small-card-heading">
						<div class="small-card-caption">Учителю</div>
						<div class="small-card-description">Создайте набор глаголов для повторения</div>
					</div>
					<form action="task.php?action=new&type=0" method="POST">
						<!--<textarea name="content" id="forteacher-task-content" cols="30" rows="10"></textarea>-->
						<input type="text" name="content" size="20"
						title="Введите список глаголов через запятую" placeholder="Введите список глаголов через запятую"
						required="required" />
						<br />
						<input type="submit" value="Сохранить" class="round-button" />
					</form>
				</div>
				<div class="irrverbs-forpupil card">
					<div class="small-card-heading">
						<div class="small-card-caption">Ученику</div>
						<div class="small-card-description">Введите код, данный учителем</div>
					</div>
					<form action="exercise.php" method="GET">
						<input type="number" name="id" /><br />
						<input type="hidden" name="type" value="0" />
						<input type="submit" value="Старт!" class="round-button" />
					</form>
				</div>
				<div class="see-also card">
					<div class="small-card-caption">Смотрите также</div>
					<ul class="see-also-list">
						<?php
							$see_also = array(
								# Numbers, dates and time = NDT
								'ndt' => array(
									'<a href="numdate.php" class="link">Дата и время по-английски</a>',
									'<a href="numdate.php" class="link">Числительные в английском языке</a>',
									'<a href="numdate.php" class="link">Числа, дата и время</a>'
								),
								# Articles
								'artc' => array(
									'<a href="articles.php" class="link">Артикли в английском языке</a>',
									'<a href="articles.php" class="link">Три артикля</a>',
									'<a href="articles.php" class="link">Различия между work и job</a>'
								),
								# Adjectives, verbs with prepositions and adverbs
								'adj' => array(
									'<a href="adjprep.php" class="link">Прилагательные с предлогами</a>',
									'<a href="adjprep.php" class="link">Глаголы с предлогами</a>',
									'<a href="adjprep.php" class="link">Как образуются наречия?</a>'
								),
								# There (to be)
								'thr' => array(
									'<a href="thereis.php" class="link">Местоположение предмета</a>',
									'<a href="thereis.php" class="link">Конструкция There is / There are</a>',
									'<a href="thereis.php" class="link">Что и где находится</a>'
								)
							);
							foreach ($see_also as $see_also_item) {
								print('<li>'.$see_also_item[mt_rand(0,2)].'</li>');
							}
						?>
					</ul>
				</div>
				<div class="in-development card">
					<div class="small-card-heading">
						<div class="small-card-caption"><span id="ee-beta">&beta;</span> Проект ещё в разработке</div>
						<div class="small-card-description">Могут быть <u>значительные</u> ошибки и неточности</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
