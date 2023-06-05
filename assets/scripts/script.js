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

// Modal

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}