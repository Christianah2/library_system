<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_title = $_POST['book_title'];
    $author_name = $_POST['author'];
    $year_of_production = date('Y', strtotime($_POST['year_of_production']));
    $age_barrier = $_POST['pg_rated'];
    $no_of_pages = $_POST['number_of_pages'];
    $book_type_id = $_POST['book_type_id'];
    $genre_id = $_POST['genre_id'];

    // Check if the book already exists in the database
    $check_query = "SELECT * FROM books WHERE title = '$book_title'";
    $verify_check_query = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($verify_check_query) > 0) {
        echo "<script>alert('Book already exists')</script>";
        echo "<script>window.location.href='books.php'</script>";
        exit();
    }
    // Generate book ID
    $book_id = substr(strtoupper($book_title), 0, 3) . mt_rand(0000, 9999);
    $author_id = '';
    //Check if author exists before
    $is_author_exist = mysqli_query($conn, "SELECT * FROM authors WHERE author_name = '$author_name'");
    if (mysqli_num_rows($is_author_exist) > 0) {
        $author_id = mysqli_fetch_array($is_author_exist)['author_id'];
    } else {
        // Generate author id
        $author_id = substr(strtoupper($author_name), 0, 3) . mt_rand(0000, 9999);
    }

    // Insert into the books table
    $sql_query = "INSERT INTO books (title, book_id, author_id, year_of_production, age_barrier, no_of_pages, book_type_id, genre_id) 
                  VALUES ('$book_title', '$book_id', '$author_id', '$year_of_production', '$age_barrier', '$no_of_pages', '$book_type_id', '$genre_id')";
    $insert_result = mysqli_query($conn, $sql_query);

    if ($insert_result === TRUE) {
        //Update the No of books for the particular genre,
        mysqli_query($conn, "UPDATE genres SET no_of_books = no_of_books + 1 WHERE genre_id = '$genre_id'");
        mysqli_query($conn, "UPDATE book_types SET no_of_books = no_of_books + 1 WHERE book_type_id = '$book_type_id'");
        if (mysqli_num_rows($is_author_exist) > 0) {
            mysqli_query($conn, "UPDATE authors SET no_of_books = no_of_books + 1 WHERE author_id = '$author_id'");
        } else {
            mysqli_query($conn, "INSERT INTO authors (author_name, author_id,no_of_books) VALUES ('$author_name', '$author_id','1')");
        }
        echo "<script>alert('Books Added Successfully')</script>";
        echo "<script>window.location.href='books.php'</script>";
        exit();
    } else {
        echo "<script>alert('Failed to Add Book')</script>";
        echo "<script>window.location.href='books.php'</script>";
        exit();
    }
}

// Get all book titles from the books table
$get_all_book_title_query = 'SELECT b.id, b.book_id,title,author_name,year_of_production,age_barrier,no_of_pages,book_type_name,genre_name,b.status
                            FROM books b
                            LEFT JOIN book_types bt
                            USING (book_type_id)
                            LEFT JOIN genres g
                            USING (genre_id)
                            LEFT JOIN authors a
                            ON a.author_id = b.author_id ORDER BY id DESC';
$get_all_book_title_result = mysqli_query($conn, $get_all_book_title_query);
$book_title = mysqli_fetch_all($get_all_book_title_result, MYSQLI_ASSOC);

//Get all list of books categories
$book_type_list = mysqli_fetch_all(mysqli_query($conn, 'SELECT * FROM book_types ORDER BY id DESC'), MYSQLI_ASSOC);
$book_genre_list = mysqli_fetch_all(mysqli_query($conn, 'SELECT * FROM genres ORDER BY id DESC'), MYSQLI_ASSOC);
$author_list = mysqli_fetch_all(mysqli_query($conn, 'SELECT * FROM authors ORDER BY id DESC'), MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>Books</title>
    <link rel='preconnect' href='https://fonts.googleapis.com' />
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
    <link href='https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap'
        rel='stylesheet'>
    <script src='https://cdn.tailwindcss.com'></script>
    <script src='tailwindConfig.js'></script>
</head>

<body class='min-h-screen bg-skyblue font-montserrat'>
    <div class='flex flex-col md:flex-row'>
        <!-- Sidebar -->
        <?php
        include('sidebar.php');
        ?>
        <!-- Main Content -->
        <div class='flex-1 px-5 py-8 bg-powderblue'>
            <div class='flex justify-between'>
                <h2 class='text-2xl font-bold text-gray-900'>
                    Books
                </h2>
                <button id='openModal' class='px-4 py-2 bg-steelblue text-white rounded-md hover:bg-indigo-600'>
                    Create Book
                </button>
            </div>
            <div class='w-full bg-powderblue py-6 rounded-lg shadow-lg mb-8'>
                <table class='min-w-full bg-white border rounded-lg'>
                    <thead>
                        <tr class='bg-steelblue text-white'>
                            <th class='py-2 px-4 border-b text-left'>ID</th>
                            <th class='py-2 px-4 border-b text-left'>Title</th>
                            <th class='py-2 px-4 border-b text-left'>Author</th>
                            <th class='py-2 px-4 border-b text-left'>Year of Production</th>
                            <th class='py-2 px-4 border-b text-left'>Number of Pages</th>
                            <th class='py-2 px-4 border-b text-left'>PG Rated</th>
                            <th class='py-2 px-4 border-b text-left'>Book Type</th>
                            <th class='py-2 px-4 border-b text-left'>Genre</th>
                            <th class='py-2 px-4 border-b text-left'>Status</th>
                            <th class='py-2 px-4 border-b text-left'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($book_title as $data) {
                        ?>
                        <tr class='bg-white border-b hover:bg-gray-100'>
                            <td class='py-2 px-4'><?php echo $i++;
                                                        ?> </td>
                            <td class='py-2 px-4'><?php echo $data['title'];
                                                        ?></td>
                            <td class='py-2 px-4'><?php echo $data['author_name'];
                                                        ?></td>
                            <td class='py-2 px-4'><?php echo $data['year_of_production'];
                                                        ?></td>
                            <td class='py-2 px-4'><?php echo $data['no_of_pages'];
                                                        ?></td>
                            <td class='py-2 px-4'><?php echo $data['age_barrier'];
                                                        ?></td>
                            <td class='py-2 px-4'><?php echo $data['book_type_name'];
                                                        ?></td>
                            <td class='py-2 px-4'><?php echo $data['genre_name'];
                                                        ?></td>

                            <td class='py-2 px-4'>
                                <?php echo ($data['status'] == '0') ? 'Available' : 'Borrowed' ?>
                            </td>

                            <td class='py-2 px-4'>

                                <!-- Ternary operator to display button if the book is available or not -->
                                <?php echo ($data['status'] == '0') ? '<button class="px-2 py-1 bg-green-500 text-white rounded 
                                hover:bg-green-700 borrow-book-button " book-title=" <?php echo $data["title"]; ?>
                                Borrow
                                Book</button>'
                                : '<button class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-700">Return
                                    Book</button>'; ?>



                                <a href="edit_books.php?book_id=<?php echo $data['id'] ?>"> <button
                                        class='px-2 py-1 bg-cornflowerblue text-white rounded hover:bg-indigo-700'>
                                        Edit
                                    </button></a>

                                <a
                                    href="delete.php?table_name=books&column_name=book_id&column_data=<?php echo $data['book_id'] ?>">
                                    <button class='px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700'>
                                        Delete
                                    </button></a>
                            </td>
                        </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- borrow book Modal structure -->
            <div id="borrowBookModal"
                class="hidden fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center">
                <div class="bg-white p-6 rounded-md shadow-lg w-1/3">
                    <h2 class="text-xl font-bold mb-4">Borrow Book</h2>
                    <p class="text-md text-gray-900 mb-4" id="modalBookDetails"></p>
                    <div class="flex justify-end">
                        <button id="closeModal-1"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800 mr-2">
                            Cancel
                        </button>
                        <button class="px-4 py-2 bg-steelblue text-white rounded-md hover:bg-cornflowerblue">
                            Confirm

                        </button>
                    </div>
                </div>
            </div>

            <!-- create book Modal Structure -->
            <div id='modal' class='fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden'>
                <div class='bg-powderblue rounded-lg shadow-lg w-1/3'>
                    <!-- Modal Header -->
                    <div class='p-4 border-b flex justify-between items-center bg-steelblue text-white rounded-t-lg'>
                        <h2 class='text-xl font-semibold'>Create Book</h2>
                        <button id='closeModal-2' class='text-white hover:text-cornflowerblue text-2xl'>
                            &times;
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div class='p-6'>
                        <form method='post'>
                            <div class='mb-4'>
                                <label for='book_title' class='block text-gray-700'>Book Title</label>
                                <input type='text' id='book_title' name='book_title' placeholder='Enter Book Title'
                                    class='w-full p-2 border border-gray-400 rounded-md mb-2 focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                                    required />
                            </div>

                            <div class='mb-4'>
                                <label for='author' class='block text-gray-700'>Author</label>
                                <input list='options' id='author' name='author' placeholder="Enter Author's Name"
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                                    required />
                                <datalist id='options'>
                                    <?php foreach ($author_list as $author_data) {
                                    ?>
                                    <option value='<?php echo $author_data['author_name'] ?>'>
                                        <?php }
                                        ?>
                                </datalist>
                            </div>

                            <div class='mb-4'>
                                <label for='age' class='block text-gray-700'>PG Rated</label>
                                <input type='number' id='pg' name='pg_rated' placeholder='Enter Age Range'
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                                    required />
                            </div>

                            <div class='mb-4'>
                                <label for='year' class='block text-gray-700'>Year of Production</label>
                                <input type='date' id='year' name='year_of_production'
                                    placeholder='Enter Year of Production'
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                                    required />
                            </div>

                            <div class='mb-4'>
                                <label for='number' class='block text-gray-700'>Number of Pages</label>
                                <input type='number' id='number' name='number_of_pages'
                                    placeholder='Enter Number of Pages'
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                                    required />
                            </div>

                            <div class='mb-4'>
                                <label for='book_type_id' class='block text-gray-700'>Book Types</label>
                                <select name='book_type_id'
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'>
                                    <option value=''>...select</option>
                                    <?php foreach ($book_type_list as $type_data) {
                                    ?>
                                    <option value='<?php echo $type_data['book_type_id'] ?>'>
                                        <?php echo $type_data['book_type_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>

                            <div class='mb-4'>
                                <label for='genre_id' class='block text-gray-700'>Genre Type</label>
                                <select name='genre_id'
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'>
                                    <option value=''>...select</option>
                                    <?php
                                    foreach ($book_genre_list as $genre_data) {
                                    ?>
                                    <option value="<?php echo $genre_data['genre_id'] ?>">
                                        <?php echo $genre_data['genre_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>

                            <div class='flex justify-center'>
                                <button type='submit'
                                    class='px-4 py-2 bg-cornflowerblue text-white rounded-md hover:bg-steelblue'>
                                    Add Book
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--Modal Script -->
    <script>
    // Get all modal elements
    const borrowModal = document.getElementById('borrowBookModal');
    const createModal = document.getElementById('modal');

    // Borrow book modal
    const closeBorrowModal = document.getElementById('closeModal-1');
    const bookDetails = document.getElementById('modalBookDetails');
    const borrowButtons = document.querySelectorAll('.borrow-book-button');
    borrowButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const bookTitle = button.getAttribute('book-title');
            bookDetails.textContent = `You are about to borrow "${bookTitle}".`;
            borrowModal.classList.remove('hidden');
        });
    });

    // Create book modal
    const openCreateModal = document.getElementById('openModal');
    const closeCreateModal = document.getElementById('closeModal-2');
    openCreateModal.addEventListener('click', () => {
        createModal.classList.remove('hidden');
    });
    closeCreateModal.addEventListener('click', () => {
        createModal.classList.add('hidden');
    });

    // Close modal on outside click
    window.addEventListener('click', (event) => {
        if (event.target === borrowModal) {
            borrowModal.classList.add('hidden');
        }
        if (event.target === createModal) {
            createModal.classList.add('hidden');
        }
    });
    </script>

</body>

</html>