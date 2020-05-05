<?php

function get_authors() {
    global $db;
    $query = 'SELECT * FROM authors
            ORDER BY authorID';
    $statement = $db->prepare($query);
    $statement->execute();
    $authors = $statement->fetchAll();
    $statement->closeCursor();
    return $authors;

}



function get_author_name($authorID){
    global $db;
    $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
    $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
    if ($categoryID == NULL || $categoryID == FALSE || $authorID == NULL || $authorID == FALSE  ) {
      
        $query = 'SELECT Q.quoteID, Q.quote_Text, A.author_Name, C.category_Name FROM Quotes Q LEFT JOIN categories C ON Q.categoryID = C.categoryID
        LEFT JOIN authors A ON Q.authorID = A.authorID ORDER BY A.author_Name DESC'; 
    }else{
        
    $query = 'SELECT * FROM authors
                WHERE authorID = :authorID';}

    $statement = $db->prepare($query);
    $statement->bindValue(':authorID', $authorID);
    $statement->execute();
    $author = $statement->fetch();
    $statement->closeCursor();
    $author_Name = $author['author_Name'];
    return $author_Name;

}



function delete_author($authorID) {
    global $db;
    $query = 'DELETE FROM authors
                 WHERE authorID = :authorID';
       $statement = $db->prepare($query);
       $statement->bindValue(':authorID', $authorID);
       $statement->execute();
       $statement->closeCursor(); 
}



function add_author($author_Name) {
    global $db;
    $query = 'INSERT INTO authors
                (author_Name)
                VALUES
                (:author_Name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':author_Name', $author_Name);
        $statement->execute();
        $statement->closeCursor();
}       


?>