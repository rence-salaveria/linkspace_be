<?php

namespace App\Enums;

/**
 * This enum represents HTTP status codes.
 */
enum HttpStatus: int
{
    /**
     * The request has succeeded.
     * @var int OK
     */
    case OK = 200;

    /**
     * The request has been fulfilled and has resulted in one or more new resources being created.
     * @var int CREATED
     */
    case CREATED = 201;

    /**
     * The server could not understand the request due to invalid syntax.
     * @var int BAD_REQUEST
     */
    case BAD_REQUEST = 400;

    /**
     * The request requires user authentication.
     * @var int UNAUTHORIZED
     */
    case UNAUTHORIZED = 401;

    /**
     * The server understood the request, but it refuses to authorize it.
     * @var int FORBIDDEN
     */
    case FORBIDDEN = 403;

    /**
     * The server can't find the requested resource.
     * @var int NOT_FOUND
     */
    case NOT_FOUND = 404;

    /**
     * The expectation given in the request's Expect header field could not be met.
     * @var int EXPECTATION_FAILED
     */
    case EXPECTATION_FAILED = 417;

    /**
     * The server understands the content type of the request entity, and the syntax of the request entity is correct, but it was unable to process the contained instructions.
     * @var int UNPROCESSABLE_ENTITY
     */
    case UNPROCESSABLE_ENTITY = 422;

    /**
     * The server encountered an unexpected condition that prevented it from fulfilling the request.
     * @var int INTERNAL_SERVER_ERROR
     */
    case INTERNAL_SERVER_ERROR = 500;

    /**
     * The request has been accepted for processing, but the processing has not been completed.
     * @var int ACCEPTED
     */
    case ACCEPTED = 202;

    /**
     * The server has successfully fulfilled the request and there is no additional content to send in the response payload body.
     * @var int NO_CONTENT
     */
    case NO_CONTENT = 204;

    /**
     * The server is delivering only part of the resource due to a range header sent by the client.
     * @var int PARTIAL_CONTENT
     */
    case PARTIAL_CONTENT = 206;

    /**
     * The URL of the requested resource has been changed permanently. The new URL is given in the response.
     * @var int MOVED_PERMANENTLY
     */
    case MOVED_PERMANENTLY = 301;

    /**
     * This response code means that the URI of requested resource has been changed temporarily.
     * @var int FOUND
     */
    case FOUND = 302;

    /**
     * The client's cached version of the resource is still up-to-date.
     * @var int NOT_MODIFIED
     */
    case NOT_MODIFIED = 304;

    /**
     * The server sends this response to direct the client to get the requested resource at another URI with same method that was used in the prior request.
     * @var int TEMPORARY_REDIRECT
     */
    case TEMPORARY_REDIRECT = 307;

    /**
     * This means that the resource is now permanently located at another URI.
     * @var int PERMANENT_REDIRECT
     */
    case PERMANENT_REDIRECT = 308;

    /**
     * The user has sent too many requests in a given amount of time.
     * @var int TOO_MANY_REQUESTS
     */
    case TOO_MANY_REQUESTS = 429;

    /**
     * The server is not ready to handle the request, usually because it is overloaded or down for maintenance.
     * @var int SERVICE_UNAVAILABLE
     */
    case SERVICE_UNAVAILABLE = 503;
}
