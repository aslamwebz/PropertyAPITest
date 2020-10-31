<?php

namespace App\Model;

use PDO;
use Config\View;
use App\Helpers\Helper;

/**
 * Property Model
 *
 * PHP version 7.0
 */
class Property extends \Config\DB
{

    /**
     * Get single property
     *
     * @return array
     */
    public static function getSingle($uuid)
    {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * from properties WHERE uuid=?');
        $stmt->execute([$uuid]);
        return $stmt->fetch();
    }

    /**
     * Get all the properties as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * from properties ORDER BY updated_at DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add product to the database
     *
     * @return message or retry
     */
    public static function addProperty($request, $FILES)
    {

        $db = static::getDB();
        // Get details from request and sanitize
        $uuid = Helper::sanitize($request['uuid']);
        $county = Helper::sanitize($request['county']);
        $country = Helper::sanitize($request['country']);
        $town = Helper::sanitize($request['town']);
        $description = Helper::sanitize($request['description']);
        $address = Helper::sanitize($request['address']);
        $image_full = "";
        $latitude = "";
        $longitude = "";
        $num_bedrooms = Helper::sanitize($request['num_bedrooms']);
        $num_bathrooms = Helper::sanitize($request['num_bathrooms']);
        $price = Helper::sanitize($request['price']);
        $type = Helper::sanitize($request['type']);
        $saleorrent = Helper::sanitize($request['saleorrent']);
        $localoronline = "local";
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        // Image resize and save

        //Save the original file
        $imagename = $FILES['image_local']['name'];
        $source = $FILES['image_local']['tmp_name'];
        $target = "img/" . $imagename;
        move_uploaded_file($source, $target);

        $imagepath = $imagename;
        $save = "img/" . 'Thumb' . $imagepath; //This is the new file you saving
        $file = "img/" . $imagepath; //This is the original file

        //image resize
        list($width, $height) = getimagesize($file);

        $modwidth = 100;

        $diff = $width / $modwidth;

        $modheight = $height / $diff;
        $tn = imagecreatetruecolor($modwidth, $modheight);
        $image = imagecreatefromjpeg($file);
        imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);

        imagejpeg($tn, $save, 100);

        $image_local = $imagename;
        $image_thumbnail = $save;

        // execute or return error
        try {
            $stmt = $db->prepare('INSERT INTO properties VALUES (?, ?, ?, ?,?,?, ?, ?, ?,?,?, ?, ?, ?,?,?,?,?,?)');
            $stmt->execute([$uuid, $county, $country, $town, $description, $address, $image_full, $image_thumbnail, $image_local, $latitude, $longitude, $num_bedrooms, $num_bathrooms, $price, $type, $saleorrent, $localoronline, $created_at, $updated_at]);
            $property = Property::getAll();

            // success render list
            $msg = 'Created Successfully!';
            View::render('index', $property, $msg);
        } catch (\PDOException $e) {
            $data = $request;
            $error['uuid'] = "The uuid already exits please recheck";
            //failure render view with older data
            View::render('/create', $data, '', $error);
        }

        // Output message
        return $msg = 'Created Successfully!';
    }

    public static function updateProperty($request, $FILES)
    {

        $db = static::getDB();
        // Get details from request and sanitize
        $uuid = Helper::sanitize($request['uuid']);
        $county = Helper::sanitize($request['county']);
        $country = Helper::sanitize($request['country']);
        $town = Helper::sanitize($request['town']);
        $description = Helper::sanitize($request['description']);
        $address = Helper::sanitize($request['address']);
        $latitude = "";
        $longitude = "";
        $num_bedrooms = Helper::sanitize($request['num_bedrooms']);
        $num_bathrooms = Helper::sanitize($request['num_bathrooms']);
        $price = Helper::sanitize($request['price']);
        $type = Helper::sanitize($request['type']);
        $saleorrent = Helper::sanitize($request['saleorrent']);
        $localoronline = "local";
        $created_at = Helper::sanitize($request['created_at']);
        $updated_at = date('Y-m-d H:i:s');

        // Image resize and save

        if (isset($FILES['image_local_new']["name"]) && $FILES['image_local_new']["name"] !== "") {
            //Save the original file
            $imagename = $FILES['image_local_new']['name'];
            $source = $FILES['image_local']['tmp_name'];
            $target = "img/" . $imagename;
            move_uploaded_file($source, $target);

            $imagepath = $imagename;
            $save = "img/" . 'Thumb' . $imagepath; //This is the new file you saving
            $file = "img/" . $imagepath; //This is the original file

            //image resize
            list($width, $height) = getimagesize($file);
            $modwidth = 100;
            $diff = $width / $modwidth;

            $modheight = $height / $diff;
            $tn = imagecreatetruecolor($modwidth, $modheight);
            $image = imagecreatefromjpeg($file);
            imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);

            imagejpeg($tn, $save, 100);

            $image_local = $imagename;
            $image_thumbnail = $save;
        } else {
            $image_full = Helper::sanitize($request['image_full']);
            $image_local = Helper::sanitize($request['image_local']);
            $image_thumbnail = Helper::sanitize($request['image_thumbnail']);
        }

        // execute or return error
        try {

            $sql = "UPDATE properties SET county=?, country=?, town=?, description=?,address=?, image_full=?, image_thumbnail=?, image_local=?, latitude=?, longitude=?, num_bedrooms=?, num_bathrooms=?, price=?,type=?,saleorrent=?,localoronline=?,created_at=?,updated_at=? WHERE uuid=?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$county, $country, $town, $description, $address, $image_full, $image_thumbnail, $image_local, $latitude, $longitude, $num_bedrooms, $num_bathrooms, $price, $type, $saleorrent, $localoronline, $created_at, $updated_at, $uuid]);

            // success render list
            $property = Property::getAll();
            $msg = 'Updated Successfully!';
            View::render('index', $property, $msg);
        } catch (\PDOException $e) {
            $data = $request;
            $FILES = $FILES;
            $error['uuid'] = "The uuid already exits please recheck";
            //failure render view with older data
            View::render('/update', $data, '', $error);
        }

        // Output message
        return $msg = 'Created Successfully!';
    }

    /**
     * Delete the selected product(s) from the database
     *
     * @return message
     */
    public static function deleteProperty($uuid)
    {
        $db = static::getDB();

        $stmt = $db->prepare('DELETE FROM properties WHERE uuid = ?');
        $stmt->execute([$uuid]);

        return $msg = 'You have deleted the selected products!';
    }

    /**
     * Delete the selected product(s) from the database
     *
     * @return array
     */
    public static function filterProperty($request)
    {


        //Search and filter the database dynamically
        $db = static::getDB();
        $conditions = [];
        $parameters = [];


        if ($request['num_bedrooms'] > 0) {
            $conditions[] = 'num_bedrooms LIKE ?';
            $parameters[] = $request['num_bedrooms'];
        }

        if ($request['saleorrent'] === "sale" || $request['saleorrent'] === "rent") {
            $conditions[] = 'saleorrent LIKE ?';
            $parameters[] = $request['saleorrent'];
        }

        if ($request['type'] !== "") {
            $conditions[] = 'type LIKE ?';
            $parameters[] = $request['type'];
        }

        if ($request['min'] >= 0 && $request['max'] > 0) {
            $conditions[] = 'price BETWEEN ? AND ?';
            $parameters[] = $request['min'];
            $parameters[] = $request['max'];
        }

        if ($request['uuid'] !== "") {
            $conditions[] = 'uuid LIKE ?';
            $parameters[] = '%' . $request['uuid'] . "%";
        }


        $sql = "SELECT * FROM properties";

        if ($conditions) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($parameters);
        $property = $stmt->fetchAll();

        View::render('index',  $property);
    }
}
