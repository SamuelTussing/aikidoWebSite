document.addEventListener('DOMContentLoaded', function() {
    fetch('images.json')
        .then(response => response.json())
        .then(imageData => {
            function updateGallery(category) {
                const imageGrid = document.getElementById('imageGrid');
                imageGrid.innerHTML = '';
                imageData[category].forEach(imageSrc => {
                    const img = document.createElement('img');
                    img.src = imageSrc;
                    img.alt = `Image de ${category}`;
                    imageGrid.appendChild(img);
                });
            }

            document.querySelectorAll('.tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    document.querySelector('.tab.active').classList.remove('active');
                    this.classList.add('active');
                    updateGallery(this.dataset.category);
                });
            });

            // Initialiser la galerie avec la première catégorie
            updateGallery('dojo');
        })
        .catch(error => console.error('Erreur lors du chargement des données d\'image:', error));
});