<?php


function get_submissions() {
    global $db;
    //$Sort = filter_input(INPUT_GET, 'Sort');

    //$query1 = 'SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
    //LEFT JOIN types T ON V.Type_code = T.Type_code';
    
    
        //$query1 = "SELECT * FROM quotes";
        $query1 = "SELECT sub_Quote_ID, sub_Quote_Text, sub_Author_Name, sub_Category_Name FROM quote_submissions";
    
    
    $statement = $db->prepare($query1);
    $statement->execute();
    $submissions = $statement->fetchAll();
    $statement->closeCursor();
    return $submissions;


}


function delete_submission($sub_Quote_ID) {
    global $db;
    $query = 'DELETE FROM quote_submissions
                WHERE sub_Quote_ID = :sub_Quote_ID';
    $statement = $db->prepare($query);
    $statement->bindValue(':sub_Quote_ID', $sub_Quote_ID);
    $statement->execute();
    $statement->closeCursor();
}

function add_submission($sub_Quote_Text, $sub_Category_Name, $sub_Author_Name, $sub_Quote_ID) {
    //Start off by adding the author to the authors table, then after we'll add the quote, b/c we need to give the author name an author ID
    //$sub_Quote_Text, $sub_Category_ID, $sub_Author_Name, $sub_Quote_ID
    global $db;
    $query = 'INSERT INTO authors
                (author_Name)
                VALUES
                (:sub_Author_Name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':sub_Author_Name', $sub_Author_Name);
    $statement->execute();
    $statement->closeCursor();

    $query2 = 'INSERT INTO categories
    (category_Name)
    VALUES
    (:sub_Category_Name)';
    $statement = $db->prepare($query2);
    $statement->bindValue(':sub_Category_Name', $sub_Category_Name);
    $statement->execute();
    $statement->closeCursor();
    

//$query = 'INSERT INTO quotes LEFT JOIN authors A ON S.sub_Author_Name = A.author_Name;
//           (quote_Text, categoryID, authorID)
//           VALUES
//           (:sub_Quote_Text, :sub_Category_ID, :sub_Author_Name)';


// $query = 'INSERT INTO quotes (quote_Text, categoryID, authorID)
//            SELECT S.sub_Quote_Text, S.sub_Category_ID, A.authorID
//            FROM authors A, quote_submissions S
//            WHERE A.author_Name = S.sub_Author_Name';

//$query = 'SELECT authorID INTO @authorid from authors where author_Name = ';
    $query3 = 'INSERT INTO quotes (quote_Text, categoryID, authorID)
    VALUES (:sub_Quote_Text, (SELECT categoryID FROM categories where Category_Name = :sub_Category_Name), (SELECT authorID FROM authors where author_Name = :sub_Author_Name))'; 

    $statement = $db->prepare($query3);
    $statement->bindValue(':sub_Quote_Text', $sub_Quote_Text);
    $statement->bindValue(':sub_Category_Name', $sub_Category_Name);
    $statement->bindValue(':sub_Author_Name', $sub_Author_Name);
    $statement->execute();
    $statement->closeCursor();

//Add the quote to the Famous Quote Database


       
}

function submit_quote($sub_Quote_Text, $sub_Author_Name, $sub_Category_Name) {
    global $db;
    $query = 'INSERT INTO quote_submissions
                (sub_Quote_Text, sub_Author_Name, sub_Category_Name)
                VALUES
                (:sub_Quote_Text, :sub_Author_Name, :sub_Category_Name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':sub_Quote_Text', $sub_Quote_Text);
    $statement->bindValue(':sub_Author_Name', $sub_Author_Name);
    $statement->bindValue(':sub_Category_Name', $sub_Category_Name);
    $statement->execute();
    $statement->closeCursor();
}

function submit_quote_api($quote_Text,$quote_author,$quote_category) {
    global $db;
    // get raw data from the request
    //$json = file_get_contents('php://input');
    //convert raw data into PHP Object
    //$data = json_decode($json);

   
        global $db;
    $query = 'INSERT INTO quote_submissions
                (sub_Quote_Text, sub_Author_Name, sub_Category_Name)
                VALUES
                (:quote_Text, :quote_author,:quote_category)';
    $statement = $db->prepare($query);
    $statement->bindValue(':quote_Text', $quote_Text);
    $statement->bindValue(':quote_author', $quote_author);
    $statement->bindValue(':quote_category', $quote_category);
    $statement->execute();
    $statement->closeCursor();

    return array("quote_Text"=>$quote_Text,"author_Name"=>$quote_author,"category_Name"=>$quote_category);
    
    }

    


