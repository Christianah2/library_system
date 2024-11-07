<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author_name = $_POST['author_name'];

    // Check if author exists before inserting
    $check_query = mysqli_query($conn, "SELECT * FROM authors WHERE author_name = '$author_name'");
    if (mysqli_num_rows($check_query) > 0) {
        echo "<script>alert('Author already exists');</script>";
        echo "<script>window.location.href='authors.php';</script>";
        exit();
    }

    // Generate author id
    $author_id = substr(strtoupper($author_name), 0, 3) . mt_rand(0000, 9999);

    // Insert into the authors table
    $sql_query = "INSERT INTO authors (author_id, author_name) 
                  VALUES ('$author_id', '$author_name')";
    $insert_result = mysqli_query($conn, $sql_query);

    if ($insert_result === TRUE) {
        echo "<script>alert('Author Added Successfully')</script>";
        echo "<script>window.location.href='authors.php'</script>";
        exit();
    } else {
        echo "<script>alert('Failed to Add Author')</script>";
        echo "<script>window.location.href='authors.php'</script>";
        exit();
    }
}

//to get the total number of books written by each author
$no_of_books_query = "SELECT a.author_id, a.author_name, 
                      COUNT(b.book_id) 
                      AS no_of_books
                      FROM authors a
                      LEFT JOIN books b 
                      ON a.author_id = b.author_id
                      ORDER BY a.author_id, a.author_name";
$no_of_books_result = mysqli_query($conn, $no_of_books_query);

// Fetch results as an associative array
$no_of_books_query = mysqli_fetch_all($no_of_books_result, MYSQLI_ASSOC);

// Fetch all authors
$authors_query = "SELECT * FROM authors";
$authors_result = mysqli_query($conn, $authors_query);

// Fetch results as an associative array
$authors_data = mysqli_fetch_all($authors_result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>
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
                <h2 class='text-2xl font-bold text-gray-900'>Authors</h2>
                <button id='openModal' class='px-4 py-2 bg-steelblue text-white rounded-md hover:bg-indigo-600'>
                    Create Author
                </button>
            </div>
            <div class='w-full bg-powderblue py-6 rounded-lg shadow-lg mb-8'>
                <table class='min-w-full bg-white border rounded-lg'>
                    <thead>
                        <tr class='bg-steelblue text-white'>
                            <th class='py-2 px-4 border-b text-left'>ID</th>
                            <th class='py-2 px-4 border-b text-left'>Author</th>
                            <th class='py-2 px-4 border-b text-left'>No of Books</th>
                            <th class='py-2 px-4 border-b text-left'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($authors_data as $data) {
                        ?>
                        <tr class='bg-white border-b hover:bg-gray-100'>
                            <td class='py-2 px-4'><?php echo $i++; ?></td>
                            <td class='py-2 px-4'><?php echo $data['author_name']; ?></td>
                            <td class='py-2 px-4'><?php echo $data['no_of_books']; ?></td>
                            <td class='py-2 px-4'>
                                <a href="edit_authors.php?authors_id=<?php echo $data['id']; ?>">
                                    <button class="px-2 py-1 bg-cornflowerblue text-white rounded hover:bg-indigo-700">
                                        Edit
                                    </button>
                                </a>
                                <a
                                    href="delete.php?table_name=authors&column_name=author_id&column_data=<?php echo $data['author_id']; ?>">
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
            <div id='modal' class='fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden'>
                <div class='bg-powderblue rounded-lg shadow-lg w-1/3'>
                    <!-- Modal Header -->
                    <div class='p-4 border-b flex justify-between items-center bg-steelblue text-white rounded-t-lg'>
                        <h2 class='text-xl font-semibold'>Create Author</h2>
                        <button id='closeModal' class='text-white hover:text-cornflowerblue text-2xl'>&times;</button>
                    </div>

                    <!-- Modal Content -->
                    <div class='p-6'>
                        <form method='post'>
                            <div class='mb-4'>
                                <label for='author' class='block text-gray-700'>Author</label>
                                <input list='options' id='author' name='author_name' placeholder="Enter Author's Name"
                                    class='w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue'
                                    required />
                                <datalist id='options'>
                                    <?php foreach ($authors_data as $author_data) { ?>
                                    <option value='<?php echo $author_data['author_name']; ?>'>
                                        <?php } ?>
                                </datalist>
                            </div>

                            <div class='flex justify-center'>
                                <button type='submit'
                                    class='px-4 py-2 bg-cornflowerblue text-white rounded-md hover:bg-steelblue'>
                                    Add Author
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