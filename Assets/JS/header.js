const header = document.getElementById("header");
let lastScroll = 0;

window.addEventListener("scroll", () => {
	const currentScroll = window.scrollY;
	if (currentScroll <= 0) {
		header.classList.remove("headerUp");
		return;
	}

	if (currentScroll > lastScroll && !header.classList.contains("headerDown")) {
		header.classList.add("headerDown");
	} else if (currentScroll < lastScroll && header.classList.contains("headerDown")) {
		header.classList.remove("headerDown");
	}

	lastScroll = currentScroll;
});
