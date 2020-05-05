<?php


function get_all_quotes() {
    global $db;
    //$Sort = filter_input(INPUT_GET, 'Sort');

    //$query1 = 'SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
    //LEFT JOIN types T ON V.Type_code = T.Type_code';
    
    
        //$query1 = "SELECT * FROM quotes";
        $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
        LEFT JOIN authors A ON Q.authorID = A.authorID";
    
    
    $statement = $db->prepare($query1);
    $statement->execute();
    $all_quotes = $statement->fetchAll();
    $statement->closeCursor();
    return $all_quotes;

function get_quotes_by_category($categoryID) {
    $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
    $Sort = filter_input(INPUT_GET, 'Sort');
    global $db;
    if ($categoryID == NULL || $categoryID == FALSE) {
              
                $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
                LEFT JOIN authors A ON Q.authorID = A.authorID ORDER BY A.author_Name DESC";     
        
    $statement = $db->prepare($query1);
    $statement->bindValue(":categoryID", $categoryID);
    $statement->execute();
    $all_quotes_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_quotes_list;

} else {
    global $db;
    //$query = 'SELECT * FROM vehicles
    //WHERE vehicles.Class_code = :Class_code
    //ORDER BY Price DESC';
      
    $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes q LEFT JOIN categories C ON Q.category_ID = C.categoryID 
    LEFT JOIN authors A ON Q.author_ID = A.authorID WHERE Q.quoteID = :quoteID ORDER BY A.author_Name DESC";    
    } 
    }
    $statement = $db->prepare($query1);
    $statement->bindValue(":categoryID", $categoryID);
    $statement->execute();
    $all_quotes_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_quotes_list;
}


function get_quote($quoteID) {
    global $db;
    $query = 'SELECT * FROM quotes
                WHERE quoteID = :quoteID';
    $statement = $db->prepare($query);
    $statement->bindValue(":quoteID", $quoteID);
    $statement->execute();
    $quote = $statement->fetch();
    $statement->closeCursor();
    return $quote;
}

function delete_quote($quoteID) {
    global $db;
    $query = 'DELETE FROM quotes
                WHERE quoteID = :quoteID';
                $statement = $db->prepare($query);
    $statement->bindValue(':quoteID', $quoteID);
    $statement->execute();
    $statement->closeCursor();
}

function add_quote($quote_Text, $categoryID, $authorID) {
    global $db;
    $query = 'INSERT INTO quotes
                (quote_Text, categoryID, authorID)
                VALUES
                (:quote_Text, :categoryID, :authorID)';
    $statement = $db->prepare($query);
    $statement->bindValue(':quote_Text', $quote_Text);
    $statement->bindValue(':categoryID', $categoryID);
    $statement->bindValue(':authorID', $authorID);
    $statement->execute();
    $statement->closeCursor();
}

function get_quotes_by_author($authorID) {
    global $db;
    $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
    $Sort = filter_input(INPUT_GET, 'Sort');
    if ($authorID == NULL || $authorID == FALSE) {
        
        
            $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
    LEFT JOIN authors A ON Q.authorID = A.authorID ORDER BY A.author_Name DESC";      
    
      
    $statement = $db->prepare($query1);
    $statement->bindValue(":authorID", $authorID);
    $statement->execute();
    $all_quotes_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_quotes_list;
} else {
    global $db;
          
        $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
        LEFT JOIN authors A ON Q.authorID = A.authorID WHERE Q.authorID = :authorID ORDER BY A.author_Name DESC";         


    $statement = $db->prepare($query1);
    $statement->bindValue(":authorID", $authorID);
    $statement->execute();
    $all_quotes_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_quotes_list;
}
}

    $categoryID = filter_input(INPUT_GET, 'categoryID');
    $authorID = filter_input(INPUT_GET, 'authorID');
    
    //$Sort = filter_input(INPUT_GET, 'Sort');

if (($categoryID != 0 || $categoryID != FALSE) && ($authorID != 0 || $authorID != FALSE) ) {

function get_quotes_by_selection($categoryID, $authorID) {
    global $db;
    $categoryID = filter_input(INPUT_GET, 'categoryID');
    $authorID = filter_input(INPUT_GET, 'authorID');
    
    //$Sort = filter_input(INPUT_GET, 'Sort');
    
    $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
    LEFT JOIN authors A ON Q.authorID = A.authorID WHERE Q.categoryID = ? AND Q.authorID = ? ORDER BY A.author_Name DESC";   
    
    $statement = $db->prepare($query1);
    $statement->bindValue(1, $categoryID, PDO::PARAM_INT);
    $statement->bindValue(2, $authorID, PDO::PARAM_INT );
    $statement->execute();
    $all_quotes_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_quotes_list;    

    

}  }  else if (($categoryID != 0 || $categoryID != FALSE) && ($authorID == 0 || $authorID == FALSE) ) {
    function get_quotes_by_selection($categoryID) {
        global $db;
        $categoryID = filter_input(INPUT_GET, 'categoryID');
        //$authorID = filter_input(INPUT_GET, 'authorID');
        
        //$Sort = filter_input(INPUT_GET, 'Sort');
        
        $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
        LEFT JOIN authors A ON Q.authorID = A.authorID WHERE Q.categoryID = ? ORDER BY A.author_Name DESC";
        
   
    
        $statement = $db->prepare($query1);
        $statement->bindValue(1, $categoryID, PDO::PARAM_INT);
        $statement->execute();
        $all_quotes_list = $statement->fetchAll();
        $statement->closeCursor();
        return $all_quotes_list;

       

} }else if (($categoryID == 0 || $categoryID == FALSE) && ($authorID != 0 || $authorID != FALSE) ) {
    function get_quotes_by_selection($authorID) {
        global $db;
        
        $authorID = filter_input(INPUT_GET, 'authorID');
        
        //$Sort = filter_input(INPUT_GET, 'Sort');
        
        $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
        LEFT JOIN authors A ON Q.authorID = A.authorID WHERE Q.authorID = ? ORDER BY A.author_Name DESC";   
        
    
    
        $statement = $db->prepare($query1);
        $statement->bindValue(1, $authorID, PDO::PARAM_INT);
        $statement->execute();
        $all_quotes_list = $statement->fetchAll();
        $statement->closeCursor();
        return $all_quotes_list;
        
        

} } else if (($categoryID == 0 || $categoryID == FALSE) && ($authorID == 0 || $authorID == FALSE) ) { 

    
        function get_quotes_by_selection() {
            global $db;
            
            //$authorID = filter_input(INPUT_GET, 'authorID');
            
            //$Sort = filter_input(INPUT_GET, 'Sort');
            
            $query1 = "SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
            LEFT JOIN authors A ON Q.authorID = A.authorID ORDER BY A.author_Name DESC";   
            
        
        
            $statement = $db->prepare($query1);
            $statement->execute();
            $all_quotes_list = $statement->fetchAll();
            $statement->closeCursor();
            return $all_quotes_list;
        
}
}

function get_quote_api($quoteID) {
    global $db;
    //$conn = mysqli_connect("localhost", "root", "Kholmes1#", "famous_quotes_site");
    $query = 'SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
    LEFT JOIN authors A ON Q.authorID = A.authorID WHERE quoteID = :quoteID ORDER BY A.author_Name DESC';   
    
    $statement = $db->prepare($query);
    $statement->bindValue(":quoteID", $quoteID);
    $statement->execute();
    $quote = $statement->fetch();
  
    $statement->closeCursor();
    return $quote;
  
   
    }




