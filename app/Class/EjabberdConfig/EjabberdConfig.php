<?php
namespace App\Class\EjabberdConfig;


class EjabberdConfig {
    protected $config_folder;
    protected $hosts_config;
    public function __construct()
    {
        $this->config_folder = env('CONFIG_FOLDER', '/opt/ejabberd/configs');
        $this->hosts_config = $this->config_folder.'/hosts.yml';
    }

    public function getConfigsFiles()
    {
        return [
            'folder' => $this->config_folder,
            'hosts' => $this->hosts_config
        ];
    }

}