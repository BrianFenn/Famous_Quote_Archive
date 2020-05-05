<?php
    session_start();
    require('model/database.php');
    require('model/category_db.php');
    require('model/author_db.php');
    require('model/quote_db.php');
    require('model/submission_db.php');
   
   

    $action = filter_input(INPUT_GET, 'action');
    //$firstname = filter_input(INPUT_GET,'firstname');
    
    //$lifetime = 60 * 60 * 24; 
    //session_set_cookie_params($lifetime, '/');
    //session_name('login');
    
    //session_write_close();
    
    //if (isset($_SESSION['firstname'] )) {
      //  $sessionfirstname = $_SESSION['firstname'];
     //};
    


    
        $removecookie = function () {
            $sessionfirstname = $_SESSION['firstname'];
        //$_SESSION = array();
        //unset($_SESSION['firstname']);
        //session_destroy();
        //session_commit();
        //$_SESSION = array();
        //$name = session_name();
        //$expire = strtotime('-1 year');
        //$params = session_get_cookie_params();
        //$path = $params['/'];
        //$domain = $params['domain'];
        //$secure = $params['secure'];
        //$httponly = $params['httponly'];
        
        //setcookie($name, '', time() -3600, $path);
        };
/*
    if ($action == 'signout') {
        $firstname = filter_input(INPUT_GET, 'firstname');
        //$firstname = $_SESSION['firstname'];
        unset($_SESSION['login']);
        session_destroy();
                //, $path, $domain, $secure, $httponly);
        //session_regenerate_id();
        if (session_status() == PHP_SESSION_ACTIVE){ session_destroy();}
        
        $_SESSION = [];
        session_start();
        $_SESSION = array();
        session_unset();
        session_destroy();
        session_write_close();
        setcookie(session_name('login'), '', 0, '/');
        //session_regenerate_id(true);
        //include('signout.php');
        
    }
*/

    $action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_quotes';
    //if ($action == NULL) {
      //  $action = filter_input(INPUT_GET, 'action');
       // if ($action == NULL) {
            //$action = 'list_vehicles';
        //}
    //}

       
    switch ($action) {
    
        default: // 'list_quotes' 
        
        $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
        $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
        $quotes = get_quotes_by_selection($categoryID,$authorID); 
        

        

        
        // call the functions
        $category_Name = get_category_name($categoryID);
        $categories = get_categories();

        $authors = get_authors();
        $author_Name = get_author_name($authorID);

        //$all_quotes = get_all_quotes();
        $all_quotes = get_quotes_by_selection($categoryID, $authorID); 
        include('quotes_list.php'); 
        break;
        
        
        case 'register_customer': 
            $firstname = filter_input(INPUT_GET, 'firstname');
            $_SESSION['firstname'] = $firstname;
            $sessionfirstname = $_SESSION['firstname'];
            //session_start();
            include('thankyou.php');

        break;

        case 'submit_new_quote':

        $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
        $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
        
        
        
        $categories = get_categories();

        
        //$Class_name = get_vehicle_class_name($Class_code);
        $authors = get_authors();
        include('quote_submission.php');
        break;

        case 'add_submission':
            //$categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
            //$categories = get_categories();
            //$authors = get_authors();
            
            
            //$quotes = get_quotes_by_selection($categoryID,$authorID); 
            //$category_Name = get_category_name($categoryID);
            //$author_Name = get_author_name($authorID);
        

            $sub_Quote_Text = filter_input(INPUT_POST, 'sub_Quote_Text');
            $sub_Author_Name = filter_input(INPUT_POST, 'sub_Author_Name');
            $sub_Category_Name = filter_input(INPUT_POST, 'sub_Category_Name');
           

           
            submit_quote($sub_Quote_Text, $sub_Author_Name, $sub_Category_Name);
        
       

        //$all_quotes = get_all_quotes();
        //$all_quotes = get_quotes_by_selection($categoryID, $authorID); 
            include('thankyou_submission.php');
    }
      

?> 
