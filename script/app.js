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
        location.href = "./profil.html";
    })
}