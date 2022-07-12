<?
class ErrorController
{
    
    public function actionMistake()
    {
 
        //header('HTTP/1.1 404 Not Found');
        require_once(ROOT . '/views/site/error.php');
        return true;
        
 
    }
 
}