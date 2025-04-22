<?php

class Router
{
    public function handleRequest()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        switch ($page) {
            case 'home':
                require_once 'controllers/ReservationController.php';
                $controller = new ReservationController();
                $controller->home();
                break;

            case 'reserve':
                require_once 'controllers/ReservationController.php';
                $controller = new ReservationController();
                $controller->makeReservation();
                break;

            case 'login':
                require_once 'controllers/UserController.php';
                $controller = new UserController();
                $controller->login();
                break;

            case 'register':
                require_once 'controllers/UserController.php';
                $controller = new UserController();
                $controller->register();
                break;

            default:
                echo "Page non trouvée.";
                break;
        }
    }
}

