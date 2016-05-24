<?php

class FrontRouter {

    private $title ;
    private $tree = array();
    private $module;
    private $subModule;
    private $language;
    private $connection;
    private $newVersion = false;
    
    public function __construct($module, $subModule){
        //
        
        $this->connection = Database::getConnection();

        $this->module = $module;
        $this->subModule = $subModule;  
    }
    public function render(){
    
        $isHomepage = false;
            $siteURL = Globals::$siteURL;
            $siteName = Globals::$siteName;
            $siteDescription = Globals::$siteDescription;
            $home = 'الرئيسية';

        $siteEmail = Globals::$siteEmail;

    	$returnTo = $_GET['returnTo'];
        
        $modules = array(
        	'hotel',
            'about',
            'login',
            'register',
            'verify',
            'confirm',
            'forgot',
            'forgotVerify',
            'forgotConfirm',
            'forgotReset',
            'user',
            'settings'
        );
        if(!in_array($this->module, $modules)){
            $this->module = 'default';
            $isHomepage = true;
        }
        
        $formSubmitted = ($_SERVER['REQUEST_METHOD'] == 'POST' && !$noSubmit);
        $this->tree[] = array('url' => $siteURL, 'name' => $home);
        if(class_exists('Memcache')){
            $memcache = new Memcache;
            //if($_SESSION['admin'])
            //    echo get_class($memcache);
            $memcacheIsConnected = $memcache->connect('localhost', 11211);
        }
        if($_SESSION['admin'] && is_file(Globals::controllers().'/index_debug.php')){
            echo 'controller debug mode';
            include Globals::controllers().'/index_debug.php';
        }else{
            include Globals::controllers().'/index.php';
        }
        
        if($_SESSION['admin'] && is_file(Globals::controllers().'/'.$this->module.'_debug.php')){
            echo 'controller debug mode';
            include Globals::controllers().'/'.$this->module.'_debug.php';
        }else{
            include Globals::controllers().'/'.$this->module.'.php';
        }
        if(Database::getConnection())
            Database::close();
        if($language == 'en'){
            if($pageDoesNotExist){
                $this->title = 'Page not found';
                $this->tree[] = array('url' => '', 'name' => $this->title);
            }
        }else if($pageDoesNotExist){  if($pageDoesNotExist){
                $this->title = 'صفحة غير موجودة';
                $this->tree[] = array('url' => '', 'name' => $this->title);
            }
        }
		if(!$formSubmitted){
            $here = urlencode($_SERVER['QUERY_STRING']);
            $error = new Error($this->module);
            if($error->exists()){
                $errors = $error->getErrors();
                //  Show only one vague error to 
                //  NOT help hackers guess the right email or password
                if($this->module == 'login'){
                   @array_Splice($errors, 1);
                }
                if($error->getSuccessful()){
                    foreach($error->getSuccessful() as $key => $val){
                        $default[$key] = str_replace('"', '&quot;', $val);
                    }
                }
            }else if($error->getNoError()){
                $success = $error->getNoError();
            }
            $error->destruct();
        }
        $title = $this->title;
        $tree = $this->tree;
        //$keywords = implode(', ', $defaultKeywords);
        /*if($this->module != 'default')
            $keywords .= ', '.$title;
        if(strpos($title, ' ') !== false)
            $keywords .= ', '.str_replace(' ', ', ', $title);
        */
        if($_SESSION['admin'] && is_file(Globals::views().'/'.$this->language.'/'.$this->module.'_debug.php')){
            echo 'view debug mode';
            $module = Globals::views().'/'.$this->module.'_debug.php';
        }else{
            $module = Globals::views().'/'.$this->module.'.php';
        }
        if($formSubmitted){
            /* ?><script type="text/javascript">
		location.href = "<?php echo $returnTo?>";
</script>
<noscript>إذا لم يحولك المتصح تلقائياّ <a href="<?php echo $returnTo?>">إضغط هنا</a></noscript><?php
             */
            ?><meta http-equiv="refresh" content="0; url='<?php echo $returnTo?>" /><?php
        }else{
            if($_SESSION['admin'] && is_file(Globals::views().'/'.$this->language.'/index_debug.php')){
                echo 'view debug mode';
                include Globals::views().'/index_debug.php';
            }else{
                include Globals::views().'/index.php';
            }
        }
    }
}