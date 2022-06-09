<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inicio de Sitio</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<body>


<div id="layotAuthentication" >

            <div id="layourAuthentication_content">
            
                <main>
                
                    <div class="container">
                    
                        <div class="row justify-content-center">
                        
                            <div class="col-lg-6">
                            
                                <div class="card mb-4 shadow-lg rounded-lg mt-5" style="max-width: 540px; ">
                                
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <br>
                                            <br>
                                            <img src="https://pbs.twimg.com/profile_images/947178325079769090/SK0Di8cF_400x400.jpg" class="img-fluid " alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <center><h5 class="card-title">Bienvenido</h5></center>
                                                <br>
                                                <form method="POST">
                                                    <div class="form-group"><input class="form-control py-2" id="inputEmailAddress" name="usuario" type="text" placeholder="Usuario"/></div><br>
                                                    <div class="form-group"><input class="form-control py-2" id="inputPassword" name="password" type="password" placeholder="Contraseña"/></div>
                                                    <div class="form-group d-flex align-items-center justify-content-center mt-4 mb-0">
                                                        <!-- <button type="submit" class="btn btn-success">Entrar</button> -->
                                                        <a class="btn btn-success" href="menu.php" role="button">Entrar</a>
                                                
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                 </div>





<?php include("components/footer.html") ?>



