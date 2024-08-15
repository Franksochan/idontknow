function openModal() {
    document.getElementById("modal").style.display = "block";
  }

  function closeModal() {
    document.getElementById("modal").style.display = "none";
  }

  window.onclick = function(event) {
    var modal = document.getElementById("modal");
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }