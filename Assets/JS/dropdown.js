const dropdowns = document.getElementsByClassName("dropdown");

for (const dropdown of dropdowns) {
	const filter = dropdown.getElementsByClassName("filter")[0];
	const list = dropdown.getElementsByClassName("optionWrapper")[0];
	const items = list.children;
	var currentItem = 0;

	filter.addEventListener("focus", () => {
		for (const item of items) {
			item.style.display = "";
		}
	});

	filter.addEventListener("keyup", () => {
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

	var scrolable = true;

	list.addEventListener("wheel", (event) => {
		if (scrolable) {
			scrolable = false;
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
			setTimeout(() => {
				scrolable = true;
			}, 50);
		}
	});

	for (const item of items) {
		if (item.children[0].checked == true) {
			filter.value = item.children[1].innerText;
		}
		item.addEventListener("click", () => {
			filter.value = item.innerText;
			item.children[0].checked = true;
			list.style.display = "none";
			setTimeout(() => {
				list.style.display = "";
			}, 1);
		});
	}
}
