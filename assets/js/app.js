/* VELOUR STUDIO - Main UI Scripts */

// Currency Popup Toggle
function toggleCurrencyPopup(e) {
  e.preventDefault();
  e.stopPropagation();
  var popup = document.getElementById("currencyPopup");
  if (popup) {
    popup.classList.toggle("show");
  }
}

// Update Country Flag in Popup
function updateFlag() {
  var select = document.getElementById("countrySelect");
  var flag = document.getElementById("countryFlag");
  if (select && flag) {
    var countryCode = select.value;
    flag.src = "https://flagcdn.com/w20/" + countryCode + ".png";
  }
}

// Close Currency Popup when clicking outside
document.addEventListener("click", function (e) {
  var popup = document.getElementById("currencyPopup");
  if (popup && popup.classList.contains("show")) {
    if (!popup.contains(e.target)) {
      popup.classList.remove("show");
    }
  }
});

// Cart Drawer Open
function openCart(e) {
  if (e) e.preventDefault();
  var overlay = document.getElementById("cartOverlay");
  var drawer = document.getElementById("cartDrawer");
  if (overlay) overlay.classList.add("show");
  if (drawer) drawer.classList.add("show");
}

// Cart Drawer Close
function closeCart() {
  var overlay = document.getElementById("cartOverlay");
  var drawer = document.getElementById("cartDrawer");
  if (overlay) overlay.classList.remove("show");
  if (drawer) drawer.classList.remove("show");
}
