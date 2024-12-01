document.addEventListener("DOMContentLoaded", () => {
  const showMenu = document.getElementById("show-menu");
  const sidebar = document.querySelector(".sidebar");
  const overlay = document.querySelector(".overlay");

  // Gestion de l'affichage du menu latéral
  showMenu.addEventListener("click", () => {
    sidebar.classList.add("show");
  });

  overlay.addEventListener("click", () => {
    sidebar.classList.remove("show");
  });

  // Gérer l'élément actif du menu
  const linkItems = document.querySelectorAll(".link-items");
  const currentPath = window.location.pathname;
  let isActiveSet = false;

  linkItems.forEach((link) => {
    if (link.href.endsWith(currentPath)) {
      link.classList.add("active");
      isActiveSet = true;
    }
  });

  // Si aucune correspondance n'est trouvée, définir 'active' sur le premier élément
  if (!isActiveSet && linkItems.length > 0) {
    linkItems[0].classList.add("active");
  }

  // Ajouter un écouteur pour gérer le clic et mettre à jour la classe 'active'
  linkItems.forEach((item) => {
    item.addEventListener("click", function (e) {
      // e.preventDefault();

      linkItems.forEach((link) => {
        link.classList.remove("active");
      });

      this.classList.add("active");
    });
  });

  // Afficher/Masquer le formulaire
  const formContainer = document.querySelector(".form-container");
  const addBtn = document.querySelector(".add-btn");
  const form = document.querySelector("form");

  if (addBtn && formContainer && form) {
    addBtn.addEventListener("click", () => {
      formContainer.classList.add("show");
    });

    formContainer.addEventListener("click", (event) => {
      if (event.target === formContainer || event.target === closeForm) {
        formContainer.classList.remove("show");
      }
    });

    form.addEventListener("click", (event) => {
      event.stopPropagation();
    });
  }
});
