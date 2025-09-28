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
        require_once Application::$working_directory . "/app/models/$model.php";
        return new $model();
    }

    /**
     * TO:DO: change function name. A bit misleading
     * @param string $view
     * @return void
     */
    public function view(string $view): void 
    {
        echo $view;
    }

    /**
     * Summary of get_layout
     * @param string $layout
     * @return bool|string
     */
    public function get_layout(string $layout): bool|string 
    {
        ob_start();
        require_once Application::$working_directory . "/app/views/layout/$layout.php";
        return ob_get_clean();
    }

    /**
     * Summary of get_view
     * @param string $view
     * @param mixed $data
     * @return bool|string
     */
    public function get_view(string $view, $data = []) : bool|string 
    {
        ob_start();
        require_once Application::$working_directory . "/app/views/$view";
        return ob_get_clean();
    }

    /**
     * It will replace all placeholders within the layout with datum
     * @param array $data Datum to be injected
     * @param string $layout Layout to use
     * @return string 
     */
    public function set_placeholders(array $data, string $layout): string
    {

        $temporary_layout = $layout;
        foreach(array_keys($data) as $key) 
        {
            $temporary_layout = str_replace("{{{$key}}}", $data[$key], $temporary_layout);
        }
        return $temporary_layout;
    }
}