<?php
// Check if their is an admin account;
include 'connection.php';
$check_admin_query = "SELECT * FROM admin";
$verify_admin_exist = mysqli_query($conn, $check_admin_query);
if (mysqli_num_rows($verify_admin_exist) > 0) {
    echo "<script>alert('Admin account already exist, Kindly Sign In')</script>";
    echo "<script>window.location.href='index.php'</script>";
}

//Create Admin Account
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_first_name = $_POST['first_name'];
    $admin_last_name = $_POST['last_name'];
    $admin_email_address = $_POST['email_address'];
    $admin_phone_number = $_POST['phone_number'];
    $admin_password = $_POST['password'];
    $admin_confirm_password = $_POST['confirm_password'];

    if ($admin_password != $admin_confirm_password) {
        echo "<script>alert('Passwords do not match')</script>";
        echo "<script>window.location.href='signup.php'</script>";
    }

    $encrypted_password = md5($admin_password);

    //Write the query to submit our data to the database
    $sql_query = "INSERT INTO admin(firstname,lastname,email_address,phone_number,password,status)
               VALUES('$admin_first_name','$admin_last_name' ,'$admin_email_address', '$admin_phone_number','$encrypted_password','0')";

    // Execute the query
    $insert_submission = mysqli_query($conn, $sql_query);

    if ($insert_submission === TRUE) {
        echo "<script>alert('Admin account created successfully')</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Admin account failed to create')</script>";
        echo "<script>window.location.href='signup.php'</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- tailwindcss configuration -->
    <script src="tailwindConfig.js"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-skyblue font-montserrat">
    <div class="w-1/2 p-8 space-y-8 bg-powderblue rounded-lg shadow-lg">
        <div>
            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                Create Admin account
            </h2>
        </div>

        <form method="post" action="" class="mt-8 space-y-6 rounded-md shadow-sm -space-y-px">
            <div>
                <label for="firstname" class="sr-only">First Name</label>
                <input id="firstname" name="first_name" type="text" required
                    class="bg-powderblue rounded-none relative block w-full px-3 py-2 border border-gray-400 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-white focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="First Name" />
            </div>
            <div>
                <label for="lastname" class="sr-only">Last Name</label>
                <input id="lastname" name="last_name" type="text" required
                    class="bg-powderblue rounded-none relative block w-full px-3 py-2 border border-gray-400 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-white focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Last Name" />
            </div>

            <div>
                <label for="phone_number" class="sr-only">Phone Number</label>
                <input id="phone" name="phone_number" type="tel" required
                    class="bg-powderblue rounded-none relative block w-full px-3 py-2 border border-gray-400 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-white focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Phone Number" />
            </div>

            <div>
                <label for="email" class="sr-only">Email address</label>
                <input id="email" name="email_address" type="email" required
                    class="bg-powderblue rounded-none relative block w-full px-3 py-2 border border-gray-400 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-white focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Email address" />
            </div>


            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" required
                    class="bg-powderblue rounded-none relative block w-full px-3 py-2 border border-gray-400 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Password" />
            </div>

            <div>
                <label for="confirm_password" class="sr-only">Confirm Password</label>
                <input id="password" name="confirm_password" type="password" required
                    class="bg-powderblue rounded-none relative block w-full px-3 py-2 border border-gray-400 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Confirm Password" />
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember_me" type="checkbox"
                        class="h-4 w-4 text-gray-600 focus:ring-indigo-500 border-gray-300 rounded" />
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                        Remember me
                    </label>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-cornflowerblue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Sign Up
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="index.php" class="font-medium text-steelblue hover:text-indigo-900">Sign in</a>
            </p>
        </div>
    </div>
</body>

</html>