<?php
include 'connection.php';

// query to get the number of books in the database
$book_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) book_count FROM books"))['book_count'];

// query to get the number of authors in the database
$author_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) author_count FROM authors"))['author_count'];

// query to get the number of books available 
$available_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) available_book FROM books WHERE status ='0'"))['available_book'];

// query to get the number of books borrowed 
$borrowed_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) borrow_book FROM books WHERE status ='1'"))['borrow_book'];

// query to fetch all books from the database
$books_query = "SELECT books.title, authors.author_name, book_types.book_type_name, genres.genre_name
                FROM books 
                LEFT JOIN authors ON books.author_id = authors.author_id 
                LEFT JOIN genres ON books.genre_id = genres.genre_id
                LEFT JOIN book_types ON books.book_type_id = book_types.book_type_id
                WHERE books.status ='0' LIMIT 15";
$books_result = mysqli_query($conn, $books_query);

if (!$books_result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Library Dashboard</title>
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
        <?php
        include('sidebar.php');
        ?>
        <!-- Main Content -->
        <div class="flex-1 px-5 py-8 bg-powderblue">
            <h2 class="text-2xl font-bold text-gray-900">
                Hello <?php echo $_SESSION['admin_firstname'] ?>
            </h2>
            <span class=" text-gray-700">
                Use the navigation menu to view available books, manage your borrowed
                books, and update your account settings.
            </span>

            <!-- Book Categories Section -->
            <div class="mt-8">
                <div class="grid grid-cols-5 gap-x-4">
                    <div class="bg-purple-600 rounded-lg p-4 text-white">
                        <p class="text-lg">Total No of Books</p>
                        <p class="text-5xl font-semibold pt-6 "><?php echo $book_count; ?></p>
                    </div>
                    <div class="bg-cyan-600 rounded-lg p-4 text-white">
                        <p class="text-lg">No of Authors</p>
                        <p class="text-5xl font-semibold pt-6 "><?php echo $author_count; ?></p>
                    </div>
                    <div class="bg-blue-600 rounded-lg p-4 text-white">
                        <p class="text-lg">No of Students</p>
                        <p class="text-5xl font-semibold pt-6 ">2</p>
                    </div>
                    <div class="bg-green-600 rounded-lg p-4 text-white">
                        <p class="text-lg">No of Available books</p>
                        <p class="text-5xl font-semibold pt-6 "><?php echo $available_books?></p>
                    </div>
                    <div class="bg-red-600 rounded-lg p-4 text-white">
                        <p class="text-lg">No of Books Borrowed</p>
                        <p class="text-5xl font-semibold pt-6 "><?php echo $borrowed_books ?></p>
                    </div>
                </div>
            </div>

            <!-- Available Books Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-900">Available Books</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <!-- Book Items -->
                    <?php while ($book = mysqli_fetch_assoc($books_result)) { ?>
                    <div class="bg-white p-4 rounded-md shadow-md">
                        <h4 class="text-lg font-bold"><?php echo ($book['title']); ?></h4>
                        <p class="text-sm text-gray-600">Author: <?php echo ($book['author_name']); ?></p>
                        <p class="text-sm text-gray-600">Type: <?php echo ($book['book_type_name']); ?></p>
                        <p class="text-sm text-gray-600">Genre: <?php echo ($book['genre_name']); ?></p>
                        <button class="mt-4 px-4 py-2 bg-steelblue text-white rounded-md hover:bg-cornflowerblue">
                            Borrow Book
                        </button>
                    </div>
                    <?php } ?>
                </div>

                <!-- Borrowed Books Section -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-900">Borrowed Books</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <?php while ($book = mysqli_fetch_assoc ($books_result)){?>
                        <div class="bg-white p-4 rounded-md shadow-md">
                            <h4 class="text-lg font-bold"><?php echo ($book['title']); ?> </h4>
                            <p class="text-sm text-gray-600">Borrowed on: 2024-09-12</p>
                            <p class="text-sm text-gray-600">Due Date: 2024-10-12</p>
                            <button class="mt-4 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800">
                                Return Book
                            </button><?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>