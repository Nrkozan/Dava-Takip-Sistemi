<?php include'admin/dbconnect.php';?>
<?php
session_start();
     if ($_POST) {
        $kullaniciAdi = $_POST['mail'];
        $sifre  = md5($_POST['password']);
            if (empty($kullaniciAdi) || empty($sifre)) {
                echo 'Boş Alan Bırakmayın !';
            }else{
                $uyegiris = $baglanti->prepare("SELECT * FROM bts_uye WHERE mail=? AND sifre=? ");
                $uyegiris->execute(array($kullaniciAdi,$sifre));
                if($uyegiris->rowCount()){
                    foreach ($uyegiris as $uyebilgi) {
                       $uyeIdsi = $uyebilgi['id'];
                       $uyeMail   = $uyebilgi['mail'];
                       $uyeisim   = $uyebilgi['isim'];

                   }
                   $_SESSION["uyeid"] = $uyeIdsi;//Session Oluşturuyoruz.
                   $_SESSION['mail'] = $uyeMail;
                   $_SESSION['isim'] = $uyeisim;
                   //Burada index.php Sayfasına Yönlendiriyoruz.
                    header("location:index.php");
                }else{
                  session_destroy();  
                
                }
            }
     }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Dava Takip Sistemi</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 420px;
  padding: 15px;
  margin: auto;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group > input,
.form-label-group > label {
  height: 3.125rem;
  padding: .75rem;
}

.form-label-group > label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0; /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  pointer-events: none;
  cursor: text; /* Match the input under the label */
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: 1.25rem;
  padding-bottom: .25rem;
}

.form-label-group input:not(:placeholder-shown) ~ label {
  padding-top: .25rem;
  padding-bottom: .25rem;
  font-size: 12px;
  color: #777;
}

/* Fallback for Edge
-------------------------------------------------- */
@supports (-ms-ime-align: auto) {
  .form-label-group > label {
    display: none;
  }
  .form-label-group input::-ms-input-placeholder {
    color: #777;
  }
}

/* Fallback for IE
-------------------------------------------------- */
@media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
  .form-label-group > label {
    display: none;
  }
  .form-label-group input:-ms-input-placeholder {
    color: #777;
  }
}
    </style>
    <!-- Custom styles for this template -->
    <link href="floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" method="post" action="" >
  <div class="text-center mb-4">
    
    <h1 class="h3 mb-3 font-weight-normal">Dava Takip Sistemi</h1>
    <h5>
      <p>demo@demo.com</p>
      <p>demo</p>
    </h5>
  </div>

  <div class="form-label-group">
    <input type="email" id="inputEmail" name="mail" class="form-control" placeholder="batuhan@gmail.com" required>
    <label for="inputEmail">Email</label>
  </div>

  <div class="form-label-group">
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="batu"  required>
    <label for="inputPassword">Şifre</label>
  </div>



 
  <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş Yap</button>
  <p class="mt-5 mb-3 text-muted text-center">&copy; 2018</p>
</form>
</body>
</html>
