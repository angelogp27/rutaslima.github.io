// Función para agregar un comentario
function addComment(routeId, comment) {
    fetch("add_comment.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `ruta_id=${routeId}&comentario=${encodeURIComponent(comment)}`,
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        updateComments(routeId);
    });
}

// Función para actualizar los comentarios en la sección correspondiente
function updateComments(routeId) {
    const commentsSection = document.getElementById(`comments-section-${routeId}`);
    commentsSection.innerHTML = ""; // Limpiar la sección de comentarios

    fetch(`get_comments.php?ruta_id=${routeId}`)
    .then(response => response.json())
    .then(comments => {
        comments.forEach(comment => {
            const commentDiv = document.createElement("div");
            commentDiv.className = "comment";
            commentDiv.innerHTML = `${comment.comentario} <span class="comment-date">${comment.fecha}</span>`;
            commentsSection.appendChild(commentDiv);
        });
    });
}

// Función para establecer la calificación
function setRating(routeId, rating) {
    fetch("add_rating.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `ruta_id=${routeId}&calificacion=${rating}`,
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        updateRating(routeId);
    });
}

// Función para actualizar el puntaje de calificación
function updateRating(routeId) {
    fetch(`get_average_rating.php?ruta_id=${routeId}`)
    .then(response => response.json())
    .then(data => {
        const ratingScore = document.getElementById(`rating-score-${routeId}`);
        ratingScore.innerText = `Puntaje: ${data.promedio}`;
        ratings[routeId] = data.promedio; // Actualiza el objeto ratings
    });
}

// Función para actualizar el ranking de rutas
function updateRanking() {
    const sortedRoutes = Object.keys(ratings).sort((a, b) => ratings[b] - ratings[a]);
    const rankingList = document.getElementById("ranking-list");
    rankingList.innerHTML = "";

    sortedRoutes.forEach(routeId => {
        const routeDescription = document.querySelector(`#route${routeId} .description-box p`).innerText;
        const listItem = document.createElement("li");
        listItem.innerText = `${routeDescription}: ${ratings[routeId]} estrellas`; // Mostrar puntaje
        rankingList.appendChild(listItem);
    });
}