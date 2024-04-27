document.addEventListener("DOMContentLoaded", (event) => {

    document.addEventListener("click", function (e) {

        if (e.target.classList.contains("checkbox")) {

            let checkbox = document.querySelectorAll(".checkbox");
            let output = document.querySelector("#trans-string");
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
            }
        }
    });

    const apiUrl = 'https://lara2.fcqdaqp.online/api/products/all';

    fetch(apiUrl)
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });


    let search = document.querySelector('#search');
    let searcharr = ['table', 'apple', 'chair', 'computer', 'cup', 'short', 'hand', 'head', 'bubble', 'ball'];

    const searchResults = document.querySelector('#searchResults');


    function updateSearchResults(query) {
        searchResults.innerHTML = '';

        const filteredWords = searcharr.filter(word => {
            return word.toLowerCase().includes(query.toLowerCase());
        });

        filteredWords.forEach(word => {
            const li = document.createElement('li');
            li.textContent = word;
            searchResults.appendChild(li);
            li.addEventListener('click', function() {
                search.value = word;
            });
        });
    }

    search.addEventListener('input', () => {
        const query = search.value.trim();

        if (query) {
            updateSearchResults(query);
        } else {
            searchResults.innerHTML = '';
        }
    });

});
