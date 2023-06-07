 var category = 'all'; // default category
 var page = 1; // default page
 var brand = 'all';
 var searchText = '';
 var orderby = 'all';
 var min = 'none';
 var max = "none";
 changePage(1);

 function changePage(value) {
     page = value;
    
     filterdata();






 }

 function filterdata() {

     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onload = function () {
         if (this.readyState == 4 && this.status == 200) {

             document.querySelector(".center-section").innerHTML = "";
             document.querySelector(".center-section").innerHTML = this.responseText;
             window.scrollTo(0, 0);



         }
     };
     xmlhttp.open("GET", "web/container.php?category=" + category + "&brand=" + brand + "&page=" + page + "&searchtext=" + searchText + "&orderby=" + orderby + "&min=" + min + "&max=" + max, true);

     xmlhttp.send();
 }


 document.querySelectorAll(".category").forEach((item) => {
     item.addEventListener("click", function () {
         value = item.getAttribute("value");
         document.querySelectorAll(".category").forEach((item) => {
             item.classList.remove('active');
         });

         if (category == value) {
             category = 'all';


         } else {
             category = value;
             item.classList.add("active");
         }
         page = 1;
         filterdata()
     });
 });
 document.querySelectorAll(".Search-context").forEach((item) => {
     item.addEventListener("keydown", function (e) {
         searchText = e.target.value.trim()
         filterdata();

     });
 });

 function itemClick(id) {
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onload = function () {
         if (this.readyState == 4 && this.status == 200) {

             document.querySelector(".content").innerHTML = "";
             document.querySelector(".content").innerHTML = this.responseText;

             magnify("myimage", 1.7);

             var form = document.querySelector('#my-form');

             form.addEventListener('submit', function (event) {
                 // prevent the default form submission behavior
                 event.preventDefault();
                 const formData = new FormData(form);
                 const xhr = new XMLHttpRequest()
                 var input1 = parseInt(document.querySelector('#insert-quantity').innerHTML);
           

                 var size = document.querySelector('#select-size').value;
                 var quantity = document.querySelector('#quantityValue').value;
                
                 if (size == 'none') {

                     Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: 'you must select a valid size ',
                     })
                 } else {
                     if (quantity > input1 || quantity == '' || quantity < 1) {
                         Swal.fire({
                             icon: 'error',
                             title: 'Oops...',
                             text: 'Your quantity is invalid ',
                         })
                     } else {


                         xhr.open("POST", "web/addcart-submit.php",true);
                         xhr.onload = function () {
                             if (xhr.status === 200) {
                                 // Handle the response from PHP here
                                 if (xhr.responseText == 1) {
                                     Swal.fire({
                                         icon: 'success',
                                         title: 'Added to your cart',
                                         showConfirmButton: false,

                                     })
                                     setTimeout(function () {
                                         location.reload();
                                     }, 1000);

                                 } else if(xhr.responseText==2){
                                        Swal.fire({
                                         icon: 'error',
                                         title: 'Login first',
                                         text: 'You must login first',
                                     })
                                 }
                                  else {
                                     Swal.fire({
                                         icon: 'error',
                                         title: 'Some thing went Wrong',
                                         text: 'You must check your product in your cart first',
                                     })
                                 }
                             }
                         };
                         xhr.send(formData);


                     }

                 }






             });

             window.scrollTo(0, 0);



         }
     };
     xmlhttp.open("GET", "web/detail.php?Id=" + id, true);

     xmlhttp.send();
 }


 function minPriceChange(value) {
     // console.log(value);
     min = value;
     filterdata();
 }

 function maxPriceChange(value) {
     max = value;
     filterdata();
 }

 function orderByChange(value) {
     orderby = value;
     filterdata();
 }
 document.querySelectorAll(".brand").forEach((item) => {
     item.addEventListener("click", function () {
         value = item.getAttribute("value");
         document.querySelectorAll(".brand").forEach((item) => {
             item.classList.remove('active');
         });
         if (brand == value) {
             brand = 'all';
         } else {
             brand = value;
             item.classList.add("active");
         }

         page = 1;
         filterdata()
     });
 });

 function filterClick() {

     document.querySelector('.background').classList.add('active');
     document.querySelectorAll('.overlay')[1].classList.add('active');

 }
 document.querySelector('.background').onclick = function () {
     document.querySelector('.background').classList.remove('active');
     if (document.querySelectorAll('.overlay')[1].classList.contains('active')) {
         document.querySelectorAll('.overlay')[1].classList.remove('active');
     }
     if (document.querySelectorAll('.overlay')[0].classList.contains('active')) {
         document.querySelectorAll('.overlay')[0].classList.remove('active');
     }
     if (document.querySelector('.cart').classList.contains('active')) {
         document.querySelector('.cart').classList.remove('active');
     }

 }

 function changeSize(value, id) {

     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onload = function () {
         if (this.readyState == 4 && this.status == 200) {
             document.querySelector("#insert-quantity").innerHTML = this.responseText;
         }

     };
     xmlhttp.open("GET", "web/select-size.php?ID=" + id + "&size=" + value, true);
     xmlhttp.send();

 }



 document.querySelector('.btn-buy').onclick = function () {
     // CHỗ này thiếu code cần session lấy id
     // id = session()
     id = 1;
     
     var date = new Date();
     date = date.toISOString().slice(0, 10).replace('T', ' ');

     var xhr = new XMLHttpRequest();
     xhr.onload = function () {
         if (xhr.status === 200) {
             // Handle the response from PHP here
            if(xhr.responseText==1){
             Swal.fire({
                 icon: 'success',
                 title: 'Your Order is created',
                 showConfirmButton: false,

             });
             setTimeout(function () {
                 location.reload();
             }, 1000);}
             else if(xhr.responseText==2){
                Swal.fire({
                 icon: 'error',
                 title: 'Your cart is empty',
                 showConfirmButton: false,

             });
             }
             else{

                Swal.fire({
                 icon: 'error',
                 title: 'Login first',
                 showConfirmButton: false,

             });
             }

         }
     };

     xhr.open("GET", "web/Buy-submit.php?IDUser=" + id + "&Date=" + date, true);
     xhr.send();



 }