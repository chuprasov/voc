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
    const apiUrl = 'http://localhost:8000/api/search';

    function searchApiByText(query) {
        const url = `${apiUrl}?text=${encodeURIComponent(query)}`;
    
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(result => {
                
                let searchResults = document.querySelector('#searchResults');
                let dataArr = result.results;
                console.log(dataArr)
                
                    searchResults.innerHTML = '';

                    let filteredWords = dataArr.filter(word => {
                        return word.toLowerCase().includes(query.toLowerCase());
                    });
                
                    filteredWords.forEach(word => {
                        let option = document.createElement('option');
                        option.classList.add('bg-gray-800', 'text-white')
                        option.textContent = word;
                        searchResults.appendChild(option);
                    });
            })
            .catch(error => {
                    console.error('Fetch error:', error);
            });
    }
    let search = document.querySelector('#sourceText');
    search.addEventListener('input', () => {
        let query = search.value.trim();

        if (search.timer) {
            clearTimeout(search.timer);
        }
        
        search.timer = setTimeout(() => {
            if (query) {
                searchApiByText(query);
            } else {
                searchResults.innerHTML = '';
            }
        }, 500);
    });
});
