<?php require 'includes/head.php'; ?>

<div class="property container-fluid">
    <div class="container property__header">
        <div class="row">
            <h2 for="sku" class="col-sm-8 ">Property List</h2>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar col-md-2">
                <?php require 'includes/sidebar.php'; ?>
            </div>
            <div class="container-fluid property__container col-md-10">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">UUID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Bedrooms</th>
                            <th scope="col">Bathrooms</th>
                            <th scope="col">Sale Or Rent</th>
                            <th scope="col">Property Type</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $property) : ?>

                            <tr>
                                <td><?= $property['uuid']; ?></td>
                                <td>
                                    <img src="<?= $property['image_thumbnail']; ?>" alt="">
                                </td>
                                <td><?= $property['num_bedrooms']; ?></td>
                                <td><?= $property['num_bathrooms']; ?></td>
                                <td><?= $property['saleorrent']; ?></td>
                                <td><?= $property['type']; ?></td>
                                <td><?= $property['price'] . ' $'; ?></td>
                                <td>
                                    <form action="/edit" method="post">
                                        <input type="hidden" name="edit" value="<?= $property['uuid']; ?>">
                                        <button class="btn btn-info" type="submit">Edit</button>
                                    </form>
                                    <form action="/delete" method="post">
                                        <input type="hidden" name="delete" value="<?= $property['uuid']; ?>">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>


                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

<?php require 'includes/footer.php' ?>