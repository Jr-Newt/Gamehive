<?php
// Check existence of id parameter before processing further
error_reporting( error_reporting() & ~E_NOTICE );
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM gamestore WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Retrieve individual field value
                $name = $row["name"];
                $description = $row["description"];
                $price = $row["price"];
                $gamecat = $row["gamecat"];
                $gameimage = $row["gameimage"];
                $mode = $row["mode"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: gameerror.php");
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to gameerror page
    header("location: gameerror.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Game</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $row["description"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <p><b><?php echo $row["price"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <p><b><?php echo $row["gamecat"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Mode</label>
                        <p><b><?php echo $row["mode"]; ?></b></p>
                    </div>

                    <p><a href="gameindex.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
