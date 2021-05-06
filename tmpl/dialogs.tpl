<div class="dialog-bg" id="login">
	<div class="dialog">
		<div class="close"><a href="#" class="link">X</a></div>
		<div class="small-card-heading">
			<div class="small-card-caption">Вход</div>
			<div class="small-card-description">Войти в свой аккаунт EngLearn</div>
		</div>
		<form action="login.php?action=login" method="POST">
			<input type="text" name="email" placeholder="Почта" required="required" /><br />
			<input type="password" name="password" placeholder="Пароль" required="required" /><br />
			<input type="submit" value="Войти" class="round-button" />
		</form>
	</div>
</div>
<div class="dialog-bg" id="register">
	<div class="dialog">
		<div class="close"><a href="#" class="link">X</a></div>
		<div class="small-card-heading">
			<div class="small-card-caption">Регистрация</div>
			<div class="small-card-description">Зарегистрировать аккаунт EngLearn</div>
		</div>
		<form action="login.php?action=register" method="POST">
			<input type="text" name="email" placeholder="Почта" required="required" /><br />
			<input type="text" name="name" placeholder="Имя" required="required" /><br />
			<input type="text" name="surname" placeholder="Фамилия" required="required" /><br />
			<input type="number" name="graden" min=1 max=11 step=1 class="grade-field" placeholder="Класс" />
			<input type="text" name="gradel" pattern="[А-Яа-я]?" class="grade-field" title="Буква класса" placeholder="Буква класса" /><br />
			<select name="usertype" id="usertype" required="required">
				<option value="0" selected="selected">Ученик</option>
				<option value="1">Учитель</option>
			</select>
			<input type="password" name="password" placeholder="Пароль" required="required" /><br />
			<input type="submit" value="Войти" class="round-button" />
		</form>
	</div>
</div>
<div class="dialog-bg" id="user-exists-err">
	<div class="dialog">
		<div class="close"><a href="#" class="link">X</a></div>
		<div class="small-card-heading">
			<div class="small-card-caption">Ошибка</div>
			<div class="small-card-description">Пользователь с таким адресом электронной почты уже существует!</div>
		</div>
	</div>
</div>
