<?php 
session_start();
$PHP_SELF=$_SERVER['PHP_SELF'];
include_once "db_conn.php";
if(isset($_POST['submit'])){
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="SELECT * FROM products";
    $result=$pdo->query($sql);
    $PID = 0;
    while($row=$result->fetch()){
      $PID = $row['id'];
    }
    $_SESSION['name']=$_POST['name'];
    $_SESSION['description']=$_POST['description'];
    $_SESSION['price']=$_POST['price'];
    $_SESSION['stock']=$_POST['stock'];
    $_SESSION['brand']=$_POST['productBrand'];
    $_SESSION['category']=$_POST['productCategory'];
    $_SESSION['productType']=$_POST['productType'];
    $_SESSION['PID']=$PID+1;
      echo "<script> alert('Product Added Successfuly') </script>";
      header("Location:addProductImages.php");
    
   
            
           
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
    <title>Add Product</title>
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
              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="market.php">الصفحة الشخصية</a>
              </li>
              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3 active" href="addProduct.php">إضافة منتج</a>
              </li>

              <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" aria-current="page" href="cart.php">السلة</a>
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

              </li><li class="nav-item">
                <a class="nav-link p-2 p-lg-3" href="logout.php">تسجيل خروج</a>
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

    <section class="addProduct py-5">
        <div class="container mt-5 mb-5">
            <div class="d-flex mb-3">
                <i class="fa-regular fa-square-plus fa-2xl pt-3 me-2 "></i>
                <h2>أضف منتج</h2>
            </div>
            
            <form action="<?php echo $PHP_SELF; ?>" method="POST">
              <div class="form-group">
                <label for="productName ">اسم المنتج</label>
                <input type="text" class="form-control" id="productName" name="name"placeholder="أدخل اسم المنتج" required="required">
              </div>
              <div class="form-group">
                <label for="productDescription">وصف المنتج</label>
                <textarea class="form-control" id="productDescription" name="description" placeholder="أدخل وصف المنتج" required="required"></textarea>
              </div>
              <div class="form-group">
                <label for="productPrice">السعر</label>
                <input type="number" class="form-control" id="productPrice" name="price"placeholder="أدخل سعر المنتج" required="required" min="1">
              </div>
              <div class="form-group">
                <label for="productStock">عدد القطع في المخزن</label>
                <input type="number" class="form-control" id="productStock" name="stock" placeholder="أدخل عدد العناصر الموجودة في المخزون" required="required" min="1">
              </div>
              <div class="form-outline mb-4 mt-3" style="display: block;">
              <h5>الحالة</h5>
                 <div>
                    <label class="block"><input type="radio" name="productType" value="New" required="required">&nbsp;جديد</label>
                    <label class="block ms-5"><input type="radio" name="productType" value="Used" required="required">&nbsp;مستخدم</label>
                 </div>
              </div>  
              <div class="form-group">
                <label for="productBrand">العلامة التجارية</label>
                    <select name="productBrand" class="form-control" id="productBrand" placeholder="أدخل العلامة التجارية"required="required">
                    
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
              </div>
              <div class="form-group">
                <label for="productCategory">الفئة</label>
                    <select name="productCategory" class="form-control" id="productCategory" placeholder="أدخل الفئة" required="required">
                     <option>زيوت</option>
                     <option>مكابح</option>
                     <option>بطاريات</option>
                     <option>مكملات</option>
                     <option >اخرى</option>
                    </select>
              </div>
              <button type="submit" name="submit"class="btn btn-lg">أضف المنتج</button>
            </form>
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