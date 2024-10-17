<?php
include 'connection.php';
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $email_address = $_POST[ 'email_address' ];
    $password = md5( $_POST[ 'password' ] );

    $sql_query = "SELECT * FROM admin WHERE email_address = '$email_address' AND password = '$password'";
    $verify_query = mysqli_query( $conn, $sql_query );
    if ( mysqli_num_rows( $verify_query ) > 0 ) {
        $admin_data = mysqli_fetch_assoc( $verify_query );
        $admin_status = $admin_data['status'];
        if ( $admin_status != '0'){
          echo "<script>alert('Your account is currently deactivated, please contact the support')</script>";
          echo "<script>window.location.href='index.php'</script>";
          exit();
        }
        else{
          // Create session variables
           session_start();
           $_SESSION = array('admin_id' => $admin_data[ 'id' ], 
                            'admin_firstname' => $admin_data[ 'firstname' ],
                            'admin_lastname' => $admin_data[ 'lastname' ],
                            'admin_email_address' => $admin_data[ 'email_address' ]);
          header( 'Location: dashboard.php' );
        }
    } else {
        echo "<script>alert('Invalid email or password')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>Sign In</title>
    <link rel='preconnect' href='https://fonts.googleapis.com' />
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
    <link href='https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap'
        rel='stylesheet'>
    <!-- Tailwind CSS CDN -->
    <script src='https://cdn.tailwindcss.com'></script>
    <!-- tailwindcss configuration -->
    <script src='tailwindConfig.js'></script>
</head>

<body class='flex items-center justify-center min-h-screen bg-skyblue font-montserrat'>
    <div class='w-full max-w-md p-8 space-y-8 bg-powderblue rounded-lg shadow-lg'>
        <div>
            <h2 class='text-center text-3xl font-extrabold text-gray-900'>
                Sign in to your account
            </h2>
        </div>

        <form method='post' action='' class='mt-8 space-y-6 rounded-md shadow-sm -space-y-px'>
            <div>
                <label for='email' class='sr-only'>Email address</label>
                <input id='email' name='email_address' type='email' required
                    class='bg-powderblue rounded-none relative block w-full px-3 py-2 border border-gray-400 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-white focus:border-indigo-500 focus:z-10 sm:text-sm'
                    placeholder='Email address' />
            </div>

            <div>
                <label for='password' class='sr-only'>Password</label>
                <input id='password' name='password' type='password' required
                    class='bg-powderblue rounded-none relative block w-full px-3 py-2 border border-gray-400 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm'
                    placeholder='Password' />
            </div>

            <div class='flex items-center justify-between'>
                <div class='flex items-center'>
                    <input id='remember_me' name='remember_me' type='checkbox'
                        class='h-4 w-4 text-gray-600 focus:ring-indigo-500 border-gray-300 rounded' />
                    <label for='remember_me' class='ml-2 block text-sm text-gray-900'>
                        Remember me
                    </label>
                </div>

                <div class='text-sm'>
                    <a href='#' class='font-medium text-steelblue hover:text-indigo-900'>Forgot your password?</a>
                </div>
            </div>

            <div>
                <button type='submit'
                    class='group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-cornflowerblue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'>
                    Sign In
                </button>
            </div>
        </form>

        <div class='text-center'>
            <p class='text-sm text-gray-600'>
                Don't have an account?
                <a href='signup.php' class='font-medium text-steelblue hover:text-indigo-900'>Sign up</a>
            </p>
        </div>
    </div>
</body>

</html>