let currentQuestion = 1;
let answer = 0;
const questionAnswerArray = [];

document.onload = loadQuestion();

function loadQuestion() {
	document.getElementById("currentQuestion").innerText = currentQuestion;
	document.getElementById("total").innerText = QuestionCount;
	document.getElementById("question").innerText = questionsArray[currentQuestion - 1].Question;
}

function checkanswer() {
	let buttons = document.getElementsByName("yesno");
	let isChecked = false;
  
	for (i = 0; i < buttons.length; i++) {
	  if (buttons[i].checked) {
		answer = buttons[i].value;
		isChecked = true;
		buttons[i].checked = false;
		break;
	  }
	}
  
	if (!isChecked) {
	  // Alert or notify the user that they need to select an answer
	  alert("Please select an answer.");
	}
  
	return isChecked;
  }

for (const questionObj of questionsArray) {
	const newQuestionAnswerObj = {
		Question: questionObj.Question,
		Answer: ''
	};
	questionAnswerArray.push(newQuestionAnswerObj);
}

function CheckButton() {
		if (questionAnswerArray[currentQuestion - 1].Answer == "1") {
			document.getElementById("yes").checked = true;


		} else if(questionAnswerArray[currentQuestion - 1].Answer == "0"){
			document.getElementById("no").checked = true;
		}
	
}

function UpdateCurrentQuestion(action) {
	if (action === "prev" && currentQuestion > 1) {
	  currentQuestion--;
	  CheckButton();
	}
  
	if (action === "next") {
	  let isRadioButtonChecked = checkanswer();
  
	  if (!isRadioButtonChecked) {
		// Return early if no answer is selected
		return;
	  }
  
	  let questionId = questionsArray[currentQuestion - 1].idQuestions;
	  sendAnswerToServer(questionId, userId, answer);
  
	  if (currentQuestion < QuestionCount) {
		questionAnswerArray[currentQuestion - 1].Answer = answer;
		currentQuestion++;
		CheckButton();
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
