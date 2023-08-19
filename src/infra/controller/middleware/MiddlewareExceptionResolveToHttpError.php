<?php

declare(strict_types=1);

namespace src\infra\controller\middleware;

use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use src\model\exceptions\AlreadyUserExistsException;
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
            HttpErrorResponse::build($e->getMessage(), 409);
        } catch (Throwable $th) {
            HttpErrorResponse::build($th->getMessage());
        }
        return HttpErrorResponse::build();
    }
}
