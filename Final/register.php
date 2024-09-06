<?php 
session_start();
$PHP_SELF=$_SERVER['PHP_SELF'];
include_once "db_conn.php";
if(isset($_POST['submit'])){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $repassword=$_POST['repassword'];
    $phone=$_POST['phone'];
    $user_type=$_POST['accountType'];
    $address = $_POST['address'];
    $sql="SELECT COUNT(email) FROM users WHERE email= '$email' ";
     $result=$pdo->query($sql);
    if($result->fetchColumn()<1){
        if ($password==$repassword) {
            $sql2="INSERT INTO users(name,email,phone_number,password,user_type,address) VALUES ('$name', '$email', '$phone', '$password', '$user_type','$address') ";
            $result2=$pdo->exec($sql2);
            header("Location:login.php");
        }
     else{
            echo "<script> alert('Password does not match'); </script>";
            data();
        }
    }
    else{
        echo "<script> alert('This email already have an account'); </script>";
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
        <title>Register Page</title>
        <link rel="stylesheet" href="css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bondi.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
    </head>

    <body>
        <section class="register py-5 p-5" style="background-color:#132763; height: 1050px;">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                        <div class="d-flex mb-4">
                                <a href="main.php"><img src="logo_b.png" style="width:110%;height:100px;"></a>
                                <h2 class="mt-4 text-uppercase text-center mt-2 fw-bold ms-1"> قم بإنشاء حساب جديد</h2>
                            </div>
                        <form method="post" action="<?php echo $PHP_SELF ?>" >
                            <div class="form-outline mb-2">
                                <label class="form-label" for="">الاسم الكامل</label>
                                <input type="text" id="name" name="name" class="form-control form-control-lg" required="required" />
                            </div>

                            <div class="form-outline mb-2">
                                <label class="form-label" for="email">بريدك الالكتروني</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg" required="required" />
                            </div>

                            <div class="form-outline mb-2">
                                <label class="form-label" for="">كلمة المرور</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" required="required" pattern="^(?=.*\d)(?=.*[A-Z])[a-zA-Z\d]{8,}$"
    title="Password must be at least 8 characters long and contain at least one uppercase letter and one number"/>
                            </div>

                            <div class="form-outline mb-2">
                                <label class="form-label" for="">أعد كتابة كلمةالمرور</label>
                                <input type="password" id="repassword" name="repassword" class="form-control form-control-lg" required="required" />
                            </div>

                            <div class="form-outline mb-2">
                                <label class="form-label" for="">رقم الهاتف</label>
                                <input type="text" id="phone" name="phone" class="form-control form-control-lg" required="required" />
                            </div>

                              <div class="form-outline mb-2">
                                <label class="form-label" for="">العنوان</label>
                                <input type="text" id="address" name="address" class="form-control form-control-lg" required="required" />
                            </div>

                            <div class="form-outline mb-4 mt-3" style="display: block;">
                                <h5>نوع الحساب</h5>
                                <div>
                                    <label class="block"><input type="radio" name="accountType" value="customer" required="required">&nbsp;حساب مشتري</label>
                                    <label class="block ms-5"><input type="radio" name="accountType" value="market" required="required">&nbsp;حساب متجر</label>
                                </div>
                            </div>


                            <div class="d-flex justify-content-center">
                           <button type="submit" name="submit" class="btn btn-block mb-4 w-100 p-3" style="background-color:#132763; color: white;">
                                    اشتراك       
                                </button>
                            </div>

                            <div class="text-center mt-4 fw-bold r">
                                <h5>تمتلك حساب بالفعل؟ <a href="login.php">تسجيل الدخول من هنا</a></p>
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
