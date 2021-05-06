<?php
	require('tmpl/database.tpl');
	$user_info = array(
		'id' => 0,
		'email' => '',
		'name' => '',
		'surname' => '',
		'grade' => '',
		'type' => -1,
		'score' => 0
	);
	$db_link = mysqli_connect($db_address, $db_login, $db_password, $db_name);
	if ($db_link !== false) {
		$result = mysqli_query($db_link, 'SELECT Id, Email, Surname, Name, Grade, Type, Score FROM users WHERE Id = '.$_COOKIE['userid'].' LIMIT 1');
		if (mysqli_num_rows($result) > 0) {
			$db_row = mysqli_fetch_array($result);
			$user_info['id'] = $db_row['Id'];
			$user_info['email'] = $db_row['Email'];
			$user_info['surname'] = $db_row['Surname'];
			$user_info['name'] = $db_row['Name'];
			$user_info['grade'] = $db_row['Grade'];
			$user_info['type'] = $db_row['Type'];
			$user_info['score'] = $db_row['Score'];
		}
		mysqli_free_result($result);
		mysqli_close($db_link);
	}
?>
<div class="user-info-wrapper">
	<div class="avatar-block user-info-item-wrapper">
		<?php print('<img src="avatar.php?id='.$user_info['id'].'" alt="Картинка профиля" id="avatar" />'); ?>
	</div>
	<div class="user-info-text-wrapper user-info-item-wrapper">
		<div class="user-info-item user-info-name"><?php print($user_info['surname'].' '.$user_info['name']); ?></div>
		<div class="user-info-item user-info-descr">
			<span id="user-info-id">
				<?php print('#'.$user_info['id'].',&nbsp;'); ?>
			</span>
			<span id="user-info-type">
				<?php
					switch($user_info['type']) {
						case 0:
							print('Ученик');
							break;
						case 1:
							print('Учитель');
							break;
						case 2:
							print('Администратор');
							break;
					}
				?>
			</span>
		</div>
		<a href="login.php?action=logout" class="link user-info-item">Выйти</a>
	</div>
</div>
