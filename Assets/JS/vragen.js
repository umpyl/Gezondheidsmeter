let currentQuestion = 1;
let answer = 0;

function loadQuestion() {
	document.getElementById("currentQuestion").innerText = currentQuestion;
	document.getElementById("total").innerText = QuestionCount;
	document.getElementById("question").innerText = questionsArray[currentQuestion - 1].Question;
}

function checkanswer() {
	let buttons = document.getElementsByName("yesno");

	for (i = 0; i < buttons.length; i++) {
		if (buttons[i].checked) {
			answer = buttons[i].value;
			buttons[i].checked = false;
			break;
		}
	}
}

function UpdateCurrentQuestion(action) {
	if (action === "prev" && currentQuestion > 1) {
		currentQuestion--;
	}

	if (action === "next") {
		let questionId = questionsArray[currentQuestion - 1].idQuestions;
		console.log(questionId);
		checkanswer();
		sendAnswerToServer(questionId, userId, answer);

		if (currentQuestion < QuestionCount) {
			currentQuestion++;
		} else {
			console.log("Last question");
		}
	}
	loadQuestion();
}

function sendAnswerToServer(questionId, userId, answer) {
	fetch("Save_answer.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({
			questionIds: questionId,
			userIds: userId,
			answers: answer,
		}),
	})
		.then((response) => response.text())
		.then((data) => {
			console.log(data);
		})
		.catch((error) => {
			console.error("Error:", error);
		});
}
