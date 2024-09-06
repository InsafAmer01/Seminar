<?php 
session_start();
$PHP_SELF=$_SERVER['PHP_SELF'];
include_once "db_conn.php";
if(isset($_POST['submit'])){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql="SELECT COUNT(email) FROM users WHERE email= '$email' ";
    $result=$pdo->query($sql);
    if($result->fetchColumn()>0){
        $sql2="SELECT * FROM users WHERE email= '$email' ";
        $result2=$pdo->query($sql2);
        while($row = $result2->fetch()){
            if($password==$row['password']){
                $_SESSION['userid']=$row['id'];
                $_SESSION['username']=$row['name'];
                $_SESSION['useremail']=$row['email'];
                $_SESSION['usernumber']=$row['phone_number'];
                $_SESSION['useraddress']=$row['address'];

                if($row['user_type']=="customer" || $row['user_type']=="market" ){
                     $_SESSION['accountType']=$row['user_type'];
                     header("Location: main2.php");
                }
                elseif($row['user_type']=="admin"){
                    $_SESSION['accountType']=$row['user_type'];
                    header("Location: admin/admin_pages/admin.php");
                }
               
            }
            else{
                 echo "<script> alert('Password is not correct'); </script>";
                 data();
            }
        }   
    }
    else{
         echo "<script> alert('There is no account linked to this email'); </script>";
         data();
    }
}
else{
    data();
}
function data(){
  global $PHP_SELF;
?>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bondi.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
    </head>

    <body>
        <section class="login"  style="background-color:#132763">
            <div class="px-4 py-5 px-md-5 text-center text-lg-start">
            <div class="container">
                <div class="row gx-lg-5 align-items-center p-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight " style="color: rgba(255, 166, 0, 0.949);">
                        افضل العروض <br />
                    <span>للعمل الخاص بك</span>
                    </h1>
                    <p style="color: white;">
                        تتخصص باور ويلز في توفير قطع غيار سيارات عالية الجودة لعشاق السيارات والمهنيين
                        سواء كنت تبحث عن ترقية أداء سيارتك أو استبدال أحد المكونات التالفة،
                        تمتلك باور ويلز مجموعة واسعة من المنتجات من أفضل العلامات التجارية المصممة لتلبية احتياجاتك.
                        من خلال واجهة سهلة الاستخدام وأسعار تنافسية، أصبح موقعنا الإلكتروني وجهة مفضلة لعشاق السيارات والميكانيكيين على حدٍ سواء
                        مع التزامها برضا العملاء والشحن السريع، تعد باور ويلز مصدرًا موثوقًا لجميع احتياجات قطع غيار سيارتك
                    </p>
                </div>
        
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">

                            <form method="post" action="<?php echo $PHP_SELF?>">
                                <a href="main.php"><img src="logo_b.png" style="width:50%;height:150px;"></a>
                                <h2 class="">يرجى تسجيل الدخول إلى الحساب الخاص بك</h2>
                                <!-- Email input -->
                                <div class="form-outline mb-4 mt-5">
                                    <label class="form-label" >عنوان البريد الإلكتروني</label>
                                    <input type="email" name="email" class="form-control" />
                                </div>
                
                                <!-- Password input -->
                                <div class="form-outline mb-5">
                                    <label class="form-label">كلمة المرور</label>
                                    <input type="password" name="password" class="form-control" />                            
                                </div>

                
                                <!-- Submit button -->
                                <button type="submit" name="submit" class="btn btn-block mb-4 w-100 p-3" style="background-color:#132763; color: white;">
                                    تسجيل الدخول
                                </button>
            

                                <div class="text-center fw-bold r">
                                    <h5>لا تمتلك حساب؟ <a href="register.php">اشترك</a></p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
    </body>
</html>
<?php 
}
?>

