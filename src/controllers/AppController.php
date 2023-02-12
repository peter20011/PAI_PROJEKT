<?php

class AppController{
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'. $template.'.php';
        $output = 'File not found';

        if(file_exists($templatePath)){
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }

    protected function changeHeader(string $path) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/{$path}");
    }

    protected function areAllSet(array $variables) : bool {
        $array = [];
        if ($this->isPost()) {
            $array = $_POST;
        }
        if ($this->isGet()) {
            $array = $_GET;
        }
        foreach ($variables as $var) {
            if (!isset($array[$var])) return false;
        }
        return true;
    }


}