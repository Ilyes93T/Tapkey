// Fonction pour créer un nouvel accès temporaire
async function createAccess() {
    const name = document.getElementById('nameInput').value;
    const tapkeyId = document.getElementById('tapkeyIdInput').value;
    const email = document.getElementById('emailInput').value;
    const startDate = document.getElementById('startDateInput').value;
    const endDate = document.getElementById('endDateInput').value;
    try {
        const response = await fetch('http://51.210.151.13/btssnir/projets2024/airlocunlock2024/airlocunlock2024/api/traitement.php', { // Endpoint spécifique pour créer un accès
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name, tapkeyId, email, startDate, endDate })
        });
        if (response.ok) {
            // Réinitialiser les champs du formulaire
            document.getElementById('nameInput').value = '';
            document.getElementById('tapkeyIdInput').value = '';
            document.getElementById('emailInput').value = '';
            document.getElementById('startDateInput').value = '';
            document.getElementById('endDateInput').value = '';
            alert('Access created successfully!'); // Afficher une alerte pour confirmer la création de l'accès
        } else {
            throw new Error('Failed to create access: ' + response.statusText); // Lever une erreur si la création a échoué
        }
    } catch (error) {
        console.error('Error creating access:', error);
        alert('Failed to create access!'); // Afficher une alerte en cas d'échec de la création de l'accès
    }
}

// Attacher l'événement de click au bouton de création d'accès
document.getElementById('createButton').addEventListener('click', createAccess);
