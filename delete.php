<?php
$table_name = $_GET['table_name'];
$column_name = $_GET['column_name'];
$column_data = $_GET['column_data'];

include 'connection.php';

// SQL query to delete the selected column
$deleteQuery = "DELETE FROM $table_name WHERE $column_name = '$column_data'";
$execute_query = mysqli_query($conn, $deleteQuery);

if ($execute_query) {
    echo "<script>
            alert('Data Deleted Successfully');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
          </script>";
} else {
    echo "<script>
            alert('Failed to delete data');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
          </script>";
}

exit();