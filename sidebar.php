<?php
include 'security_check.php';
?>
<div class="bg-steelblue w-full md:w-1/4 p-8 text-white min-h-screen">
    <h1 class="text-3xl font-bold mb-8">Library Dashboard</h1>
    <nav class="space-y-4">
        <a href="dashboard.php"
            class="block px-4 py-2 bg-cornflowerblue rounded-md hover:bg-white hover:text-steelblue">
            Home
        </a>
        <a href="books.php" class="block px-4 py-2 bg-cornflowerblue rounded-md hover:bg-white hover:text-steelblue">
            View Books
        </a>
        <a href="authors.php" class="block px-4 py-2 bg-cornflowerblue rounded-md hover:bg-white hover:text-steelblue">
            Authors
        </a>
        <a href="book-genre.php"
            class="block px-4 py-2 bg-cornflowerblue rounded-md hover:bg-white hover:text-steelblue">
            Books Genres
        </a>
        <a href="book-types.php"
            class="block px-4 py-2 bg-cornflowerblue rounded-md hover:bg-white hover:text-steelblue">
            Book Type
        </a>
        <a href="#" class="block px-4 py-2 bg-cornflowerblue rounded-md hover:bg-white hover:text-steelblue">
            Borrowed Books
        </a>
        <a href="#" class="block px-4 py-2 bg-cornflowerblue rounded-md hover:bg-white hover:text-steelblue">
            Return Book
        </a>
        <a href="#" class="block px-4 py-2 bg-cornflowerblue rounded-md hover:bg-white hover:text-steelblue">
            Account Settings
        </a> <a href="logout.php" class="block px-4 py-2 bg-red-500 rounded-md hover:bg-white hover:text-steelblue">
            Log Out
        </a>
    </nav>
</div>