<div class="ex-translate">
	<?php
		session_start();
		$db_link = mysqli_connect($db_address, $db_login, $db_password, $db_name);
		if ($db_link !== false) {
			if (!array_key_exists('verbs_arr', $_SESSION) || $_SESSION['verbs_arr'] === null) {
				if ($taskid != 0) {
					$result = mysqli_query($db_link, 'SELECT Content FROM tasks WHERE Type = 0 AND Id = '.$taskid.' LIMIT 1');
					if (mysqli_num_rows($result) > 0) {
						$verbs_to_learn = explode(',', mysqli_fetch_array($result)['Content']);
					}
					mysqli_free_result($result);
				}
				else {
					$verbs_to_learn = array();
					$result = mysqli_query($db_link, 'SELECT Infinitive FROM verbs');
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_row($result)) {
							$verbs_to_learn[] = $row[0];
						}
					}
					mysqli_free_result($result);
				}
				shuffle($verbs_to_learn);
				$_SESSION['verbs_arr'] = $verbs_to_learn;
				$_SESSION['verbs_cnt'] = count($verbs_to_learn);
				$_SESSION['verb_num'] = 0;
			}
			if (array_key_exists('verb_arr', $_SESSION) && $_SESSION['verb_num'] == $_SESSION['verbs_cnt']) {
				unset($_SESSION['verbs_arr']);
				unset($_SESSION['verbs_cnt']);
				unset($_SESSION['verb_num']);
				header('Location: index.php');
			}
			$request = mysqli_prepare($db_link, 'SELECT `Translate` FROM verbs WHERE Infinitive LIKE ?');
			mysqli_stmt_bind_param($request, 's', $_SESSION['verbs_arr'][$_SESSION['verb_num']]);
			mysqli_stmt_execute($request);
			mysqli_stmt_bind_result($request, $verb_translate);
			mysqli_stmt_fetch($request);
			mysqli_stmt_close($request);
			mysqli_close($db_link);
			print($verb_translate);
			++$_SESSION['verb_num'];
		}
	?>
</div>
<div class="ex-fields">
	<input type="text" class="ex-field" id="irrverb-inf" />
	<input type="text" class="ex-field" id="irrverb-smp" />
	<input type="text" class="ex-field" id="irrverb-prt" />
</div>
