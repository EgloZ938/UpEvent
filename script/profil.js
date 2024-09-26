if(document.getElementsByClassName("pfp-cliquable")){
    let tabPfp = document.getElementsByClassName("pfp-cliquable");
    
    for (let i = 0; i < tabPfp.length; i++) {
        tabPfp[i].addEventListener("click", (e) => {
            let dataTarget = e.currentTarget.getAttribute('data-target');
            location.href = `./profil.php?id_user=${dataTarget}`;
        });
    }
}

if(document.getElementsByClassName("suppr-btn")){
    let tabSupprBtn = document.getElementsByClassName("suppr-btn");

    for(let i = 0; i < tabSupprBtn.length; i++){
        tabSupprBtn[i].addEventListener("click", (e) =>{
            let dataTarget = e.currentTarget.getAttribute("data-id-event");
            let formdata = new FormData();
            formdata.append("id_event", dataTarget);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "./php/remove_event.php", true);
            xhr.send(formdata);
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let response = xhr.responseText;
                    if (response == "L'événement et tous ses participants ont été supprimés avec succès.") {
                        location.reload();
                    }
                }
            }
        })
    }
}

if (document.getElementById("like-btn")) {
    document.getElementById("like-btn").addEventListener("click", (e) => {
        let id_user_profil = e.currentTarget.getAttribute('data-id-profil');
        let formdata = new FormData();
        formdata.append("id_user_liked", id_user_profil);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "./php/add_like.php", true);
        xhr.send(formdata);
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let response = xhr.responseText;
                if (response == "like ajouté") {
                    location.reload();
                }
            }
        }
    })
}

if (document.getElementById("dislike-btn")) {
    document.getElementById("dislike-btn").addEventListener("click", (e) =>{
        let id_user_profil = e.currentTarget.getAttribute('data-id-profil');
        let formdata = new FormData();
        formdata.append("id_user_liked", id_user_profil);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "./php/remove_like.php", true);
        xhr.send(formdata);
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let response = xhr.responseText;
                if (response == "like supprimé") {
                    location.reload();
                }
            }
        }
    })
}

if(document.getElementsByClassName("desinscrire-btn")){
    let tabInscrireBtn = document.getElementsByClassName("desinscrire-btn");
    for (let i = 0;i < tabInscrireBtn.length; i++){
        tabInscrireBtn[i].addEventListener("click", (e) =>{
            let dataTarget = e.currentTarget.getAttribute('data-id-event');
            let formdata = new FormData();
            formdata.append("id_event", dataTarget);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "./php/remove_inscription.php", true);
            xhr.send(formdata);
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let response = xhr.responseText;
                    console.log(response);
                    if(response == "réussite"){
                        location.reload();
                    }
                }
            }
        })
    }
}

if(document.getElementsByClassName("inscrire-btn")){
    let tabInscrireBtn = document.getElementsByClassName("inscrire-btn");
    for (let i = 0;i < tabInscrireBtn.length; i++){
        tabInscrireBtn[i].addEventListener("click", (e) =>{
            let dataTarget = e.currentTarget.getAttribute('data-id-event');
            let formdata = new FormData();
            formdata.append("id_event", dataTarget);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "./php/add_inscription.php", true);
            xhr.send(formdata);
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let response = xhr.responseText;
                    console.log(response);
                    if(response == "réussite"){
                        location.reload();
                    }
                }
            }
        })
    }
}