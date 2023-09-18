<?php

namespace go1\app\providers;

use Firebase\JWT\JWT;
use Silex\Api\BootableProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

// Sourced from here: https://github.com/go1com/JwtMiddleware/blob/master/JwtMiddleware.php
class JwtMiddlewareProvider implements BootableProviderInterface
{
    public function boot(Application $app)
    {
        $app->before(function (Request $req) {
            if ($auth = $req->headers->get('Authorization') ?: $req->headers->get('authorization')) {
                if (0 === strpos($auth, 'Bearer ')) {
                    $token = substr($auth, 7);
                }
            }

            $token = $req->query->get('jwt', isset($token) ? $token : null);
            $token = $token ?: $req->cookies->get('jwt');
            if ($token && (2 === substr_count($token, '.'))) {
                $chunks = explode('.', $token);
                $req->attributes->set('jwt.payload', JWT::jsonDecode(JWT::urlsafeB64Decode($chunks[1])));
                $req->attributes->set('jwt.raw', $token);
            }
        });
    }
}
