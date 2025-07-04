<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read JSON Data</title>

    <!-- Basic Styling -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 50px;
            min-height: 100vh;
        }

        #main {
            width: 600px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .header {
            border-bottom: 2px solid #007BFF;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }

        #load-data {
            padding: 10px;
            background: #f0f8ff;
            border-radius: 4px;
            color: #222;
        }
    </style>
</head>
<body>
    <div id="main">
        <div class="header">
            <h1>Read JSON Data</h1>
        </div>

        <div id="load-data">
            <!-- JSON data will be displayed here -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
/*
This is a jQuery AJAX request that fetches data from a PHP file named `fetch-json.php` and appends the received JSON data to an HTML element with the id `load-data`. The data is displayed in a formatted list with ID, Name, BirthDate, Phone Number, and Gender. */
        $.ajax({
                url: "fetch-json.php", // file name
                type: "GET", // request type
                dataType: "json", // data type - in which format we want the file to reurn data
                success: function (data) {  // success function
                    $.each(data, function (key, value) {
                        $("#load-data").append(
                            "ID: " + value.id + "<br>" +
                            "Name: " + value.name + "<br>" +
                            "BirthDate: " + value.birth_date + "<br>" +
                            "Phone Number: " + value.phone + "<br>" +
                            "Gender: " + value.gender + "<br><br>"
                        );
                    });
                }
            }
        )
    //    $.getJSON("fetch-json.php", function(data){
    //         $.each(data, function(key, value){
    //             $("#load-data").append(
    //                "ID: " + value.id + "<br>" +
    //                "Name: " + value.name + "<br>" +
    //                "BirthDate: " + value.birth_date + "<br>" +
    //                "Phone Number: " + value.phone + "<br>" +
    //                "Gender: " + value.gender + "<br><br>"
    //             );
    //         });
    //     });

    </script>

</body>
</html>
