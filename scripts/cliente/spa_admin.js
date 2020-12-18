var admin = angular.module("admin", ["ngRoute"]);

admin.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl: "admin/admin_home.php"
    })
    .when("/admin", {
        templateUrl: "admin/admin_home.php"
    })
    .when("/trabajadores", {
        templateUrl: "admin/admin_trabajadores.php"
    })
        .when("/agregar_trabajador", {
            templateUrl: "agregar/agregar_trabajador.php"
        })
    .when("/areas", {
        templateUrl: "admin/admin_areas.php"
    })
    .when("/horarios", {
        templateUrl: "admin/admin_horarios.php"
    })
        .when("/agregar_horario", {
            templateUrl: "agregar/agregar_horario.php"
        })
    .when("/registros", {
        templateUrl: "admin/admin_registros.php"
    })
    .otherwise({redirectTo : '/'});
});