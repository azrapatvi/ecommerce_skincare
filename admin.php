<!--table is copy pasted from bootstrap and the search bar etc came from the data tables 
website from the website we have to copy paste the css and js cdn and also we have to copy
the scipt which below 
also copy paste the jquery cdn uncompressed file from chrome -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>admin panel</title>
    <style>
        *{
            margin: 10px 5px 0 5px;
        }
    </style>
</head>
<body>
    <?php
        $servername="localhost";
        $username="root";
        $password="";
        $database="azra";

        $conn=mysqli_connect($servername,$username,$password,$database);
        if(!$conn){
            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
    connection failed;
  </div>
</div>';
        }
        
    ?>
    <h3 style="text-align:center;padding:5px;">Admin Panel</h3><hr>
    <table class="table table-striped table-hover" id="myTable" style="padding:10px 20px;">
        <thead>
          <tr>
            <th scope="col">name</th>
            <th scope="col">phone no</th>
            <th scope="col">email</th>
            <th scope="col">address</th>
            <th scope="col">product details</th>
            <th scope="col">total</th>
          </tr>
        </thead>
        <tbody  class="table-group-divider">
        <?php
            $sql="SELECT * FROM `serum_details`";
            $result=mysqli_query($conn,$sql);

            while($row=mysqli_fetch_assoc($result)){
                $name=$row['name'];
                $phone_no=$row['phone_no'];
                $email=$row['email'];
                $address=$row['address'];
                $product_details=$row['product_details'];
                $total=$row['total'];
                echo '<tr>
                        <th scope="row">'.$name.'</th>
                        <td>'.$phone_no.'</td>
                        <td>'.$email.'</td>
                        <td>'.$address.'</td>
                        <td>'.$product_details.'</td>
                        <td>'.$total.'</td>
                      </tr>';
            }


    
        ?>
        </tbody>
      </table>
      <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
      <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
      <script>
        let table = new DataTable('#myTable');
      </script>
</body>
</html>