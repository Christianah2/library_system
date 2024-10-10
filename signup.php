<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];
    $user_email_address = $_POST['email_address'];
    $user_phone_number = $_POST['phone_number'];
    $user_password = $_POST['password'];
    include 'connection.php';

    //Write the query to submit our data to the database
    $sqlQuery = "INSERT INTO admin(firstname,lastname,email_address,phone_number,password)
               VALUES('$user_firstname','$user_lastname' ,'$user_email_address', '$user_phone_number',
               '$user_password')";
    $messageSubmission = mysqli_query($conn, $sqlQuery);
    if ($messageSubmission === TRUE) {
        echo "<script>alert('Form submitted successfully')</script>";
    } else {
        echo "<script>alert('Form failed to submit')</script>";
    }
    echo "<script>window.location.href='signup.php'</script>";
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

        <form method="post" class="mt-8 space-y-6 rounded-md shadow-sm -space-y-px">
            <div>
                <label for="firstname" class="sr-only">First Name</label>
                <input id="firstname" name="firstname" type="text" required
                    class="bg-powderblue rounded-none relative block w-full px-3 py-2 border border-gray-400 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-white focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="First Name" />
            </div>
            <div>
                <label for="lastname" class="sr-only">Last Name</label>
                <input id="lastname" name="lastname" type="text" required
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