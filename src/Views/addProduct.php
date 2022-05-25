<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Scandiweb-test</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="/js/add.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Product Add</span>
                    <form class="d-flex">
                        <button class="btn btn-sm btn-outline-success me-2" id="save-btn" type="button">Save</button>
                        <button class="btn btn-sm btn-outline-danger" id="cancel-btn" type="button">Cancel</button>
                    </form>
                </div>
            </nav>
        </header>

        <main>
            <div class="container py-3">
                <form id="product_form">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label" for="sku">SKU</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" required>
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label class="col-sm-1 col-form-label"  for="name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label class="col-sm-1 col-form-label"  for="price">Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label class="col-sm-1 col-form-label"  for="type">Type</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="productType" name="type" required>
                                <option value="Book">Book</option>
                                <option value="DVD">DVD</option>
                                <option value="Furniture">Furniture</option>
                            </select>
                        </div>
                    </div>
                    <div id="typeFormGroup" class="form-group row">
                        <div id="DVD-div" style="display:none">
                            <div class="form-group row pt-3">
                                <label class="col-sm-1 col-form-label" for="size">Size (MB)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="size" name="size" placeholder="Size" required>
                                </div>
                            </div>
                            <p class="mt-2">Please, provide size</p>
                        </div>
                        <div id="Book-div" style="display:none">
                            <div class="form-group row pt-3">
                                <label class="col-sm-1 col-form-label" for="weight">Weight (KG)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="weight" name="weight" placeholder="Weight" required>
                                </div>
                            </div>
                            <p class="mt-2">Please, provide weight</p>
                        </div>
                        <div id="Furniture-div" style="display:none">
                            <div class="form-group row pt-3">
                                <label class="col-sm-1 col-form-label" for="height">Height (CM)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="height" name="descrheightiption" placeholder="Height" required>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <label class="col-sm-1 col-form-label" for="width">Width (CM)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="width" name="width" placeholder="Width" required>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <label class="col-sm-1 col-form-label" for="length">Length (CM)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="length" name="length" placeholder="Length" required>
                                </div>
                            </div>
                            <p class="mt-2">Please, provide dimensions</p>
                        </div>
                    </div>

                    <h5 id="formStatus" class="text-success mt-3"></h5>
                    <ul id="formErrors"></ul>

                </form>
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