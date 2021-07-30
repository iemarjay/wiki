<?php


namespace App;


use Pecee\Http\Middleware\Exceptions\TokenMismatchException;
use Pecee\SimpleRouter\Exceptions\HttpException;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

class Provider
{
    /**
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws TokenMismatchException
     */
    public static function boot(): void
    {
        $instance = new self();

        $instance->runMigration();
        $instance->loadRoutes();
    }

    /**
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws TokenMismatchException
     */
    protected function loadRoutes(): void
    {
        require_once __DIR__. '/../routes.php';

        SimpleRouter::setDefaultNamespace('\App\Http\Controllers');
        SimpleRouter::start();
    }

    protected function runMigration(): void
    {
        $db = new Donation;

        $db->migrate();
    }
}
