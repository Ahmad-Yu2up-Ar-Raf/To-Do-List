<?php


include"database.php";
error_reporting(E_ERROR | E_PARSE);
session_start();
// untuk login
$username1 = $_POST["name"];
$password1 = $_POST["password"];
$submit1 = $_POST["submit"];


if(isset($submit1)){
    $sql = "SELECT * FROM yusuf_data WHERE username='$username1' AND password='$password1'";
    $squ = $db->query($sql);
    if($squ->num_rows > 0 ){
        header("location: display.php");
        $result = $squ->fetch_assoc();
        $_SESSION["username"] = $result["username"];
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["is_login"] = true;

    }else{
          $massage = "username {$username1} dan paswword Tidak ditemukan";
    }

    echo "<script>setTimeout(() => { window.alert(message);},100)</script>";
}


// untuk daftar

$username2 = $_POST["name2"];
$password2 = $_POST["password2"];
$submit2 = $_POST["submit2"];

if(isset($submit2)){
    
    $sqp = "SELECT * FROM yusuf_data WHERE username='$username2'";
    $sqw = $db->query($sqp);

// if($sqw->num_rows > 0){
//    $massage = "Nama {$username2} sudah di gunakan";
// }else{

//     $sqt = "INSERT INTO yusuf_data(username,password) VALUES ('$username2', '$password2')";
//     if($db->query($sqt)){
//           $massage = "Berhasil";
//     }else{
//           $massage = "gagal";
//     }
//     echo "<script>setTimeout(() => { window.alert(message);},100)</script>";
// }


try{

    if(empty($username2) && empty($password2)){
        $massage = "username dan paswword tidak boleh kosong";
    }else{
        $sqt = "INSERT INTO yusuf_data(username,password) VALUES ('$username2', '$password2')";
        if($db->query($sqt)){
              $massage = "Berhasil";
        }else{
              $massage = "gagal";
        }
    }
 
    }catch(mysqli_sql_exception){
        $massage = "Nama {$username2} sudah di gunakan";
    }
    echo "<script>setTimeout(() => { window.alert(message);},100)</script>";

} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- font -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font -->
</head>
<style>
    *{
        margin: 0%;
        padding: 0%;
        box-sizing: border-box;
        font-family: 'Poppins';
    }
    * a{
        color: gray;
  text-decoration: none;
    }
    body{
        align-content: center;
    min-height: 100vh;
    background:linear-gradient(rgba(0,0,0,0.30),rgba(0,0,0,0.70)), url("https://images.unsplash.com/photo-1522482178516-7a04ae0dce7a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D") ;
    background-size:  cover;
    background-repeat: no-repeat;
    background-position: center;
    
    }
.form{
    background:rgba(0, 0, 0, 0.7) ;
    align-items: center;
    width: 50%;
    text-align: center;
    margin: auto;
    border-radius: 10px;
    padding: 55px;
}

.form input{
    border-radius: 30px;
    width: 100%;
    padding: 20px;

    font-size: 15px;
    border: none ;
    outline: none;
}
#submit {
  width: 100%;
  padding: 20px;
  font-size: 1em;
  border: none;
  border-radius: 30px ;
  background-color: #fa0e60;
  font-weight: 500;
  color: white;
  margin: 2em 0em;
  cursor: pointer;
}
form i {
    margin-bottom: 1em;
    font-size: 3em;
    color: white;
}


.hide {
    display: none;
}

#particles-js {
    position: absolute;
    background-size: cover;
	background-position: top center;
    left: 0;
	top: 0;
	height:99%;
	width: 100%;
    z-index: -1;
}

label {
 display: flex;
align-items: center;
   border-radius: 30px;
background: white;
   margin: 2em 0em;
}
label i {
    margin-top:         19px;
    margin-right: 6%;

    font-size: 18px;
    color: gray;
    cursor: pointer;


}
label i:hover {

    color: #fa0e60;
  


}
@media(max-width:815px){
    .form{
   
   
    width: 400px;
  
  
    border-radius: 10px;

}
label i {
    

    font-size: 14px;



}
.form input{
    border-radius: 30px;
    width: 100%;
    padding: 20px;

    font-size: 10px;
    border: none ;
    outline: none;
}
}
@media(max-width:545px){
    .form{
   
   
    width: 300px;
  
  
    border-radius: 10px;

}
label i {
    

    font-size: 14px;



}
.form input{
    border-radius: 30px;
    width: 100%;
    padding: 20px;

    font-size: 10px;
    border: none ;
    outline: none;
}
}
</style>
<body>
    
    <div id="particles-js">
        </div>


        
    <form action="index.php" method="POST" class="form pertama">

            <i class="fa-solid fa-users" ></i>
            <input type="text" name="name" placeholder="Username">
         
            
            
            <label for="password">
                        <input type="password" name="password" placeholder="Password" id="sandi">

                <i class="fa-solid eyes  "></i>
                    </label>

                    <button name="submit" id="submit">Login</button>
                    <a href="" id="Login">Register ?</a>
                </form>
            
            
            
            
            
            <form action="index.php" method="POST" class="form kedua hide">
                
            
                <i class="fa-solid fa-users"></i>
                <input type="text" name="name2" placeholder="Username">
                
          
                <label for="password">
                        <input type="password" name="password2" placeholder="Password" id="sandi2">

                <i class="fa-solid eyes2 "></i>
                    </label>

              

           
                <button name="submit2" id="submit">submit</button>
                <a href="" id="Register">Login ?</a>
            </form>
            
            
            
   


<script src="particles.min.js"></script>
<script src="app.js"></script>
<script>
        


    let Login = document.querySelector(".pertama") 
    let Register = document.querySelector(".kedua") 
    let button1 = document.getElementById("Register") 
    let button2 = document.getElementById("Login") 
    let show = document.querySelector(".eyes")
    let password = document.getElementById("sandi")
    let show2 = document.querySelector(".eyes2")
    let password2 = document.getElementById("sandi2")

console.log(password)

function validasi(y,x){
    if(y.target.value >= 0){
        x.classList.remove("fa-eye")
    }else{
        x.classList.add("fa-eye")

    }
}


password.addEventListener("input",(e) => { validasi(e,show)
   
})
password2.addEventListener("input",(e) => { validasi(e,show2)
   
})

function showPassword(sandi,tampil){

    if(sandi.type === "password"){
           sandi.type = "text"
       }else{
           sandi.type = "password"
       }
    if(tampil.classList.contains("fa-eye")){

        tampil.classList.remove("fa-eye")
        tampil.classList.add("fa-eye-slash")
    }else{
        tampil.classList.add("fa-eye")
        tampil.classList.remove("fa-eye-slash")
    }
}




    
   show.addEventListener("click", () => showPassword(password,show))
   show2.addEventListener("click", () => showPassword(password2,show2))

    button1.addEventListener("click", (e) => {
        e.preventDefault()
        Register.classList.add("hide")
        Login.classList.remove("hide")
    })
    button2.addEventListener("click", (e) => {
        e.preventDefault()
        Register.classList.remove("hide")
        Login.classList.add("hide")
    })
   show.addEventListener("input", () => {
if(password.type == "password" || password2.type == "password" ){
    password.type = "text"
   }else{
    password.type = "password"
   }
   })
   let message = "<?php echo addslashes($massage); ?>";
   




   </script>
   
</body>

</html>
