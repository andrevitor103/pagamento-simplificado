<?php

declare(strict_types=1);

namespace src\infra\http\controller\middleware;

use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use src\app\model\exceptions\AlreadyUserExistsException;
use Throwable;

final class MiddlewareExceptionResolveToHttpError implements MiddlewareInterface
{
    public function process(Request $request, Handler $handler): Response
    {
        try {
            return $handler->handle($request);
        } catch (AlreadyUserExistsException $e) {
            return HttpErrorResponse::build($e->getMessage(), 409);
        } catch (ValidationException $e) {
            return HttpErrorResponse::build($e->validator->errors()->__toString(), 400);
        } catch (Throwable $th) {
            return HttpErrorResponse::build($th->getMessage());
        }
    }
}
