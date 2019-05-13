<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route["iniciarSesion"] = "Login_controller/iniciarSesion";
$route["cerrarSesion"] = "Login_controller/Salir";

$route["Roles"] = "Usuarios_controller";
$route["guardarRol"] = "Usuarios_controller/guardarRol";
$route["actualizarRol"] = "Usuarios_controller/actualizarRol";
$route["modificarEstadoRol"] = "Usuarios_controller/modificarEstadoRol";

$route["Usuarios"] = "Usuarios_controller/usuarios";
$route["guardarUsuario"] = "Usuarios_controller/guardarUsuario";
$route["actualizarUsuario"] = "Usuarios_controller/actualizarUsuario";
$route["modificarEstadoUsuario"] = "Usuarios_controller/modificarEstadoUsuario";

$route["Perfil"] = "Usuarios_controller/perfil";
