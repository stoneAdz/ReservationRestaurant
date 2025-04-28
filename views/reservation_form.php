<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver une table</title>
    <link rel="stylesheet" href="assets/css/reservation_form.css">
<body class="reservation-container">

    <div class="container">
        <h1>Réserver une table</h1>

        <form method="POST" action="?page=reserve">
            <label for="date">Date :</label>
            <input type="date" name="date" required><br><br>

            <label for="time">Heure :</label>
            <input type="time" name="time" required><br><br>

            <label for="guests">Nombre de personnes :</label>
            <input type="number" name="guests" min="1" required><br><br>

            <button type="submit">Confirmer la réservation</button>
        </form>

        <hr>

        <h3>🕒 Créneaux déjà réservés :</h3>
        <ul id="bookedSlots"></ul>
    </div>

    <script>
        fetch('BD/reservations.json')
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('bookedSlots');
                if (!Array.isArray(data)) return;

                 
                const grouped = {};

                data.forEach(res => {
                    const key = `${res.date} à ${res.time}`;
                    const guests = parseInt(res.guests);

                    if (!grouped[key]) {
                        grouped[key] = guests;
                    } else {
                        grouped[key] += guests;
                    }
                });

                // 🧾 Affichage
                Object.entries(grouped).forEach(([slot, total]) => {
                    const li = document.createElement('li');
                    const remaining = 24 - total;

                    li.textContent = `${slot} - ${total} personnes réservées (${remaining > 0 ? remaining + " restantes" : "COMPLET"})`;
                    if (remaining <= 0) li.classList.add('red');
                    list.appendChild(li);
                });
            });
    </script>
</body>
</html>
</head>
<body class="reservation-container">

    <div class="container">
        <h1>Réserver une table</h1>

        <form method="POST" action="?page=reserve">
            <label for="date">Date :</label>
            <input type="date" name="date" id="dateInput" required><br><br>

            <label for="time">Heure :</label>
            <select name="time" id="timeSelect" required>
                <option value="">-- Choisissez une date d'abord --</option>
            </select><br><br>

            <label for="guests">Nombre de personnes :</label>
            <input type="number" name="guests" min="1" required><br><br>

            <button type="submit">Confirmer la réservation</button>
        </form>

        <hr>

        <h3>Créneaux déjà réservés :</h3>
        <ul id="bookedSlots"></ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.getElementById('dateInput');
            const timeSelect = document.getElementById('timeSelect');

            dateInput.addEventListener('change', function () {
                const selectedDate = this.value;

                if (!selectedDate) return;

                
                timeSelect.innerHTML = '<option>Chargement...</option>';

                fetch(`index.php?page=check-availability&date=${encodeURIComponent(selectedDate)}`)
                    .then(response => response.json())
                    .then(data => {
                        timeSelect.innerHTML = '';

                        if (data.length === 0) {
                            const option = document.createElement('option');
                            option.textContent = "Aucun créneau disponible";
                            option.disabled = true;
                            timeSelect.appendChild(option);
                        } else {
                            data.forEach(time => {
                                const option = document.createElement('option');
                                option.value = time;
                                option.textContent = time;
                                timeSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des créneaux :', error);
                    });
            });

             
            fetch('BD/reservations.json')
                .then(response => response.json())
                .then(data => {
                    const list = document.getElementById('bookedSlots');
                    if (!Array.isArray(data)) return;

                    const grouped = {};
                    data.forEach(res => {
                        const key = `${res.date} à ${res.time}`;
                        grouped[key] = (grouped[key] || 0) + parseInt(res.guests);
                    });

                    Object.entries(grouped).forEach(([slot, total]) => {
                        const li = document.createElement('li');
                        const remaining = 24 - total;
                        li.textContent = `${slot} - ${total} personnes réservées (${remaining > 0 ? remaining + " restantes" : "COMPLET"})`;
                        if (remaining <= 0) li.classList.add('red');
                        list.appendChild(li);
                    });
                });
        });
    </script>
</body>
</html>
