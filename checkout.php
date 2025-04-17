<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <style>
        body{
            background-color: #fff5fa;
        }
        .phpsuccess {
            background-color: transparent;
        }

        .product-summary {
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        
    </style>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databse = "azra";

    $conn = mysqli_Connect($servername, $username, $password, $databse);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_POST['name'];
            $number = $_POST['number'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $item_list = $_POST['item_list'];
            $total = $_POST['total'];

            $sql = "INSERT INTO serum_details (name, phone_no, email, address, product_details, total) 
                    VALUES ('$name', '$number', '$email', '$address', '$item_list', '$total')";

            if (mysqli_query($conn, $sql)) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong class="phpsuccess">Success!</strong> Order placed successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Unable to place the order: ' . mysqli_error($conn) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        }
    }
    ?>

    <div class="product-summary text-center">
        <ul id="itemList" class="list-unstyled"></ul>
        <p id="totalDisplay" class="fw-bold"></p>
    </div>

    <section class="fourth-section" id="contact_us">
        <h1 class="heading">Complete The Process:</h1>
        <form action="" method="POST">
            <input class="form-input" type="text" name="name" placeholder="Enter your name" required><br>
            <input class="form-input" type="text" name="number" placeholder="Enter your phone number" required><br>
            <input class="form-input" type="email" name="email" placeholder="Enter your email" required><br>
            <textarea class="form-input" name="address" placeholder="Enter your address" required></textarea><br>

            <!-- Hidden fields -->
            <input type="hidden" id="item_list" name="item_list">
            <input type="hidden" id="total" name="total">

            <input class="btn-sub" type="submit" value="Submit"><br>
            <input class="btn-res" type="reset" value="Reset">
        </form>
    </section>

    <script>
        let names = localStorage.getItem('names') || '';
        let prices = localStorage.getItem('prices') || '';
        let total = localStorage.getItem('total') || 0;

        let nameList = names.split(',');
        let priceList = prices.split(',');

        const itemList = document.getElementById("itemList");
        itemList.innerHTML = '';
        for (let i = 0; i < nameList.length; i++) {
            const li = document.createElement("li");
            li.textContent = `${nameList[i]} - Rs.${priceList[i]}`;
            itemList.appendChild(li);
        }

        const totalDisplay = document.getElementById("totalDisplay");
        totalDisplay.textContent = total ? `Total: Rs.${total}` : "No total found.";

        document.querySelector("form").addEventListener("submit", function (event) {
            event.preventDefault(); // temporarily prevent submit for dev

            let itemListStr = "";
            for (let i = 0; i < nameList.length; i++) {
                itemListStr += `${nameList[i]} - Rs.${priceList[i]}`;
                if (i < nameList.length - 1) {
                    itemListStr += ", ";
                }
            }

            document.getElementById("item_list").value = itemListStr;
            document.getElementById("total").value = total;

            this.submit(); // now allow submit
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>
