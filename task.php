<?php
	require('tmpl/database.tpl');
	if (array_key_exists('action', $_GET)) {
		if (
			$_GET['action'] == 'new' &&
			array_key_exists('content', $_POST) &&
			array_key_exists('type', $_GET) &&
			array_key_exists('userid', $_COOKIE)
		) {
			$db_link = mysqli_connect($db_address, $db_login, $db_password, $db_name);
			if ($db_link !== false) {
				$request = mysqli_prepare('INSERT INTO tasks (TeacherId, Content, Type) VALUES (?, ?, ?)');
				mysqli_stmt_bind_param($request, 'isi', $_COOKIE['userid'], $_POST['content'], $_GET['type']);
				mysqli_stmt_execute($request);
				mysqli_stmt_close($request);
				mysqli_close($db_link);
			}
		}
		elseif (
			$_GET['action'] == 'done' &&
			array_key_exists('content', $_GET) &&
			array_key_exists('type', $_GET) &&
			array_key_exists('user', $_GET) &&
			array_key_exists('timer', $_GET)
		) {
			$separator = '##';
			$content_arr = explode($separator, trim($_GET['content']));
			$verb_correct = '';
			$verb_correct_count = 0;
			$fordb = trim($content_arr[0]);
			if ($_GET['type'] == '0') {
				$db_link = mysqli_connect($db_address, $db_login, $db_password, $db_name);
				if ($db_link !== false) {
					$verb_check_req = mysqli_prepare(
						$db_link,
						'SELECT Infinitive, Simple, Participle, `Translate` FROM verbs WHERE `Translate` LIKE ?'
					);
					mysqli_stmt_bind_param($verb_check_req, 's', $fordb);
					mysqli_stmt_execute($verb_check_req);
					mysqli_stmt_bind_result($verb_check_req, $verb_inf, $verb_smp, $verb_prt, $verb_trn);
					mysqli_stmt_fetch($verb_check_req);
					mysqli_stmt_close($verb_check_req);
					if (
						preg_match('/(\\b'.str_replace(
							',', '[\\.\\,\\(\\)\\[\\]\\{\\}]*',
							str_replace(' ', '\\s*', $verb_inf)
						).')/', trim($content_arr[1])) == 1
					) {
						$verb_correct .= 'inf,';
						++$verb_correct_count;
					}
					if (
						preg_match('/(\\b'.str_replace(
							',', '[\\.\\,\\(\\)\\[\\]\\{\\}]*',
							str_replace(' ', '\\s*', $verb_smp)
						).')/', trim($content_arr[2])) == 1
					) {
						$verb_correct .= 'smp,';
						++$verb_correct_count;
					}
					if (
						preg_match('/(\\b'.str_replace(
							',', '[\\.\\,\\(\\)\\[\\]\\{\\}]*',
							str_replace(' ', '\\s*', $verb_prt)
						).')/', trim($content_arr[3])) == 1
					) {
						$verb_correct .= 'prt';
						++$verb_correct_count;
					}
					if ($_GET['user'] != 0) {
						$add_compl_task_req = mysqli_prepare(
							$db_link,
							'INSERT INTO completed (UserId, TaskId, Type, Correct, `Time`) VALUES (?, ?, ?, ?, ?)'
						);
						$timer_str = date_format(date_create_from_format('G:i:s', $_GET['timer']), 'G:i:s');
						mysqli_stmt_bind_param(
							$add_compl_task_req, 'iiiss',
							$_GET['user'], $_GET['task'], $_GET['type'], $verb_correct,
							$timer_str
						);
						mysqli_stmt_execute($add_compl_task_req);
						mysqli_stmt_close($add_compl_task_req);
					}
					mysqli_close($db_link);
					if ($verb_correct_count == 3) {
						echo 'correct';
					}
					elseif ($verb_correct_count == 0) {
						echo 'incorrect';
					}
					else {
						echo 'partially';
					}
				}
			}
		}
	}
?>
