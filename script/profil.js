document.getElementById("formulaire").addEventListener("submit", (e) =>{
    e.preventDefault();
    let prenom = document.getElementById("prenom").value;
    let nom = document.getElementById("nom").value;
    let email = document.getElementById("email").value;
    let bio = document.getElementById("bio").value;
    let campus = document.getElementById("campus").value;
    let formdata = new FormData();
    formdata.append("prenom", prenom);
    formdata.append("nom", nom);
    formdata.append("email", email);
    formdata.append("bio", bio);
    formdata.append("campus", campus);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/modif_info_profil.php", true);
    xhr.send(formdata);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response = xhr.responseText;
            if(response == "Les informations ont été mises à jour avec succès."){
                alert("Les informations ont été mises à jour avec succès");
            }
            else{
                alert("Echec l'hors de la mise à jour des informations");
            }
        }
    }
})