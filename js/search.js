const searchBar = document.querySelector(".users .search .input");
const searchBtn = document.querySelector(".users .search i");

// Définir la variable usersList en sélectionnant l'élément où vous souhaitez afficher les résultats de la recherche
const usersList = document.querySelector(".users .users-list");

searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    if (searchBtn.classList.toggle("active")) {
        searchBar.value = "";
        searchBar.classList.remove("active");
    }
}

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    if (searchTerm != "") {
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/exemple%20(1)/StageProject/pages/search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // Utilisez innerHTML pour remplacer le contenu de usersList avec les résultats de la recherche
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("searchTerm=" + searchTerm);
}
