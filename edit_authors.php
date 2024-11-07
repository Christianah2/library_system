<?php
$author_sn_id = $_GET['authors_id'];
include 'connection.php';

// Fetch authors based on author's id
$sqlQuery  = "SELECT * FROM authors WHERE id='$author_sn_id'";
$author_data  = mysqli_fetch_assoc(mysqli_query($conn, $sqlQuery));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author_name = $_POST['author_name'];


    //sql qery to update author's information
    $sql_query = "UPDATE authors SET author_name='$author_name' WHERE id='$author_sn_id'";
    $update_author_data = mysqli_query($conn, $sql_query);

    if ($update_author_data === TRUE) {
        echo "<script>alert('Author updated successfully');</script>";
        echo "<script>window.location.href='authors.php';</script>";
    } else {
        echo "<script>alert('Author update failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit authors</title>
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
        <div class='bg-white rounded-lg shadow-lg p-8 w-1/2 my-auto mt-12 mx-auto '>
            <div class='flex justify-between items-center'>
                <p class='text-3xl font-bold text-steelblue'>Edit Author</p>
            </div>
            <form method='post'>
                <div class='pt-7 grid gap-y-5'>
                    <div class='mb-4'>
                        <label for='author' class='block text-gray-700 font-bold mb-2'>Author</label>
                        <input list='options' id='author' name='author_name'
                            value="<?php echo $author_data['author_name']; ?>"
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
                            UPDATE AUTHOR
                        </button>
                    </div>

                </div>
            </form>

        </div>
</body>

</html>