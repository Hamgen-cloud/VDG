<!DOCTYPE html>
<html>
<head>
    <title>Contact Info</title>
</head>
<body>
    <h1>Contact Information</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Choose txt file:</label>
        <input type="file" name="file" id="file" required accept=".txt">
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>