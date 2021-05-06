<nav class="menu">
	<ul class="top-menu">
		<li><a href="index.php">Неправильные глаголы</a></li>
		<li><a href="engtime.php">Времена</a></li>
		<li><a href="articles.php">Артикли</a></li>
		<li><a href="numdate.php">Числа и даты</a></li>
		<li><a href="adjprep.php">Прилагательные</a></li>
		<li><a href="thereis.php">There is</a></li>
		<li class="account-item">
			<a href="#">Аккаунт</a>
			<div class="account-info msg vertical">
				<?php
					if (array_key_exists('userid', $_COOKIE)) {
						require('tmpl/user_info.tpl');
					}
					else {
						include('tmpl/login_links.tpl');
					}
				?>
			</div>
		</li>
	</ul>
</nav>
