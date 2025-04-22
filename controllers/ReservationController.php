
<?php

class ReservationController
{
    public function home()
    {
        require_once 'views/home.php';
    }

    public function makeReservation()
    {
        require_once 'views/reservation_form.php';
    }
}

