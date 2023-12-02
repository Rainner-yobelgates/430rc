<?php 

use Illuminate\Support\Facades\Session;
function get_list_status_product()
{
    return [
        80 => 'Active',
        98 => 'Sold',
        99 => 'Inactive'
    ];
}
function get_list_status()
{
    return [
        80 => 'Active',
        99 => 'Inactive'
    ];
}
function list_category_product()
{
    return [
        'Shirt',
        'Drinking Bottle',
        'Sock'
    ];
}
function list_size_product()
{
    return [
        'S',
        'M',
        'L',
        'XL',
        'XXL',
        '250 Ml',
        '500 Ml',
        'All Size',
    ];
}

function list_days($index = Null)
{
    return [
        'monday' . $index,
        'tuesday' . $index,
        'wednesday' . $index,
        'thursday' . $index,
        'friday' . $index,
        'saturday' . $index,
        'sunday' . $index,
    ];
}

function notif_cart(){
    $getNotifCart = Session::get('cart');
    return $getNotifCart ?? [];
}

function get_api_province(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: " . env('KEY_RAJAONGKIR')
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    return "cURL Error #:" . $err;
    } else {
    return $response;
    }
}

function get_api_city(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: " . env('KEY_RAJAONGKIR')
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    return "cURL Error #:" . $err;
    } else {
    return $response;
    }
}

function get_courier($origin, $destination, $weight, $courier){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=". $origin ."&destination=". $destination ."&weight=".$weight."&courier=".$courier,
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: " . env('KEY_RAJAONGKIR')
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        $response = json_decode($response, true);
        if (isset($response['rajaongkir']['results'])) {
            return $response['rajaongkir']['results'][0]['costs'];
        }
    }
}
?>