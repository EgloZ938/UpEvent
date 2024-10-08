document.getElementById("formulaire").addEventListener("submit", (e) =>{
    e.preventDefault();
    let prenom = document.getElementById("prenom").value;
    let nom = document.getElementById("nom").value;
    let email = document.getElementById("email").value;
    let bio = document.getElementById("bio").value;
    let campus = document.getElementById("campus").value;

    let instagram = document.getElementById("instagram").value || '';
    let linkedin = document.getElementById("linkedin").value || '';
    let twitter = document.getElementById("twitter").value || '';
    let discord = document.getElementById("discord").value || '';

    let reseaux = {
        instagram: instagram,
        linkedin: linkedin,
        twitter: twitter,
        discord: discord
    };

    let reseauxJson = JSON.stringify(reseaux);

    let formdata = new FormData();
    formdata.append("prenom", prenom);
    formdata.append("nom", nom);
    formdata.append("email", email);
    formdata.append("bio", bio);
    formdata.append("campus", campus);
    formdata.append("reseaux", reseauxJson);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/modif_info_profil.php", true);
    xhr.send(formdata);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response = xhr.responseText;
            if(response == "Les informations ont été mises à jour avec succès."){
                location.href = "./profil.php";
            }
            else{
                alert("Echec l'hors de la mise à jour des informations");
            }
        }
    }
})

document.getElementById("img-container").addEventListener("click", function() {
    document.getElementById("pdp").click();
});

document.getElementById("pdp").addEventListener("change", function(event) {
    if(event.target.files && event.target.files[0]) {
        let reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById("profil").style.backgroundImage = `url(${e.target.result})`;
        }
        reader.readAsDataURL(event.target.files[0]);

        document.getElementById("submit-img-container").style.display = "flex";
    }
});