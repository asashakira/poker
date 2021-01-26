function plusBet() {
  var x = document.getElementById("plus").textContent;
  document.getElementById("plus").innerHTML = parseInt(x) + 100;
}

function minusBet() {
  var x = document.getElementById("minus").textContent;
  document.getElementById("minus").innerHTML = parseInt(x) - 100;
}


