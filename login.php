<?php
	require('tmpl/database.tpl');
	if (array_key_exists('action', $_GET)) {
		if ($_GET['action'] == 'login') {
			$db_link = mysqli_connect($db_address, $db_login, $db_password, $db_name);
			$request = mysqli_prepare($db_link, 'SELECT Id, Email, Password FROM users WHERE Email LIKE ? ORDER BY Id DESC LIMIT 1');
			mysqli_stmt_bind_param($request, 's', $_POST['email']);
			mysqli_stmt_execute($request);
			mysqli_stmt_bind_result($request, $user_id, $user_email, $user_password);
			mysqli_stmt_fetch($request);
			mysqli_stmt_close($request);
			mysqli_close($db_link);
			if (password_verify($_POST['password'], $user_password)) {
				setcookie('userid', $user_id);
				setcookie('username', $user_email);
				setcookie('userpswd', $user_password);
			}
			header('Location: index.php');
		}
		elseif ($_GET['action'] == 'register') {
			$grade_str = $_POST['graden'].strtoupper($_POST['gradel']);
			$db_link = mysqli_connect($db_address, $db_login, $db_password, $db_name);
			$user_exists_req = mysqli_prepare($db_link, 'SELECT Id FROM users WHERE Email LIKE ? ORDER BY Id DESC');
			mysqli_stmt_bind_param($user_exists_req, 's', $_POST['email']);
			mysqli_stmt_execute($user_exists_req);
			if (mysqli_num_rows(mysqli_stmt_get_result($user_exists_req)) > 0) {
				header('Location: index.php#user-exists-err');
				exit;
			}
			mysqli_stmt_close($user_exists_req);
			$request = mysqli_prepare($db_link, 'INSERT INTO users(Email, Surname, Name, Password, Grade, Type, Score) VALUES (?, ?, ?, ?, ?, ?, 0)');
			mysqli_stmt_bind_param(
				$request, 'sssssi',
				$_POST['email'], $_POST['surname'], $_POST['name'],
				password_hash($_POST['password'], PASSWORD_DEFAULT),
				$grade_str, $_POST['usertype']
			);
			mysqli_stmt_execute($request);
			mysqli_stmt_close($request);
			mysqli_close($db_link);
			header('Location: index.php');
		}
		elseif ($_GET['action'] == 'logout') {
			unset($_COOKIE['userid']);
			unset($_COOKIE['username']);
			unset($_COOKIE['userpswd']);
			setcookie('userid', null, -1);
			setcookie('username', null, -1);
			setcookie('userpswd', null, -1);
			header('Location: index.php');
		}
	}
	else {
		header('Location: index.php');
	}
?>
