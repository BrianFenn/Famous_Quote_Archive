<?php

$errorArray = array();

function get_all_quotes() {
        global $db;
        $random = filter_input(INPUT_GET, 'random');
        //$authorID = filter_input(INPUT_GET, 'authorID');
        $limit = filter_input(INPUT_GET, 'limit');
        //$Sort = filter_input(INPUT_GET, 'Sort');
        
        $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
        LEFT JOIN authors A ON Q.authorID = A.authorID ORDER BY A.author_Name DESC";   
            
        $statement = $db->prepare($query1);
        $statement->execute();
        //$all_quotes_list = $statement->fetchAll();
        //$statement->closeCursor();
        //return $all_quotes_list;
       // while (
             $all_quotes_list = $statement->fetchALL(PDO::FETCH_ASSOC); //) {
         //   $all_quotes_list[] = $row;
         //}
         $statement->closeCursor();
        
         if (!empty($limit)){
            error_reporting(0);
            //echo json_encode($limit);
            $limitset = array_slice($all_quotes_list, 0, $limit);
            //echo implode(', ', $limitset);
            //$limitset = array($all_quotes_list);
            //echo serialize($limitset);
            //var_dump(json_encode($limitset));
            //print $limitset;
            echo json_encode($limitset);
        } else if  ($random == 'true')  {
            //$new_array = array($all_quotes_list);
            //echo json_encode(gettype($all_quotes_list));
            //$random_quote = array_rand($all_quotes_list, 1);\
            $random_quote = array_rand($all_quotes_list);
            $random_index = $all_quotes_list[$random_quote];
            echo json_encode($random_index);
            //$random_selector = $all_quotes_list[$random_quote[0]];
            //$random = shuffle($all_quotes_list);
            //echo json_encode($random[0]);
               // $json = json_encode($all_quotes_list);
               // echo $json;
            } else {
                $json = json_encode($all_quotes_list);
                echo $json;
            }
     
        }

function get_quote($quoteID) {
    global $db;
    $query = 'SELECT * FROM quotes
                WHERE quoteID = :quoteID';
    $statement = $db->prepare($query);
    $statement->bindValue(":quoteID", $quoteId);
    $statement->execute();
    $quote = $statement->fetch();
    $statement->closeCursor();
    return $quote;
}

function delete_quote($quoteId) {
    global $db;
    $query = 'DELETE FROM quotes
                WHERE quoteID = :quoteID';
                $statement = $db->prepare($query);
    $statement->bindValue(':quoteID', $quoteId);
    $statement->execute();
    $statement->closeCursor();
}

function add_quote($quote_Text, $categoryId, $authorId) {
    global $db;
    $query = 'INSERT INTO quotes
                (quote_Text, categoryID, authorID)
                VALUES
                (:quote_Text, :categoryID, :authorID)';
    $statement = $db->prepare($query);
    $statement->bindValue(':quote_Text', $quote_Text);
    $statement->bindValue(':categoryID', $categoryId);
    $statement->bindValue(':authorID', $authorId);
    $statement->execute();
    $statement->closeCursor();
}

function get_quotes_by_category($categoryId) {
    
    global $db;
    global $errorArray;

    $categoryId = filter_input(INPUT_GET, 'categoryId');
    $limit = filter_input(INPUT_GET, 'limit');

    $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
    LEFT JOIN authors A ON Q.authorID = A.authorID WHERE Q.categoryID = :categoryId ORDER BY A.author_Name DESC";
       
    $statement = $db->prepare($query1);
    $statement->bindValue(":categoryId", $categoryId);
    $statement->execute();
    $row = $statement->fetchALL(PDO::FETCH_ASSOC);
        //$all_quotes_list[] = $row;
        $all_quotes_list = $row;
     
     $statement->closeCursor();

     if (empty($all_quotes_list)) {
            array_push($errorArray, array("message"=>"The requested category ID does not exist."));
            //echo json_encode("Our database does not contain any quotes with that category ID!");
        } else { 
            if (!empty($limit)){
                error_reporting(0);
               
                $limitset = array_slice($all_quotes_list, 0, $limit);
                echo json_encode($limitset);
            } else { 
                $json = json_encode($all_quotes_list);
                echo $json;
            } 
        }
}

function get_quotes_by_author($authorId) {
    $authorId = filter_input(INPUT_GET, 'authorId', FILTER_VALIDATE_INT);
    $limit = filter_input(INPUT_GET, 'limit');
        global $db;
        global $errorArray;

        $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
        LEFT JOIN authors A ON Q.authorID = A.authorID Where Q.authorID = :authorId ORDER BY A.author_Name DESC";      
                  
        $statement = $db->prepare($query1);
        $statement->bindValue(':authorId', $authorId);
        $statement->execute();
     
        $row = $statement->fetchALL(PDO::FETCH_ASSOC);
            //$all_quotes_list[] = $row;
        $all_quotes_list = $row;
         $statement->closeCursor();
    
         if (empty($all_quotes_list)) {
            array_push($errorArray, array("message"=>"The requested author ID does not exist."));
                //echo json_encode("Our database does not contain any quotes with that author ID!");
            } else {  
                if (!empty($limit)){
                    error_reporting(0);
                   
                    $limitset = array_slice($all_quotes_list, 0, $limit);
                    echo json_encode($limitset);
                } else { 
                    $json = json_encode($all_quotes_list);
                    echo $json;
                } 
            }
                 
            
}


   
function get_quotes_by_selection($categoryId, $authorId) {
    global $db;
    global $errorArray;
    $categoryId = filter_input(INPUT_GET, 'categoryId');
    $authorId = filter_input(INPUT_GET, 'authorId');
    $limit = filter_input(INPUT_GET, 'limit');
   
    
    $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
    LEFT JOIN authors A ON Q.authorID = A.authorID WHERE Q.categoryID = ? AND Q.authorID = ? ORDER BY A.author_Name DESC";   
    
    $statement = $db->prepare($query1);
    $statement->bindValue(1, $categoryId, PDO::PARAM_INT);
    $statement->bindValue(2, $authorId, PDO::PARAM_INT );
    $statement->execute();

     $row = $statement->fetchALL(PDO::FETCH_ASSOC);
        //$all_quotes_list[] = $row;
     $all_quotes_list = $row;
     $statement->closeCursor();
    
    
     //find out if the user defined category exists
     $search_category = "SELECT * FROM categories WHERE categoryID = :categoryId";
     $statement = $db->prepare($search_category);
     $statement->bindValue(':categoryId', $categoryId);
     $statement->execute();
     $category_search = $statement->fetchAll();
    $statement->closeCursor();
    if (empty($category_search)) {
        array_push($errorArray, array("message"=>"The requested category ID does not exist.")); }
    
    //find out if the user defined author exists
    $search_author = "SELECT * FROM authors WHERE authorID = :authorId";
     $statement = $db->prepare($search_author);
     $statement->bindValue(':authorId', $authorId);
     $statement->execute();
     $author_search = $statement->fetchAll();
    $statement->closeCursor();
    if (empty($author_search)) {
        array_push($errorArray, array("message"=>"The requested author ID does not exist.")); }
    
    //push the array to user
 
    if (!empty($limit)){
        error_reporting(0);
       
        $limitset = array_slice($all_quotes_list, 0, $limit);
        echo json_encode($limitset);
    } else if (!empty($all_quotes_list)) {
        
        $json = json_encode($all_quotes_list);
        echo $json;
    } else {
        array_push($errorArray, array("message"=>"The requested Search Criteria yielded 0 results."));
    }
}
        
        
     
    
function get_quote_api($quoteId) {
    global $db;
    global $errorArray;
    $limit = filter_input(INPUT_GET, 'limit');
    //$conn = mysqli_connect("localhost", "root", "Kholmes1#", "famous_quotes_site");
    $query = 'SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
    LEFT JOIN authors A ON Q.authorID = A.authorID WHERE quoteID = :quoteID ORDER BY A.author_Name DESC';   
    
    $statement = $db->prepare($query);
    $statement->bindValue(":quoteID", $quoteId);
    $statement->execute();
   
   if ( false !== ($row = $statement->fetch(PDO::FETCH_ASSOC))) {

    //$quotes[] = $row;
    $quotes = $row;
    $statement->closeCursor();

    if (!empty($limit)){
        error_reporting(0);
       
        $limitset = array_slice($quotes, 0, $limit);
        echo json_encode($limitset);
    } else { 
        $json = json_encode($quotes);
        echo $json;
    } 
} else {
          
            array_push($errorArray, array("message"=>"The requested quote ID does not exist.")); 
            
    }
}



