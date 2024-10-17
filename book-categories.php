<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_category_name = $_POST['genres'];

    // Check if book category (genres) already exists in the database
    $check_query = "SELECT * FROM genres WHERE genre_name = '$book_category_name'";
    $verify_check_query = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($verify_check_query) > 0) {
        echo "<script>alert('Book Category already exists')</script>";
        echo "<script>window.location.href='book-categories.php'</script>";
        exit();
    }

    // Generate book category (genres) ID
    $book_category_id = substr(strtoupper($book_category_name), 0, 3) . mt_rand(0000, 9999);

    // Insert into the genres table
    $sql_query = "INSERT INTO genres (genre_name, genre_id) VALUES ('$book_category_name', '$book_category_id')";
    $insert_result = mysqli_query($conn, $sql_query);

    if ($insert_result === TRUE) {
        echo "<script>alert('Book Category Added Successfully')</script>";
        echo "<script>window.location.href='book-categories.php'</script>";
        exit();
    } else {
        echo "<script>alert('Failed to Add Book Category')</script>";
        echo "<script>window.location.href='book-categories.php'</script>";
        exit();
    }
}

// Get all book categories from the genres table
$get_all_book_category_query = "SELECT * FROM genres ORDER BY id DESC";
$get_all_book_category_result = mysqli_query($conn, $get_all_book_category_query);
$book_category = mysqli_fetch_all($get_all_book_category_result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Categories</title>
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
        <div class="flex-1 px-5 py-8 bg-powderblue">
            <div class="flex justify-between">
                <h2 class="text-2xl font-bold text-gray-900">
                    Book Categories
                </h2>
                <button id="openModal" class="px-4 py-2 bg-steelblue text-white rounded-md hover:bg-indigo-600">
                    Create Book Category
                </button>
            </div>
            <div class="w-full  bg-powderblue py-6 rounded-lg shadow-lg mb-8">
                <table class="min-w-full bg-white border rounded-lg">
                    <thead>
                        <tr class="bg-steelblue text-white">
                            <th class="py-2 px-4 border-b text-left">ID</th>
                            <th class="py-2 px-4 border-b text-left">Category Name</th>
                            <th class="py-2 px-4 border-b text-left">Description</th>
                            <th class="py-2 px-4 border-b text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($book_category as $data) { ?>
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <td class="py-2 px-4"><?php echo $i++; ?></td>
                            <td class="py-2 px-4"><?php echo $data['genre_name']; ?></td>
                            <td class="py-2 px-4"><?php echo $data['no_of_books']; ?></td>
                            <td class="py-2 px-4">
                                <button class="px-2 py-1 bg-cornflowerblue text-white rounded hover:bg-indigo-700">
                                    Edit
                                </button>
                                <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Structure -->
            <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden">
                <div class="bg-powderblue rounded-lg shadow-lg w-1/3">
                    <!-- Modal Header -->
                    <div class="p-4 border-b flex justify-between items-center bg-steelblue text-white rounded-t-lg">
                        <h2 class="text-xl font-semibold">Create Book Category</h2>
                        <button id="closeModal" class="text-white hover:text-cornflowerblue text-2xl">
                            &times;
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div class="p-6">
                        <form action="" method="POST">
                            <div class="mb-4">
                                <label for="category-name" class="block text-gray-700">Category Name</label>
                                <input type="text" id="category-name" name="genres" placeholder="Enter category name"
                                    class="w-full p-2 border border-gray-400 rounded-md mb-2 focus:outline-none focus:ring-2 focus:ring-cornflowerblue"
                                    required />
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-gray-700">Description</label>
                                <textarea id="description" name="description" placeholder="Enter description"
                                    class="w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue"
                                    required></textarea>
                            </div>

                            <button type="submit"
                                class="w-full px-4 py-2 bg-steelblue text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- JavaScript to Handle Modal -->
            <script>
            const modal = document.getElementById("modal");
            const openModal = document.getElementById("openModal");
            const closeModal = document.getElementById("closeModal");

            openModal.addEventListener("click", () => {
                modal.classList.remove("hidden");
            });

            closeModal.addEventListener("click", () => {
                modal.classList.add("hidden");
            });

            window.addEventListener("click", (event) => {
                if (event.target === modal) {
                    modal.classList.add("hidden");
                }
            });
            </script>

        </div>
    </div>
</body>

</html>