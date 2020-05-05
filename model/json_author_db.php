<?php

function get_authors() {
    global $db;
    $query = 'SELECT * FROM authors
            ORDER BY authorID';
    $statement = $db->prepare($query);
    $statement->execute();

    while( $row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $authors[] = $row;
     }
     $statement->closeCursor();
 
     $json = json_encode($authors);
 
         echo $json;

    $statement->closeCursor();
    return $authors;
    //} else {
      //  echo json_encode("Sorry, there are zero authors in the database.");
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