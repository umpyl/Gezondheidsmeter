const header = document.getElementById("header");
const scrollWatcher = document.createElement("div");

scrollWatcher.setAttribute("data-scroll-watcher", "");
header.before(scrollWatcher);

const headerObserver = new IntersectionObserver((entries) => {
	header.classList.toggle("sticking", !entries[0].isIntersecting);
});

headerObserver.observe(scrollWatcher);
