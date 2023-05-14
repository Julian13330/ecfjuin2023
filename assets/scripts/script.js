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

// Système de filtre par catégorie pour les plâts

// récupère-les buttons
const filterButtons = Array.from(document.querySelectorAll('.btn-filter'));

// event listener
filterButtons.forEach(button => {
    button.addEventListener('click', e => {
        // récupère la valeur de l'attribut data-filter du button
        const filter = e.target.dataset.filter;
        // récupère-les elements à modifier par la suite
        const items = document.querySelectorAll('.categorie-section');


        // tout afficher si all est sélectionné
        if (filter === 'all') {
            items.forEach(item => item.style.display = 'block');
        } else {
            // sinon cacher tous les éléments
            items.forEach(item => item.style.display = 'none');

            // et ne montrer que celui qui est sélectionné
            document.querySelectorAll(`[data-category="${filter}"]`).forEach(item => item.style.display = 'block');
        }
    });
});