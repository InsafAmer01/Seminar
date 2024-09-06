<?php 
session_start();
$PHP_SELF=$_SERVER['PHP_SELF'];
include_once "db_conn.php";
  if(isset($_POST['addToCart'])){
  $userid=$_SESSION['userid'];
  $productid=$_POST['info'];
  $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
  $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql="INSERT INTO cart(userid,productid) VALUES ('$userid','$productid')";
  $result=$pdo->exec($sql);
  echo "<script> alert('Item have been added to cart'); </script>";
  data();
}
if(isset($_POST['opnion'])){
  $userid=$_SESSION['userid'];
  $pid = $_SESSION['pid'];
  $comment=$_POST['comment'];
  if(isset($_POST['rating'])){
    $rating=$_POST['rating'];
  }
  else{
    $rating=0;
  }
  
  $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
  $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql="INSERT INTO comment (rating,comment,productid,userid) VALUES ($rating,'$comment',$pid,$userid)";

  $result=$pdo->exec($sql);
  
  header( "refresh:0.5;url=product.php" );
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
    <title>Product Page</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bondi.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

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
                <a class="nav-link p-2 p-lg-3 " aria-current="page" href="main2.php">الصفحة الرئيسية</a>
              </li>

              <?php
              if($_SESSION['accountType']=='customer'){

              ?>
              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="customer.php">الصفحة الشخصية</a>
              </li>
              <?php
                }
                ?>
                 <?php
              if($_SESSION['accountType']=='market'){

              ?>
              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="market.php">الصفحة الشخصية</a>
              </li>
              <?php
                }
                ?>

                   <?php
              if($_SESSION['accountType']=='market'){

              ?>
              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="addProduct.php">إضافة منتج</a>
              </li>
              <?php
                }
                ?>

              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3 " href="cart.php">السلة</a>
              </li>
              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" aria-current="page" href="tracking.php">تتبع الطلبات</a>
              </li>
              <?php 
                if($_SESSION['accountType']=='market'){
                  ?>
                  <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" aria-current="page" href="trackingMarket.php">تتبع طلبات متجرك</a>
              </li>
              <?php 
                }
              ?>
              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="#contact">تواصل معنا</a>
              </li>

              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="#about">معلومات عنا</a>
                </li>
                 

                 <?php
              if($_SESSION['accountType']=='market' || $_SESSION['accountType']=='customer'){

              ?>

                <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="logout.php">تسجيل خروج</a>
              </li>

                <?php
                }else{
                ?>
                <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="login.php">تسجيل دخول</a>
              </li>

                <?php
                }
                ?>
              
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


    <section class="product py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                  <?php 
                    if(isset($_SESSION['pid'])){
                      $pid = $_SESSION['pid'];
                      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                      $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                      $sql="SELECT * FROM images WHERE productID='$pid'";
                      $result=$pdo->query($sql);
                      while($row=$result->fetch()){
                        echo "<figure>";
                        echo "<img class='card-img-top mb-5 mb-md-0' src='images/".$row['name']."' alt=''>";
                        echo "</figure>";

                      }
                      $sql2="SELECT * FROM products WHERE id='$pid'";
                      $result2=$pdo->query($sql2);
                      while($row2=$result2->fetch()){
                  ?>
                    
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder"><?php echo $row2['name'] ?></h1>
                    <?php 
                    $uid=$row2['userID'];
                      $sql3="SELECT * FROM users WHERE id='$uid'";
                      $result3=$pdo->query($sql3);
                      while($row3=$result3->fetch()){
                        ?>
                        <h2 style="color: darkblue;"><?php echo "Market: ".$row3['name'] ?></h2>
                        <?php
                      }
                      ?>
                    <div class="fs-5 mb-5">
                        <span><?php echo $row2['price'] ?></span>
                    </div>
                    <p class="lead"><?php echo $row2['description'] ?></p>
                    <div class="d-flex">
                        <!--input id="form1" min="0" name="quantity" value="1" type="number" class="form-control form-control-sm" style='max-width: 4rem' /-->
                        <?php if($row2['stock']>1){ ?>
                        <form action="<?php echo $PHP_SELF?>" method="post">
                          <input type="submit" name="addToCart" value="Add to Cart" class="btn btnadd shadow-0 me-1">
                          <input type="hidden" name="info" value="<?php echo $_SESSION['pid'] ?>">
                        </form>   
                        <?php 
                          }
                          else{
                            echo "<span><b>Out Of Stock</b></span>";
                          }
                        ?>     
                    </div>
                    <?php 
                        }
                      }

                    ?>
                </div>
            </div>
        </div>
    </section>
    <form action="<?php echo $PHP_SELF?>" method="POST">
      <div class="comSec d-flex  p-5" style="background-color: #eee;">
      <div class="card">
        <div class="row " style="background-color: white;">

          <div class="col-lg-6 p-3">
            <div class="d-flex"> 
              <img src="noPic.png" width="70" height="70" class="rounded-circle"> 
              <div class="">
                <div class="comment-box ml-2">
                  <h4>أضف تعليق</h4>
                  <div class="rating"> 
                    <input type="radio" name="rating" value="5" id="5">
                    <label for="5">☆</label> 
                    <input type="radio" name="rating" value="4" id="4">
                    <label for="4">☆</label> 
                    <input type="radio" name="rating" value="3" id="3">
                    <label for="3">☆</label> 
                    <input type="radio" name="rating" value="2" id="2">
                    <label for="2">☆</label> 
                    <input type="radio" name="rating" value="1" id="1">
                    <label for="1">☆</label> 
                  </div>
                  <div class="comment-area"> 
                    <textarea class="form-control" placeholder="ما رأيك؟" rows="4" name="comment"></textarea> 
                    <button class="btn btn-success send btn-sm mt-2" type="submit" name="opnion">Send <i class="fa fa-long-arrow-right ml-1"></i></button> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          </form>
            
            <?PHP 
              $pid = $_SESSION['pid'];
              $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
              $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              $sql="SELECT * FROM comment WHERE productid=$pid";
              $result=$pdo->query($sql);
              $sum=0;
              $count=0;
              while ($row=$result->fetch()) {
                if($row['rating']==0){

                }
                else{
                  $sum=$sum+$row['rating'];
                  $count++;
                }
                
              }
              if($count==0){

              }
              else{
                $rating=$sum/$count;
                
              
            ?>
          <div class="col-lg-6 p-3">
            <h4>التعليقات</h4>
            <h5 class="small"><?php  echo $rating." Stars based on ".$count." reviews." ?></h5>
               <?PHP 
             }
              $pid = $_SESSION['pid'];
              $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
              $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              $sql2="SELECT * FROM comment as c INNER JOIN users as u WHERE c.productid=$pid AND c.userid=u.id ORDER BY c.comment DESC";
              $result2=$pdo->query($sql2);
              if($result2->rowCount()==0){

              }
              else{
              while ($row2=$result2->fetch()) {
                
              
            ?>
            <div class="card comment mb-2">
              <div class="d-flex p-3"> 
                <img src="noPic.png" width="70" height="70" class="rounded-circle mt-2"> 
                <div class="mt-4 ms-2">
                  <h5 class=""><?php echo $row2['name'];?></h5>
                  <p><?php echo "rated: ";
                        for($i =0; $i<$row2['rating'];$i++){
                          echo "<label style='color:orange;'>☆</label>";
                        }

                  ?></p>
                  <p><?php echo $row2['comment']; ?></p>
                </div>
              </div>
            </div>
              <?php }}?>
      
          </div>
        </div>
      </div>
      
    </div> 
    

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