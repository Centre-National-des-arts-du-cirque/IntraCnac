const viewButtons = document.querySelectorAll('.view-btn');

viewButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Trouve le contenu du ticket associé au bouton
        const ticketContent = this.closest('.ticket').querySelector('.ticket-content');

        // Affiche ou cache le contenu du ticket
        if (this.textContent == 'Afficher') {
            ticketContent.style.display = 'block';
            this.textContent = 'Masquer';
        } else {
            ticketContent.style.display = 'none';
            this.textContent = 'Afficher';
        }
    });
});