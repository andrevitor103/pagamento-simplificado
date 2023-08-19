<?php
namespace src\infra\http\controller;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

final class ControllerTest 
{
    public function execute(Request $request, Response $response, array $args): Response {
        $response
            ->getBody()
            ->write('Óla mundo do PHPs');
        return $response
                    ->withStatus(200);
    }

}
