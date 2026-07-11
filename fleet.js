const searchInput = document.getElementById("searchInput");
const categoryFilter = document.getElementById("categoryFilter");
const cards = document.querySelectorAll(".car-card");
const noResults = document.getElementById("noResults");

function filterCars() {

    const search = searchInput.value.toLowerCase().trim();
    const category = categoryFilter.value;

    let visibleCount = 0;

    cards.forEach(card => {

        const title = card
            .querySelector("h3")
            .textContent
            .toLowerCase();

        const cardCategory = card.dataset.category;

        const searchMatch = title.includes(search);

        const categoryMatch =
            category === "all" ||
            cardCategory === category;

        if (searchMatch && categoryMatch) {

            card.style.display = "block";
            visibleCount++;

        } else {

            card.style.display = "none";

        }

    });

    if (visibleCount === 0) {
        if (noResults) {
            noResults.style.display = "block";
        }
    } else {
        if (noResults) {
            noResults.style.display = "none";
        }
    }

}

searchInput.addEventListener("keyup", filterCars);
categoryFilter.addEventListener("change", filterCars);

// Run once when page loads
filterCars();

const navToggle = document.querySelector(".nav-toggle");
const navMenu = document.querySelector(".nav-menu");

if(navToggle && navMenu){
    navToggle.addEventListener("click", ()=>{
        navMenu.classList.toggle("active");
        navToggle.classList.toggle("open");
    });

    document.querySelectorAll(".nav-menu a").forEach(link=>{
        link.addEventListener("click", ()=>{
            navMenu.classList.remove("active");
            navToggle.classList.remove("open");
        });
    });
}
