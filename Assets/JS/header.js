const header = document.getElementById("header");
const observer = new ResizeObserver((mutations) => {
	console.log(mutations);
	mutations.forEach(() => {
		header.style.setProperty("--header-offset", header.offsetHeight + "px");
	});
});
let lastScroll = 0;

observer.observe(header);

header.style.setProperty("--header-offset", header.offsetHeight + "px");

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
