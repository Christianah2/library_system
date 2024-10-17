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
        <?php
    include('sidebar.php');
    ?>
        <!-- Main Content -->
        <div class="flex-1 px-5 py-8 bg-powderblue">
            <div class="flex justify-between">
                <h2 class="text-2xl font-bold text-gray-900">
                    Books
                </h2>
                <button id="openModal" class="px-4 py-2 bg-steelblue text-white rounded-md hover:bg-indigo-600">
                    Create Book
                </button>
            </div>
            <div class="w-full  bg-powderblue py-6 rounded-lg shadow-lg mb-8">
                <table class="min-w-full bg-white border rounded-lg">
                    <thead>
                        <tr class="bg-steelblue text-white">
                            <th class="py-2 px-4 border-b text-left">ID</th>
                            <th class="py-2 px-4 border-b text-left">Book Title</th>
                            <th class="py-2 px-4 border-b text-left">Author</th>
                            <th class="py-2 px-4 border-b text-left">Description</th>
                            <th class="py-2 px-4 border-b text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Data -->
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <td class="py-2 px-4">1</td>
                            <td class="py-2 px-4">Alice's Adventures in Wonderland</td>
                            <td class="py-2 px-4">Lewis Carrol</td>
                            <td class="py-2 px-4">Fantasy</td>
                            <td class="py-2 px-4">
                                <button class="px-2 py-1 bg-cornflowerblue text-white rounded hover:bg-indigo-700">
                                    Edit
                                </button>
                                <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <td class="py-2 px-4">2</td>
                            <td class="py-2 px-4">Pride and Prejudice</td>
                            <td class="py-2 px-4">Jane Austen</td>
                            <td class="py-2 px-4">Romance</td>
                            <td class="py-2 px-4">
                                <button class="px-2 py-1 bg-cornflowerblue text-white rounded hover:bg-indigo-700">
                                    Edit
                                </button>
                                <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <td class="py-2 px-4">3</td>
                            <td class="py-2 px-4">A Brief History of Humankind</td>
                            <td class="py-2 px-4">Yuval Noah Harari</td>
                            <td class="py-2 px-4">History</td>
                            <td class="py-2 px-4">
                                <button class="px-2 py-1 bg-cornflowerblue text-white rounded hover:bg-indigo-700">
                                    Edit
                                </button>
                                <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <!-- more rows can be added here as needed -->
                    </tbody>
                </table>
            </div>



            <!-- Modal Structure -->
            <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden">
                <div class="bg-powderblue rounded-lg shadow-lg w-1/3">
                    <!-- Modal Header -->
                    <div class="p-4 border-b flex justify-between items-center bg-steelblue text-white rounded-t-lg">
                        <h2 class="text-xl font-semibold">Create Book</h2>
                        <button id="closeModal" class="text-white hover:text-cornflowerblue text-2xl">
                            &times;
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div class="p-6">
                        <form>
                            <div class="mb-4">
                                <label for="category-name" class="block text-gray-700"> Title</label>
                                <input type="text" id="book_title" name="book_title" placeholder="Enter Book Title"
                                    class="w-full p-2 border border-gray-400 rounded-md mb-2 focus:outline-none focus:ring-2 focus:ring-cornflowerblue"
                                    required />
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-gray-700">Author</label>
                                <input type="text" id="Author" name="name" placeholder="Enter Author's Name"
                                    class="w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue"
                                    required />
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-gray-700">Category</label>
                                <select name="name"
                                    class="w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue">
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-gray-700">Type</label>
                                <select name="name"
                                    class="w-full p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-cornflowerblue">
                                </select>
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