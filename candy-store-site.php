<?php
// ============================================================
// The Candy Store - header, menu, index, receipt and footer in one file
// Open:  candy-store-site.php   or   candy-store-site.php?page=receipt
// Needs PHP 8+ (the match example uses PHP 8 syntax)
// ============================================================

// ============================================================
// SITE PARTS: header, menu, footer  (stand-ins for header.php / footer.php)
// ============================================================
$page  = $_GET['page'] ?? 'index';
$pages = [
    'index'   => 'Home',
    'receipt' => 'Receipt',
];
if (!array_key_exists($page, $pages)) {
    $page = 'index';
}

function site_header($title) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?> - The Candy Store</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
    <h1>The Candy Store</h1>
</header>
<?php }

function site_menu($current) {
    global $pages; ?>
    <nav class="nav">
        <?php foreach ($pages as $key => $label) { ?>
            <a href="?page=<?= $key ?>"<?= $key === $current ? ' aria-current="page"' : '' ?>><?= $label ?></a>
            <?php if ($key !== array_key_last($pages)) echo '|'; ?>
        <?php } ?>
    </nav>
<?php }

function site_footer() { ?>
    <footer class="foot">&copy; <?= date('Y') ?> The Candy Store</footer>
<?php }

// ---------- 1. if statement ----------
$name     = 'Ivy';
$greeting = 'Hello';
if ($name !== '') {
    $greeting = 'Welcome back, ' . $name;
}

// ---------- 2. if ... else ----------
$stock = 5;
if ($stock > 0) {
    $message = 'In stock';
} else {
    $message = 'Sold out';
}

// ---------- 3. ternary operator ----------
$message3 = ($stock > 0) ? 'In stock' : 'Sold out';

// ---------- 4. if ... elseif ... else ----------
$ordered = 3;
if ($stock > 0) {
    $message4 = 'In stock';
} elseif ($ordered > 0) {
    $message4 = 'Coming soon';
} else {
    $message4 = 'Sold out';
}

// ---------- 5. switch ----------
$day = 'Monday';
switch ($day) {
    case 'Monday':
        $offer = '20% off chocolates';
        break;
    case 'Tuesday':
        $offer = '20% off mints';
        break;
    default:
        $offer = 'Buy three packs, get one free!';
}

// ---------- 6. match ----------
$offer6 = match ($day) {
    'Monday'            => '20% off chocolates',
    'Saturday', 'Sunday' => '20% off mints',
    default             => '10% off your entire order',
};

// ---------- 7-9 + 10 data ----------
$price = 1.99;
$products = [
    'Toffee' => 2.99,
    'Mints'  => 1.99,
    'Fudge'  => 3.49,
];

// ---------- 11. multiple ifs ----------
$stock11 = 25;
if ($stock11 >= 10) {
    $message11 = 'Good availability';
}
if ($stock11 > 0 && $stock11 < 10) {
    $message11 = 'Low stock';
}
if ($stock11 == 0) {
    $message11 = 'Out of stock';
}

// ============================================================
// RECEIPT DATA  (name, unit price, quantity)
// ============================================================
$order = [
    ['Toffee', 2.99, 2],
    ['Mints',  1.99, 3],
    ['Fudge',  3.49, 1],
];
$subtotal = 0;
foreach ($order as $line) {
    $subtotal += $line[1] * $line[2];
}
$discountRate = match (true) {
    $subtotal >= 20 => 0.10,
    $subtotal >= 10 => 0.05,
    default         => 0,
};
$discount = $subtotal * $discountRate;
$taxRate  = 0.12;
$tax      = ($subtotal - $discount) * $taxRate;
$total    = $subtotal - $discount + $tax;
$receiptNo = str_pad('1001', 6, '0', STR_PAD_LEFT);
function money($n) { return '$' . number_format($n, 2); }
?>
<?php site_header($pages[$page]); ?>
<?php site_menu($page); ?>

<?php if ($page === 'index') { ?>
    
    

    <!-- 1 -->
    <div class="label">1. if statement</div>
    <section class="banner">
        <h1>The Candy Store</h1>
        <h2><?= $greeting ?></h2>
    </section>

    <!-- 2 -->
    <div class="label">2. if ... else</div>
    <section class="banner">
        <h1>The Candy Store</h1>
        <h2>Chocolate</h2>
        <p><?= $message ?></p>
    </section>

    <!-- 3 -->
    <div class="label">3. ternary operator</div>
    <section class="banner">
        <h1>The Candy Store</h1>
        <h2>Chocolate</h2>
        <p><?= $message3 ?></p>
    </section>

    <!-- 4 -->
    <div class="label">4. if ... elseif ... else</div>
    <section class="banner">
        <h1>The Candy Store</h1>
        <h2>Chocolate</h2>
        <p><?= $message4 ?></p>
    </section>

    <!-- 5 -->
    <div class="label">5. switch</div>
    <section class="banner">
        <h1>The Candy Store</h1>
        <h2>Offers on <?= $day ?></h2>
        <p><?= $offer ?></p>
    </section>

    <!-- 6 -->
    <div class="label">6. match</div>
    <section class="banner">
        <h1>The Candy Store</h1>
        <h2>Offers on <?= $day ?></h2>
        <p><?= $offer6 ?></p>
    </section>

    <!-- 7 -->
    <div class="label">7. while loop</div>
    <section class="banner">
        <h1>The Candy Store</h1>
        <h2>Prices for Multiple Packs</h2>
        <p>
            <?php
            $counter = 1;
            $packs   = 5;
            while ($counter <= $packs) {
                echo $counter;
                echo ' packs cost $';
                echo number_format($price * $counter, 2);
                echo '<br>';
                $counter++;
            }
            ?>
        </p>
    </section>

    <!-- 8 -->
    <div class="label">8. do ... while loop</div>
    <section class="banner">
        <h1>The Candy Store</h1>
        <h2>Prices for Multiple Packs</h2>
        <p>
            <?php
            $packs = 5;
            do {
                echo $packs;
                echo ' packs cost $';
                echo number_format($price * $packs, 2);
                echo '<br>';
                $packs--;
            } while ($packs > 0);
            ?>
        </p>
    </section>

    <!-- 9 -->
    <div class="label">9. for loop</div>
    <section class="banner">
        <h1>The Candy Store</h1>
        <h2>Prices for Multiple Packs</h2>
        <p>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo $i;
                echo ' packs cost $';
                echo number_format($price * $i, 2);
                echo '<br>';
            }
            ?>
        </p>
    </section>

    <!-- 10 -->
    <div class="label">10. foreach loop</div>
    <section class="banner">
        <h1>The Candy Store</h1>
        <h2>Price List</h2>
        <table>
            <tr>
                <th>Item</th>
                <th>Price</th>
            </tr>
            <?php foreach ($products as $item => $price_each) { ?>
            <tr>
                <td><?= $item ?></td>
                <td>$<?= number_format($price_each, 2) ?></td>
            </tr>
            <?php } ?>
        </table>
    </section>

    <!-- 11 -->
    <div class="label">11. multiple ifs + header / footer</div>
    <section class="banner dark">
        <h1>The Candy Store</h1>
        <?php site_menu($page); ?>
        <h2>Chocolate</h2>
        <p><?= $message11 ?></p>
        <?php site_footer(); ?>
    </section>
<?php } ?>

<?php if ($page === 'receipt') { ?>
    <section class="banner">
        <h2>Receipt #<?= $receiptNo ?></h2>
        <p><?= date('F j, Y, g:i a') ?></p>
        <table>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
            <?php foreach ($order as $line) { ?>
            <tr>
                <td><?= $line[0] ?></td>
                <td><?= money($line[1]) ?></td>
                <td><?= $line[2] ?></td>
                <td><?= money($line[1] * $line[2]) ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">Subtotal</td>
                <td><?= money($subtotal) ?></td>
            </tr>
            <?php if ($discount > 0) { ?>
            <tr>
                <td colspan="3">Discount (<?= $discountRate * 100 ?>%)</td>
                <td>-<?= money($discount) ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">Tax (<?= $taxRate * 100 ?>%)</td>
                <td><?= money($tax) ?></td>
            </tr>
            <tr>
                <th colspan="3">Total</th>
                <th><?= money($total) ?></th>
            </tr>
        </table>
        <p>Thank you for shopping at The Candy Store!</p>
    </section>
<?php } ?>

<?php site_footer(); ?>
</body>
</html>
