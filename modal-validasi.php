modal-validasi.html
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="styling.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
        <link rel="icon" type="image/ico" href="logo2.png">
        <link rel="stylesheet" href="./fontawesome-free-6.2.1-web/css/all.css">
        <title> PinjamRuang FATISDA </title>
    </head>
    <body>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConfirmation">Tambah User</button>
        
        <div class="modal fade" id="modalConfirmation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-5 d-flex flex-row" style="background-color:#c9efff; border-radius:30px; align-items: center; justify-items: center;">
                    <div class="position-relative" style="padding:50px; background-color: #71d4ff; border-radius: 30px;">
                        <i class="position-absolute top-50 start-50 translate-middle fa-solid fa-circle-exclamation fa-2xl" style="color: #000000; align-items: center; justify-content: center;"></i>
                    </div>
                    <div class="flex-column">
                        <div>
                            <h1 class="mx-5 fs-5 text-center" style="font-weight: bolder;" id="staticBackdropLabel">Yakin untuk validasi?</h1>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn" style="margin-left: 41px; margin-right: 10px; padding-right:30px; padding-left:30px; background-color: #ee7d87; border-radius: 20px; color:black; align-items: center; justify-content: center;" data-bs-dismiss="modal">Tidak</button>
                            <button type="button" class="btn" style="padding-right:40px; padding-left:40px; background-color: #8de66a; border-radius: 20px; color: black; align-items: center; justify-content: center;">Ya</button>         
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="modal fade" id="modalConfirmation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-5 d-flex flex-row" style="background-color:#c9efff; border-radius:30px; align-items: center; justify-items: center;">
                    <div class="position-relative" style="padding:50px; background-color: #71d4ff; border-radius: 30px;">
                        <i class="position-absolute top-50 start-50 translate-middle fa-solid fa-circle-exclamation fa-2xl" style="color: #000000; align-items: center; justify-content: center;"></i>
                    </div>
                    <div class="flex-column">
                        <div>
                            <h1 class="mx-5 fs-5 text-center" style="font-weight: bolder;" id="staticBackdropLabel">Yakin untuk menolak?</h1>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn" style="margin-left: 41px; margin-right: 10px; padding-right:30px; padding-left:30px; background-color: #ee7d87; border-radius: 20px; color:black; align-items: center; justify-content: center;" data-bs-dismiss="modal">Tidak</button>
                            <button type="button" class="btn" style="padding-right:40px; padding-left:40px; background-color: #8de66a; border-radius: 20px; color: black; align-items: center; justify-content: center;">Ya</button>         
                        </div>
                    </div>
                </div>
            </div>
        </div> 

 
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/65ec807597.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    </body>
</html>