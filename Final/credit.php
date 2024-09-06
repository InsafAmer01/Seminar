<?php
session_start();
$PHP_SELF=$_SERVER['PHP_SELF'];
include_once "db_conn.php";
if(isset($_POST['credit'])){
  $orderID = rand(000000000,999999999);
  $id = $_SESSION['userid'];
  $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
  $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql="SELECT * FROM cart where userid='$id'";
  $result=$pdo->query($sql);
  while($row=$result->fetch()){
    $pid=$row['productid'];
    $sql2="INSERT INTO trackings (order_id,status,userid,productid) VALUES ($orderID,'Pending',$id,$pid)";
    $result2=$pdo->exec($sql2);
    $sql3 = "DELETE FROM cart WHERE userid=$id and productid=$pid";
      $result3=$pdo->exec($sql3); 
      $sql4="UPDATE products SET stock=stock-1 WHERE id=$pid";
      $result4=$pdo->exec($sql4);
      $sql5="SELECT * FROM stat where userid=$id";
      $result5=$pdo->query($sql5);
      if($result5->rowcount()==0){
        $sql6="INSERT INTO stat(productid,quantity,userid) VALUES ($pid,1,$id)";
        $result6=$pdo->exec($sql6);
      }
      else{
        while($row5=$result5->fetch()){
        if($row5['productid']==$pid && $row5['userid']==$id){
          $sql6="UPDATE stat SET quantity=quantity+1 where productid=$pid AND userid=$id";
          $result6=$pdo->exec($sql6);
        }
        else{
          $sql6="INSERT INTO stat(productid,quantity,userid) VALUES ($pid,1,$id)";
          $result6=$pdo->exec($sql6);
        }
      }
      }
      
  }
  $Cardholder=$_POST['Cardholder'];
  $cardnumber=$_POST['cardnumber'];
  $expiration=$_POST['expiration'];
  $cvv=$_POST['cvv'];
  $sql7="INSERT INTO credit (cardName,cardNum,expriyDate,cvv,orderid) VALUES ('$Cardholder',$cardnumber,$expiration,$cvv,$orderID)";
  $result7=$pdo->exec($sql7);
  echo "<script> alert('Your order have been placed'); </script>";
  header( "refresh:0.5;url=main2.php" );

}
elseif(isset($_POST['cash'])){
  $orderID = rand(000000000,999999999);
  $id = $_SESSION['userid'];
  $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
  $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql="SELECT * FROM cart where userid='$id'";
  $result=$pdo->query($sql);
  while($row=$result->fetch()){
    $pid=$row['productid'];
    $sql2="INSERT INTO trackings (order_id,status,userid,productid) VALUES ($orderID,'Pending',$id,$pid)";
    $result2=$pdo->exec($sql2);
    $sql3 = "DELETE FROM cart WHERE userid=$id and productid=$pid";
      $result3=$pdo->exec($sql3); 
      $sql4="UPDATE products SET stock=stock-1 WHERE id=$pid";
      $result4=$pdo->exec($sql4);
      $sql5="SELECT * FROM stat where userid=$id";
      $result5=$pdo->query($sql5);
      if($result5->rowcount()==0){
        $sql6="INSERT INTO stat(productid,quantity,userid) VALUES ($pid,1,$id)";
        $result6=$pdo->exec($sql6);
      }
      else{
        while($row5=$result5->fetch()){
        if($row5['productid']==$pid && $row5['userid']==$id){
          $sql6="UPDATE stat SET quantity=quantity+1 where productid=$pid AND userid=$id";
          $result6=$pdo->exec($sql6);
        }
        else{
          $sql6="INSERT INTO stat(productid,quantity,userid) VALUES ($pid,1,$id)";
          $result6=$pdo->exec($sql6);
        }
      }
      }

  }
  echo "<script> alert('Your order have been placed'); </script>";
  header( "refresh:0.5;url=main2.php" );
}
else{
  data();
}

function data(){
  global $PHP_SELF;
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Credit</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bondi.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <style>
    section{
      width: 600px;
      height: 20px;
      margin: auto;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">

          <button 
          class="navbar-toggler" 
          type="button" 
          data-bs-toggle="collapse" 
          data-bs-target="#main" 
          aria-controls="main" 
          aria-expanded="false" 
          aria-label="Toggle navigation">
          <i class="fa-solid fa-angle-down"></i>
          </button>

          <div class="collapse navbar-collapse" id="main">
        
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" aria-current="page" href="#">الصفحة الرئيسية</a>
              </li>
              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="#contact">تواصل معنا</a>
              </li>

              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="#about">معلومات عنا</a>

              </li><li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="login.html">تسجيل الدخول</a>
              </li>
            </ul>  
        </div>
    </nav>

    <div class="search pt-1 pb-1 text-center text-md-start">
      <div class="container">
        <form class="row align-items-center" method="post" action="search.php">
            <div class="col-md-4 col-lg-3">
              <div class="fw-bold fs-5 mb-3">
                <a href="main2.php"><img src="logo.png" style="width:50%;height:100px;"></a>
              </div>
            </div>

            <div class="col-md-8 col-md-8 col-lg-8 mb-3 d-flex">
              <input class="rounded-pill w-100 p-2" type="search" id="filter" placeholder="Insert an item.." name='item'/>
              <input class="btn rounded-pill ms-5 " type="submit" value="Search" name="search" />
            </div>
            <div class="filters m-3">
                <div class="d-flex" style="background-color: #132763">
                  <div class="d-flex">
                    <i class="fa-solid fa-arrow-up-short-wide fa-2x mt-2 mb-2 ms-2" style="color:rgba(255, 166, 0, 0.949)"></i>
                    <h4 class="mt-2 mb-2 ms-2 me-5 " style="color:white">الفرز والتصفية</h4>
                  </div>
                
                  <select id="condition" class="m-2">
                    <option value="">الحالة</option>
                    <option value="new">جديد</option>
                    <option value="used">مستعمل</option>
                  </select>
          
                  <select id="price" class="m-2">
                    <option value="">السعر</option>
                    <option value="high">الأغلى</option>
                    <option value="low">الأرخص</option>
                  </select>
          
                  <select id="price" class="m-2">
                    <option value="">اختر ماركة السيارة</option>
                    <option value="Acura">Acura</option>
                    <option value="Alfa Romeo">Alfa Romeo</option>
                    <option value="Aston Martin">Aston Martin</option>
                    <option value="Audi">Audi</option>
                    <option value="Bentley">Bentley</option>
                    <option value="BMW">BMW</option>
                    <option value="Bugatti">Bugatti</option>
                    <option value="Buick">Buick</option>
                    <option value="Cadillac">Cadillac</option>
                    <option value="Chevrolet">Chevrolet</option>
                    <option value="Chrysler">Chrysler</option>
                    <option value="Citroën">Citroën</option>
                    <option value="Dodge">Dodge</option>
                    <option value="Ferrari">Ferrari</option>
                    <option value="Fiat">Fiat</option>
                    <option value="Ford">Ford</option>
                    <option value="Genesis">Genesis</option>
                    <option value="GMC">GMC</option>
                    <option value="Honda">Honda</option>
                    <option value="Hyundai">Hyundai</option>
                    <option value="Infiniti">Infiniti</option>
                    <option value="Jaguar">Jaguar</option>
                    <option value="Jeep">Jeep</option>
                    <option value="Kia">Kia</option>
                    <option value="Lamborghini">Lamborghini</option>
                    <option value="Land Rover">Land Rover</option>
                    <option value="Lexus">Lexus</option>
                    <option value="Lincoln">Lincoln</option>
                    <option value="Lotus">Lotus</option>
                    <option value="Maserati">Maserati</option>
                    <option value="Mazda">Mazda</option>
                    <option value="McLaren">McLaren</option>
                    <option value="Mercedes-Benz">Mercedes-Benz</option>
                    <option value="Mini">Mini</option>
                    <option value="Mitsubishi">Mitsubishi</option>
                    <option value="Nissan">Nissan</option>
                    <option value="Pagani">Pagani</option>
                    <option value="Peugeot">Peugeot</option>
                    <option value="Porsche">Porsche</option>
                    <option value="Ram">Ram</option>
                    <option value="Renault">Renault</option>
                    <option value="Rolls-Royce">Rolls-Royce</option>
                    <option value="Subaru">Subaru</option>
                    <option value="Suzuki">Suzuki</option>
                    <option value="Tesla">Tesla</option>
                    <option value="Toyota">Toyota</option>
                    <option value="Volkswagen">Volkswagen</option>
                    <option value="Volvo">Volvo</option>
                  </select>
          
                  <input class="mt-2 mb-2 ms-2" type="checkbox" id="inStock" name="inStock" value="inStock">
                  <h6 class="mt-3 mb-2 ms-1" style="color:white;"> متوفر في المخزن</h6>
                </div>
              </div>
          </form>
      </div>
  </div>

    


    <div class="navbar navbar-expand-lg">
        <div class="container">
            <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#menu" 
            aria-controls="menu" 
            aria-expanded="false" 
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="menu">
            
              <ul class="navbar-nav m-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link p-2 p-lg-3" aria-current="page" href="oils.php">زيوت</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-2 p-lg-3" href="battaries.php">بطاريات</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link p-2 p-lg-3" href="brake.php">دواسات الفرامل</a>

                </li><li class="nav-item">
                    <a class="nav-link p-2 p-lg-3" href="accessories.php">مُكَمِّلات</a>
                </li>

                </ul>
            </div>  
        </div>
    </div>

    <section class="credit h-100 h-custom " style="background-color: white; ">
        <div class="container py-5 h-100 " >
          <div class="row d-flex justify-content-center align-items-center h-100\" >
            <div class="col " >
              <div class="card ms-5">
                <div class="card-body p-4 " >
                  <div class="row">
                    <div class="col-lg-12">
                      <div style="background-color:#132763;" class="card text-white rounded-3">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="text-white mb-0">معلومات البطاقة</h5>
                          </div>
      
                          <p class="small mb-2">نوع البطاقة</p>
                          <a href="#!" type="submit" class="text-white"><i
                              class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                          <a href="#!" type="submit" class="text-white"><i
                              class="fab fa-cc-visa fa-2x me-2"></i></a>
                          <a href="#!" type="submit" class="text-white"><i
                              class="fab fa-cc-amex fa-2x me-2"></i></a>
                          <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>
      
                          <form class="mt-4" method="POST" method="<?php echo $PHP_SELF?>">
                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typeName">اسم حامل البطاقة</label>
                              <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                                placeholder="Cardholder's Name" name="Cardholder" />                              
                            </div>
      
                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typeText">رقم البطاقة</label>
                              <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                                placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" name="cardnumber" />                             
                            </div>
      
                            <div class="row mb-4">
                              <div class="col-md-6">
                                <div class="form-outline form-white">
                                    <label class="form-label" for="typeExp">انتهاء الصلاحية</label>s
                                  <input type="date" id="typeExp" class="form-control form-control-lg"
                                    placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" name="expiration" />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-outline form-white">
                                    <label class="form-label" for="typeText">Cvv</label>
                                  <input type="password" id="typeText" class="form-control form-control-lg"
                                    placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" name="cvv" />
                                </div>
                              </div>
                            </div>
      
                          <hr class="my-4">
                            <?php 
                                $id = $_SESSION['userid'];
                                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                                $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                                $sql="SELECT * FROM cart as c INNER JOIN products as p where c.userid='$id' AND c.productid=p.id";
                                $result=$pdo->query($sql);
                                $Total=0;
                                while($row=$result->fetch()){
                                  $Total=$Total+$row['price'];
                                }
                            ?>

                          <div class="d-flex justify-content-between">
                            <p class="mb-2">مبلغ إجمالي</p>
                            <p class="mb-2"><?php echo "$".$Total; ?></p>
                          </div>
      
                          <div class="d-flex justify-content-between">
                            <p class="mb-2">الشحن</p>
                            <p class="mb-2">$20.00</p>
                          </div>
      
                          <div class="d-flex justify-content-between mb-4">
                            <p class="mb-2">المجموع</p>
                            <p class="mb-2"><?php echo "$".$Total+20; ?></p>
                          </div>
      
                          <button style="background-color: rgba(255, 166, 0, 0.949); border: #132763;" type="submit" class="btn btn-info btn-block btn-lg text-white" name="credit">
                            <div class="d-flex justify-content-between">
                              <span class="me-3"><?php echo "$".$Total+20; ?></span>
                              <span class="">Checkout <i class="fa-regular fa-credit-card"></i></span>
                            </div>
                          </button>

                        </div>
                      </div>
      
                      <button class="btn btn-info btn-block btn-lg text-white ms-3 mt-2" style="background-color: rgba(255, 166, 0, 0.949); border: #132763;" type="submit" name="cash">
                        <div class="d-flex justify-content-between">
                          <span></span>
                          <span class="">Pay On Arrival <i class="fa-solid fa-money-bill-1-wave"></i></span>
                        </div>
                      </button>
                    </div>
                     </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

    <footer class="footer text-center text-lg-start">
      <div class="container p-4">
        <div class="row">
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
            <h5 id="about" class=" about text-uppercase">معلومات عنا</h5>
            <p>تأسست باور ويلز في عام 2023 بهدف توفير قطع غيار سيارات عالية الجودة بأسعار معقولة</p>
          </div>
    
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
            <h5 id="contact" class="text-uppercase">تواصل معنا</h5>
    
            <p>
              <p>إذا كانت لديك أي أسئلة أو استفسارات ، فلا تتردد في التواصل معنا على</p>
                <ul style="list-style-type: none;">
                  <li><i class="fa-solid fa-envelope"></i><b> البريد الإلكتروني: </b>info@powerwheels.com</li>
                  <li><i class="fa-solid fa-square-phone"></i><b> رقم الهاتف: </b> **********</li>
                </ul>
            </p>
          </div>
        </div>
      </div>
    
      <div class="text-center p-3">
        <p>&copy; جميع الحقوق محفوظة لدى باور ويلز</p>
      </div>
  </footer>
    
</body>
</html>
<?php 
}
?>