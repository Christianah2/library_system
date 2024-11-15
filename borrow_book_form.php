<?php
include 'connection.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>borrow book form</title>
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

        <div class="fixed inset-0 flex items-center justify-center">
            <div class="bg-white p-4 rounded shadow-lg w-1/3">
                <p class="text-3xl font-bold text-steelblue mb-2">Borrow Book</p>
                <form id="borrow-book-form" method="GET">
                    <!-- form fields -->
                    <div class="mb-4">
                        <label for="user-name" class="block text-gray-700">Student's First Name</label>
                        <input type="text" id="user-name" name="user_name" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="user-name" class="block text-gray-700">Student's last Name</label>
                        <input type="text" id="user-name" name="user_name" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="user-name" class="block text-gray-700">Email Address</label>
                        <input type="text" id="user-name" name="user_name" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Book Title</label>
                        <input type="text" id="title" name="title" value="<?php echo $book_data['title']; ?>"
                            class="w-full p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="book_type" class="block text-gray-700">Book Type</label>
                        <input type="text" id="book_type" name="book_type"
                            value="<?php echo $book_type_data['book_type_name']; ?>" class="w-full p-2 border rounded"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="genre-name" class="block text-gray-700">Book Genre</label>
                        <input type="text" id="genre-name" name="genre-name"
                            value="<?php echo $genre_data['genre_name']; ?>" class="w-full p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="user-name" class="block text-gray-700">Borrow Date</label>
                        <input type="text" id="user-name" name="user_name" class="w-full p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="user-name" class="block text-gray-700">Return Date</label>
                        <input type="text" id="user-name" name="user_name" class="w-full p-2 border rounded" required>
                    </div>

                    <div class="flex justify-end">
                        <a href="book.php"> <button type="button" id="close-form"
                                class="px-4 py-2 bg-red-500 text-white rounded mr-2">Close</button></a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>