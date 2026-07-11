const cards = document.querySelectorAll(
".service-card, .why-card, .step"
);

const observer = new IntersectionObserver(entries => {

entries.forEach(entry => {

if(entry.isIntersecting){

entry.target.style.opacity = "1";
entry.target.style.transform = "translateY(0)";

}

});

},{
threshold:.2
});

cards.forEach(card => {

card.style.opacity = "0";
card.style.transform = "translateY(40px)";
card.style.transition = ".7s";

observer.observe(card);

});

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
