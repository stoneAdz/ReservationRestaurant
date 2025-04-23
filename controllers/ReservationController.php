
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
        $guests = $_POST['guests'];

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
        $data[] = $reservation;
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

        echo "<p>Réservation enregistrée avec succès !</p>";
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

}

