<?php
class Router{

    private $title;
    private $connection;
    public $records;
    
    public function __construct($module){
        
        $this->connection = Database::getConnection();
        $this->module = $module;
        
    }
    public function render(){

        if(!Globals::session_started() ){
            $this->module = 'login';
        }

        $formSubmitted = ($_SERVER['REQUEST_METHOD'] == 'POST' || $_GET['delete']);
        if($_GET['returnTo'])
            $returnTo = urlencode($_GET['returnTo']);
        else
            $returnTo = urlencode ($_SERVER['QUERY_STRING']);

		$type = Globals::get_type();
        $module_file = $type."_modules.php";
		include $module_file;
		
        include Globals::controlControllers().'/index.php';
		
            if(!in_array($this->module, $modules)){
            $this->module = 'default';
            $isHomepage = true;
        }
        if(!$formSubmitted){
            $here = urlencode($_SERVER['QUERY_STRING']);
            $error = new Error($this->module);
            if($error->exists()){
                $errors = $error->getErrors();
                if($this->module == 'login'){
                   @array_Splice($errors, 1);
                }
                if($error->getSuccessful()) {
                    foreach ($error->getSuccessful() as $key => $val) {
                        if (is_array($val))
                            $default[$key] = $val;
                        else
                            $default[$key] = str_replace('"', '&quot;', $val);
                    }
                }
            }elseif($error->getNoError()){
                 $success = $error->getNoError();
            }
            $error->destruct();
        }
        include Globals::controlControllers().'/'.$this->module.'.php';
        $siteURL = Globals::$siteURL;
        $title = $this->title;
        $module = Globals::controlViews().'/'.$this->module.'.php';
        $num = $_GET['num'];
        if($formSubmitted){
            ?><meta http-equiv="refresh" content="0; url='index.php?<?php echo urldecode($returnTo)?>" /><?php
        }else
            include Globals::controlViews().'/index.php';
    }
}