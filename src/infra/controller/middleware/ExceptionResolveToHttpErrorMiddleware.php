<?php

declare(strict_types=1);

namespace src\infra\controller\middleware;

use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response as ResponseImplementation;
use src\model\exceptions\AlreadyUserExistsException;
use Throwable;

final class ExceptionResolveToHttpErrorMiddleware implements MiddlewareInterface
{
    public function process(Request $request, Handler $handler): Response
    {
        $response = new ResponseImplementation();
        try {
            return $handler->handle($request);
        } catch (AlreadyUserExistsException $e) {
            $response
                ->getBody()
                ->write($e->getMessage());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(409);
        } catch (ValidationException $validationException) {
            $response
                ->getBody()
                ->write($validationException->validator->errors()->__toString());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(422);
        } catch (Throwable $th) {
            $response
                ->getBody()
                ->write($th->getMessage());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500);
        }
    }
}
