// ==============================
// BOOKING FORM
// ==============================

const bookingForm = document.getElementById("bookingForm");
const bookBtn = document.querySelector(".book-btn");

// Set today's date as the minimum pickup date
const pickupDate = document.querySelector('input[name="pickupdate"]');

const today = new Date().toISOString().split("T")[0];

pickupDate.min = today;


// ==============================
// FORM SUBMISSION
// ==============================

bookingForm.addEventListener("submit", function(e){

    e.preventDefault();

    const fullname = document.querySelector('input[name="fullname"]').value.trim();
    const email = document.querySelector('input[name="email"]').value.trim();
    const phone = document.querySelector('input[name="phone"]').value.trim();
    const vehicle = document.querySelector('select[name="vehicle"]').value;
    const pickup = document.querySelector('input[name="pickup"]').value.trim();
    const destination = document.querySelector('input[name="destination"]').value.trim();
    const date = document.querySelector('input[name="pickupdate"]').value;
    const time = document.querySelector('input[name="pickuptime"]').value;

    // Empty field validation
    if(
        fullname === "" ||
        email === "" ||
        phone === "" ||
        vehicle === "" ||
        pickup === "" ||
        destination === "" ||
        date === "" ||
        time === ""
    ){

        alert("Please complete all required fields.");

        return;

    }


    // Loading Button

    const originalText = bookBtn.innerHTML;

    bookBtn.disabled = true;

    bookBtn.innerHTML =
    `<i class="fa-solid fa-spinner fa-spin"></i> Booking...`;


    // Fake request (replace later with PHP)

    setTimeout(()=>{

        alert("🎉 Your booking request has been submitted successfully!");

        bookingForm.reset();

        pickupDate.min = today;

        bookBtn.disabled = false;

        bookBtn.innerHTML = originalText;

    },2000);

});

const navToggle = document.querySelector('.nav-toggle');
const navMenu = document.querySelector('.nav-menu');

if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
        const isOpen = navMenu.classList.toggle('open');
        navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
}
