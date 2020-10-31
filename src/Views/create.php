<?php require
    'includes/head.php';
?>

<div class="product__new container main">
    <div class="product__newForm">
        <div class="container">
            <form action="insert" method="post" enctype="multipart/form-data">
                <div class="product__newTitle ">
                    <div class="row">
                        <h2 for="submitButton" class="col-sm-8 ">Add Property</h2>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class=" col-md-12 ">
                        <div class="form-group row">
                            <label for="uuid" class="col-md-2 col-form-label">ID</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="uuid" name="uuid" required value="<?= $data['uuid'] ?? '' ?>">
                                <label for="error"><?= $error['uuid'] ?? '' ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="county" class="col-md-2  col-form-label">County</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="county" name="county" required value="<?= $data['county'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-md-2  col-form-label">Country</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="country" name="country" required value="<?= $data['name'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="town" class="col-md-2  col-form-label">Town</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="town" name="town" required value="<?= $data['town'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Description" class="col-md-2  col-form-label">Description</label>
                            <div class="col-sm-6">
                                <textarea name="description" id="" cols="70" rows="10" required><?= $data['description'] ?? '' ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-2  col-form-label">Address</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="address" name="address" required value="<?= $data['address'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-2  col-form-label">Image</label>
                            <div class="col-sm-6">
                                <input type="file" name="image_local" id="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="num_bedrooms" class="col-md-2  col-form-label">Number Of rooms: </label>
                            <div class="col-sm-6">
                                <select name="num_bedrooms">
                                    <?php for ($i = 1; $i <= 20; $i++) : ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="num_bathrooms" class="col-md-2  col-form-label">Number Of bathrooms: </label>
                            <div class="col-sm-6">
                                <select name="num_bathrooms">
                                    <?php for ($i = 1; $i <= 20; $i++) : ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-2  col-form-label">Price</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="price" name="price" required value="<?= $data['price'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-2  col-form-label">Property Type </label>
                            <div class="col-sm-6">
                                <select name="type">
                                    <option value="Detatched">Detatched</option>
                                    <option value="Semi-detached">Semi-detached</option>
                                    <option value="Terraced">Terraced</option>
                                    <option value="Flat">Flat</option>
                                    <option value="Bungalow">Bungalow</option>
                                    <option value="End of Terrace">End of Terrace</option>
                                    <option value="Cottage">Cottage</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-2  col-form-label">Property Type </label>
                            <div class="col-md-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="saleorrent" id="saleorrent1" value="sale" checked>
                                    <label class="form-check-label" for="saleorrent1">
                                        Rent
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="saleorrent" id="saleorrent2" value="rent">
                                    <label class="form-check-label" for="saleorrent2">
                                        Sale
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <input type="submit" class="btn btn-info" id="submitButton" name="submit" value="Save">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'includes/footer.php' ?>