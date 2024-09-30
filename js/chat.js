
const send = document.querySelector(".typing-area");
const inputField = send.querySelector("input[name='message']");
const sendBtn = send.querySelector("button");
const chatBox = document.querySelector(".chat-box");

// Récupérer la valeur de outgoing_id à partir du champ caché
const outgoingId = document.querySelector("input[name='outgoing_id']").value;
// Récupérer la valeur de incoming_id à partir du champ caché
const incomingId = document.querySelector("input[name='incoming_id']").value;

send.onsubmit = (e) => {
    e.preventDefault();
    const message = inputField.value.trim();
    if (message !== "") {
        let formData = new FormData(send);
        formData.append('outgoing_id', outgoingId);
        // Envoyer le formulaire avec les données à insertdatachat.php
        fetch("insertdatachat.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (response.ok) {
                inputField.value = ""; 
                scrollToBottom(); 
            } else {
                console.error("Erreur lors de l'envoi du formulaire");
            }
        })
        .catch(error => console.error("Erreur:", error));
    }
}
setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/exemple%20(1)/StageProject/pages/getChat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("incoming_id=" + incomingId);
}, 1000); // Envoyer la requête toutes les secondes (1000 ms)

// Fonction scrollToBottom pour faire défiler la boîte de chat vers le bas
function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}

