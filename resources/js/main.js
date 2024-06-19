document.addEventListener("DOMContentLoaded", (event) => {
    let search = document.querySelector("#sourceText");
    let clearBtn = document.querySelector("#clearBtn");
    let output = document.querySelector("#trans-string");
    let transBtn = document.querySelector("#translate-button");
    let searchOptions = document.querySelector(".search-options");

    if (transBtn) {
        transBtn.addEventListener("click", () => {
            let checkbox = document.querySelectorAll(".checkbox");

            output.value = "";
            for (let i = 0; i < checkbox.length; i++) {
                if (checkbox[i].checked) {
                    checkbox[i].checked = false;
                }
            }
        });
    }

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("checkbox")) {
            let checkbox = document.querySelectorAll(".checkbox");

            let arr = [];

            for (let i = 0; i < checkbox.length; i++) {
                if (checkbox[i].checked) {
                    arr[i] = checkbox[i].value;
                } else {
                    arr[i] = "";
                }

                let filteredArr = arr.filter(function (el) {
                    return el != "";
                });

                output.value = filteredArr.join("; ");

                output.dispatchEvent(new Event("input"));
            }
        }
    });

    /* Live search with API */
    const apiUrl = import.meta.env.VITE_APP_URL + "api/search";
    let searchResults = document.querySelector("#searchResults");

    function searchApiByText(query) {
        const url = `${apiUrl}?text=${encodeURIComponent(query)}`;

        fetch(url)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((result) => {
                let dataArr = result.results;

                searchResults.innerHTML = "";

                let filteredWords = dataArr.filter((word) => {
                    return word.toLowerCase().includes(query.toLowerCase());
                });

                filteredWords.forEach((word, index) => {
                    if (index > 0) {
                        let hr = document.createElement("hr");
                        hr.classList.add("my-2", "border-gray-400");
                        searchResults.appendChild(hr);
                    }

                    let div = document.createElement("div");

                    div.classList.add(
                        "bg-white",
                        "text-black",
                        "p-2",
                        "cursor-pointer"
                    );
                    div.textContent = word;
                    searchResults.appendChild(div);

                    div.addEventListener("click", () => {
                        search.value = div.textContent;
                        search.dispatchEvent(new Event("input"));
                        searchOptions.classList.add("hidden");
                    });

                    if (clearBtn) {
                        clearBtn.addEventListener("click", function () {
                            let checkboxContainer =
                                document.querySelector("#checkboxContainer");
                            if (checkboxContainer) {
                                checkboxContainer.classList.add("hidden");
                            }
                            search.value = "";
                            div.remove;
                            let hrElements =
                                searchResults.querySelectorAll("hr");
                            hrElements.forEach((hr) => {
                                hr.remove();
                            });
                            checkInputValue();
                        });
                    }
                });
            })
            .catch((error) => {
                console.error("Fetch error:", error);
            });
    }

    checkInputValue();

    if (search) {
        search.addEventListener("input", checkInputValue);
    }

    function checkInputValue() {
        if (search && clearBtn) {
            clearBtn.style.display = search.value !== "" ? "block" : "none";
        }
    }

    function handleSearch(event, showOptions) {
        let query = search.value.trim();
        if (showOptions) {
            searchOptions.classList.remove("hidden");
        }

        if (query) {
            searchApiByText(query);
        } else {
            searchResults.innerHTML = "";
        }
    }

    let isInput = false;
    let isChange = false;

    if (search) {
        search.addEventListener("input", () => {
            isInput = true;
            handleSearchWithFlags();
        });

        search.addEventListener("change", () => {
            isChange = true;
            handleSearchWithFlags();
        });

        function handleSearchWithFlags() {
            if (isInput || isChange) {
                handleSearch(null, isInput);
                isInput = false;
                isChange = false;
            }
        }
    }
});
