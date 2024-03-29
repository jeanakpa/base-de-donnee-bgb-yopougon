function confirmerSuppression(matricule, grade, nom, prenom, compagnie) {
    // Afficher un message de confirmation
    if (confirm(`Voulez-vous vraiment supprimer ${grade} ${nom} ${prenom} de la compagnie ${compagnie} ?`)) {
      // Rediriger vers la page de traitement de suppression avec le matricule
      window.location.href = `traitement_suppression_membre.php?matricule=${matricule}`;
    }
  }

  function convertirEnMajuscules(element) {
    element.value = element.value.toUpperCase();
  }
  