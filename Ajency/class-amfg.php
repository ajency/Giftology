<?php

class Ajency_MFG {

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function load() {
        //Initialize the fund module
        include 'funds/class-amfg-funds.php';
        new Ajency_MFG_Funds($this->plugin_name,$this->version);
    }
}