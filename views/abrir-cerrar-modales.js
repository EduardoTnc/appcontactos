document.addEventListener('DOMContentLoaded', function () {

    // Abrir modales
    document.querySelectorAll('[data-modal-target]').forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.querySelector(button.dataset.modalTarget);
            openModal(modal);
        });
    });

    // Cerrar modales
    document.querySelectorAll('.modal-close').forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal');
            closeModal(modal);
        });
    });

    function openModal(modal) {
        if (modal == null) return;
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Evitar scroll al abrir modal
    }

    function closeModal(modal) {
        if (modal == null) return;
        modal.classList.remove('active');
        document.body.style.overflow = 'auto'; // Restaurar scroll al cerrar modal
    }

});