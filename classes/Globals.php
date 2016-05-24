<?php

class Globals
{
    public $databaseServer = 'localhost';
    public $databaseUserName = 'root';
    public $databasePassword = 'root';
    public $databaseName = 'clinic';


    private static $global;

    public static function getInstance()
    {
        if (null === Globals::$global) {
            Globals::$global = new Globals();
        }

        return Globals::$global;
    }

    protected function __construct()
    {
    }

    static public $publicModule = 'default';


    static public $siteURL = '';
    static public $secureSiteURL = '';
    static public $siteDomain = '';
    static public $siteEmail = '';
    static public $homeTitle = '';
    static public $siteDescription = '';
    static public $reviewDefaultThumbnail = 'review_default.jpg';
    static public $productDefaultThumbnail = 'review_default.jpg';
    static private $folder = '/';
    static private $photos = '/dynamic';
    static private $images = '/images';
    static private $singerPhotos = '/singerPhotos';
    static private $productPhotos = '/products';
    static private $storePhotos = '/stores';
    static private $brandPhotos = '/brands';
    static private $temp = '/temp';
    static private $controllers = '/controllers';
    static private $views = '/views';
    static private $controlControllers = 'control/controllers';
    static private $controlViews = 'control/views';

    static public function HTMLImages()
    {
        return Globals::HTMLRoot() . Globals::$images;
    }

    static public function HTMLRoot()
    {
        return '';//Globals::$folder;
    }

    static public function HTMLSingerPhotos()
    {
        return Globals::HTMLPhotos() . Globals::$singerPhotos;
    }

    static public function HTMLPhotos()
    {
        return Globals::HTMLRoot() . Globals::$photos;
    }

    static public function HTMLProductPhotos()
    {
        return Globals::HTMLPhotos() . Globals::$productPhotos;
    }

    static public function HTMLBrandPhotos()
    {
        return Globals::HTMLPhotos() . Globals::$brandPhotos;
    }

    static public function HTMLStorePhotos()
    {
        return Globals::HTMLPhotos() . Globals::$storePhotos;
    }

    static public function HTMLTemp()
    {
        return Globals::HTMLPhotos() . Globals::$temp;
    }

    static public function controllers()
    {
        return Globals::PHPRoot() . Globals::$controllers;
    }

    static public function PHPRoot()
    {
        return '../' . Globals::$folder;
    }

    static public function views()
    {
        return Globals::PHPRoot() . Globals::$views;
    }

    static public function controlControllers()
    {
        return Globals::PHPRoot() . Globals::$controlControllers;
    }

    static public function controlViews()
    {
        return Globals::PHPRoot() . Globals::$controlViews;
    }

    static public function PHPImages()
    {
        return Globals::PHPRoot() . Globals::$image;
    }

    static public function PHPSingerPhotos()
    {
        return Globals::PHPPhotos() . Globals::$singerPhotos;
    }

    static public function PHPPhotos()
    {
        return Globals::PHPRoot() . Globals::$photos;
    }

    static public function PHPProductPhotos()
    {
        return Globals::PHPPhotos() . Globals::$productPhotos;
    }

    static public function PHPBrandPhotos()
    {
        return Globals::PHPPhotos() . Globals::$brandPhotos;
    }

    static public function PHPStorePhotos()
    {
        return Globals::PHPPhotos() . Globals::$storePhotos;
    }

    static public function PHPTemp()
    {
        return Globals::PHPPhotos() . Globals::$temp;
    }

    static public function activeAndLoggedIn()
    {
        return (Globals::$uid && Globals::$usergroupid != 3 && Globals::$usergroupid != 8);
    }

    static public function canHasStore()
    {
        return (in_array(17, Globals::$membergroupids));
    }

    static public function session_started()
    {
        if (isset($_SESSION['doctor']) || isset($_SESSION['patient']) || isset($_SESSION['secretary'])
            || isset($_SESSION['dependent'])
        ) return true;
        else return false;
    }

    static public function get_type()
    {
        if (isset($_SESSION['doctor'])) return 'doctor';
        else if (isset($_SESSION['patient'])) return 'patient';
        else if (isset($_SESSION['secretary'])) return 'secretary';
        else if (isset($_SESSION['dependent'])) return 'dependent';
        else return "";
    }

    static public function setModule($module)
    {
        GLOBALS::$publicModule = $module;
    }

    static public function getModule()
    {
        return Globals::$publicModule;
    }




}
