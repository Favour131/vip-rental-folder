// const form =
// document.getElementById("contactForm");

// const successMessage =
// document.getElementById("successMessage");

// form.addEventListener("submit", e => {

// e.preventDefault();

// successMessage.style.display =
// "block";

// form.reset();

// setTimeout(() => {

// successMessage.style.display =
// "none";

// }, 4000);

// });

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