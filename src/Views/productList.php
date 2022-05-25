<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Scandiweb-test</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="/js/list.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Product List</span>
                    <form class="d-flex">
                        <button class="btn btn-sm btn-outline-success me-2" id="add-product-btn" type="button">ADD</button>
                        <button class="btn btn-sm btn-outline-danger" id="delete-product-btn" type="button">MASS DELETE</button>
                    </form>
                </div>
            </nav>
        </header>

        <main>
            <div class="container py-3">
            
            <div id="product-list" class="row">
                <?php 
                    $productTypes = array(
                        "Book" => "Weight",
                        "DVD" => "Size",
                        "Furniture" => "Dimensions",
                    );

                    $products = (new Nedius\Models\Product)->all();
                    foreach ($products as $product) {
                        echo '<div class="col-md-3">
                                <div class="card mb-4 box-shadow">
                                    <div class="card-body">
                                        <!-- <div class="d-flex justify-content-between align-items-center">
                                            <p class="card-text mb-1">checkbox</p>
                                        </div> -->
                                        <div class="form-check">
                                            <input class="delete-checkbox form-check-input position-static" type="checkbox" value="' . $product->getSku() . '">
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <p class="card-text mb-1">' . $product->getSku() . '</p>
                                            <p class="card-text mb-1">' . $product->getName() . '</p>
                                            <p class="card-text mb-1">' . number_format($product->getPrice(), 2, '.', "") . ' $</p>
                                            <p class="card-text mb-1">' . $productTypes[$product->getType()] . ': ' . $product->getDescription() . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                ?>
            </div>
                
            </div>
        </main>

        <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 my-4 mx-5 border-top">
            <div class="col-md-4 d-flex flex-column align-items-center">
                <div class="text-muted">Scandiweb Test assignment</div>
                <div class="text-muted">&copy; 2022 nedius</div>
            </div>
        </footer>
    </body>
</html>