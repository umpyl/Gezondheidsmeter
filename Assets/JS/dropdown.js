const dropdowns = document.getElementsByClassName("dropdown");

for (const dropdown of dropdowns) {
	const filter = dropdown.getElementsByClassName("filter")[0];
	const list = dropdown.getElementsByClassName("optionWrapper")[0];
	const items = list.getElementsByClassName("dropdownContent");
	var currentItem = 0;

	filter.addEventListener("keyup", (event) => {
		for (const item of list.children) {
			txtValue = item.getElementsByTagName("label")[0].textContent || item.getElementsByTagName("label")[0].innerText;
			item.getElementsByTagName("input")[0].checked = false;

			if (txtValue.toUpperCase().indexOf(filter.value.toUpperCase()) > -1) {
				item.style.display = "";
			} else {
				item.style.display = "none";
			}
		}
	});

	list.addEventListener("wheel", (event) => {
		var items = Array.from(list.children).filter((item) => item.style.display !== "none");
		var delta = event.deltaY || -event.wheelDelta || event.detail;
		event.preventDefault();

		if (delta > 0) {
			currentItem = Math.min(currentItem + 1, items.length - 3);
		} else {
			currentItem = Math.max(currentItem - 1, 0);
		}

		var scrollTo = items[currentItem].offsetTop;

		list.scrollTop = scrollTo;
	});

	items.addEventListener("changed", (event) => {
		console.log(event);
	});
}
