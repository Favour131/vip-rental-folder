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