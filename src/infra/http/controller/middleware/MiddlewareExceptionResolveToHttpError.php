<?php

declare(strict_types=1);

namespace src\infra\http\controller\middleware;

use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use src\app\model\exceptions\AlreadyUserExistsException;
use Throwable;

final class MiddlewareExceptionResolveToHttpError implements MiddlewareInterface
{
    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
    }

    public function process(Request $request, Handler $handler): Response
    {
        try {
            return $handler->handle($request);
        } catch (AlreadyUserExistsException $e) {
            $this->logger->warning('already_user_exists', [
                'data' => $e->getMessage()
            ]);
            return HttpErrorResponse::build($e->getMessage(), 409);
        } catch (ValidationException $e) {
            $this->logger->warning('bad_request',[
                'data' => $e->validator->errors()->jsonSerialize()
            ]);
            return HttpErrorResponse::build($e->validator->errors()->toJson(), 400);
        } catch (Throwable $th) {
            $this->logger->error('server_error',[
                'data' => $th->getMessage(),
                'previous' => $th->getPrevious()
            ]);
            return HttpErrorResponse::build($th->getMessage());
        }
    }
}
