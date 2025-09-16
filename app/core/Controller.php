<?php 

class Controller 
{
    /**
     * Controller is the base class for all controllers
     */

    /**
     * Summary of model
     * @param string $model
     * @return object
     */
    protected function model(string $model): object 
    {
        require_once '../app/models' . $model . '.php';
        return new $model();
    }

    /**
     * Summary of view
     * @param string $view
     * @param mixed $data
     * @return void
     */
    public function view(string $view, $data = []): void 
    {
        require_once '../app/views/' . $view .'.php';
    }
}