<?php
$book_type_id = $_GET['book_type_id'];
include "connection.php";

//fetch all data usind book type id (serial number)
$sqlQuery = " SELECT * FROM book_types WHERE book_type_id = '$book_type_id'";
$book_type_data  = mysqli_fetch_assoc(mysqli_query($conn, $sqlQuery));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_type_name = $_POST['book_type'];


    // SQL query to update book type information
    $sql_query = "UPDATE book_types SET  book_type_name='$book_type_name' WHERE book_type_id='$book_type_id'";
    $update_book_type_data = mysqli_query($conn, $sql_query);

    if ($update_book_type_data === TRUE) {
        echo "<script>alert('Book Type Updated Successfully');</script>";
        echo "<script>window.location.href='book-types.php';</script>";
    } else {
        echo "<script>alert('Book Type update failed');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit book types</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwindConfig.js"></script>
</head>

<body class="min-h-screen bg-skyblue font-montserrat">
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <?php include('sidebar.php'); ?>

        <!-- Main Content -->
        <div class='bg-white rounded-lg shadow-lg p-8 w-1/2 mx-auto mt-12 my-auto'>
            <div class='flex justify-between items-center'>
                <p class='text-3xl font-bold text-steelblue'>Edit Book Genre</p>
            </div>
            <form method='post'>
                <div class='pt-7 grid gap-y-5'>

                    <!-- Book Type -->
                    <div class="mb-4">
                        <label for="book_type" class="block text-gray-700">Book Type Name</label>
                        <input type="text" id="book_type" value="<?php echo $book_type_data['book_type_name']; ?>"
                            name="book_type" placeholder="Enter type name"
                            class="w-full p-2 border border-gray-400 rounded-md mb-2 focus:outline-none focus:ring-2 focus:ring-cornflowerblue"
                            required />
                    </div>

                    <!-- Submit Button -->
                    <button class='bg-steelblue py-3 rounded-md text-white hover:bg-cornflowerblue' type='submit'>UPDATE
                        BOOK TYPE</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>