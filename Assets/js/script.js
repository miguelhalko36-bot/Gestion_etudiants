document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("#studentForm");
   
    if (form) {
        form.addEventListener("submit", function(e) {
            const nom = document.querySelector("#nom").value.trim();
            const prenom = document.querySelector("#prenom").value.trim();
            const errorBox = document.querySelector("#error-msg");
            if (nom === "" || prenom === "") {
                e.preventDefault();
                errorBox.textContent = "Erreur : Le nom et le prénom sont obligatoires.";
                errorBox.style.display = "block";
            }
        });
    }
});
function confirmDelete() {
    return confirm("Voulez-vous vraiment supprimer cet étudiant ?");
}
