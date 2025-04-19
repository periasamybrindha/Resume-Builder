<?php
session_start(); // Ensure session is started for notifications
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_GET) {
    $post = $_GET;

    if (isset($post['id']) && !empty($post['id'])) {
        $authid = $fn->Auth()['id'];

        try {
            // Correct DELETE query using JOIN
            $query = "DELETE resumes, skills, educations, experience 
                      FROM resumes 
                      LEFT JOIN skills ON resumes.id = skills.resume_id 
                      LEFT JOIN educations ON resumes.id = educations.resume_id 
                      LEFT JOIN experience ON resumes.id = experience.resume_id 
                      WHERE resumes.id = '{$post['id']}' AND resumes.user_id = '$authid'";

            if ($db->query($query) === TRUE) {
                $_SESSION['alert'] = "Resume deleted successfully!";
                $fn->redirect('../myresumes.php');
                exit;
            } else {
                throw new Exception("Database Error: " . $db->error);
            }
        } catch (Exception $error) {
            $_SESSION['error'] = "Error: " . $error->getMessage();
            $fn->redirect('../myresumes.php');
            exit;
        }
    } else {
        $_SESSION['error'] = "Please provide a valid resume ID.";
        $fn->redirect('../myresumes.php');
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request.";
    $fn->redirect('../myresumes.php');
    exit;
}
?>
