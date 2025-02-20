<?php

class View 
{
    private string $title;
    
    
    /**
     * Constructeur. 
     */
    public function __construct($title) 
    {
        $this->title = $title;
    }
    
    public function render(string $viewPath, array $params = []) : void 
    {
        $content = $this->_renderViewFromTemplate($viewPath, $params);
        $title = $this->title;
        ob_start();
        require(MAIN_VIEW_PATH);
        echo ob_get_clean();
    }

    public function renderSecondary(string $viewPath, array $params = []) : void
    {
        extract($params); // On transforme les diverses variables stockées dans le tableau "params" en véritables variables qui pourront être lues dans le template.
        ob_start();
        require($viewPath);
        echo ob_get_clean();
    }

    private function _renderViewFromTemplate(string $viewPath, array $params = []) : string
    {  
        if (file_exists($viewPath)) {
            extract($params); // On transforme les diverses variables stockées dans le tableau "params" en véritables variables qui pourront être lues dans le template.
            ob_start();
            require($viewPath);
            return ob_get_clean();
        } else {
            throw new Exception("La vue '$viewPath' est introuvable.");
        }
    }
}



