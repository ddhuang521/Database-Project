  /* Resetbutton  -  You dont need this   */

  var el = document.querySelector(".svg");
  var elWrapperClone = el.innerHTML;
  document.getElementById("button").addEventListener("click", function() {
    el.innerHTML = elWrapperClone;
  });