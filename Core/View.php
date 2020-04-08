<?php

namespace Core;


use App\Models\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * View
 *
 * PHP version 7.0
 */
class View
{

    /**
     * Render a view file
     *
     * @param string $view The view file
     * @param array $args Associative array of data to display in the view (optional)
     *
     * @return void
     * @throws \Exception
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/App/Views/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
     * Render a view template using Twig
     *
     * @param string $template The template file
     * @param array $args Associative array of data to display in the view (optional)
     *
     * @return void
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public static function renderTemplate($template, $args = [])
    {
        $args = array_merge($args, self::getDefaultArgs());
        static $twig = null;

        if ($twig === null) {

            $loader = new FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new Environment($loader, [
                'cache' => dirname(__DIR__) . '/cache',
                'debug' => true
            ]);
        }
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        $twig->enableDebug();
        echo $twig->render($template, $args);
    }

    protected static function getDefaultArgs()
    {
        return [
            'user' => User::getLoggedUser()
        ];
    }
}
