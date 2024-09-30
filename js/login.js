document.addEventListener('DOMContentLoaded', function() {
    // Votre code JavaScript ici
    const form = document.querySelector(".panel-body");
    const continueBtn = document.querySelector(".button");

    form.onsubmit = (e)=>{
        e.preventDefault();
    }

    form.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/exemple%20(1)/StageProject/pages/AddUser.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    console.log(data);
                }
            }
        }
        xhr.send();
    }
    
});