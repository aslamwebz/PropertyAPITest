<form action="filter" method="post">
    <div class="form-group">
        <select class="form-control filter" id="filter_from" name="num_bedrooms">
            <option value="" namespace="num_bedrooms">Filter by Bedrooms</option>
            <?php
            for ($i = 1; $i <= 20; $i++) { ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control filter" id="filter_type" name="saleorrent">
            <option value="">Filter Sale/Rent</option>
            <option value="rent">Rent</option>
            <option value="sale">Sale</option>
        </select>
    </div>
    <div class="form-group">

        <select class="form-control filter" id="filter_type" name="type">
            <option value="">Property Type</option>
            <option value="Detatched">Detatched</option>
            <option value="Flat">Flat</option>
            <option value="Semi-detached">Semi-detached</option>
            <option value="Bungalow">Bungalow</option>
            <option value="End of Terrace">End of Terrace</option>
            <option value="Terraced">Terraced</option>
            <option value="Cottage">Cottage</option>
        </select>
    </div>
    <div class="form-group">
        <label for="price" class="col-form-label">Price</label>
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" placeholder="Min" name="min" type="number">
            </div>
            <div class="col-md-6">
                <input class="form-control" placeholder="Max" name="max" type="number">
            </div>
        </div>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Search" name="uuid" type="text" placeholder="UUID">
        <br>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Apply filter">
        </div>
    </div>
</form>