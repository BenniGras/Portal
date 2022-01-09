<?php

session_start();

require __DIR__ . "/../src/init.php";

$pathInfo = $_SERVER['PATH_INFO'];


$routes = [
    '/startseite' => [
        'controller' => 'itemController',
        'method' => 'renderIndex'
    ],
    '/merkliste' => [
        'controller' => 'itemController',
        'method' => 'renderBookmarks'
    ],
    '/artikel' => [
        'controller' => 'itemController',
        'method' => 'renderItem'
    ],
    '/anzeige_erstellen' => [
        'controller' => 'itemController',
        'method' => 'addItem'
    ],
    '/anmelden' => [
        'controller' => 'loginController',
        'method' => 'login'
    ],
    '/abmelden' => [
        'controller' => 'loginController',
        'method' => 'logout'
    ],
    '/registrieren' => [
        'controller' => 'loginController',
        'method' => 'renderRegistry'
    ],
    '/registrieren_privat' => [
        'controller' => 'loginController',
        'method' => 'addUser'
    ],
    '/registrieren_handel' => [
        'controller' => 'loginController',
        'method' => 'addDealer'
    ],
    '/mein_profil' => [
        'controller' => 'loginController',
        'method' => 'dashboard'
    ],
    '/meine_daten' => [
        'controller' => 'loginController',
        'method' => 'showUser'
    ],
    '/meine_anzeigen' => [
        'controller' => 'itemController',
        'method' => 'myItems'
    ],
    '/daten_ändern' => [
        'controller' => 'loginController',
        'method' => 'editUser'
    ],
    '/passwort_ändern' => [
        'controller' => 'loginController',
        'method' => 'changePassword'
    ],
    '/anzeige_bearbeiten' => [
        'controller' => 'itemController',
        'method' => 'editItem'
    ],
    '/anzeige_hervorheben' => [
        'controller' => 'itemController',
        'method' => 'addHighlightItem'
    ],
    '/hervorhebung_abschließen' => [
        'controller' => 'itemController',
        'method' => 'crossSelling'
    ],
    '/suche' => [
        'controller' => 'itemController',
        'method' => 'search'
    ],
    '/locked' => [
        'controller' => 'loginController',
        'method' => 'locked'
    ],
    '/highlight_dashboard' => [
        'controller' => 'itemController',
        'method' => 'highlightDashboard'
    ],
    '/change_wishlist' => [
        'controller' => 'itemController',
        'method' => 'changeWishlist'
    ],
];
if(isset($routes[$pathInfo])) {
    $route = $routes[$pathInfo];
    $controller = $container->make($route['controller']);
    $method = $route['method'];
    $controller->$method();
}
?>