<?php
    class Website{
        public $name;
        public $host;
        public $made;
        public $language;
        
        public $description  = 'Content Management System for data administration';
        public $keywords     = 'content management system, data, administration';
        public $creator      = '<a href="https://www.zlatanstajic.com/">Zlatan Stajic</a>';
        public $creator_name = 'Zlatan Stajic';
        public $creator_website   = 'https://www.zlatanstajic.com/';
        public $exception_message = 'No connection to database. Please inform website administrator about this error.';
        
        public $favoriteIcon = 'images/favicon.png';
        public $logo_front   = 'images/logo/zlatanstajic-front.png';
        public $logo_inside  = 'images/logo/zlatanstajic-inside.png';
        
        protected $charset = 'UTF-8';
        protected $head    = array();
        protected $bottom  = array();
        protected $link    = 'link';
        protected $script  = 'script';
        protected $link_custom   = 'link-custom';
        protected $script_custom = 'script-custom';
        
        public function __construct($name, $host, $made, $language='EN', $description='', $keywords=''){
            $this->name     = $name;
            $this->host     = $host;
            $this->made     = $made;
            $this->language = $language; 
            
            if( !empty($description) ){
                $this->description = $description;
            }
            
            if( !empty($keywords) ){
                $this->keywords = $keywords;
            }
        }
        
        public function setImages($favorite_icon='', $logo_front='', $logo_inside=''){
            $this->favoriteIcon = $favorite_icon;
            $this->logo_front   = $logo_front;
            $this->logo_inside  = $logo_inside;
        }     
        
        public function changeCreator($creator=''){
            $this->creator = $creator;
        }      
        
        public function changeCharset($charset){
            $this->charset = $charset;
        }       
        
        public function signature($alwaysMadeYear=false){
            $currentYear = date('Y');
            
            if( $currentYear === $this->made or $alwaysMadeYear ){
                $since = $currentYear;
            }else{
                $since = $this->made .'-'. $currentYear;
            }
            
        return 'Copyright &#169; '. $since .' | '. $this->creator;
        }   
        
        public function currentPage(){
            return basename($_SERVER['PHP_SELF']);
        }  
        
        public function add_to_head($path, $type=''){
            if( empty($type) ){
                $type = $this->link;
            }
            $this->head[] = array('path'=>$path, 'type'=>$type);
        }
        
        public function add_to_bottom($path, $type=''){
            if( empty($type) ){
                $type = $this->script;
            }
            $this->bottom[] = array('path'=>$path, 'type'=>$type);
        }
        
        public function head($title=''){
            $return  = '<meta http-equiv="Content-Type" content="text/html; charset='. $this->charset .'">' .PHP_EOL;
            $return .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">' .PHP_EOL;
            $return .= '<meta name="viewport" content="width=device-width, initial-scale=1">' .PHP_EOL;
            $return .= '<meta name="description" content="'. $this->name .':' . ' '. $this->description .'">' .PHP_EOL;
            $return .= '<meta name="keywords" content="'. $this->keywords .'">' .PHP_EOL;
            $return .= '<meta name="author" content="'. $this->creator_name .'">' .PHP_EOL;
            $return .= '<link rel="shortcut icon" href="'. $this->favoriteIcon .'" type="image/png">' .PHP_EOL;
            
            $return .= '<title>';
                if( empty($title) ){
                    $return .= $this->name;
                }else{
                    $return .= $title;
                }
            $return .= '</title>' .PHP_EOL;
            
            $return .= '<!-- HEAD -->' .PHP_EOL;
            if( empty($this->head) ){
                $return .= '<!-- NOT LOADED -->' .PHP_EOL;
            }else{
                foreach($this->head as $head){
                    switch($head['type']){    
                        case $this->link:    
                            {
                                $return .= '<link rel="stylesheet" href="';
                                $return .= $head['path'];
                                $return .= '">' .PHP_EOL;
                            }
                        break; 
                        case $this->script:    
                            {
                                $return .= '<script src="';
                                $return .= $head['path'];
                                $return .= '"></script>' .PHP_EOL;
                            }
                        break; 
                        case $this->link_custom:    
                            {
                                $return .= '<style>';
                                $return .= $head['path'];
                                $return .= '</style>' .PHP_EOL;
                            }
                        break; 
                        case $this->script_custom:    
                            {
                                $return .= '<script>';
                                $return .= $head['path'];
                                $return .= '</script>' .PHP_EOL;
                            }
                        break;    
                    }    
                }
            }
            $return .= '<!-- /HEAD -->' .PHP_EOL;
            
        return $return;
        }   
        
        public function bottom(){
            $return = '<!-- BOTTOM -->' .PHP_EOL;
            if( empty($this->bottom) ){
                $return .= '<!-- NOT LOADED -->' .PHP_EOL;
            }else{
                foreach($this->bottom as $bottom){
                    switch($bottom['type']){    
                        case $this->link:    
                            {
                                $return .= '<link rel="stylesheet" href="';
                                $return .= $bottom['path'];
                                $return .= '">' .PHP_EOL;
                            }
                        break; 
                        case $this->script:    
                            {
                                $return .= '<script src="';
                                $return .= $bottom['path'];
                                $return .= '"></script>' .PHP_EOL;
                            }
                        break;    
                    }   
                }
            }
            $return .= '<!-- /BOTTOM -->' .PHP_EOL;
        return $return;
        }
        
        public function redirect_to_page($page){
            header('Location: '. $page .'');
            exit();
            
            echo '    
                <!DOCTYPE HTML>
                <html lang="en-US">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="refresh" content="1; url=http://'. $this->host .'">
                        <script>
                            window.location.href = "http://'. $this->host .'";
                        </script>
                        <title>Page Redirection</title>
                    </head>
                    <body>
                        If you are not redirected automatically, follow this <a href="http://'. $this->host . $page .'">link to '. $this->name .'</a>.
                    </body>
                </html>
            ';            
        }
        
        public function hidden_signature($language){
            $hidden_signature = '<!-- ';
            switch($language){
                case 'EN':{
                    $hidden_signature .= 'Proudly built by: '. $this->creator_name .'; Find me on '. $this->creator_website;
                } break;
                default: $hidden_signature .= 'Ponosno izradio: '. $this->creator_name .'; Pronaðite me na '. $this->creator_website;
            }
            $hidden_signature .=  ' -->'. PHP_EOL;
        return $hidden_signature;
        }
    }
?>