<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/**********************************************************************************/
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
$route["actualizarPassword"] = "Usuarios_controller/actualizarPassword";
$route["actualizarDatPerfil"] = "Usuarios_controller/actualizarDatPerfil";
/*************************************************************************************/
$route["Areas"] = "Areas_controller";
$route["guardarAreas"] = "Areas_controller/guardarAreas";
$route["actualizarAreas"] = "Areas_controller/actualizarAreas";
$route["Baja_AltaAreas"] = "Areas_controller/Baja_Alta";
/*************************************************************************************/
$route["Simbologia"] = "Siglas_controller";
$route["guardarSimbologia"] = "Siglas_controller/guardarSimbologia";
$route["actualizarSimbologia"] = "Siglas_controller/actualizarSimbologia";
$route["Baja_Alta"] = "Siglas_controller/Baja_Alta";
/*************************************************************************************/
$route["CategoriasAut"] = "Autorizaciones_controller";
$route["guardarAutCategoria"] = "Autorizaciones_controller/guardarAutCategoria";
$route["actualizarAutCategoria"] = "Autorizaciones_controller/actualizarAutCategoria";
$route["baja"] = "Autorizaciones_controller/baja";

$route["Permisos"] = "Autorizaciones_controller/indexCrear";
$route["guardarPermisos"] = "Autorizaciones_controller/guardarPermisos";
$route["actualizarPermisos"] = "Autorizaciones_controller/actualizarPermisos";
$route["bajaPermisos"] = "Autorizaciones_controller/bajaPermisos";


$route["Asignar_Permiso"] = "Autorizaciones_controller/indexAsignar";
$route["asignarPermiso"] = "Autorizaciones_controller/asignarPermiso";
$route["getAuthAsig/(:any)"] = "Autorizaciones_controller/getAuthAsig/$1";
/*************************************************************************************/
$route["CatReportes"] = "CategoriaReporte_controller";
$route["guardarCatRep"] = "CategoriaReporte_controller/guardarCatRep";
$route["actualizarCatRep"] = "CategoriaReporte_controller/actualizarCatRep";
$route["Baja_AltaCatRep"] = "CategoriaReporte_controller/Baja_AltaCatRep";
/*************************************************************************************/
$route["Informes"] = "Informes_controller";
$route["reporte_2"] = "Informes/racymp_controller";

$route["reporte_6"] = "Informes/CNS_controller";
$route["nuevoCNS"] = "Informes/CNS_controller/nuevoCNS";
$route["guardarCNS"] = "Informes/CNS_controller/guardarCNS";
$route["mostrarCNSDetalle/(:any)"] = "Informes/CNS_controller/mostrarCNSDetalle/$1";
$route["editarCNS/(:any)"] = "Informes/CNS_controller/editarCNS/$1";
$route["actualizarCNS"] = "Informes/CNS_controller/actualizarCNS";
$route["BajaAltaCNS"] = "Informes/CNS_controller/BajaAltaCNS";

$route["reporte_8"] = "Informes/Veced_controller";
$route["nuevoVECED"] = "Informes/Veced_controller/nuevoVECED";
$route["getProductosSAP"] = "Informes/Veced_controller/getProductosSAP";
$route["guardarVeced"] = "Informes/Veced_controller/guardarVeced";
$route["mostrarVecedAjax/(:any)"] = "Informes/Veced_controller/mostrarVecedAjax/$1";
$route["BajaAltaVeced"] = "Informes/Veced_controller/BajaAltaVeced";
$route["editarVeced/(:any)"] = "Informes/Veced_controller/editarVeced/$1";
$route["actualizarVeced"] = "Informes/Veced_controller/actualizarVeced";

$route["reporte_9"] = "Informes/Pccn3_controller";
$route["nuevoPCCN3"] = "Informes/Pccn3_controller/nuevoPCCN3";
/*$route["getProductosSAP"] = "Informes/Veced_controller/getProductosSAP";*/
$route["guardarPccn3"] = "Informes/Pccn3_controller/guardarPccn3";
/*$route["mostrarVecedAjax/(:any)"] = "Informes/Veced_controller/mostrarVecedAjax/$1";
$route["BajaAltaVeced"] = "Informes/Veced_controller/BajaAltaVeced";
$route["editarVeced/(:any)"] = "Informes/Veced_controller/editarVeced/$1";
$route["actualizarVeced"] = "Informes/Veced_controller/actualizarVeced";*/
/*************************************************************************************/
