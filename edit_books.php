<?php
$book_sn_id = $_GET['book_id'];
include 'connection.php';

// Fetch book data based on the book's serial (id) number
$sqlQuery  = "SELECT * FROM `books` WHERE id='$book_sn_id'";
$book_data  = mysqli_fetch_assoc(mysqli_query($conn, $sqlQuery));


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $year_of_production = date( 'Y', strtotime( $_POST['year_of_production']));
    $age_barrier = $_POST['age_barrier'];
    $no_of_pages = $_POST['no_of_pages'];
    $book_type_id = $_POST['book_type_id'];
    $genre_id = $_POST['genre_id'];

    // SQL query to update book information
    $sql_query = "UPDATE books SET 
                    title='$book_title', 
                    author_id='$author_id', 
                    year_of_production='$year_of_production', 
                    age_barrier='$age_barrier',
                    no_of_pages='$no_of_pages', 
                    book_type_id='$book_type_id', 
                    genre_id='$genre_id' 
                  WHERE id='$book_sn_id'";

    $update_book_data = mysqli_query($conn, $sql_query);

    if ($update_book_data === TRUE) {
        echo "<script>alert('Book updated successfully');</script>";
        echo "<script>window.location.href='books.php';</script>";
    } else {
        echo "<script>alert('Book update failed');</script>";
    }
}

//get all list of books categories
$book_type_query = ('SELECT * FROM book_types ORDER BY id DESC');
$book_type_result = mysqli_query($conn, $book_type_query);

if ($book_type_result) {
    $book_type_list = mysqli_fetch_all($book_type_result, MYSQLI_ASSOC);
} else {
    $book_type_list = [];
}

$book_genre_query = ('SELECT * FROM genres ORDER BY id DESC');
$book_genre_result = mysqli_query($conn, $book_genre_query);

if ($book_genre_result) {
    $book_genre_list = mysqli_fetch_all($book_genre_result, MYSQLI_ASSOC);
} else {
    $book_genre_list = [];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Book</title>
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
        <div class='bg-white rounded-lg shadow-lg p-8 w-1/2 mx-auto mt-12'>
            <div class='flex justify-between items-center'>
                <p class='text-3xl font-bold text-steelblue'>Edit Book</p>
            </div>
            <form method='post' action=''>
                <div class='pt-7 grid gap-y-5'>
                    <!-- Book Title -->
                    <div class='grid'>
                        <label for='title' class='block text-gray-700 text-sm font-bold mb-2'>Book Title</label>
                        <input type='text' id='title' value="<?php echo $book_data['title']; ?>" name='title'
                            class='border border-gray-400 px-5 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                            required>
                    </div>

                    <!-- Author -->
                    <div class='grid'>
                        <label for='author_id' class='block text-gray-700 text-sm font-bold mb-2'>Author</label>
                        <input type='text' id='author_id' value="<?php echo $book_data['author_id']; ?>"
                            name='author_id'
                            class='border border-gray-400 px-5 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                            required>
                    </div>

                    <!-- Year of Production -->
                    <div class='grid'>
                        <label for='year_of_production' class='block text-gray-700 text-sm font-bold mb-2'>Year of
                            Production</label>
                        <input type='date' id='year_of_production'
                            value="<?php echo $book_data['year_of_production']; ?>" name='year_of_production'
                            class='border border-gray-400 px-5 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                            required>
                    </div>

                    <!-- Number of Pages -->
                    <div class='grid'>
                        <label for='no_of_pages' class='block text-gray-700 text-sm font-bold mb-2'>Number of
                            Pages</label>
                        <input type='number' id='no_of_pages' value="<?php echo $book_data['no_of_pages']; ?>"
                            name='no_of_pages'
                            class='border border-gray-400 px-5 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                            required>
                    </div>

                    <!-- PG Rated -->
                    <div class='grid'>
                        <label for='age_barrier' class='block text-gray-700 text-sm font-bold mb-2'>PG Rated</label>
                        <input type='number' id='age_barrier' value="<?php echo $book_data['age_barrier']; ?>"
                            name='age_barrier'
                            class='border border-gray-400 px-5 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                            required>
                    </div>

                    <!-- Book Type ID -->
                    <div class='grid'>
                        <label for='book_type_id' class='block text-gray-700 text-sm font-bold mb-2'>Book Type</label>
                        <select id='book_type_id' name='book_type_id'
                            class='border border-gray-400 px-5 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'>

                            <option value="">...Select</option>
                            <?php
                            foreach ($book_type_list as $type_data) {
                            ?>
                            <option value="<?php echo $type_data['book_type_id']; ?>">
                                <?php echo $type_data['book_type_name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Genre ID -->
                    <div class='grid'>
                        <label for='genre_id' class='block text-gray-700 text-sm font-bold mb-2'>Genre</label>
                        <select id='genre_id' name='genre_id'
                            class='border border-gray-400 px-5 py-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'>
                            <option value=''>...Select</option>
                            <?php
                            foreach ($book_genre_list as $genre_data) { ?>
                            <option value="<?php echo $genre_data['genre_id'] ?>">
                                <?php echo $genre_data['genre_name'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button class='bg-steelblue py-3 rounded-md text-white hover:bg-cornflowerblue' type='submit'>UPDATE
                        BOOKS</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>