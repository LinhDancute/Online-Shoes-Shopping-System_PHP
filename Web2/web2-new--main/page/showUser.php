<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Price</th>
                <th>Name</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        require_once("dbconnect.php");
        $query = "select * from product";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            print <<<HERE
                <tr>
                <td>$row[ID]</td>
                <td>$row[Price]</td>
                <td>$row[Name]</td>
                <td>$row[Size]</td>
                <td>$row[Quantity]</td>
                <td>$row[Category_ID]</td>
                <td>$row[Brand_ID]</td>
                <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Update
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-danger data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Delete
                    </button>
                </td>
                </tr>
            HERE;
        }
        ?>
    </table>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create new product
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3 row">
                            <div class="col-6">
                                <label for="Name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="Name" name="Name">
                                <label for="Price" class="form-label">Price</label>
                                <input type="text" class="form-control" id="Price">
                                <label for="Size" class="form-label">Size</label>
                                <input type="text" class="form-control" id="Size">
                                <label for="Quantity" class="form-label">Quantity</label>
                                <input type="text" class="form-control" id="Quantity">
                                <label for="Category" class="form-label">Category</label>
                                <select class="form-select" aria-label="Default select example" id="Category">
                                    <?php
                                    $query = "select * from category";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value=" . $row["ID"] . ">" . $row["Name"] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="Brand" class="form-label">Brand</label>
                                <select class="form-select" aria-label="Default select example" id="Brand">
                                    <?php
                                    $query = "select * from Brand";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value=" . $row["ID"] . ">" . $row["Name"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6 text-center">
                                <input type="file" name="img" id="img_file" class="form-control-plain-text mb-3" onchange="Displayimg()">
                                <img src="" class="rounded img-fluid img-thumbnail" alt="product_img" id="product_img">
                                <script>
                                    function Displayimg() {
                                        console.log("Changed");
                                        const img_file = document.getElementById("img_file");
                                        const img = document.getElementById("product_img");
                                        img.src = "../image/" + img_file.value.split(/(\\|\/)/g).pop();
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>