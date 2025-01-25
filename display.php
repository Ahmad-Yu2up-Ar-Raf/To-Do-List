<?php 

include "database.php";
session_start();
// $user_id = "SELECT * FROM task WHERE";

error_reporting(E_ERROR | E_PARSE);

$add = $_POST["Add"];
$task = $_POST["task"];
$user_id = $_SESSION["user_id"];



if(isset($add)){
    if(empty($task)){
        $massage = "jangan kosong";
    }else{

        $sql = "INSERT INTO task(user_id ,task_name) VALUE ('$user_id','$task')";

        $xqc = $db->query($sql);
   
    
    }
   
}

// SHOW DATA 
$q_select = "SELECT * FROM task WHERE user_id='$user_id' ORDER BY id DESC";
$q_select_connect = $db->query($q_select);




$signOut = $_POST["sign-out"];

if(isset($signOut)){
    session_unset();
    session_destroy();
   header("location: index.php");
}

// hapus data 
$trash = $_GET["deleted"];

if(isset($trash)){

$remove = "DELETE FROM task WHERE id='$trash'";
$remove_connect = $db->query($remove);
header("Refresh:0; url=display.php");
}
// status
$done = $_GET["done"];
$status = $_GET["status"];

if(isset($done)){

    
    if($status == "pending"){
        $status = "completed";
    }else{
        $status = "pending";
    }
    $update = "UPDATE task SET status = '$status' WHERE id ='$done'";
    $update_run = $db->query($update);
    header("Refresh:0; url=display.php");
}


// statistik

$statistickAll = "SELECT * FROM task WHERE user_id='$user_id' ORDER BY id DESC";
$statistick_resultAll = $db->query($statistickAll);
$statistickFirst = mysqli_num_rows($statistick_resultAll);



$statistick = "SELECT * FROM task WHERE user_id='$user_id' AND status='completed' ORDER BY id DESC";
$statistick_result = $db->query($statistick);
$statistick2 = mysqli_num_rows($statistick_result);

$statistick3 = "SELECT * FROM task WHERE user_id='$user_id' AND status='pending' ORDER BY id DESC";
$statistick_result3 = $db->query($statistick3);
$statistick5 = mysqli_num_rows($statistick_result3);


try{
    
    $hasilPending = $statistick5 / $statistickFirst * 100;
    $hasilCompleted = $statistick2 / $statistickFirst * 100;
    $bulatPending = floor($hasilPending);
    $bulatCompleted = floor($hasilCompleted);
}catch(DivisionByZeroError){
    $bulatPending = null;
    $bulatCompleted = null;
}


$boolean = is_null($bulatPending);

// edit data 
$ngedit = $_POST["ngedit"];
$edit = $_POST["editugas"];
$id_ngedit = $_GET["edit"];




if(isset($ngedit)){

    if(empty($edit)){
        header("Refresh:0; url=display.php");
    }else{
$update_edit = "UPDATE task SET task_name  = '$edit' WHERE id ='$id_ngedit'";
          $update_run_edit = $db->query($update_edit);
          header("Refresh:0; url=display.php");
    }

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Font -->
</head>
<style>
*{
margin: 0%;
padding: 0%;
box-sizing: border-box;
font-family: 'Poppins';
}
.box {
    background: none;
    width: fit-content;
    width: 10%;
    position: relative;
   

}
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

    min-height: 100vh;
    align-content:center ;

    }
    .side-bar {
        top: 0%;
        min-height: 100vh;
        background: black;
        min-width: 200px;
        position: fixed;
        color: white;
    }
    .side-bar ul {
        width: 100%;

        font-size: 15px;
    }
    .side-bar ul li{
        width: 100%;
        display: flex;
        align-items: center;
      padding-left: 30px;
      height: 70px;
 cursor: pointer;
 transition: .3s ease;
    }
    .side-bar ul li:hover {
        color: yellow;
    }
    .side-bar ul li i {
        font-size: 20px;
        margin-right: 40px;
    }
    .side-bar ul li h5 {
        font-weight: 300;
    }
    .title{
     text-align: center;
    }
.user{
    width: 100%;
    display: flex;
    border-bottom: 0.1px white;
    padding-left: 10px;
    height: 100px;
    align-items: center;
    border-bottom: 10px solid white;
}
.user div {
width: 10%;
}
.user div h6 span {
    font-weight: 400;
}
.user div h6 {
  margin-left:20px ;
}
.user i {
    font-size: 30px;
}
.log-out {
    bottom: 0%;
    position: absolute;
}
form button {
    all: unset;
}
.color-click{
    color: yellow;
}
#to-do-list,#statistic{

   width: 100%;
    min-height: 100vh;

    padding-left: 230px;
    padding-right: 28px;
}
.title-list, .title-statistick {
    padding: 25px 10px;

    border-bottom: 1px solid black;

  margin: auto;
}
.kanan a {
    margin-left: 30px;
}
/* .To-Do{
    display: flex;
 

} */
.hasil h6 {
    font-weight: 600;
    font-size: 20px;
}

.To-Do form {
    display: flex;
}

 .done {

font-weight: 400;
  color: gray;
  
}
.not-done{
display: none;
}

.hasil h6 {
    font-size: 15px;
    font-weight: 400;
    margin-left: 30px;
}
.hasil {
    padding: 20px;
    align-items: center;
    display: flex;
 border-bottom: 1px solid black; 
 justify-content: space-between;
}
.keterangan button {
    cursor: pointer;
}
.add-task form {
    margin: 20px 0px;
    box-shadow: 1px 1px 5px black;
}

.add-task form input {
    outline: none;
    border: none;

}
#add {
    padding: 10px 15px;
    cursor: pointer;
    background-color: #f8f8f8;
}
.hide {
    display: none;
}
.keterangan {
    display: flex;
}
.empty {
    color: gray;
    text-align: center;
    align-items: center;
    align-content: center;
}
.keterangan input{
    cursor: pointer;
}
.tamat {
    font-style: italic;
    text-decoration: line-through;
}
.review {
    display: flex;
    padding: 30px;
    border-bottom: 1px solid black ;
    justify-content: space-between;
}
.review li span {
    color: gray;
}
.card{
  
    display: flex;
    
}

.statis {
    cursor: pointer;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 30px ;
    margin-right: 10px;
    width: 100%;
    font-size: 15px;
    transition: .3s ease;
    box-shadow: 1px 0px 5px #010101;
}
.statis:hover {
    transform: translateY(-4px);
    box-shadow: 1px 2px 5px #010101;
}
.statis i {
    margin-right: 20px;
    color: white;
background: #010101;
    border-radius: 10px;
    padding: 35px 35px;
    font-size: 20px;
}
.card div span {
    margin-left: 2px;
    font-weight: 400;
    font-size: 20px;
}


/* .completed h1{
 
}
.pending h1{
 
} */

.sembunyikan {
    display: none;
}


.review span {
    font-size: 15px;
    margin-right: 20px;
}
.review h5 {
font-size: 10px;
}
/* .quest {

} */
.title-statistick {
    margin-bottom: 30px;
}
.result-title {
    display: flex;
    align-items: center;
}
.formEdit {
    display: none;
    margin: 30px 10px;
}
.edits {
    justify-content: center;
    background: rgba(0,0,0,0.7);
    position: absolute;
    display:contents;


    
}
.edits a {
    color: white;

}
/* .edits form {

} */
.edits form input{
    outline: none;
    padding: 20px;

 border: none;
}
.edits form button{
  cursor: pointer;
}


</style>

<body>



    
    <div class="side-bar">
        <div class="user">

            <i class="fa-solid fa-user"></i>
            <div><h6><?= $_SESSION["username"]?><span>
            User
            </span> </h6> </div>
        </div>
        <ul> 
            <li class="side home"><i class="fa-solid fa-house"></i> <h5>Home</h5></li>
            <li class="side dashboard"><i class="fa-solid fa-border-none"></i><h5>Dashboard</h5></li>
            <li class="side to-do"><i class="fa-solid fa-clipboard-list"></i> <h5>To Do List</h5></li>
            <form action="display.php" method="post">
<button name="sign-out">

    <li   class="side log-out"><i class="fa-solid fa-right-from-bracket"></i> <h5>Log Out</h5></li>
</button>
            </form>
        </ul>
        </div>
        <h1 class="title hide">👋 WELCOME <?= $_SESSION["username"]?></h1>


        <div id="statistic" class="statistic hide">

    <h1 class="title-statistick"><?= $_SESSION["username"]?> Statistic</h1>
 <?php if($boolean){?>

<div class="empty">Empty</div>
<?php }else{?>
    <div class="result ">
        <div class="card">

            <div class="statis quest ">
    <div class="result-title">
    <i class="fa-solid fa-sheet-plastic"></i>
    <div class="hahahaha">
    
        <h1 class="quest"><?=$statistickFirst ?></h1>
        <p>Quest</p>
    </div>
    </div>
            </div>
              <div class="statis completed ">
                <div class="result-title"><i class="fa-solid fa-check"></i>
            <div class="hahahaha">
    
                <h1><?=$bulatCompleted ?><span>%</span></h1>
                <p>Completed</p>
            </div>
            </div>
              </div>
              <div class="statis pending ">
                <div class="result-title"><i class="fa-regular fa-hourglass-half"></i>
            <div class="hahahaha">
    
                <h1><?=$bulatPending ?><span>%</span> </h1>
                <p>Pending</p>
            </div>
            </div>
              </div>
        </div>
        
          <div class="preview">
              <div class="tugas">

                <h1>Quest</h1>
                <ul>

                    <?php if($statistickFirst > 0){
                        while($iss = mysqli_fetch_array($statistick_resultAll)){
                            ?>
  
  <div class="review ">  
    
 

              <li><?=$iss["task_name"] ?>  </li>
       
              <span><?=$iss["status"] ?></span>
            
         
        
    </div>
    <?php }} ?>
</ul>
     </div>
     <div class="yang-selesai hide ">
       
     <h1>Completed</h1>
     <ul>

   
     <?php if($statistick2 > 0){
                while($iqq = mysqli_fetch_array($statistick_result)){
             ?>
       
     <div class="review">  
        <div class="kiri">
          
            <li><?=$iqq["task_name"] ?></li>
        </div>
    
       </div>
       <?php }} ?>
       </ul>
     </div>

     <div class="belom-selesai hide">
     <h1>Pending</h1>
     <ul>

         <?php if($statistick5 > 0){
             while($pss = mysqli_fetch_array($statistick_result3)){
                 ?>

<div class="review ">  
    <div class="kiri">
        
        <li><?=$pss["task_name"] ?></li>
    </div>
    
</div>
<?php }} ?>
</ul>
</div>
</div>
</div>
<?php } ?>
</div>
        
<div id="to-do-list" class="list ">

    <h1 class="title-list">To-Do</h1>
    <div class="add-task">

        <form action="display.php" method="post">
            <button type="submit" name="Add" id="add">+</button>
            <input type="text" name="task"  placeholder="Add New Task" autocomplete="off" >
        </form>
    </div>
    <?php if(mysqli_num_rows($q_select_connect) > 0) {
        while($r = mysqli_fetch_array($q_select_connect)){
        ?>
    <div class="hasil" >
        <div class="keterangan">

          

            <input type="checkbox" class="check-box" name="check" onclick="window.location.href = '?done=<?=$r['id'] ?>&status=<?=$r['status'] ?>'" <?=$r['status'] == 'completed' ?  'checked' : '' ?> >
         
 
            <h6  class="selesai <?=$r['status'] == 'completed' ? 'tamat' : '' ?>  "><?=$r['task_name'] ?></h6>
        </div>
           
        <div class="kanan">

            <span type="submit"  name="hapus" class="done <?=$r['status'] == 'pending' ?  'not-done' : '' ?> "  >Done</span>
            <a href="?edit=<?=$r["id"]?>" class="formEdit2"><i class="fa-solid fa-pencil"></i></a>
      <a href="?deleted=<?=$r["id"] ?>"><i class="fa-solid fa-trash"></i></a>
        </div>
    </div>
<div class="formEdit <?=strpos($_SERVER['REQUEST_URI'], '?edit=' . $r["id"]) !== false ? 'edits' : '' ?>"  >
   
    <form action="display.php?edit=<?=$r["id"]?>" method="post">
        <input name="editugas" type="text"  placeholder="Edit Task" >
        <button name="ngedit" type="submit" ><i class="fa-solid fa-arrow-up-right-from-square"></i></button>
    </form>
</div>
    <?php }} else { ?>
        <div class="empty">Empty</div>
        <?php }?>
</div>



<!-- <div class="to-do-list">
  <form action=""></form>
</div> -->
    <!-- <hr> -->
    <!-- <h1>Selamat Datang</h1>
    <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="" class="box">
    <h1 id="number" >0</h1>
    <button id="add">+</button>
    <button id="min">mulai</button>
    -->


    <script> 
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

const sideIcon = document.querySelectorAll(".side")
const home = document.querySelector(".home")
const dashboard = document.querySelector(".dashboard")
const toDo = document.querySelector(".to-do")
const sideBar = document.querySelector(".side-bar")
const listSection = document.querySelector(".list")
const welcome = document.querySelector(".title")
const statistic = document.querySelector(".statistic")
const Display = document.querySelector(".title")

console.log(Display)

sideIcon.forEach((icon) => icon.addEventListener("click", (e) => {



    if(icon.classList.contains("home")){
         console.log("hi")
         home.classList.add("color-click")
         toDo.classList.remove("color-click")
         dashboard.classList.remove("color-click")
         Display.classList.remove("hide")
         listSection.classList.add("hide")
         statistic.classList.add("hide")
         welcome.classList.add("hide")
        }else if(icon.classList.contains("dashboard")){
            home.classList.remove("color-click")
            toDo.classList.remove("color-click")
          dashboard.classList.add("color-click")
          listSection.classList.add("hide")
          welcome.classList.add("hide")
          statistic.classList.remove("hide")
        }else if(icon.classList.contains("to-do")){
    dashboard.classList.remove("color-click")
    home.classList.remove("color-click")
            toDo.classList.add("color-click")
            listSection.classList.remove("hide")
            welcome.classList.add("hide")
            statistic.classList.add("hide")
        }
    }))
    
    function saveLocal(){
        let task = [];
        sideIcon.forEach(function(item){
            task.push(item.classList.trim());
        })
        
        localStorage.setItem('task', JSON.stringify(task))
    }
    
    

// document.addEventListener("click", (e) => {
//     if(sideBar.contains(e.target)  && !home.contains(e.target) || !dashboard.contains(e.target) || !toDo.contains(e.target) ){
//         toDo.classList.remove("color-click")
//         dashboard.classList.remove("color-click")
//         home.classList.remove("color-click")
//         console.log("hello-word")
//     }
// })

// Ambil semua checkbox
let check = document.querySelectorAll('.check-box');

// Pasang event listener pada setiap checkbox
check.forEach((check2) => {
  check2.addEventListener('click', () => {
    // Cari tombol 'done' yang terkait dengan checkbox ini
    let done = check2.closest('.hasil').querySelector('.done');

    // Aktifkan atau nonaktifkan tombol 'done' berdasarkan status checkbox
    if(!check2.checked){

        done.classList.add("not-done") = check2.checked;
    }else{
        done.classList.remove("not-done")

    }
  });
});


// Cek apakah status checkbox sudah disimpan sebelumnya
// if (localStorage.getItem("checkStatus") === "checked") {


// } 



console.log(check)
// console.log(done)
// function onclick(){

// }

const k = document.querySelectorAll(".statis")


const yu = document.querySelector(".tugas")
const yt = document.querySelector(".yang-selesai")
const ye = document.querySelector(".belom-selesai")


k.forEach((ks) => ks.addEventListener("click", () => {
  if(ks.classList.contains("quest")){
    yu.classList.remove("hide")
    yt.classList.add("hide")
    ye.classList.add("hide")
  }else if(ks.classList.contains("completed")){
    yu.classList.add("hide")
    yt.classList.remove("hide")
    ye.classList.add("hide")
  }else{
    yu.classList.add("hide")
    yt.classList.add("hide")
    ye.classList.remove("hide")
  }
 
 
}) )





// let x = 0
// let y = 0
// let move = 10
// let item = document.querySelector(".box")
//   let i = document.getElementById("number")
//   let u = document.getElementById("add")
//   let e = document.getElementById("min")
//   let q = 1

// h = Number(i.innerHTML)

// console.log(h)



// u.addEventListener("click", () => {
//     q++
//     h  = q 
//     i.innerHTML = h
// })









//     for(i = 5;i >= 0;i--){
        
//             console.log(i)
        
//     }

//  mov
//             console.log(move)
//             //    if(event.key.startsWit("Arrow")){
            
//             //   switch(event.key){
//             //     case "ArrowUp":
//             //         y -= move
//             //         break
//             //     case "ArrowDown":
//             //         y += move
//             //         break
//             //     case "ArrowLeft":
//             //         x -= move
//             //         break
//             //     case "ArrowRight":
//             //         x += move
//             //         break
//             //   }
//             //   item.style.top = `${y}px`
//             //   item.style.left = `${x}px`
//             // }
//         })
//         document.addEventListener("keyup", (e) => {
//             console.log(move)
            
//         })
//         //  if(e.key.startsWith("Arrow")){
//         //     switch(case){
//         //  cas
//         //     }
//         //  }
         
    </script>
</body >
</html>