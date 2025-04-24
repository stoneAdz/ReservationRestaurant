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
                
                case 'mes-reservations':
    require_once 'controllers/ReservationController.php';
    $controller = new ReservationController();
    $controller->myReservations();
    break;

		case 'cancel-reservation':
    require_once 'controllers/ReservationController.php';
    $controller = new ReservationController();
    $controller->cancelReservation();
    break;
               case 'edit-reservation':
    require_once 'controllers/ReservationController.php';
    $controller = new ReservationController();
    $controller->editReservation();
    break;
    case 'all-reservations':
    require_once 'controllers/ReservationController.php';
    $controller = new ReservationController();
    $controller->allReservations();
    break;


            case 'logout':
                session_destroy();
                header('Location: index.php?page=home');
                exit;
                break;

            default:
                echo "Page non trouvée.";
                break;
        }
    }
}

