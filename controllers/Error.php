<?php


namespace app\controllers;


use app\core\Controller;

class Error extends Controller
{
    /**
     *renders 404 view
     */
    public function notFound()
    {
        $this->render('main', '404');
    }

    /**
     * Puts errors array to $_SESSION variable under 'errors' key
     * @param array $errors - array of errors
     * @param string $redirect_path - path to redirect to after setting errors
     */
    public static function setSessionErrors (array $errors, string $redirect_path) {
        $_SESSION['errors'] = $errors;
        header("Location: " . $_ENV['APP_URL'] . $redirect_path);
        die();
    }
}