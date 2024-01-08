const toggle = document.getElementById("darkmodeToggle");

var mode = document.cookie
	.split("; ")
	.find((row) => row.startsWith("DarkMode="))
	?.split("=")[1];
mode = mode === "true" ? true : false;

function UpdateMode() {
	document.body.setAttribute("theme-mode", mode ? "dark" : "light");
	toggle.checked = mode;
}

toggle.addEventListener("change", () => {
	mode = toggle.checked ? true : false;
	document.cookie = "DarkMode=" + (toggle.checked ? true : false);
	UpdateMode();
});

UpdateMode();
