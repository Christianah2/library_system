<?php
include 'connection.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $book_title = $_POST[ 'book_title' ];
    $author_id = $_POST[ 'author' ];
    $year_of_production = $_POST[ 'year' ];
    $age_barrier = $_POST[ 'age' ];
    $no_of_pages = $_POST[ 'number' ];
    $book_type_id = $_POST[ 'book_type_id' ];
    $genre_id = $_POST[ 'genre_id' ];

    // Check if the book already exists in the database
    $check_query = "SELECT * FROM books WHERE title = '$book_title'";
    $verify_check_query = mysqli_query( $conn, $check_query );
    if ( mysqli_num_rows( $verify_check_query ) > 0 ) {
        echo "<script>alert('Book already exists')</script>";
        echo "<script>window.location.href='books.php'</script>";
        exit();
    }

    // Generate book ID
    $book_id = substr( strtoupper( $book_title ), 0, 3 ) . mt_rand( 0000, 9999 );

    // Insert into the books table
    $sql_query = "INSERT INTO books (title, book_id, author_id, year_of_production, age_barrier, no_of_pages, book_type_id, genre_id) 
                  VALUES ('$book_title', '$book_id', '$author_id', '$year_of_production', '$age_barrier', '$no_of_pages', '$book_type_id', '$genre_id')";
    $insert_result = mysqli_query( $conn, $sql_query );

    if ( $insert_result === TRUE ) {
        echo "<script>alert('Book title Added Successfully')</script>";
        echo "<script>window.location.href='books.php'</script>";
        exit();
    } else {
        echo "<script>alert('Failed to Add Book')</script>";
        echo "<script>window.location.href='books.php'</script>";
        exit();
    }
}

// Get all book titles from the books table
$get_all_book_title_query = 'SELECT * FROM books ORDER BY id DESC';
$get_all_book_title_result = mysqli_query( $conn, $get_all_book_title_query );
$book_title = mysqli_fetch_all( $get_all_book_title_result, MYSQLI_ASSOC );

//Get all list of books categories
$book_type_list = mysqli_fetch_all( mysqli_query( $conn, 'SELECT * FROM book_types ORDER BY id DESC' ), MYSQLI_ASSOC );
$book_genre_list = mysqli_fetch_all( mysqli_query( $conn, 'SELECT * FROM genres ORDER BY id DESC' ), MYSQLI_ASSOC );
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
include( 'sidebar.php' );
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
                            <th class='py-2 px-4 border-b text-left'>Book Type ID</th>
                            <th class='py-2 px-4 border-b text-left'>Genre ID</th>
                            <th class='py-2 px-4 border-b text-left'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
foreach ( $book_title as $data ) {
    ?>
                        <tr class='bg-white border-b hover:bg-gray-100'>
                            <td class='py-2 px-4'><?php echo $i++;
    ?> </td>
                            <td class='py-2 px-4'><?php echo $data[ 'title' ];
    ?></td>
                            <td class='py-2 px-4'><?php echo $data[ 'author_id' ];
    ?></td>
                            <td class='py-2 px-4'><?php echo $data[ 'year_of_production' ];
    ?></td>
                            <td class='py-2 px-4'><?php echo $data[ 'no_of_pages' ];
    ?></td>
                            <td class='py-2 px-4'><?php echo $data[ 'age_barrier' ];
    ?></td>
                            <td class='py-2 px-4'><?php echo $data[ 'book_type_id' ];
    ?></td>
                            <td class='py-2 px-4'><?php echo $data[ 'genre_id' ];
    ?></td>
                            <td class='py-2 px-4'>

                                <a href="edit_books.php?books=<?php echo $book['id'] ?>"> <button
                                        class='px-2 py-1 bg-cornflowerblue text-white rounded hover:bg-indigo-700'>
                                        Edit
                                    </button></a>

                                <button class='px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700'>
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <?php }
    ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Structure -->
            <div id='modal' class='fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden'>
                <div class='bg-powderblue rounded-lg shadow-lg w-1/3'>
                    <!-- Modal Header -->
                    <div class='p-4 border-b flex justify-between items-center bg-steelblue text-white rounded-t-lg'>
                        <h2 class='text-xl font-semibold'>Create Book</h2>
                        <button id='closeModal' class='text-white hover:text-cornflowerblue text-2xl'>
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
                                <input type='text' id='author' name='author' placeholder="Enter Author's Name"
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                                    required />
                            </div>

                            <div class='mb-4'>
                                <label for='age' class='block text-gray-700'>PG Rated</label>
                                <input type='number' id='pg' name='age' placeholder='Enter Age Range'
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                                    required />
                            </div>

                            <div class='mb-4'>
                                <label for='year' class='block text-gray-700'>Year of Production</label>
                                <input type='date' id='year' name='year' placeholder='Enter Year of Production'
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                                    required />
                            </div>

                            <div class='mb-4'>
                                <label for='number' class='block text-gray-700'>Number of Pages</label>
                                <input type='number' id='number' name='number' placeholder='Enter Number of Pages'
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                                    required />
                            </div>

                            <div class='mb-4'>
                                <label for='genre_id' class='block text-gray-700'>Book Types</label>
                                <select name='book_type_id'
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'>
                                    <option value=''>...select</option>
                                    <?php foreach ( $book_type_list as $type_data ) {?>
                                    <option value='<?php echo $type_data['book_type_id']?>'>
                                        <?php echo $type_data[ 'book_type_name' ]?></option>
                                    <?php }?>
                                </select>
                            </div>

                            <div class='mb-4'>
                                <label for='book_type_id' class='block text-gray-700'>Genre Type</label>
                                <select name='book_genre_id'
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'>
                                    <option value=''>...select</option>
                                    <?php
        foreach ( $book_genre_list as $genre_data ) {
            ?>
                                    <option value="<?php $genre_data['genre_id']?>">
                                        <?php echo $genre_data[ 'genre_name' ]?></option>
                                    <?php }
            ?>
                                </select>
                            </div>

                            <div class='flex justify-end'>
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

    <!-- Modal Script -->
    <script>
    // Get modal elements
    const modal = document.getElementById('modal');
    const openModal = document.getElementById('openModal');
    const closeModal = document.getElementById('closeModal');

    // Event listeners to open and close the modal
    openModal.addEventListener('click', () => {
        modal.classList.remove('hidden');
        // Show the modal
    });

    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
        // Hide the modal
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
    </script>
</body>

</html>