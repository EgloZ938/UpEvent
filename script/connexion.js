document.getElementById("form-card").addEventListener("submit", (e) => {
    e.preventDefault();
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let formdata = new FormData();
    formdata.append("email", email);
    formdata.append("password", password);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./db/connexion.php", true);
    xhr.send(formdata);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response = xhr.responseText;
            console.log(response);
            if(response == "mauvais mot de passe"){
                document.getElementById("error-form").style.display = "block";
                document.getElementById("error-form").innerHTML = "Mot de passe incorrect";
            }
            if(response == "email introuvable"){
                document.getElementById("error-form").style.display = "block";
                document.getElementById("error-form").innerHTML = "Email introuvable";
            }
            if(response == "conected"){
                location.href = "./";
            }
        }
    }
})