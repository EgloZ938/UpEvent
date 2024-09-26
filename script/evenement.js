function selectEventType(pastille) {
    // Sélectionner toutes les pastille-theme
    const pastilles = document.querySelectorAll('.pastille-theme');
    
    pastilles.forEach(pastilleItem => {
        pastilleItem.style.transform = "scale(1)";
        pastilleItem.style.backgroundColor = "#fff";
    });
    
    pastille.style.transform = "scale(1.1)";
    pastille.style.backgroundColor = "#f0f0f0";
    
    const themeText = pastille.querySelector('.theme').innerHTML;
    document.getElementById("categorie-value").value = themeText;
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
            if(response == "réussite"){
                location.href = "./profil.php";
            }
        }
    }
})