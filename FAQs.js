const faqs=document.querySelectorAll(".faq");

faqs.forEach(faq=>{

faq.querySelector(".question").addEventListener("click",()=>{

faq.classList.toggle("active");

});

});

const searchInput=document.getElementById("searchInput");

searchInput.addEventListener("keyup",()=>{

const value=searchInput.value.toLowerCase();

faqs.forEach(faq=>{

const text=faq.innerText.toLowerCase();

faq.style.display=text.includes(value)
?"block"
:"none";

});

});