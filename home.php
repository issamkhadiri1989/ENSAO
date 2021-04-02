<?php define('COUNTRY', 'MOROCCO')?>
<!doctype html>
<html>
<head>
    <title>Houses</title>
</head>

<body>
<h1>List of houses to sell <strong>
        <?= COUNTRY ?>
    </strong></h1>
<?php
require_once "House.php";
$owner1 = new Owner('Owner 1');
$owner2 = new Owner('Owner 2');
$lot = [
    new House(250000, 3, 'Address 1', $owner1),
    new House(350000, 4, 'Address 2', $owner1),
    new House(450000, 4, 'Address 3', $owner2),
];
foreach ($lot as $house) {
    ?>
<div>
    <address><?= $house->getAddress() ?></address>
    <label>
        <span><?= $house->getRooms()?> rooms</span>
        <strong><?= $house->getPrice() ?> MAD <small>
                <?= House::VAT?> % of VAT
            </small></strong></label>
    <p>Owned by <u><?= $house->getOwner()->getName()?></u></p>
</div>
<?php
}
?>
<h2><?= Owner::getSum() ?> MAD</h2>

</body>
</html>