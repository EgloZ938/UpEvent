function selectEventType(button) {
    // Enlève la classe "selected" de tous les boutons
    const buttons = document.querySelectorAll('.button');
    buttons.forEach(btn => {
        btn.classList.remove('selected');
        // Réinitialise la couleur des boutons
        btn.style.backgroundColor = ""; // Réinitialise la couleur de fond
    });

    // Ajoute la classe "selected" et change la couleur de fond du bouton cliqué
    button.classList.add('selected');
    button.style.backgroundColor = "#700A36";
    document.getElementById("categorie-value").value = button.innerHTML;
}

document.getElementById("formulaire").addEventListener("submit", (e) =>{
    e.preventDefault();
    let titre = document.getElementById("titre").value;
    let description = document.getElementById("description").value;
    let categorie = document.getElementById("categorie-value").value;
    let lieu = document.getElementById("location").value;
    let date = document.getElementById("date").value;
    let heure = document.getElementById("heure").value;
    let nbrParticipants = document.getElementById("participants").value;
    let formdata = new FormData();
    formdata.append("titre", titre);
    formdata.append("description", description);
    formdata.append("categorie", categorie);
    formdata.append("lieu", lieu);
    formdata.append("date", date);
    formdata.append("heure", heure);
    formdata.append("nbrParticipants", nbrParticipants);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/new_event.php", true);
    xhr.send(formdata);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response = xhr.responseText;
            console.log(response);
            if(response == "réussite"){
                location.href = "./";
            }
        }
    }
})