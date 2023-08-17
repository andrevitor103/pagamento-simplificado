<?php

namespace src\controller\validation;

use Illuminate\Validation\ValidationException;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

final class UserCreateRequestValidation implements MiddlewareInterface
{
    public function process(Request $request, Handler $handler): Response
    {
        $rules = [
            'firstName' => 'required',
            'lastName'  => 'required',
            'document'  => 'required',
            'email'     => 'required',
            'password'  => 'required',
            'type'      => 'required'
        ];
        $loader = new FileLoader(new Filesystem(), 'lang'); 
        $translator = new Translator($loader, 'en');
        $validatorFactory = new Factory($translator, new Container());
        $validate = $validatorFactory->make($request->getParsedBody(), $rules);
        if ($validate->fails()) {
            throw new ValidationException($validate, null, $validate->errors());
        }
        return $handler->handle($request);
    }
}
