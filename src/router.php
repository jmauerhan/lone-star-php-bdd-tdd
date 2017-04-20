<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request AS SilexRequest;
use Symfony\Component\HttpFoundation\Response AS SilexResponse;

$app               = new Silex\Application();
$app['debug']      = true;
$app['debug.mode'] = 'dev';

$app->post('chirp', function () use ($app) {
    //Validate JSON
    //Tranform JSON into DVO
    //Save Chirp to to DB
    //Generate response
    return $app->json([], 201);
});

$app->get('timeline', function () use ($app) {
    return $app->json([], 200);
});