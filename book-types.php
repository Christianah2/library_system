<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Categories</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwindConfig.js"></script>
</head>

<body class="flex flex-col items-center justify-center min-h-screen bg-skyblue font-montserrat p-10">
    <!-- Sidebar -->

    <!-- Table for Book types-->
    <div class="w-full max-w-4xl bg-powderblue p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Books</h2>
        <table class="min-w-full bg-white border rounded-lg">
            <thead>
                <tr class="bg-steelblue text-white">
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">Type Name</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data -->
                <tr class="bg-white border-b hover:bg-gray-100">
                    <td class="py-2 px-4 text-left">1</td>
                    <td class="py-2 px-4 text-left">Paperback</td>
                    <td class="py-2 px-4 text-left">
                        <button class="px-2 py-1 bg-cornflowerblue text-white rounded hover:bg-indigo-700">
                            Edit
                        </button>
                        <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700">
                            Delete
                        </button>
                    </td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-100">
                    <td class="py-2 px-4 text-left">2</td>
                    <td class="py-2 px-4 text-left">Hardcover</td>
                    <td class="py-2 px-4 text-left">
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

    <!-- Button to Open Modal -->
    <button id="openModal" class="px-4 py-2 bg-steelblue text-white rounded-md hover:bg-indigo-600">
        Create Book Type
    </button>

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
                <form>
                    <div class="mb-4">
                        <label for="book-type" class="block text-gray-700">Book Type</label>
                        <input type="text" id="book-type" name="book_type" placeholder="Enter book type"
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
</body>

</html>