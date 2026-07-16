// ================================
// ELEMENTS
// ================================

const menuToggle = document.querySelector(".menu-toggle");
const sidebar = document.querySelector(".sidebar");
const overlay = document.querySelector(".overlay");
console.log(menuToggle);
console.log(sidebar);
const notification = document.querySelector(".notification");
const sidebarMenu = document.querySelector(".sidebar-menu");

// ================================
// SIDEBAR KEYBOARD SCROLL
// ================================

if(sidebarMenu){

    const scrollStep = 120;

    sidebarMenu.addEventListener("keydown", (event) => {

        switch(event.key){

            case "ArrowDown":
                event.preventDefault();
                sidebarMenu.scrollBy({ top: scrollStep, behavior: "smooth" });
                break;

            case "ArrowUp":
                event.preventDefault();
                sidebarMenu.scrollBy({ top: -scrollStep, behavior: "smooth" });
                break;

            case "PageDown":
                event.preventDefault();
                sidebarMenu.scrollBy({ top: sidebarMenu.clientHeight, behavior: "smooth" });
                break;

            case "PageUp":
                event.preventDefault();
                sidebarMenu.scrollBy({ top: -sidebarMenu.clientHeight, behavior: "smooth" });
                break;

            case "Home":
                event.preventDefault();
                sidebarMenu.scrollTo({ top: 0, behavior: "smooth" });
                break;

            case "End":
                event.preventDefault();
                sidebarMenu.scrollTo({ top: sidebarMenu.scrollHeight, behavior: "smooth" });
                break;

        }

    });

}

// ================================
// MOBILE SIDEBAR
// ================================

// if(menuToggle){

//     menuToggle.addEventListener("click",()=>{

//         sidebar.classList.toggle("active");

//         overlay.classList.toggle("active");

//     });

// }

// ================================
// CLOSE SIDEBAR
// ================================

// if(overlay){

//     overlay.addEventListener("click",()=>{

//         sidebar.classList.remove("active");

//         overlay.classList.remove("active");

//     });

// }

// ================================
// CLOSE SIDEBAR AFTER CLICKING LINK
// ================================

document.querySelectorAll(".sidebar a").forEach(link=>{

    link.addEventListener("click",()=>{

        if(window.innerWidth <= 768){

            sidebar.classList.remove("active");

            overlay.classList.remove("active");

        }

    });

});

// ================================
// ACTIVE SIDEBAR LINK
// ================================

const navLinks = document.querySelectorAll(".sidebar li");

navLinks.forEach(item=>{

    item.addEventListener("click",()=>{

        navLinks.forEach(link=>{

            link.classList.remove("active");

        });

        item.classList.add("active");

    });

});

// ================================
// NOTIFICATION
// ================================

if(notification){

notification.addEventListener("click",()=>{

alert("No new notifications.");

});

}

// ================================
// CARD HOVER EFFECT
// ================================

const cards = document.querySelectorAll(".card");

cards.forEach(card=>{

card.addEventListener("mouseenter",()=>{

card.style.transform="translateY(-8px)";

});

card.addEventListener("mouseleave",()=>{

card.style.transform="translateY(0px)";

});

});

// ================================
// WINDOW RESIZE
// ================================

window.addEventListener("resize",()=>{

if(window.innerWidth > 768){

sidebar.classList.remove("active");

overlay.classList.remove("active");

}

});