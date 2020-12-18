var spa = angular.module("spa", ["ngRoute"]);

spa.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl: "home.php"
    })
    .when("/inicio", {
        templateUrl: "home.php"
    })
    .when("/perfil", {
        templateUrl: "perfil.php"
    })
    .when("/horario", {
        templateUrl: "horario.php"
    })
    .when("/registros", {
        templateUrl: "registros.php"
    })
    .otherwise({redirectTo : '/'});
});