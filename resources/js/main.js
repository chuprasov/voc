
document.addEventListener("DOMContentLoaded", (event) => {
    console.log('0000000000');

    document.addEventListener("translations-rendered", (event) => {
        let getsel = document.querySelector("#get-sel");
        let checkbox = document.querySelectorAll(".checkbox");
        let output = document.querySelector("#translated-text");
        let arr = [];

        console.log('1111111');
        console.log(checkbox);
        console.log(output);

        for (let i = 0; i < checkbox.length; i++) {
            checkbox[i].onclick = function () {
                console.log('22222222');

                if (checkbox[i].checked) {
                    arr[i] = checkbox[i].value;
                } else {
                    arr[i] = "";
                }

                let filteredArr = arr.filter(function (el) {
                    return el != "";
                });
                output.value = filteredArr.join("; ");
            };
        }
    });
});
