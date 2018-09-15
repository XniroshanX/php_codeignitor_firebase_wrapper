<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class cfwp {

    protected $serviceAccount;
    protected $firebase;
    protected $database;

    function __construct() {
        $this->init();
    }

    public function init() {
        echo "initiating...";
        // This assumes that you have placed the Firebase credentials in the same directory
        // as this PHP file.
        $this->serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/google-service-account.json');

        $this->firebase = (new Factory)
        ->withServiceAccount($this->serviceAccount)
        // The following line is optional if the project id in your credentials file
        // is identical to the subdomain of your Firebase project. If you need it,
        // make sure to replace the URL with the URL of your project.
        ->withDatabaseUri('https://mydatabase-87b2e.firebaseio.com')
        ->create();

        $this->database = $this->firebase->getDatabase();
    }

    public function set($path, $value) {
        $newPush = $this->database
                        ->getReference($path)
                        ->set($value);
        echo "<pre>";
        var_dump($newPush);
        echo "</pre>";
    }
}

$cfwp = new cfwp();
$cfwp->set("15/lastChatStatusUpdateTime", "niroshan");