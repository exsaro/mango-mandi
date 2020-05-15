<?php
    // session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
        <div class="container">
            <a href="" class="navbar-brand"><?php echo $_SESSION['company_name']; ?></a>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h1>User List</h1>
                    <button class="btn btn-primary">Add User</button>
                </div>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Mango variety</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Saravanan</td>
                            <td>Chennai</td>
                            <td>
                                <span class="badge badge-info">Malgova</span>
                                <span class="badge badge-info">Alphonsos</span>
                                <span class="badge badge-info">Badami</span>
                                <span class="badge badge-info">Chaunsa</span>
                                <span class="badge badge-info">Kesar</span>
                            </td>
                            <td>
                                <a href="">View</a> |
                                <a href="">Edit</a> |
                                <a href="">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Saravanan</td>
                            <td>Chennai</td>
                            <td>
                                <span class="badge badge-info">Malgova</span>
                                <span class="badge badge-info">Alphonsos</span>
                                <span class="badge badge-info">Badami</span>
                                <span class="badge badge-info">Chaunsa</span>
                                <span class="badge badge-info">Kesar</span>
                            </td>
                            <td>
                                <a href="">View</a> |
                                <a href="">Edit</a> |
                                <a href="">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Saravanan</td>
                            <td>Chennai</td>
                            <td>
                                <span class="badge badge-info">Malgova</span>
                                <span class="badge badge-info">Alphonsos</span>
                                <span class="badge badge-info">Badami</span>
                                <span class="badge badge-info">Chaunsa</span>
                                <span class="badge badge-info">Kesar</span>
                            </td>
                            <td>
                                <a href="">View</a> |
                                <a href="">Edit</a> |
                                <a href="">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Saravanan</td>
                            <td>Chennai</td>
                            <td>
                                <span class="badge badge-info">Malgova</span>
                                <span class="badge badge-info">Alphonsos</span>
                                <span class="badge badge-info">Badami</span>
                                <span class="badge badge-info">Chaunsa</span>
                                <span class="badge badge-info">Kesar</span>
                            </td>
                            <td>
                                <a href="">View</a> |
                                <a href="">Edit</a> |
                                <a href="">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Saravanan</td>
                            <td>Chennai</td>
                            <td>
                                <span class="badge badge-info">Malgova</span>
                                <span class="badge badge-info">Alphonsos</span>
                                <span class="badge badge-info">Badami</span>
                                <span class="badge badge-info">Chaunsa</span>
                                <span class="badge badge-info">Kesar</span>
                            </td>
                            <td>
                                <a href="">View</a> |
                                <a href="">Edit</a> |
                                <a href="">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>  
                
            </div>
        </div>
    </div>
    
    
</body>
</html>