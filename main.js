window.addEventListener("scroll",()=>{

document.querySelector("nav")

.style.background=

window.scrollY>100

?

"rgba(0,0,0,.85)"

:

"transparent";

});



const cards=

document.querySelectorAll(".glass-card");



cards.forEach(card=>{

card.addEventListener(

"mousemove",

e=>{

let x=

e.offsetX/20;

let y=

e.offsetY/20;

card.style.transform=

`rotateY(${x}deg)
rotateX(${-y}deg)`;

});



card.addEventListener(

"mouseleave",

()=>{

card.style.transform=

"rotate(0deg)";
                                                          
});                                                                         

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
