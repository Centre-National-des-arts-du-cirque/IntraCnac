// Initialise les variables
const yearSelector = document.getElementById('monthSelector');
const monthSelector = document.getElementById('yearSelector');

// Ajoute un écouteur d'événement à chaque élément <select>
yearSelector.addEventListener('change', updateUrl);
monthSelector.addEventListener('change', updateUrl);

// Fonction pour mettre à jour l'URL
function updateUrl() {
  // Obtient la valeur actuelle du sélecteur
  const value = this.value;

  // Crée un objet URL
  const url = new URL(window.location.href);

  // Met à jour le paramètre d'URL correspondant
  url.searchParams.set(this.id, value);

  // Met à jour l'URL de la page
  window.location.href = url.toString();
}