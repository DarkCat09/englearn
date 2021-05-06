function setup_handlers() {
	/*
	var dialogs = document.querySelectorAll('.dialog-bg');
	for (var i = 0; i < dialogs.length; i++) {
		//dialogs[i].addEventListener('click', function() { window.location.hash = ''; });
	}
	*/
	var ex_fields = document.querySelectorAll('.ex-fields>.ex-field');
	for (var j = 0; j < ex_fields.length; j++) {
		ex_fields[j].addEventListener('keydown', function(event) {
			if (event.key == 'Enter') {
				next_button = document.getElementById('ex-next');
				if (next_button)
					next_button.click();
			}
		});
	}
	var ee_beta = document.getElementById('ee-beta');
	if (ee_beta != null) {
		ee_beta.addEventListener('click', easter_egg);
	}
};

function timer() {
	var timer_el = document.getElementById('timer');
	var time_formatter = new Intl.NumberFormat('ru', {useGrouping: false, minimumIntegerDigits: 2});
	var hour = 0, minute = 0, second = 0;
	setInterval(function() {
		++second;
		if (second > 59) {
			++minute;
			second = 0;
			if (minute > 59) {
				++hour;
				minute = 0;
			}
		}
		timer_el.innerHTML = hour + ':' + time_formatter.format(minute) + ':' + time_formatter.format(second);
	}, 1000);
};

var ex_send_button = null;
function send_result(event, type, user, task) {
	ex_send_button = event.currentTarget;
	var exercise_card = ex_send_button.parentNode;
	var timer_value = exercise_card.querySelector('#timer').innerHTML;
	var answer_fields = exercise_card.querySelector('.ex-fields').querySelectorAll('.ex-field');
	var translate = exercise_card.querySelector('.ex-translate');
	var separator = '##';
	var answers = translate.innerHTML + separator;
	for (var i = 0; i < answer_fields.length; i++) {
		answers += (answer_fields[i].value + ((i == (answer_fields.length - 1)) ? '' : separator));
	}
	alert(answers);
	var xhr = new XMLHttpRequest();
	alert(`/englearn/task.php?action=done&content=${encodeURIComponent(answers)}&user=${user}&type=${type}&task=${task}&timer=${timer_value}`);
	xhr.open('GET', `/englearn/task.php?action=done&content=${encodeURIComponent(answers)}&user=${user}&type=${type}&task=${task}&timer=${timer_value}`);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4) {
			alert('response: ' + xhr.response);
			if (xhr.response == 'correct') {
				ex_send_button.style.animation = '1.5s ease-out 0s 1 normal none running ex-button-correct';
			}
			else if (xhr.response == 'partially') {
				ex_send_button.style.animation = '1.5s ease-out 0s 1 normal none running ex-button-partially';
			}
			else {
				ex_send_button.style.animation = '1.5s ease-out 0s 1 normal none running ex-button-incorrect';
			}
			setTimeout(function() { window.location.reload(); }, 1500);
		}
	};
	xhr.send();
};

var ee_clicks = 0;
var ee_letter = 0;
function easter_egg(event) {
	if (event.type == "click") {
		++ee_clicks;
		if (ee_clicks >= 7) {
			switch (ee_letter) {
				case 0: //beta
					event.currentTarget.innerHTML = '&gamma;';
					ee_letter = 1;
					break;
				case 1: //gamma
					event.currentTarget.innerHTML = '&lambda;';
					ee_letter = 2;
					break;
				case 2: //lambda
					event.currentTarget.innerHTML = '&mu;';
					ee_letter = 3;
					break;
				case 3: //mu
					event.currentTarget.innerHTML = '&pi;';
					ee_letter = 4;
					break;
				case 4: //pi
					event.currentTarget.innerHTML = '&omega;';
					ee_letter = 5;
					break;
				case 5:
					event.currentTarget.innerHTML = '&beta;';
					ee_letter = 0;
					break;
				default:
					event.currentTarget.innerHTML = '&beta;';
					ee_letter = 0;
					break;
			}
		}
	}
};
