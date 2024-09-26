/** Home page */

if(document.querySelector('.mobile-menu-button')){
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');
    
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });
    });
}

if(document.querySelector('#profil')){
    document.getElementById("profil").addEventListener("click", () => {
        location.href = "./profil.php";
    })
}

if(document.getElementsByClassName("pfp-cliquable")){
    let tabPfp = document.getElementsByClassName("pfp-cliquable");
    
    for (let i = 0; i < tabPfp.length; i++) {
        tabPfp[i].addEventListener("click", (e) => {
            let dataTarget = e.currentTarget.getAttribute('data-target');
            location.href = `./profil.php?id_user=${dataTarget}`;
        });
    }
}

if(document.getElementById("inscrire-btn")){
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

if(document.getElementById("desinscrire-btn")){
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