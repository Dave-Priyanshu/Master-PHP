<?php
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];

    if (!is_dir('upload-images')) {
        mkdir('upload-images', 0777, true);
    }

    if (move_uploaded_file($file_tmp, "upload-images/" . $file_name)) {
        $message = "✅ Image uploaded successfully as <strong>$file_name</strong>";
    } else {
        $message = "❌ Failed to upload image.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Styled File Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Global reset & font */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #343a40;
        }

        input[type="file"] {
            display: block;
            margin: 15px auto;
            padding: 10px;
        }

        input[type="submit"] {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0b5ed7;
        }

        .message {
            margin-top: 15px;
            font-size: 0.95rem;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Upload an Image</h1>

        <!-- Show upload message -->
        <?php if (!empty($message)): ?>
            <p class="message <?php echo strpos($message, '✅') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </p>
        <?php endif; ?>

        <!-- Upload form -->
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" required>
            <input type="submit" value="Upload Image">
        </form>
    </div>
</body>
</html>

