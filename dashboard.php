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
                Good Afternoon <?php echo $_SESSION['admin_firstname']?>
            </h2>
            <span class=" text-gray-700">
                Use the navigation menu to view available books, manage your borrowed
                books, and update your account settings.
            </span>

            <!-- Book Categories Section -->
            <div class="mt-8">
                <div class="grid grid-cols-4 gap-x-4">
                    <div class="bg-purple-600 rounded-lg p-4 text-white">
                        <p class="text-lg">No of Books</p>
                        <p class="text-5xl font-semibold pt-6 ">23</p>
                    </div>
                    <div class="bg-blue-600 rounded-lg p-4 text-white">
                        <p class="text-lg">No of Students</p>
                        <p class="text-5xl font-semibold pt-6 ">2</p>
                    </div>
                    <div class="bg-red-600 rounded-lg p-4 text-white">
                        <p class="text-lg">No of Authors</p>
                        <p class="text-5xl font-semibold pt-6 ">12</p>
                    </div>
                    <div class="bg-cyan-600 rounded-lg p-4 text-white">
                        <p class="text-lg">No of Books Borrowed</p>
                        <p class="text-5xl font-semibold pt-6 ">2</p>
                    </div>
                </div>
            </div>

            <!-- Available Books Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-900">Available Books</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <!-- Book Items -->
                    <!-- This section will be populated with PHP and SQL queries -->
                    <div class="bg-white p-4 rounded-md shadow-md">
                        <h4 class="text-lg font-bold">Book Title 1</h4>
                        <p class="text-sm text-gray-600">Author: Ogunsola Christianah</p>
                        <p class="text-sm text-gray-600">Category: Fiction</p>
                        <button class="mt-4 px-4 py-2 bg-steelblue text-white rounded-md hover:bg-cornflowerblue">
                            Borrow Book
                        </button>
                    </div>

                    <div class="bg-white p-4 rounded-md shadow-md">
                        <h4 class="text-lg font-bold">Book Title 2</h4>
                        <p class="text-sm text-gray-600">Author: Macmillian</p>
                        <p class="text-sm text-gray-600">Category: Non-fiction</p>
                        <button class="mt-4 px-4 py-2 bg-steelblue text-white rounded-md hover:bg-cornflowerblue">
                            Borrow Book
                        </button>
                    </div>

                    <div class="bg-white p-4 rounded-md shadow-md">
                        <h4 class="text-lg font-bold">Book Title 3</h4>
                        <p class="text-sm text-gray-600">Author: Wole Soyinka</p>
                        <p class="text-sm text-gray-600">Category: Biography</p>
                        <button class="mt-4 px-4 py-2 bg-steelblue text-white rounded-md hover:bg-cornflowerblue">
                            Borrow Book
                        </button>
                    </div>
                    <div>
                        <!-- Additional book items can be displayed here -->
                    </div>
                </div>

                <!-- Borrowed Books Section -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-900">Borrowed Books</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <!-- Placeholder for borrowed books, it will be populated with PHP -->
                        <div class="bg-white p-4 rounded-md shadow-md">
                            <h4 class="text-lg font-bold">Book Title 4</h4>
                            <p class="text-sm text-gray-600">Borrowed on: 2024-09-12</p>
                            <p class="text-sm text-gray-600">Due Date: 2024-10-12</p>
                            <button class="mt-4 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-800">
                                Return Book
                            </button>
                        </div>
                        <!-- Additional borrowed book items can be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>