document.addEventListener("DOMContentLoaded", (event) => {
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("checkbox")) {
            console.log("*******");
            let getsel = document.querySelector("#get-sel");
            let checkbox = document.querySelectorAll(".checkbox");
            let output = document.querySelector("#trans-string");
            let arr = [];

            console.log("1111111");
            console.log(checkbox);
            console.log(output);

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
});
