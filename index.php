<?php

    //koneksi databse
    $server="localhost";
    $user = "root";
    $pass = "";
    $database = "lnt mid";

    $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

    //button
    if(isset($_POST['bsave'])){

        //Testing edited data or new file
        if($_GET['hal'] == "edit"){
            //data edited
            $edit = mysqli_query($koneksi,"UPDATE  tmhs set 
            Judul = '$_POST[tjudul]',
            Penerbit = '$_POST[tpenerbit]',
            Genre = '$_POST[tgenre]',
            Kondisi = '$_POST[tkondisi]',
            Deskripsi = '$_POST[talamat]'
            WHERE Nomor = '$_GET[id]' ");
            if($edit){
                echo "<script>
                alert('Edit Data Saved!');
                document.location='index.php';
                </script>";
            }
            else{
                echo "<script>alert('Error Edit Data!');</script>";
            }
        }
        else{
            //data will be created
            $save = mysqli_query($koneksi, "INSERT INTO tmhs
            (Judul, Penerbit, Genre, Kondisi, Deskripsi) VALUES ('$_POST[tjudul]', '$_POST[tpenerbit]', '$_POST[tgenre]', '$_POST[tkondisi]', '$_POST[talamat]') ");

            if($save){
                echo "<script>
                alert('Data Saved!');
                document.location='index.php';
                </script>";
            }
            else{
                echo "<script>alert('Error Data Saving!');</script>";
            }
        }

        
    }

    //edit
    if(isset($_GET['hal'])){
        //show data that want to be edited
        if($_GET['hal'] == "edit"){
            //display data
            $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE Nomor = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data){
                //data found data will be temp into a variable
                $vJudul = $data['Judul'];
                $vPenerbit = $data['Penerbit'];
                $vGenre = $data['Genre'];
                $vKondisi = $data['Kondisi'];
                $valamat = $data['Deskripsi'];
                
            }
        }
        else if($_GET['hal'] == "delete"){
            $delete = mysqli_query($koneksi, "DELETE FROM tmhs WHERE Nomor = '$_GET[id]' ");
            if($delete){
                echo "<script>
                alert('Delete Book Success!');
                document.location='index.php';
                </script>";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <box-icon name='book-reader' ></box-icon>
    <style>
        .logo{
            display:flex;
            margin:5% 40% 5% 40%
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
             <h2 class="text-center ">BNCC Library</h2>
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M21 8c-.202 0-4.85.029-9 2.008C7.85 8.029 3.202 8 3 8a1 1 0 0 0-1 1v9.883a1 1 0 0 0 .305.719c.195.188.48.305.729.28l.127-.001c.683 0 4.296.098 8.416 2.025.016.008.034.005.05.011.119.049.244.083.373.083s.254-.034.374-.083c.016-.006.034-.003.05-.011 4.12-1.928 7.733-2.025 8.416-2.025l.127.001c.238.025.533-.092.729-.28.194-.189.304-.449.304-.719V9a1 1 0 0 0-1-1zM4 10.049c1.485.111 4.381.48 7 1.692v7.742c-3-1.175-5.59-1.494-7-1.576v-7.858zm16 7.858c-1.41.082-4 .401-7 1.576v-7.742c2.619-1.212 5.515-1.581 7-1.692v7.858z"></path><circle cx="12" cy="5" r="3"></circle></svg>
    <!-- <h5>Ayo Donasikan Bukumu Disini!</h5>         -->
</div>
   
    <!-- <h2 class="text-center">Boston Library</h2> -->


<div class="card m-5">
    <div class="card-header bg-primary text-white">
        Input Buku Baru
     </div>
     <div class="card-body">
        <form method="post" action="">
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="tjudul" value="<?=@$vJudul?>" class="form-control", placeholder="Masukan Judul Buku" required>
            </div>

            <div class="form-group mt-3">
                <label>Penerbit</label>
                <input type="text" name="tpenerbit" value="<?=@$vPenerbit?>" class="form-control", placeholder="Nama Penerbit" required>
            </div>

            <div class="form-group mt-3">
                <label>Genre</label>
                <select class="form-control" name="tgenre" value="<?=@$vGenre?>" id="">
                    <option value="Fiksi">Fiksi</option>
                    <option value="Ilmiah">Ilmiah</option>
                    <option value="Sejarah">Sejarah</option>
                    <option value="Sastra">Sastra</option>
                    <option value="Comedy">Comedy</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label>Kondisi</label>
                <select class="form-control" name="tkondisi" value="<?=@$vKondisi?>" id="">
                    <option value="Baru">Baru</option>
                    <option value="Bekas">Bekas</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label>Deskripsi</label>
                <textarea type="text" name="talamat" value="<?=@$valamat?>" class="form-control", placeholder="Deskripsi" required></textarea>

                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3" name="bsave">Save</button>
            <button type="reset" class="btn btn-danger mt-3" name="breset">Clear</button>
        </form>

    </div>
</div>

<!-- Table -->
<div class="card">
    <div class="card-header bg-success text-white">
        Data Perpustakaan
     </div>
     <div class="card-body">
       
     <table class="table table-bor table-striped">
         <tr>
             <th>No</th>
             <th>Judul Buku</th>
             <th>Penerbit</th>
             <th>Genre</th>
             <th>Kondisi</th>
             <th>Deskripsi</th>
             <th>Settings</th>
         </tr>
        <?php
            $no = 1;
            $tampil = mysqli_query($koneksi,"SELECT * from tmhs order by Nomor desc");
            while($data = mysqli_fetch_array($tampil)) :
            ?>
         <tr>
             <td><?=$no++;?></td>
             <td><?=$data['Judul']?></td>
             <td><?=$data['Penerbit']?></td>
             <td><?=$data['Genre']?></td>
             <td><?=$data['Kondisi']?></td>
             <td><?=$data['Deskripsi']?></td>
             <td>
                 <a href="index.php?hal=edit&id=<?=$data['Nomor']?>" class="btn btn-warning"> Edit </a>
                 <a href="index.php?hal=delete&id=<?=$data['Nomor']?>" onclick="return confirm('Are You Sure Want To Delete This Book?')" class="btn btn-danger"> Delete </a>
             </td>
         </tr>
         <?php endwhile; ?>
     </table>

    </div>
</div>

</div>




<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>