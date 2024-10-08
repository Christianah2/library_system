<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_email_address = $_POST['email_address'];
    $user_phone_number = $_POST['phone_number'];
    $user_address = $_POST['address'];
    $user_date_of_birth = $_POST['date_of_birth'];

    include 'connection.php';

    //Write the query to submit our data to the database
    $sqlQuery = "INSERT INTO student(firstname,lastname,email_address,phone_number,address,date_of_birth)
                 VALUES('$user_firstname','$user_lastname' ,'$user_email_address', '$user_phone_number','$user_address','$user_date_of_birth')";
    $messageSubmission = mysqli_query($conn, $sqlQuery);
    if ($messageSubmission === TRUE) {
        echo "<script>alert('Message submitted successfully')</script>";
    } else {
        echo "<script>alert('Message failed to submit')</script>";
    }
    echo "<script>window.location.href='signup.html'</script>";
}