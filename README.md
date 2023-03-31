# PHP-Login
This is a PHP script for handling user authentication through a login form. It starts a session using the session_start() function and checks if the submit button has been pressed using the isset() function. If the form has been submitted, it checks if the user and pass fields have been filled out using the !empty() function.

If the fields are not empty, the script connects to a MySQL database using the mysqli_connect() function and selects a database using the mysqli_select_db() function. It then executes a SQL query using the mysqli_query() function to retrieve the user's credentials from the database.

If the query returns a non-zero number of rows, indicating that the user's credentials are valid, the script retrieves the user's details from the query result using the mysqli_fetch_assoc() function and stores them in session variables using the $_SESSION superglobal. Finally, it redirects the user to the ViewStatus.php page using the header() function.

If the query returns zero rows, indicating that the user's credentials are invalid, the script redirects the user to the warn.php page using the header() function.

It's worth noting that the script is vulnerable to SQL injection attacks, as it directly concatenates user input into the SQL query without sanitizing or validating it. It would be safer to use prepared statements or a database abstraction layer to prevent SQL injection attacks.
