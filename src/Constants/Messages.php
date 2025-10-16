<?php

namespace App\Constants;

/**
 * Messages sent to user via HTTP.
 */
class Messages
{
    // -- COMMON -- //
    public const string API_ERROR = "Error en Oracle";
    public const string UNKNOWN_ERROR = "Error desconocido";
    public const string INVALID_REQUEST = "Solicitud inválida";

    public const string MUST_SEND_BODY = "No hay cuerpo o es inválido";
    public const string MUST_SEND_PARAMS = "No hay parámetros requeridos o son inválidos";

    // -- LOGIN -- //
    public const string LOGIN_FAILED = "No se ha podido iniciar sesión.";
}
