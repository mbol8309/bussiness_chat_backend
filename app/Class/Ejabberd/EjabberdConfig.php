<?php

namespace App\Class\Ejabberd;

use App\Models\Domain;
use Exception;
use Illuminate\Support\Facades\Log;

class EjabberdConfig
{
    protected $config_folder;
    protected $hosts_config;
    public function __construct()
    {
        $this->config_folder = env('CONFIG_FOLDER', '/opt/ejabberd/configs');
        $this->hosts_config = $this->config_folder . '/hosts.yml';
    }

    public function getConfigsFiles()
    {
        return [
            'folder' => $this->config_folder,
            'hosts' => $this->hosts_config
        ];
    }

    public function generateHostConfigFile()
    {
        try {
            $hosts = Domain::all();
            $urls = $hosts->pluck('url')->toArray();
            $config = fopen($this->hosts_config, 'w');
            fwrite($config, "hosts:\n   - localhost\n");
            $urls_string = array_reduce($urls, function ($carry, $item) {
                return $carry . "   - " . $item."\n";
            }, '');
            fwrite($config, $urls_string);
            fclose($config);
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            fclose($config);
            return false;
        }
    }
}
