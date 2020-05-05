<?php

function get_categories() {
    global $db;
    $query = 'SELECT * FROM categories
            ORDER BY categoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
    return $categories;

}

function get_category_name($categoryID) {
    global $db;
    $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
    $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
    if ($categoryID == NULL || $categoryID == FALSE || $authorID == NULL || $authorID == FALSE  ) {
      
        $query = 'SELECT Q.quoteID, Q.quote_Text, Q.categoryID, Q.authorID, A.author_Name, C.category_Name FROM quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID 
        LEFT JOIN authors A ON Q.authorID = A.authorID ORDER BY A.author_Name DESC'; 
    }else{
        
    $query = 'SELECT * FROM categories
                WHERE categoryID = :categoryID';}
    
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryID', $categoryID);
    $statement->execute();
    $category = $statement->fetch();
    $statement->closeCursor();
    $category_Name = $category['category_Name'];
    return $category_Name;

}



function delete_category($categoryID) {
    global $db;
    $query = 'DELETE FROM categories
                 WHERE categoryID = :categoryID';
       $statement = $db->prepare($query);
       $statement->bindValue(':categoryID', $categoryID);
       $statement->execute();
       $statement->closeCursor(); 
}



function add_category($category_Name) {
    global $db;
    $query = 'INSERT INTO categories
                (category_Name)
                VALUES
                (:category_Name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_Name', $category_Name);
        $statement->execute();
        $statement->closeCursor();
}       


?>


