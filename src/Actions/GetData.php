<?php

namespace App\Actions;

use GuzzleHttp\Client;
use PDO;
use App\Helpers\Helper;

/**
 * Get Api Data
 *
 * PHP version 7.0
 */
class GetData extends \Config\DB
{

    /**
     * Get data from the api
     *
     * @return array
     */
    public static function getData()
    {

        $db = static::getDB();

        //Get the data from the mtc dev server and deleiver as an array
        $client = new Client();
        $response = $client->request('GET', "https://trialapi.craig.mtcdevserver.com/api/properties?api_key=" . \Config\Config::API_KEY);

        // If api error resnpond error code else proceed
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            return $response->getStatusCode();
        } else {

            $body = $response->getBody();
            $data = json_decode($body, true);
            $data = $data['data'];

            // Get the old data stored in database
            $oldData = \App\Model\Property::getAll();

            // Filter the data for the existed values and get only new values
            // $filtered = array_filter(
            //     $data,
            //     function ($item) use ($oldData) {
            //         if (!in_array($item, $oldData)) {
            //             return $item;
            //         }
            //     },
            //     ARRAY_FILTER_USE_KEY
            // );

            $data = array_unique($data, SORT_REGULAR);

            foreach ($data as $property) {
                $uuid = Helper::sanitize($property['uuid']);
                $county = Helper::sanitize($property['county']);
                $country = Helper::sanitize($property['country']);
                $town = Helper::sanitize($property['town']);
                $description = Helper::sanitize($property['property_type']['description']);
                $address = Helper::sanitize($property['address']);
                $image_full = Helper::sanitize($property['image_full']);
                $image_thumbnail = Helper::sanitize($property['image_thumbnail']);
                $image_local = '';
                $latitude = Helper::sanitize($property['latitude']);
                $longitude = Helper::sanitize($property['longitude']);
                $num_bedrooms = Helper::sanitize($property['num_bedrooms']);
                $num_bathrooms = Helper::sanitize($property['num_bathrooms']);
                $price = Helper::sanitize($property['price']);
                $type = Helper::sanitize($property['property_type']['title']);
                $saleorrent = Helper::sanitize($property['type']);
                $localoronline = "online";
                $created_at = Helper::sanitize($property['created_at']);
                $updated_at = Helper::sanitize($property['updated_at']);

                try {
                    //insert the data into the database
                    $stmt = $db->prepare('INSERT INTO properties VALUES (?, ?, ?, ?,?,?, ?, ?, ?,?,?, ?, ?, ?,?,?,?,?,?)');
                    $stmt->execute([$uuid, $county, $country, $town, $description, $address, $image_full, $image_thumbnail, $image_local, $latitude, $longitude, $num_bedrooms, $num_bathrooms, $price, $type, $saleorrent, $localoronline, $created_at, $updated_at]);
                    // $products = Product::getAll();
                } catch (\Throwable $th) {

                    $db = static::getDB();

                    $properties = \App\Model\Property::getAll();

                    foreach ($properties as $property) {
                        $stmt = $db->prepare('DELETE FROM properties WHERE localoronline = "online"');
                        $stmt->execute();
                    }

                    $stmt = $db->prepare('INSERT INTO properties VALUES (?, ?, ?, ?,?,?, ?, ?, ?,?,?, ?, ?, ?,?,?,?,?,?)');
                    $stmt->execute([$uuid, $county, $country, $town, $description, $address, $image_full, $image_thumbnail, $image_local, $latitude, $longitude, $num_bedrooms, $num_bathrooms, $price, $type, $saleorrent, $localoronline, $created_at, $updated_at]);
                }
            }
        }
    }
}
