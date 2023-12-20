const categoryFilter = document.getElementById("categoryFilter");
const categoryButtons = categoryFilter.querySelectorAll(".filter");
const recuringFilter = document.getElementById("recuringFilter");
const recuringButtons = recuringFilter.querySelectorAll(".filter");
const questions = document.querySelectorAll(".question");
const questionList = document.getElementById("questionList");

var category = "All";
var recuring = "All";

categoryButtons.forEach((button) => {
	button.addEventListener("click", (e) => {
		category = e.target.getAttribute("data-category");

		if (!document.startViewTransition) {
			UpdateFilterButtons(categoryFilter, e.target);
			FilterQuestions();
		}

		document.startViewTransition(() => {
			UpdateFilterButtons(categoryFilter, e.target);
			FilterQuestions();
		});
	});
});

recuringButtons.forEach((button) => {
	button.addEventListener("click", (e) => {
		recuring = e.target.getAttribute("data-recuring");

		if (!document.startViewTransition) {
			UpdateFilterButtons(recuringFilter, e.target);
			FilterQuestions();
		}

		document.startViewTransition(() => {
			UpdateFilterButtons(recuringFilter, e.target);
			FilterQuestions();
		});
	});
});

function UpdateFilterButtons(list, button) {
	list.querySelector(".active").classList.remove("active");
	button.classList.add("active");
}

function FilterQuestions() {
	questions.forEach((question) => {
		question.classList.remove("noLine");
		var questionCategory = question.getAttribute("data-category");
		var questionRecuring = question.getAttribute("data-recuring");

		if ((questionCategory === category || category === "All") && (questionRecuring === recuring || recuring === "All")) {
			question.removeAttribute("hidden");
		} else {
			question.setAttribute("hidden", "");
		}
	});
	var visibleQuestions = questionList.querySelectorAll("li.question:not([hidden])");
	visibleQuestions[visibleQuestions.length - 1].classList.add("noLine");
}
