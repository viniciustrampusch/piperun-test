<?php

namespace App\Constants;

class HttpResponseStatus
{
    public const OK = 200;
    public const CREATED = 201;
    public const ACCEPTED = 202;
    public const MOVED_PERMANENTLY = 301;
    public const NOT_MODIFIED = 304;
    public const TEMPORARY_REDIRECT = 307;
    public const PERMANENT_REDIRECT = 308;
    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const METHOD_NOT_ALLOWED = 405;
    public const CONFLICT = 409;
    public const GONE = 410;
    public const URI_TOO_LONG = 414;
    public const TOO_MANY_REQUESTS = 429;
    public const INTERNAL_SERVER_ERROR = 500;
    public const NOT_IMPLEMENTED = 501;
    public const BAD_GATEWAY = 502;
    public const SERVICE_UNAVAILABLE = 503;
    public const GATEWAY_TIMEOUT = 504;
}
