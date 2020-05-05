<?php
    session_start();
    require('../model/database.php');
    require('../model/admin_db.php');
    require('../model/quote_db.php');
    require('../model/category_db.php');
    require('../model/author_db.php');
    require('../model/submission_db.php');
    
    
    
    //require('../admin-register.php');
    $action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_quotes';
    //if ($action == NULL) {
      //  $action = filter_input(INPUT_GET, 'action');
       // if ($action == NULL) {
           // $action = 'list_vehicles';
        //}
    //}


    if (!isset($_SESSION['is_valid_admin_login'])) {
        $action = 'login';
    }



    switch($action) {
    
    case 'register_admin_user': 
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $confirm_password = filter_input(INPUT_POST, 'confirm_password');
        //username_check($username);
        //$username_exists = False;
        $error_reg = false;
    //is username empty
    if (empty($username)  || strlen($username) <= 4)   {
        $error_username = "Please enter a valid username with at least 5 characters.";
        $error_reg = true;
    } else { empty($error_username); 
        
        
        }

    $uppercase = preg_match('@[A-Z]@', $password);
    //$lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    if (isset($password) && $uppercase && $number && strlen($password) > 5) {
        empty($error_password);
        
    }else { empty($error_password);
        $error_password = "Password must be at least: 1 uppercase, 1 number, and a minimum of 6 characters long.";
        $error_reg = true;
        }

    if ($confirm_password == $password) {
        empty($error_confirm_password);
        
       
    }else { $error_confirm_password = "The passwords you entered do not match.";
        $error_reg = true;
        }

        if ($error_reg == false) {
            username_check($username);
            if (empty(username_check($username))) {
                //$username_exists = True;
                add_admin($username,$password);
                include('thankyou_added_admin.php');
            } else { 
                $user_name_exists = "Username is taken.";
                include('../admin-register.php');
            }
        }
        if ($error_reg == True) {
            include('../admin-register.php');
            
        }

        //add_admin($username,$password);
       // if ($username_exists == False) {
        //goto admin page
        //}
        //}else { 
           
          //  include('../admin-register.php');
            //echo "Username already exists.";
        
        //echo $rowcount;
        //username_check($username); 
        //echo $row;
        break;
    


    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_admin_login($username, $password)) {
            $_SESSION['is_valid_admin_login'] = true;
            $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
        $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
        
        //$Sort = filter_input(INPUT_GET, 'Sort');
        $quotes = get_quotes_by_selection($categoryID,$authorID); 

        
        // call the functions
        $category_Name = get_category_name($categoryID);
        $categories = get_categories();

        $authors = get_authors();
        $author_Name = get_author_name($authorID);

        
            include('quote_list.php');
        } else {
            $login_message = 'You must login to view this page.';
            
            include('../admin-login.php');
        }
    break;

    
    case 'register_user':
        
        include('../admin-register.php');
    break;

    case 'admin_logout':
        $_SESSION = array();
        session_destroy();
        $login_message = 'You have been logged out.';
        include('../admin-login.php');
    break;

        
    case 'list_quotes':
        $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
        $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
       
        //$Sort = filter_input(INPUT_GET, 'Sort');

        
        // call the functions
        $category_Name = get_category_name($categoryID);
        $categories = get_categories();

        $authors = get_authors();
        $author_Name = get_author_name($authorID);

        
        
        
        
        //$Vehicles = get_vehicles_by_class($Class_code);
        
        //if ( $Class_code != 0 && $Type_code != 0 && $Make != 0) {
            //$Vehicles = get_vehicles_by_class($Class_code);
            //$Vehicles = get_all_vehicles(get_vehicles_by_class($Class_code,get_vehicles_by_type($Type_code,get_vehicles_by_make($Make))));
        //}

        $quotes = get_quotes_by_selection($categoryID,$authorID); 
        //Refined_Vehicle_Results = get_all_vehicles(get_vehicles_by_class(get_vehicles_by_type(get_vehicles_by_make())));
        //$Vehicles = get_all_vehicles(get_vehicles_by_class($Class_code,get_vehicles_by_type($Type_code,get_vehicles_by_make($Make))));
        
        include('quote_list.php');
    break;
    
    case 'list_categories':
        $categories = get_categories();
        include('category_list.php');
    break;

    case 'delete_quote':
        $quoteID = filter_input(INPUT_POST, 'quoteID', FILTER_VALIDATE_INT);
        if (empty($quoteID) ) {
            $error = "Missing or incorrect Quote id.";
            include('../errors/error.php');
        } else {
            delete_quote($quoteID);
            header("Location: .");
        }
    break;

    case 'delete_category':
        $categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
        if (empty($categoryID)) {
            $error = "Missing or incorrect category ID.";
            include('../errors/error.php');
        } else {
            delete_category($categoryID);
            header("Location: .?action=show_view_edit_categories_form");
        }
    break;

    case 'show_add_form':
        $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
        $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
        
        
        $categories = get_categories();
        //$Class_name = get_vehicle_class_name($Class_code);
        $authors = get_authors();
        //$Type_name = get_vehicle_type_name($Type_code);
       
        // call the functions
        include('add_quote.php');
    break;

    case 'add_quote':
        
        $quote_Text = filter_input(INPUT_POST, 'quote_Text');
        $authorID = filter_input(INPUT_POST, 'authorID', FILTER_VALIDATE_INT);
        $categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
        
        //$_SESSION['quote_text'] = $quote_Text;
        //if ($Vehicle_year == NULL || $Vehicle_year == FALSE || $Make == NULL || $Make == FALSE || $Model == NULL || $Model == FALSE || $Price == NULL || $Price == FALSE || $Type_code == NULL || $Type_code == FALSE || $Class_code == NULL || $Class_code == FALSE) 
        //{
          //  $error = "Invalid vehicle data. Check all fields and try again.";
            //include('errors/error.php');
        //} else {
            add_quote($quote_Text, $categoryID, $authorID);
            header("Location: .?authorID=$authorID");
            
        //}
    break;

    case 'add_category':
            
        $category_Name = filter_input(INPUT_POST, 'category_Name');
        add_category($category_Name);
        header("Location: .?action=show_view_edit_categories_form");
    break;

    case 'show_view_edit_categories_form':
        $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
        $categories = get_categories();

        include('category_list.php'); 
    break;

    case 'add_author':
        $author_Name = filter_input(INPUT_POST, 'author_Name');
        add_author($author_Name);
        header("Location: .?action=show_view_edit_authors_form");

    break;

    case 'delete_author':
        $authorID = filter_input(INPUT_POST, 'authorID', FILTER_VALIDATE_INT);
        if (empty($authorID)) {
            $error = "Missing or incorrect Author ID.";
            include('../errors/error.php');
        } else {
            delete_author($authorID);
            header("Location: .?action=show_view_edit_authors_form");
        }
    break;

    case 'show_view_edit_authors_form':
        $authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
        $authors = get_authors();

        include('author_list.php'); 
    break;

    case 'view_submissions':
        //$categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
        //$authorID = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
       
        $submissions =  get_submissions(); 
        
        //$categories = get_categories();
        //$category_Name = get_category_name($categoryID);
        //$Class_name = get_vehicle_class_name($Class_code);
        //$authors = get_authors();
        //$Type_name = get_vehicle_type_name($Type_code);
       
        // call the functions


        include('view_submissions.php');
    break;

    case 'delete_submission':
        $sub_Quote_ID = filter_input(INPUT_POST, 'sub_Quote_ID', FILTER_VALIDATE_INT);
        if (empty($sub_Quote_ID) ) {
            $error = "Missing or incorrect Submission Quote id.";
            include('../errors/error.php');
        } else {
            delete_submission($sub_Quote_ID);
            header("Location: .?action=view_submissions");
            //include('')
        }
    break;

    case 'approve_quote':
        $sub_Quote_ID = filter_input(INPUT_POST, 'sub_Quote_ID', FILTER_VALIDATE_INT);
       
        $sub_Quote_Text = filter_input(INPUT_POST, 'sub_Quote_Text');
        $sub_Author_Name = filter_input(INPUT_POST, 'sub_Author_Name');
        $sub_Category_Name = filter_input(INPUT_POST, 'sub_Category_Name');
        //$sub_Category_ID = filter_input(INPUT_POST, 'sub_Category_ID', FILTER_VALIDATE_INT);
        
    
    //$_SESSION['quote_text'] = $quote_Text;
    //if ($Vehicle_year == NULL || $Vehicle_year == FALSE || $Make == NULL || $Make == FALSE || $Model == NULL || $Model == FALSE || $Price == NULL || $Price == FALSE || $Type_code == NULL || $Type_code == FALSE || $Class_code == NULL || $Class_code == FALSE) 
    //{
      //  $error = "Invalid vehicle data. Check all fields and try again.";
        //include('errors/error.php');
    //} else {
        add_submission($sub_Quote_Text, $sub_Category_Name, $sub_Author_Name, $sub_Quote_ID);
        delete_submission($sub_Quote_ID);
        header("Location: .?action=view_submissions");
    break;
    
    case 'manage_users':
        $users = get_users();

        include('manage_users.php');
    break;

    case 'remove_user':
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
        remove_user($user_id);

        $users = get_users();
        include('manage_users.php');
    break;
}



?> 

   