// Gestionare interactivitate pentru aplicația bibliotecii
document.addEventListener("DOMContentLoaded", () => {
  console.log("Library Management System loaded.");

  // Exemplu de funcționalitate: confirmarea ștergerii unui utilizator
  const deleteLinks = document.querySelectorAll('a[href*="delete.php"]');
  deleteLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      if (!confirm("Sigur dorești să ștergi acest utilizator?")) {
        e.preventDefault();
      }
    });
  });
});
