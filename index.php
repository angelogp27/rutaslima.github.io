<?php
$conn = new mysqli("localhost", "root", "", "mi_sitio_web");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener todos los comentarios
$comentarios = [];
$result = $conn->query("SELECT * FROM comentarios ORDER BY fecha DESC");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $comentarios[] = $row; // Guardar cada comentario en el array
    }
}

// Consulta para obtener el promedio de calificación de cada ruta
$promedios = [];
$result = $conn->query("SELECT ruta_id, AVG(calificacion) as promedio FROM calificaciones GROUP BY ruta_id");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $promedios[$row['ruta_id']] = round($row['promedio'], 1); // Guardar el promedio en el array
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUTAS</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>RUTAS</h1>
        <!-- Barra de navegación -->
        <nav>
            <button onclick="showSection('routes-section')">Rutas</button>
            <button onclick="showSection('ranking-section')">Ranking</button>
        </nav>
    </header>
    
    <main>
        <section id="routes-section">
            <div class="route" id="route1">
                <img src="./img/3301.jpg" alt="Ruta 1" class="bus-image">
                <div class="description-box">
                    <p>RUTA 3301</p>
                </div>
                <div class="rating-section" data-route="1">
                    <?php
                    $promedio = round($promedios[1] ?? 0);
                    for ($i = 1; $i <= 5; $i++) {
                        $selected = $i <= $promedio ? "selected" : "";
                        echo "<span class='rating-stars $selected' onclick='setRating(1, $i)'>★</span>";
                    }
                    ?>
                </div>
                <p class="rating-score" id="rating-score-1">Puntaje: <?php echo $promedios[1] ?? 0; ?></p>
                <textarea class="comment-box" placeholder="Añade un comentario..." id="comment-input-1"></textarea>
                <button onclick="addComment(1, document.getElementById('comment-input-1').value)">Enviar</button>
                <div id="comments-section-1" class="comments-section"></div>
                <?php foreach ($comentarios as $comentario) : ?>
                    <?php if ($comentario['ruta_id'] == 1) : ?>
                        <div class="comment">
                            <?php echo htmlspecialchars($comentario['comentario']); ?>
                            <span class="comment-date"><?php echo $comentario['fecha']; ?></span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Repite para las rutas 2, 3, 4 y así sucesivamente... -->
            <div class="route" id="route2">
                <img src="./img/1802.jpeg" alt="Ruta 2" class="bus-image">
                <div class="description-box">
                    <p>RUTA 1802</p>
                </div>
                <div class="rating-section" data-route="2">
                    <?php
                    $promedio = round($promedios[2] ?? 0);
                    for ($i = 1; $i <= 5; $i++) {
                        $selected = $i <= $promedio ? "selected" : "";
                        echo "<span class='rating-stars $selected' onclick='setRating(2, $i)'>★</span>";
                    }
                    ?>
                </div>
                <p class="rating-score" id="rating-score-2">Puntaje: <?php echo $promedios[2] ?? 0; ?></p>
                <textarea class="comment-box" placeholder="Añade un comentario..." id="comment-input-2"></textarea>
                <button onclick="addComment(2, document.getElementById('comment-input-2').value)">Enviar</button>
                <div id="comments-section-2" class="comments-section"></div>
                <?php foreach ($comentarios as $comentario) : ?>
                    <?php if ($comentario['ruta_id'] == 2) : ?>
                        <div class="comment">
                            <?php echo htmlspecialchars($comentario['comentario']); ?>
                            <span class="comment-date"><?php echo $comentario['fecha']; ?></span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="route" id="route3">
                <img src="./img/3405.jpg" alt="Ruta 3" class="bus-image">
                <div class="description-box">
                    <p>RUTA 3405</p>
                </div>
                <div class="rating-section" data-route="3">
                    <?php
                    $promedio = round($promedios[3] ?? 0);
                    for ($i = 1; $i <= 5; $i++) {
                        $selected = $i <= $promedio ? "selected" : "";
                        echo "<span class='rating-stars $selected' onclick='setRating(3, $i)'>★</span>";
                    }
                    ?>
                </div>
                <p class="rating-score" id="rating-score-3">Puntaje: <?php echo $promedios[3] ?? 0; ?></p>
                <textarea class="comment-box" placeholder="Añade un comentario..." id="comment-input-3"></textarea>
                <button onclick="addComment(3, document.getElementById('comment-input-3').value)">Enviar</button>
                <div id="comments-section-3" class="comments-section"></div>
                <?php foreach ($comentarios as $comentario) : ?>
                    <?php if ($comentario['ruta_id'] == 3) : ?>
                        <div class="comment">
                            <?php echo htmlspecialchars($comentario['comentario']); ?>
                            <span class="comment-date"><?php echo $comentario['fecha']; ?></span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="route" id="route4">
                <img src="./img/4902.jpg" alt="Ruta 4" class="bus-image">
                <div class="description-box">
                    <p>RUTA 4902</p>
                </div>
                <div class="rating-section" data-route="4">
                    <?php
                    $promedio = round($promedios[4] ?? 0);
                    for ($i = 1; $i <= 5; $i++) {
                        $selected = $i <= $promedio ? "selected" : "";
                        echo "<span class='rating-stars $selected' onclick='setRating(4, $i)'>★</span>";
                    }
                    ?>
                </div>
                <p class="rating-score" id="rating-score-4">Puntaje: <?php echo $promedios[4] ?? 0; ?></p>
                <textarea class="comment-box" placeholder="Añade un comentario..." id="comment-input-4"></textarea>
                <button onclick="addComment(4, document.getElementById('comment-input-4').value)">Enviar</button>
                <div id="comments-section-4" class="comments-section"></div>
                <?php foreach ($comentarios as $comentario) : ?>
                    <?php if ($comentario['ruta_id'] == 4) : ?>
                        <div class="comment">
                            <?php echo htmlspecialchars($comentario['comentario']); ?>
                            <span class="comment-date"><?php echo $comentario['fecha']; ?></span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="ranking-section" style="display: none;">
            <h2>Ranking de Rutas</h2>
            <ol id="ranking-list"></ol>
        </section>

    </main>

    <script>
        const ratings = {
            1: <?php echo round($promedios[1] ?? 0); ?>,
            2: <?php echo round($promedios[2] ?? 0); ?>,
            3: <?php echo round($promedios[3] ?? 0); ?>,
            4: <?php echo round($promedios[4] ?? 0); ?>
        };

        function showSection(sectionId) {
            const sections = document.querySelectorAll("main > section");
            sections.forEach(section => {
                section.style.display = section.id === sectionId ? "block" : "none";
            });

            if (sectionId === 'ranking-section') {
                updateRanking();
            }
        }

        function setRating(routeId, rating) {
            fetch("guardar_calificacion.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `ruta_id=${routeId}&calificacion=${rating}`,
            })
            .then(response => response.text())
            .then(data => {
                ratings[routeId] = rating; // Actualizar la calificación en el objeto
                updateRatingDisplay(routeId);
            });
        }

        function updateRatingDisplay(routeId) {
            const scoreElement = document.getElementById(`rating-score-${routeId}`);
            scoreElement.innerText = `Puntaje: ${ratings[routeId]}`;
            const stars = document.querySelectorAll(`.rating-section[data-route='${routeId}'] .rating-stars`);

            stars.forEach((star, index) => {
                star.classList.toggle('selected', index < ratings[routeId]);
            });
        }

        function addComment(routeId, comment) {
            if (comment.trim() === "") {
                alert("Por favor, escribe un comentario.");
                return;
            }

            fetch("guardar_comentario.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `ruta_id=${routeId}&comentario=${encodeURIComponent(comment)}`,
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                updateComments(routeId); // Actualiza la sección de comentarios después de guardar
            });
        }

        function updateComments(routeId) {
            fetch(`obtener_comentarios.php?ruta_id=${routeId}`)
                .then(response => response.json())
                .then(comments => {
                    const commentsSection = document.getElementById(`comments-section-${routeId}`);
                    commentsSection.innerHTML = ""; // Limpiar comentarios anteriores

                    comments.forEach(comment => {
                        const commentDiv = document.createElement("div");
                        commentDiv.classList.add("comment");
                        commentDiv.innerHTML = `${comment.comentario} <span class="comment-date">${comment.fecha}</span>`;
                        commentsSection.appendChild(commentDiv);
                    });
                });
        }

        function updateRanking() {
            const sortedRoutes = Object.keys(ratings).sort((a, b) => ratings[b] - ratings[a]);
            const rankingList = document.getElementById("ranking-list");
            rankingList.innerHTML = "";

            sortedRoutes.forEach(routeId => {
                const routeDescription = document.querySelector(`#route${routeId} .description-box p`).innerText; // Obtiene el texto "RUTA X"
                const listItem = document.createElement("li");
                listItem.innerText = `${routeDescription}: ${ratings[routeId]} estrellas`; // Mostrar puntaje
                rankingList.appendChild(listItem);
        });
    }
    </script>
</body>
</html>