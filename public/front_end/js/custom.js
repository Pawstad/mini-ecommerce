// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();

// owl carousel 

$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 6
        }
    }
})

// Quantity selector functionality
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.querySelector('.quantity-input');
    const minusBtn = document.querySelector('.quantity-minus');
    const plusBtn = document.querySelector('.quantity-plus');

    if (quantityInput && minusBtn && plusBtn) {

// copy quantity to hidden inputs before submit
document.addEventListener('submit', function(e) {
    const qty = document.querySelector('.quantity-input')?.value || 1;
    document.querySelectorAll('.form-quantity, .form-quantity-buy').forEach(function(el) {
    el.value = qty;
    });
});
    minusBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        }
    });

    plusBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        let maxStock = parseInt(quantityInput.getAttribute('max'));
        if (currentValue < maxStock) {
        quantityInput.value = currentValue + 1;
        }
    });
    }
});