<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_type_name = $_POST['book_type'];
    //Check if book type is already exist in database
    $check_query = "SELECT * FROM book_types WHERE book_type_name = '$book_type_name'";
    $verify_check_query = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($verify_check_query) > 0) {
        echo "<script>alert('Type Name already exist')</script>";
        echo "<script>window.location.href='book-types.php'</script>";
        exit();
    }

    //Generate book type id;
    $book_type_id = substr(strtoupper($book_type_name), 0, 3) . mt_rand(0000, 9999);
    $sql_query = "INSERT INTO book_types (book_type_name,book_type_id) VALUES ('$book_type_name','$book_type_id')";
    $insert_result = mysqli_query($conn, $sql_query);
    if ($insert_result === TRUE) {
        echo "<script>alert('Book Type Added Successfully')</script>";
        echo "<script>window.location.href='book-types.php'</script>";
        exit();
    } else {
        echo "<script>alert('Failed to Add Book Type')</script>";
        echo "<script>window.location.href='book-types.php'</script>";
        exit();
    }
}

$get_all_book_type_query = "SELECT * FROM book_types ORDER BY id DESC";
$get_all_book_type_result = mysqli_query($conn, $get_all_book_type_query);
$book_types = mysqli_fetch_all($get_all_book_type_result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Types</title>
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
            <div class="flex justify-between">
                <h2 class="text-2xl font-bold text-gray-900">
                    Book Types
                </h2>
                <button id="openModal" class="px-4 py-2 bg-steelblue text-white rounded-md hover:bg-indigo-600">
                    Create Book Type
                </button>
            </div>
            <div class="w-full  bg-powderblue py-6 rounded-lg shadow-lg mb-8">
                <table class="min-w-full bg-white border rounded-lg">
                    <thead>
                        <tr class="bg-steelblue text-white">
                            <th class="py-2 px-4 border-b text-left">ID</th>
                            <th class="py-2 px-4 border-b text-left">Name</th>
                            <th class="py-2 px-4 border-b text-left">No Of Book</th>
                            <th class="py-2 px-4 border-b text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($book_types as $data) { ?>
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <td class="py-2 px-4"><?php echo $i++; ?></td>
                            <td class="py-2 px-4"><?php echo $data['book_type_name'] ?></td>
                            <td class="py-2 px-4"><?php echo $data['no_of_books'] ?></td>
                            <td class="py-2 px-4">
                                <a href="edit_book_types.php?book_type_id=<?php echo $data['id'] ?>">
                                    <button class="px-2 py-1 bg-cornflowerblue text-white rounded hover:bg-indigo-700">
                                        Edit
                                    </button>
                                </a>

                                <a
                                    href="delete.php?table_name=book_types&column_name=book_type_id&column_data=<?php echo $data['book_type_id'] ?>">
                                    <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </a>
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
                        <h2 class="text-xl font-semibold">Create Book Type</h2>
                        <button id="closeModal" class="text-white hover:text-cornflowerblue text-2xl">
                            &times;
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div class="p-6">
                        <form method="post">
                            <div class="mb-4">
                                <label for="book_type" class="block text-gray-700">Book Type Name</label>
                                <input type="text" id="book_type" name="book_type" placeholder="Enter type name"
                                    class="w-full p-2 border border-gray-400 rounded-md mb-2 focus:outline-none focus:ring-2 focus:ring-cornflowerblue"
                                    required />
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
            // Get modal elements
            const modal = document.getElementById("modal");
            const openModal = document.getElementById("openModal");
            const closeModal = document.getElementById("closeModal");

            // Event listeners to open and close the modal
            openModal.addEventListener("click", () => {
                modal.classList.remove("hidden"); // Show the modal
            });

            closeModal.addEventListener("click", () => {
                modal.classList.add("hidden"); // Hide the modal
            });

            // Close modal when clicking outside the modal content
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