<?php
session_start();
require_once('db_connection.php');

// questa è la VERSIONE SICURA (con MITIGAZIONE SQL INJECTION)

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    $sql = "SELECT * FROM movies WHERE title LIKE ?";
    $stmt = $conn->prepare($sql);

    $searchTerm = '%' . $searchTerm . '%';
    $stmt->bind_param("s", $searchTerm);
} else {
    $sql = "SELECT * FROM movies";
    $stmt = $conn->prepare($sql);
}

try {
    $stmt->execute();
    $result = $stmt->get_result();
} catch (\Throwable $th) {
    $error = "Error: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage Film</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        .hide{
            display: none;
        }
    </style>
</head>
<body>

<?php include "_nav.php";?>

<div class="container">
    <h1 class="text-center my-4">Secure Movie Platform</h1>
    
    <div class="row">
        <div class="col-md-6 mx-auto mb-4">
            <form action="<?php echo($_SERVER["SCRIPT_NAME"]); ?>" method="get" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cerca film">
                <button type="submit" class="btn btn-primary">Cerca</button>
            </form>

            <div id="msgerr" class="hide">
                <?php if(isset($error)){
                    echo $error; 
                } ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
        <?php if (isset($result) && $result->num_rows > 0) { ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Year</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['year'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <h2>Nessun film trovato</h2>
        <?php } ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    btnerr = document.querySelector('#btnerr')
    if(btnerr){
        btnerr.addEventListener('click',(e)=>{
            msgerr = document.querySelector('#msgerr')
            msgerr.classList.toggle("hide");
        })
    }
</script>

</body>
</html>