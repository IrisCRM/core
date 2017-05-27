<?php

use Iris\Iris;

/**
 * Generate absolute url
 * @param string $relative Relative URL
 * @return string
 */
function url($relative = null)
{
    /** @var \Symfony\Component\HttpFoundation\Request $request */
    $request = Iris::$app->getContainer()->get('http.request');

    $baseUrl = $request->getSchemeAndHttpHost() ?: Iris::$app->config('http.url');

    return $baseUrl . ($relative ? '/' : '') . $relative;
}
