document.addEventListener("DOMContentLoaded", (event) => {

    document.addEventListener("click", function (e) {

        if (e.target.classList.contains("checkbox")) {

            let transBtn = document.querySelector('#translate-button');

            transBtn.addEventListener('click', function() {
                for (let i = 0; i < checkbox.length; i++) {
                    if (checkbox[i].checked) {
                        checkbox[i].checked = false;
                        output.value = '';
                    }
                }
            });

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


    /* Live search with API */
    const apiUrl = 'https://lara2.fcqdaqp.online/api/products/all';
    
    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(result => {
            let search = document.querySelector('#sourceText');
            let searchResults = document.querySelector('#searchResults');
            let dataArr = result.data;
            let titleArr = [];
            for (let i = 0; i < dataArr.length; i++) {
                titleArr[i] = dataArr[i].title;
            }

            function updateSearchResults(query) {
                searchResults.innerHTML = '';

                let filteredWords = titleArr.filter(word => {
                    return word.toLowerCase().includes(query.toLowerCase());
                });
            
                filteredWords.forEach(word => {
                    let option = document.createElement('option');
                    option.classList.add('bg-gray-800', 'text-white')
                    option.textContent = word;
                    searchResults.appendChild(option);
                });
            }

            search.addEventListener('input', () => {
                let query = search.value.trim();

                if (search.timer) {
                    clearTimeout(search.timer);
                }
                
                search.timer = setTimeout(() => {
                    if(search.value !='') {
                        searchResults.classList.remove('hidden')
                    }
                    else {
                        searchResults.classList.add('hidden')
                    }
                    if (query) {
                        updateSearchResults(query);
                    } else {
                        searchResults.innerHTML = '';
                    }
                }, 500);
            });
        });
    
    

});
