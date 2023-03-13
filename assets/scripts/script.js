// Effet sur la barre nav lorsqu'on scrolle la page
const navbar = document.getElementById("navbarSite")
const scrollTopButton = document.getElementById("scroll-top-button")

window.onscroll=function(){
    if(window.pageYOffset>200){
        navbar.classList.remove("bg-transparent","navbar-light");
        navbar.classList.add("bg-dark", "navbar-dark");
        scrollTopButton.classList.add("show");
    }
    else {
        navbar.classList.add("bg-transparent","navbar-dark");
        navbar.classList.remove("bg-light", "navbar-light");
        scrollTopButton.classList.remove("show");
        
    }
}