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
  const addSubjects = document.querySelectorAll(".add-subjects-btn");
  const form = document.querySelector("form");

  if (formContainer && form) {
    if (addBtn) {
      addBtn.addEventListener("click", () => {
        formContainer.classList.add("show");
      });
    } else if (addSubjects.length > 0) {
      addSubjects.forEach((addSubject) => {
        addSubject.addEventListener("click", () => {
          formContainer.classList.add("show");
        });
      });
    }

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

function showAlert(message) {
  const alertBox = document.getElementById("customAlert");
  const alertMessage = document.getElementById("alertMessage");

  alertMessage.textContent = message;
  alertBox.style.display = "block";
}

function closeAlert() {
  const alertBox = document.getElementById("customAlert");
  alertBox.style.display = "none";
}

async function deleteStudent(studentId) {
  if (!confirm("Êtes-vous sûr de vouloir supprimer cet étudiant ?")) return;

  try {
    const response = await fetch("/database/delete.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        id: studentId,
        type: "delete_student",
      }),
    });

    // Vérifier si la réponse est OK (status 200)
    if (!response.ok) {
      throw new Error(
        "La requête a échoué avec le statut : " + response.status
      );
    }

    const data = await response.json();
    console.log(data); // Afficher la réponse pour débogage

    if (data.status === "success") {
      showAlert(data.message);
      document.querySelector(`tr[data-id='${studentId}']`).remove(); // Supprime la ligne
    } else {
      showAlert("Erreur :" + data.message);
    }
  } catch (error) {
    console.error("Erreur :", error);
    showAlert("Une erreur est survenue lors de la suppression.");
  }
}
