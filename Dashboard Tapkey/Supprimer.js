// Fonction pour supprimer un accès temporaire
async function deleteAccess() {
    const tapkeyIdToDelete = document.getElementById('tapkeyIdToDeleteInput').value;
    try {
        const response = await fetch('http://51.210.151.13/btssnir/projets2024/airlocunlock2024/airlocunlock2024/api/traitement.php', { // Endpoint spécifique pour supprimer un accès
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ tapkeyId: tapkeyIdToDelete })
        });
        if (response.ok) {
            // Réinitialiser le champ du formulaire
            document.getElementById('tapkeyIdToDeleteInput').value = '';
            alert('Access deleted successfully!'); // Afficher une alerte pour confirmer la suppression de l'accès
        } else {
            throw new Error('Failed to delete access: ' + response.statusText); // Lever une erreur si la suppression a échoué
        }
    } catch (error) {
        console.error('Error deleting access:', error);
        alert('Failed to delete access!'); // Afficher une alerte en cas d'échec de la suppression de l'accès
    }
}

// Attacher l'événement de click au bouton de suppression d'accès
document.getElementById('deleteButton').addEventListener('click', deleteAccess);

