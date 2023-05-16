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

// QuerySelectorAll sur mes bouttons
const filterButtons = Array.from(document.querySelectorAll('.btn-filter'));

// Listener
filterButtons.forEach(button => {
    button.addEventListener('click', e => {
        // Prend la valeur de data.filter
        const filter = e.target.dataset.filter;
        // Récupère par catégorie
        const items = document.querySelectorAll('.categorie-section');

        // Afficher tout les plats
        if (filter === 'all') {
            items.forEach(item => item.style.display = 'block');
        } else {
            // Afficher les plats sélectionné
            document.querySelectorAll(`[data-category="${filter}"]`).forEach(item => item.style.display = 'block');
        }
    });
});