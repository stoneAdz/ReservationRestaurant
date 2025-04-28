<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réserver une table</title>
    <link rel="stylesheet" href="assets/css/reservation_form.css"> 
</head>
<body>

<h1>Réserver une table</h1>

<form method="POST" action="?page=reserve">
    <label for="date">Date :</label>
    <input type="date" name="date" id="date" required><br><br>

    <label for="time">Heure :</label>
    <select name="time" id="time" required>

    </select><br><br>

    <label for="guests">Nombre de personnes :</label>
    <input type="number" name="guests" min="1" required><br><br>

    <button type="submit">Confirmer la réservation</button>
</form>

<hr>

<h3> Créneaux disponibles :</h3>
<ul id="availableSlots"></ul>

<script>

function generateTimeSlots() {
    const slots = [];
    for (let hour = 18; hour <= 22; hour++) {
        slots.push(`${String(hour).padStart(2, '0')}:00`);
        slots.push(`${String(hour).padStart(2, '0')}:30`);
    }
    return slots;
}

// Charge les créneaux
function loadAvailableSlots() {
    const dateInput = document.getElementById('date');
    const timeSelect = document.getElementById('time');
    const list = document.getElementById('availableSlots');

    dateInput.addEventListener('change', () => {
        fetch('BD/reservations.json')
            .then(response => response.json())
            .then(data => {
                timeSelect.innerHTML = '';
                list.innerHTML = '';

                const selectedDate = dateInput.value;
                const allSlots = generateTimeSlots();

                const grouped = {};

                if (Array.isArray(data)) {
                    data.forEach(res => {
                        if (res.date === selectedDate) {
                            const key = res.time;
                            grouped[key] = (grouped[key] || 0) + parseInt(res.guests);
                        }
                    });
                }

                const availableSlots = allSlots.filter(time => {
                    return !grouped[time] || grouped[time] < 24;
                });

                availableSlots.forEach(time => {
                    const option = document.createElement('option');
                    option.value = time;
                    option.textContent = time;
                    timeSelect.appendChild(option);

                    const li = document.createElement('li');
                    li.textContent = `${time} (Disponible)`;
                    list.appendChild(li);
                });

                if (availableSlots.length === 0) {
                    list.innerHTML = "<li>Aucun créneau disponible pour cette date.</li>";
                }
            });
    });
}

loadAvailableSlots();
</script>

</body>
</html>
