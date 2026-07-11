function openCancelModal(id){

    const modal = document.getElementById("cancelModal");
    const hiddenInput = document.getElementById("cancelBookingId");

    if(modal){
        modal.style.display = "flex";
    }

    if(hiddenInput){
        hiddenInput.value = id;
    }

}


function confirmCancelBooking(){

    const bookingId = document.getElementById("cancelBookingId").value;

    if(!bookingId){
        closeCancelModal();
        return;
    }

    window.location.href = "cancel-booking.php?id=" + bookingId;

}


function closeCancelModal(){

    const modal = document.getElementById("cancelModal");

    if(modal){
        modal.style.display = "none";
    }

}
function openPaymentModal(id){

    const modal = document.getElementById("paymentModal");

    const button = document.getElementById("confirmPaymentBtn");


    if(modal){

        modal.style.display = "flex";

    }


    if(button){

        button.onclick = function(){

            window.location.href = "make-payment.php?id=" + id;

        };

    }

}



function closePaymentModal(){

    const modal = document.getElementById("paymentModal");

    if(modal){

        modal.style.display = "none";

    }

}


// sidebar toggle for mobile dashboard
const menuToggle = document.querySelector(".menu-toggle");
const sidebar = document.querySelector(".sidebar");

if(menuToggle && sidebar){
    menuToggle.addEventListener("click", () => {
        sidebar.classList.toggle("active");
    });
}