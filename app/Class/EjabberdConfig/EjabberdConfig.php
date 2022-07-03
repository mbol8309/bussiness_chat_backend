<?php
namespace App\Class\EjabberdConfig;


class EjabberdConfig {
    protected $config_folder;
    public function __construct()
    {
        $this->config_folder = env('CONFIG_FOLDER', '/opt/ejabberd/configs');
    }

    public function getConfigFolder()
    {

    }

}