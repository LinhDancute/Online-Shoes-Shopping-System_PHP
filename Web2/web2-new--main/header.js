// REPONSIVE MAIN HEADER

$(document).ready(function () {
    $('#toggle').click(function () {
        $('.header-main .container').slideToggle();
    });
})

const cartIcon = document.querySelector("#cart-icon");
const cart = document.querySelector(".cart");
const cartClose = document.querySelector("#cart-close");
const darkBg = document.querySelector(".background");
cartIcon.addEventListener("click", () => {
    cart.classList.add("active");
    darkBg.classList.add("active");
    updateTotal();
});

cartClose.addEventListener("click", () => {
    cart.classList.remove("active");
    darkBg.classList.remove("active");
});

// Start when document is ready
if (document.readyState == "loading") {
    document.addEventListener('DOMContentLoaded', start);
} else {
    start();
}

// ================ START =================
function start() {
    addEvents();
}

// ================ UPDATE & RENDER ================
function update() {
    addEvents();
    updateTotal();
}

// ================ ADD EVENTS =================
function addEvents() {
    // remove item from cart
    let cartRemove_btns = document.querySelectorAll(".cart-remove");
    cartRemove_btns.forEach((btn) => {
        btn.addEventListener("click", handle_removeCartItem);
    });

    // change item quantity
    let quantity_input = document.querySelectorAll(".cart-quantity");
    quantity_input.forEach(input => {
        input.addEventListener("change", handel_changeItemQuantity);
    })
}

//================ HANDLE FUNCTION =============
function handle_removeCartItem() {
    this.parentElement.remove();
    id = this.parentElement.querySelector('#product-id').value;
    size = this.parentElement.querySelector('#product-size').value;
    //session
  
    // console.log(userid)
    update();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

        }
    };
    xhttp.open("GET", "web/deletecart.php?productId=" + id + "&productSize= " + size, true);
    xhttp.send();


}
var quantity
var ob
function handel_changeItemQuantity() {
    if (isNaN(this.value) || this.value < 1) {
        this.value = 1;
    }
    this.value = Math.floor(this.value);
    id = this.parentElement.querySelector('#product-id').value;
    size = this.parentElement.querySelector('#product-size').value;
    var xhttp = new XMLHttpRequest();
    ob=this;
    quantity=this.value;
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if(xhttp.responseText==1){
                updatequantity(ob)
                Swal.fire({
                                         icon: 'error',
                                         title: 'Your number is limited ',
                                         text: 'You must choose the valid number1',
                                     })
            }
        }
    };
    xhttp.open("GET", "web/increaseProduct.php?productId=" + id + "&Quantity=" + this.value+ "&productSize= " + size, true);
    
    xhttp.send();
     
   
    
    
    update();
}
function updatequantity(o){
    o.value=quantity-1;
    
}

//================ UPDATE AND RERENDER FUNCTION ============

function updateTotal() {
    let cartBoxes = document.querySelectorAll('.cart-box');
    const totalElement = cart.querySelector('.total-price');
    let total = 0;
    cartBoxes.forEach((cartBox) => {
        let priceElement = cartBox.querySelector(".cart-price");
        let price = parseFloat(priceElement.innerHTML.replace("$", ""));
        let quantity = cartBox.querySelector(".cart-quantity").value;
        total += price * quantity;
    });
    total = total.toFixed(2);
    totalElement.innerHTML = "$" + total;
}
