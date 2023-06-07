function del(Table) {
  if (confirm("Delete this item?")) {
    const itemID = document.getElementById("DID").value;
    if(Table == "users" || Table == "googleuser" || Table == "clients")
      window.location.href = "./Account/"+Table+"_Controller.php?action=delete&ID="+itemID;
    else
      window.location.href = Table+"/"+Table+"_Controller.php?action=delete&ID="+itemID;
      //window.location.href = "/web2-new--main/"+Table+"/"+Table+"_Controller.php?action=delete&ID="+itemID;
  }
}
function Product_Details(Table) {
  const table = document.getElementById(Table);
  const ID = document.getElementById("DID");
  const name = document.getElementById("DName");
  const Price = document.getElementById("DPrice");
  const Category = document.getElementById("DCategory");
  const Brand = document.getElementById("DBrand");
  const Img = document.getElementById("Dproduct_img");
  const file = document.getElementById("default_img");
  const Des = document.getElementById("DDescription");
  const status =  document.getElementById("status");
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
    console.log(values);
    ID.value = values[0];
    name.value = values[1];
    Price.value = values[2];
    Category.value = values[3];
    Brand.value = values[4];
    Des.value = values[5];
    file.value = values[6];
    Img.src = "image/" + values[6];
    status.value = values[7];
    
    

    if(values[6]==""){
      document.getElementById("remove_img_btn").style.display = 'none';
    }
    else{
      document.getElementById("remove_img_btn").style.display = 'block';
    
    }
  });
}
function Size_Details(Table){
  const table = document.getElementById(Table);
  var id;
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("size_form").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open("GET", "product/size_details.php?ID=" + values[0], true);
    xmlhttp.send();
    document.getElementById("QuantityModalLabel").innerHTML = values[1];
  });
}

function ChangeSize(Table){
  console.log("run")
  const table = document.getElementById(Table);
  const Quantity = document.getElementById("Quantity");
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
    console.log(values);
    Quantity.value=[2];
  });
}

function Displayimg(input, img) {
  const img_file = document.getElementById(input);
  const myimg = document.getElementById(img);
  myimg.src = "image/" + img_file.value.split(/(\\|\/)/g).pop();
  //document.getElementById("remove_img_btn").style.display = 'block';
}

function delimg(default_input,input,img){
  const view = document.getElementById(img);
  view.src = "";
  document.getElementById(input).value = "";
  document.getElementById(default_input).value = "";
  document.getElementById("remove_img_btn").style.display = 'none';
}

function Order_Details(Table) {
  const table = document.getElementById(Table);
  const Customer_ID = document.getElementById("Customer_ID");
  const Order_ID = document.getElementById("Order_ID");
  const BuyDate = document.getElementById("BuyDate");
  const Status = document.getElementById("Status");
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
    document.getElementById("Order_Detail_modal").innerHTML ="Order ID: " + values[0];
    Order_ID.value = values[0];
    document.getElementById("DID").value = values[0];
    Customer_ID.value = values[1];
    BuyDate.value = values[2];
    Status.value = values[3];
    //get Order_Details
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("Order_Details_tbl").innerHTML =
          this.responseText;
      }
    };
    console.log("OK");
    xmlhttp.open("GET", "Order/order_details.php?ID=" + values[0], true);
    xmlhttp.send();
  });
}
function getvaluefromtable(table){
  var $row = $(this).closest("tr"),       // Finds the closest row <tr> 
    $tds = $row.find("td");             // Finds all children <td> elements

$.each($tds, function() {               // Visits every single <td> element
    console.log($(this).text());        // Prints out the text within the <td>
});
}
function User_Details(Table){
  const table = document.getElementById(Table);
  const ID = document.getElementById("DID");
  const Name = document.getElementById("DName");
  const Username = document.getElementById("DUsername");
  const Address = document.getElementById("DAddress");
  const Password = document.getElementById("DPassword");
  const Type = document.getElementById("DType");
  const Phone = document.getElementById("DPhone");
  const gender = document.getElementById("Dgender");
  const birthday = document.getElementById("Dbirthday");
  const created_at = document.getElementById("created_at");
  const email = document.getElementById("Demail");
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
  ID.value = values[0];
  Username.value = values[1];
  Name.value = values[2];
  birthday.value = values[3];
  gender.value = values[4];
  email.value = values[5];
  Phone.value = values[6];
  Address.value = values[7];
  Password.value = values[8];
  Type.value = values[9];
  created_at.value = values[10];
});

}
function clients_Details(Table){
  const table = document.getElementById(Table);
  const ID = document.getElementById("DID");
  const Username = document.getElementById("DUsername");
  const Address = document.getElementById("DAddress");
  const Password = document.getElementById("DPassword");
  const Phone = document.getElementById("DPhone");
  const created_at = document.getElementById("created_at");
  const email = document.getElementById("Demail");
  const OTP = document.getElementById("OTP");
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
  ID.value = values[0];
  Username.value = values[1];
  email.value = values[2];
  Phone.value = values[3];
  Address.value = values[4];
  Password.value = values[5];
  created_at.value = values[6];
  OTP.value = values[7];
});
}
function googleuser_Details(Table){
  const table = document.getElementById(Table);
  const ID = document.getElementById("DID");
  const FirstName = document.getElementById("FirstName");
  const LastName = document.getElementById("LastName");
  const FullName = document.getElementById("FullName");
  const email = document.getElementById("Demail");
  const token = document.getElementById("Token");
  const gender = document.getElementById("Dgender");
  const vemail = document.getElementById("VerifiedEmail");
  const img = document.getElementById("product_img");
  $(table).on("click", "td", function () {
    var values = [];
    $.each($(this).siblings(), function () {
      values.push($(this).text());
    });
  ID.value = values[0];
  email.value = values[1];
  FirstName.value = values[2];
  LastName.value = values[3];
  gender.value = values[4];
  FullName.value = values[5];
  img.src = "image/" + values[6];
  vemail.value = values[7];
  token.value = values[8];
});
}
// function OrderSearch(url) {
//   const fromdate = document.getElementById("fromdate");
//   const todate = document.getElementById("todate");
//   if ((fromdate.value = null)) alert("");
//   const xmlhttp = new XMLHttpRequest();
//   xmlhttp.onreadystatechange = function () {
//     if (this.readyState == 4 && this.status == 200) {
//       document.getElementById("orders").innerHTML = this.responseText;
//     }
//   };
//   console.log("OK");
//   xmlhttp.open("GET", "Order/order_details.php?ID=" + values[0], true);
//   xmlhttp.send();
// }
function setAction(action_ID,action_group_ID){
  const status = document.getElementById(action_ID + "." + action_group_ID);
  console.log(status.checked);
  console.log("action_ID:"+action_ID);
  console.log("actionG_ID:"+action_group_ID);
  const xmlhttp = new XMLHttpRequest();
  let checked = 0;
if (action_ID == 3 && action_group_ID ==1){
  return false;
}
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
    }
  };
  if(status.checked == true)
    checked = 1;
  xmlhttp.open("GET", "Account/Acount_Action_Controller.php?action_ID=" + action_ID+"&action_group_ID="+action_group_ID + "&status="+checked, true);
  xmlhttp.send();

}
function findtopsale(){
  const fromdate = document.getElementById("fromdate").value;
  const todate = document.getElementById("todate").value;
  const limit = document.getElementById("limit").value;
  window.location.href="Admin.php?chon=statistics&fromdate=" + fromdate + "&todate=" + todate + "&limit=" + limit + "&topsale=1";
  //console.log(fromdate);

}

function setAccountview(view){
  window.location.href="admin.php?chon=accounts&view=" + view;

}

var form = document.querySelector('#add-product-form');
form.addEventListener('submit', function (event) {
    // prevent the default form submission behavior
    event.preventDefault();
    var name = document.querySelector('#Name').value;


    var price = document.querySelector('#Price').value;



    // check the form data
    if (name === '' || price === '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'you must type valid infomation',
        })
    } else {
        if (price < 1) {
            Swal.fire({
                title: 'Price is invalid',
                text: "The price should be more than 1 !",
                icon: 'warning',


            })

        } else {
                if(isNaN(price)){
                    alert("Price must be number");
          }
          else{
            form1.submit()}
        }

    }
});
var form1 = document.querySelector('#detail-product-form');
form1.addEventListener('submit', function (event) {
    // prevent the default form submission behavior
    event.preventDefault();
    var name = document.querySelector('#DName').value;


    var price = document.querySelector('#DPrice').value;



    // check the form data
    if (name === '' || price === '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'you must type valid infomation',
        })
    } else {
        if (price < 1) {
            Swal.fire({
                title: 'Price is invalid',
                text: "The price should be more than 1 !",
                icon: 'warning',

            })

        } else {
          if(isNaN(price)){
                                   alert("Price must be number");

          }
          else{
            form1.submit()}
        }

    }
});

// function submitf() {
//     alert('stop submit');

// }
