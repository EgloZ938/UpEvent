document.getElementById("form-card").addEventListener("submit", (e) => {
    e.preventDefault();
    let prenom = document.getElementById("prenom").value;
    let nom = document.getElementById("nom").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let formdata = new FormData();
    formdata.append("prenom", prenom);
    formdata.append("nom", nom);
    formdata.append("email", email);
    formdata.append("password", password);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./db/inscription.php", true);
    xhr.send(formdata);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response = xhr.responseText;
            if(response == "mail_existant"){

            }
            if(response == "inscription_reussie"){
                location.href = "./";
            }
        }
    }
})