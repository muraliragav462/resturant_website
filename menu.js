   
 
let cart = [];
function addToCart(item) {
  cart.push(item);
  alert(item + " added to cart!");
}

function orderWhatsapp() {
  let text = "Order Items:\n" + cart.join("\n");
  let url = "https://wa.me/91XXXXXXXXXX?text=" + encodeURIComponent(text);
  window.open(url, "_blank");
}
