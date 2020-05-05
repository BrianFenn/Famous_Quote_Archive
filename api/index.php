<?php 

require('../model/database.php');
require('../model/admin_db.php');
require('../model/json_quote_db.php');
//require('../model/category_db.php');
require('../model/json_category_db.php');
//require('../model/author_db.php');
require('../model/json_author_db.php');
require('../model/submission_db.php');


 
$request_method=$_SERVER["REQUEST_METHOD"];

//echo "Hello World"; //json_encode($request_method);

//$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1 ));


switch($request_method)
{
    case 'GET':
        //$errorArray = array();
        $categoryId = filter_input(INPUT_GET, 'categoryId');
        $authorId = filter_input(INPUT_GET, 'authorId');
        $quoteId = filter_input(INPUT_GET, 'quoteId', FILTER_VALIDATE_INT);   
        $quote_Text = filter_input(INPUT_GET, 'quote_Text'); 
        $limit = filter_input(INPUT_GET, 'limit');
        header('Content-Type: application/json'); 
        if ($authorId == 'all' && $categoryId == 'all') {
            get_authors();
            get_categories();
           
        }
        else if($authorId == 'all' ){
            get_authors();
           
        } else if ( $categoryId == 'all' ){
            get_categories();
           
        }

        else if (!empty($quoteId)) {
        
        //Retrieve Quotes
        //$data = get_quote($quoteID);
        
        //$data = array("Quote ID"=>$quoteID, "Category ID"=>$categoryID, "Author ID"=>$authorID,// "Quote Text"=>$quote_Text ,
                        //"Author Name"=>"author_Name", "Category Name"=>"category_Name"
          //          );
                   // $data = array("Quote ID"=>quoteID, "Category ID"=>categoryID, "Author ID"=>authorID,// "Quote Text"=>$quote_Text ,
                        //"Author Name"=>"author_Name", "Category Name"=>"category_Name"
                    //);
         get_quote_api($quoteId);
         

        }
       else if(!empty($categoryId && $authorId)) {
           // $data = array(get_quotes_by_selection($categoryID, $authorID)); 
            //echo json_encode($data);
          //  if (!empty($limit)){
            //    $data = get_quotes_by_selection($categoryId, $authorId);;
              //     echo array_slice($data, 0, $limit);
                //} else {
                    get_quotes_by_selection($categoryId, $authorId);
                   
            

        } else if ((!empty($categoryId)) && (empty($authorId))) {
         
                
               // if (!empty($limit)) {
                //$data = get_quotes_by_category($categoryId);
                  // echo array_slice($data, 0, $limit);
                //} else {
                      get_quotes_by_category($categoryId);
                      
                //}
        } else if (!empty($authorId) && empty($categoryId)) {
           
            //echo json_encode ("CategoryID is not set/ author ID is set");
           
           // if (!empty($limit)){
             //   $data = get_quotes_by_author($authorId);
              //     echo array_slice($data, 0, $limit);
               // } else {
                    get_quotes_by_author($authorId);
                    //var_dump(http_response_code());
                    
                //}
        } else
        
        {
            get_all_quotes();
                   
            //$data = get_all_quotes();
            //echo json_encode($data);
            //get_quotes_by_selection();
        }
        if (!empty($errorArray)){ echo json_encode($errorArray); 
            http_response_code(404);}
    break;

    case 'POST':
        //$quoteID = filter_input(INPUT_POST, 'quoteID', FILTER_VALIDATE_INT);   
        //$sub_Quote_Text = filter_input(INPUT_POST, 'sub_Quote_Text');
        //$categoryId = filter_input(INPUT_POST, 'CategoryID', FILTER_VALIDATE_INT);
        //$sub_Author_Name = filter_input(INPUT_POST, 'sub_Author_Name');
        if (!isset($_SERVER["CONTENT_TYPE"])) {
            $data = array("message"=>"Required: Content-Type header");
            header('Content-Type: application/json');
            echo json_encode($data);
        }
        // get raw data from the request
        $json = file_get_contents('php://input');
        //convert raw data into PHP Object
        $data = json_decode($json);
        if (property_exists($data, 'quote_Text')){
            $quote_Text = $data->quote_Text;
        } else {
            array_push($errorArray, array("message"=>"The key: quote_Text is missing.")); 
        }
        if (property_exists($data, 'author_Name')) {
            $quote_author = $data->author_Name;
        } else {
            array_push($errorArray, array("message"=>"The key: author_Name is missing.")); 
        }
        if (property_exists($data, 'category_Name')) {
            $quote_category = $data->category_Name;
        } else {
            array_push($errorArray, array("message"=>"The key: category_Name is missing.")); 
        }
    
        if (!empty($errorArray)) {
            if (empty($quote_Text)) {
                array_push($errorArray, array("message"=>"The quote text is empty or invalid.")); 
            }
        } else if (empty($quote_author)) {
            array_push($errorArray, array("message"=>"The author value is empty or invalid.")); 
        } else if (empty($quote_category)) {
            array_push($errorArray, array("message"=>"The category value is empty or invalid.")); 
        } else {
        //echo $data;
        //$quote_Text = $_REQUEST["quote_Text"];
        //$quote_author = $_REQUEST["author_Name"];
        //$quote_category = $_REQUEST["category_Name"];

        
        $response = submit_quote_api($quote_Text,$quote_author,$quote_category);
        }

        if (!empty($errorArray)){
            echo json_encode($errorArray); 
            
            http_response_code(404);
            
            
        }
            else {
                http_response_code(200);
               echo json_encode($response);
            
            }
}
        /*

        if (null !== (header('Content-Type: application/json'))) {
            //do this if content type is json
            $json_submission = json_decode($sub_Quote_Test, $categoryId, $sub_author_Name);
            if (empty($sub_Quote_Text)){
                //msg error on Quote Text Missing (or invalid)
                array_push($errorArray, array("message"=>"The quote text is empty or invalid.")); 
            }    
            if (empty($categoryId)) {
                array_push($errorArray, array("message"=>"The category ID is empty or invalid.")); 
            }
            if (empty($sub_Author_Name)){
                array_push($errorArray, array("message"=>"The author name is empty or invalid.")); 
            }

            if (!empty($errorArray)) {
            //echo "OK"response code (200)
            http_response_code(200);
        } else {
            http_response_code(404);
            echo json_encode($errorArray); 
        }
    }
       submit_quote($sub_Quote_Text, $categoryId, $sub_Author_Name); 
       
       $data = array("Message"=> "Your quote has been submitted."); 
       echo json_encode($data);
    break;
    }
        /*

        if(!empty($_GET["quoteID"])) {
            $quoteID=intval($_GET["quoteID"]);
           $quotebyID =  get_quote($quoteID);
            array($quotebyID);
           $json_quotebyID = json_encode($quotebyID);
           echo $json_quotebyID;
        } 
        else 
        {
            $all_quotes = get_all_quotes();
            array($all_quotes);
             $json_all_quotes = json_encode($all_quotes);
             echo $json_all_quotes;
        }
        break;
    

    default:
        //Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;

        case 'POST':
            //Retrieve Quotes
            if(!empty($_GET["quoteID"])) {
                $quoteID=intval($_GET["quoteID"]);
               $quotebyID =  get_quotes($quoteID);
               echo json_encode($quotebyID);
            } 
            else 
            {
                $all_quotes = get_quotes();
                 echo json_encode($all_quotes);
            }
            break;

    
   */
  

?>
