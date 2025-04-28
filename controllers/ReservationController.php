
<?php

class ReservationController
{
    public function home()
    {
        require_once 'views/home.php';
    }
public function makeReservation()
{
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $date = $_POST['date'];
        $time = $_POST['time'];
        $guests = (int)$_POST['guests'];

        $reservation = [
            'user' => $_SESSION['user']['email'],
            'name' => $_SESSION['user']['name'],
            'date' => $date,
            'time' => $time,
            'guests' => $guests
        ];

        $file = 'BD/reservations.json';

        if (!file_exists($file)) {
            file_put_contents($file, json_encode([], JSON_PRETTY_PRINT));
        }

        $data = json_decode(file_get_contents($file), true);

        $totalGuests = 0;
        foreach ($data as $existing) {
            if ($existing['date'] === $date && $existing['time'] === $time) {
                $totalGuests += (int)$existing['guests'];
            }
        }

        if ($totalGuests + $guests > 24) {
            echo "<p style='color:red;'> Ce créneau est complet (maximum 24 personnes).</p>";
            echo "<p><a href='?page=reserve'>Retour au formulaire</a></p>";
            return;
        }

        $data[] = $reservation;
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

        echo "<p> Réservation enregistrée avec succès !</p>";
        echo "<p style='color: green;'>✉️ Un e-mail de confirmation a été envoyé à <strong>{$_SESSION['user']['email']}</strong></p>";

        echo "<pre style='background:#f8f8f8; padding:10px; border:1px solid #ccc;'>
📅 Confirmation de réservation
Bonjour {$_SESSION['user']['name']},

Votre réservation du {$date} à {$time} pour {$guests} personne(s) a bien été enregistrée.

Merci de votre confiance !
        </pre>";

        echo "<p><a href='?page=home'>Retour à l'accueil</a></p>";
    } else {
        require_once 'views/reservation_form.php';
    }
}



public function myReservations()
{
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $file = 'BD/reservations.json';
    $reservations = [];

    if (file_exists($file)) {
        $all = json_decode(file_get_contents($file), true);
        foreach ($all as $res) {
            if ($res['user'] === $_SESSION['user']['email']) {
                $reservations[] = $res;
            }
        }
    }

    // On envoie les données à la vue
    require 'views/my_reservations.php';
}
public function cancelReservation()
{
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $file = 'BD/reservations.json';
    $id = isset($_GET['id']) ? (int)$_GET['id'] : -1;

    if (file_exists($file) && $id >= 0) {
        $data = json_decode(file_get_contents($file), true);
        $data = array_values(array_filter($data, function ($r, $i) use ($id) {
            return $i !== $id;
        }, ARRAY_FILTER_USE_BOTH));

        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }

    header('Location: index.php?page=mes-reservations');
    exit;
}
public function editReservation()
{
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $file = 'BD/reservations.json';
    $id = isset($_GET['id']) ? (int)$_GET['id'] : -1;

    if (!file_exists($file) || $id < 0) {
        header('Location: index.php?page=mes-reservations');
        exit;
    }

    $data = json_decode(file_get_contents($file), true);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mise à jour
        $data[$id]['date'] = $_POST['date'];
        $data[$id]['time'] = $_POST['time'];
        $data[$id]['guests'] = $_POST['guests'];

        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
        header('Location: index.php?page=mes-reservations');
        exit;
    } else {
        // Affichage du formulaire avec données existantes
        $res = $data[$id];
        require 'views/edit_reservation.php';
    }
}

public function allReservations()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['email'] !== 'admin@resto.com') {
        echo "<p> Accès refusé. Cette page est réservée à l'administrateur.</p>";
        return;
    }

    $file = 'BD/reservations.json';
    $reservations = [];

    if (file_exists($file)) {
        $reservations = json_decode(file_get_contents($file), true);
    }

    require 'views/all_reservations.php';
}

}

