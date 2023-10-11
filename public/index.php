<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../src/vendor/autoload.php';

$app = new \Slim\App;

// Endpoint to post a name to the database
$app->post('/postName', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody());
    $fname = $data->fname;
    $lname = $data->lname;

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO names (fname, lname) VALUES (:fname, :lname)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->execute();

        $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }
    $conn = null;
    return $response;
});

// Endpoint to retrieve and print data from the database
$app->get('/printName', function (Request $request, Response $response, array $args) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM names";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            array_push($data, array("fname" => $row["fname"], "lname" => $row["lname"]));
        }
        $data_body = array("status" => "success", "data" => $data);
        $response->getBody()->write(json_encode($data_body));
    } else {
        $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));
    }

    $conn->close();
});


// Endpoint to update data in the database
$app->put('/updateName/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $data = $request->getParsedBody(); // Use getParsedBody() for PUT requests
    $fname = $data['fname'];
    $lname = $data['lname'];

    // Debugging: Log values before executing the query
    error_log("ID: " . $id);
    error_log("First Name: " . $fname);
    error_log("Last Name: " . $lname);

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE names SET fname = :fname, lname = :lname WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->execute();

        $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));
    } catch (PDOException $e) {
        // Debugging: Log any exceptions
        error_log("Error: " . $e->getMessage());
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }
    $conn = null;
    return $response;
});

// Endpoint to delete data from the database
$app->delete('/deleteName/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM names WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }
    $conn = null;
    return $response;
});

$app->run();
?>
