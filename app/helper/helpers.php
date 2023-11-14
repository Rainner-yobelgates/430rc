<?php 
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
?>