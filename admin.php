<?php
function addTouristSpot($Tourist_Spot_Name, $location, $description, $image)
{
    $xml = simplexml_load_file('touristSpot.xml');

    // Create the root element if it doesn't exist
    if (!$xml) {
        $xml = new SimpleXMLElement('<TouristSpots></TouristSpots>');
    }

    $newLocation = $xml->addChild('TouristLocation');
    $newLocation->addChild('Tourist_Spot_Name', $Tourist_Spot_Name);
    $newLocation->addChild('Location', $location);
    $newLocation->addChild('Description', $description);

    $imageFileName = $image['name'];
    $imageFolderPath = 'uploads/' . $location; // Create a folder using the tourist spot/event name
    if (!is_dir($imageFolderPath)) {
        mkdir($imageFolderPath, 0777, true); // Create the folder if it doesn't exist
    }
    $imageFilePath = $imageFolderPath . '/' . $imageFileName; // Set the path to store the image
    move_uploaded_file($image['tmp_name'], $imageFilePath); // Move the uploaded image to the specified path
    $newLocation->addChild('Image', $imageFilePath); // Store the image path in the XML

    $xml->asXML('Tour.xml');
    header("Location: admin.php");
    exit();
}

function deleteTour($location)
{
    $xml = simplexml_load_file('Tour.xml');

    // Find the tourist spot with the given location
    $deletedLocation = $xml->xpath("//TouristLocation[Location = '{$location}']");

    if (!empty($deletedLocation)) {
        $deletedLocation = $deletedLocation[0];

        // Delete the associated image file
        $imageFilePath = (string) $deletedLocation->Image;
        if (file_exists($imageFilePath)) {
            unlink($imageFilePath);
        }

        // Delete the associated folder
        $imageFolderPath = dirname($imageFilePath);
        if (is_dir($imageFolderPath)) {
            $files = glob($imageFolderPath . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($imageFolderPath);
        }

        // Remove the tourist spot from the XML
        unset($deletedLocation[0]);
        $xml->asXML('Tour.xml');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Tourist_Spot_Name']) && isset($_POST['Location']) && isset($_POST['location-description'])) {
    $Tourist_Spot_Name = $_POST['Tourist_Spot_Name'];
    $location = $_POST['Location'];
    $description = $_POST['location-description'];
    $image = $_FILES['image'];

    addTouristSpot($Tourist_Spot_Name, $location, $description, $image);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $location = $_GET['delete'];
    deleteTour($location);
    header("Location: admin.php");
    exit();
}

$xml = simplexml_load_file('Tour.xml');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(images/background.jpg);
        }

        .admin-main {
            background-color: #f9f9f9;
            padding: 20px;
            background-image: url(images/background.jpg);
        }

        .content-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .banner {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        ul li {
            display: inline-block;
            margin-right: 10px;
        }

        ul li a {
        
            color: green;
            
        }

        .label-add {
            font-size: 20px;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="file"],
        input[type="submit"] {
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .description-container {
            height: 100px;
        }

        #label-upload {
            display: block;
            margin-bottom: 10px;
        }

        .data-container {
            max-width: 800px;
            margin: 20px auto;
        }

        h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f9f9f9;
        }

        #Description-data {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        #delete-button {
            color: red;
            text-decoration: none;
        }
    </style>

</head>
<body>
<section>
    <div class="admin-main">
        <div class="content-container">
            <form action="admin.php" method="post" enctype="multipart/form-data">
                <h1 class="banner">Admin Page</h1>
                <ul>
                    <li>
                        <a href="index.php">Home Page</a>
                    </li>
                </ul>
                <h3 class="label-add">Add More Destinations</h3>
                <input type="text" name="Tourist_Spot_Name" placeholder="Add Spot Name" required>
                <input type="text" name="Location" placeholder="Add Tourist Location" required>
                <input type="text" name="location-description" placeholder="Add location description"
                       class="description-container" required>
                <label for="image" id="label-upload">Upload Image here :
                    <input type="file" name="image" accept="image/*" required></label>
                <input type="submit" value="Add">
            </form>
        </div>
    </div>
</section>
<section>
    <div class="data-container">
        <h3>Existing Data</h3>
        <table>
            <tr>
                <th>Tourist Spot Name</th>
                <th>Location</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($xml->Tour as $index => $location) {
                echo '<tr>';
                echo '<td>' . $location->Tourist_Spot_Name . '</td>';
                echo '<td>' . $location->Location . '</td>';
                echo '<td id="Description-data">' . $location->Description . '</td>';
                echo '<td><img src="' . $location->Image . '" alt="Image"></td>';
                echo '<td><a href="admin.php?delete=' . urlencode($location->Location) . '" id="delete-button">Delete</a></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</section>
</body>
</html>
