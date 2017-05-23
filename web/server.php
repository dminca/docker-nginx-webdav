<?php
    require("vendor/autoload.php");

    /**
     * This is a simple implementation of SabreDAV.
     * @author xama (https://www.xama.us)
     * @version 1.0
     * @license MIT
     */

    use Sabre\DAV;
    use Sabre\DAV\Auth;

    $rootDirectory = new DAV\FS\Directory('public');

    /* Configure Server */
    $server = new DAV\Server($rootDirectory);
    $server->setBaseUri('/');

    /* Configure lock plugin */
    $lockBackend = new DAV\Locks\Backend\File('data/locks');
    $lockPlugin = new DAV\Locks\Plugin($lockBackend);
    $server->addPlugin($lockPlugin);

    /* Load plugins */
    $server->addPlugin(new DAV\Browser\Plugin());
    $server->addPlugin($authPlugin);

    /* Run the server */
    $server->exec();

