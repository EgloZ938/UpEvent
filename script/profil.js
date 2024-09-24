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
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./db/inscription.php", true);
    xhr.send(formdata);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response = xhr.responseText;
            if(response == "mail_existant"){
                document.getElementById("error-form").style.display = "block";
                document.getElementById("error-form").innerHTML = "Email déjà utilisé";
            }
            if(response == "inscription_reussie"){
                location.href = "./";
            }
        }
    }
})