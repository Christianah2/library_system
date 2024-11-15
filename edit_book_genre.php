<?php
$book_genre_id = $_GET['genre_id'];
include 'connection.php';

// Fetch book data based on the book's serial (id) number
$sqlQuery  = "SELECT * FROM `genres` WHERE genre_id='$book_genre_id'";
$genre_data  = mysqli_fetch_assoc(mysqli_query($conn, $sqlQuery));


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $genre_name = $_POST['genre_name'];
    $description = $_POST['description'];


    // SQL query to update book information
    $sql_query = "UPDATE genres SET  genre_name='$genre_name', description='$description' WHERE genre_id='$book_genre_id'";
    $update_genre_data = mysqli_query($conn, $sql_query);

    if ($update_genre_data === TRUE) {
        echo "<script>alert('Book Genre Updated Successfully');</script>";
        echo "<script>window.location.href='book-genre.php';</script>";
    } else {
        echo "<script>alert('Book update failed');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Book Genre</title>
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

                    <div class='grid'>
                        <label for='genre-name' class='block text-gray-700 text-sm font-bold mb-2'>Genre Name</label>
                        <input type='text' id='genre-name' value="<?php echo $genre_data['genre_name']; ?>"
                            name='genre_name'
                            class='border border-gray-400 px-5 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                            required>
                    </div>


                    <div class='grid'>
                        <label for='description' class='block text-gray-700 text-sm font-bold mb-2'>Description</label>
                        <input type='text' id='description' value="<?php echo $genre_data['description']; ?>"
                            name='description'
                            class='border border-gray-400 px-5 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                            required>
                    </div>


                    <!-- Submit Button -->
                    <div class='flex justify-center'>
                        <button type='submit'
                            class='px-4 py-2 bg-cornflowerblue text-white rounded-md hover:bg-steelblue'>
                            UPDATE GENRE TYPE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>