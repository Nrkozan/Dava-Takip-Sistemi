<?php include 'admin/guvenlik.php'; ?>
<?php
date_default_timezone_set('Europe/Istanbul');
$simdi = date("d-m-Y");
if ($_POST) {
if ($_POST['event'] == 'ekle') {
$durum = 'devam';
$stmt = $baglanti->prepare("INSERT INTO bts_dava
(dosyano,dosyadi,muvekkil,aciklama,tarih,mahkemetarih,durum)
VALUES
(:var1,:var2,:var3,:var4,:var5,:var6,:var7)");
$stmt->bindParam(':var1', $_POST['dno'], PDO::PARAM_STR);
$stmt->bindParam(':var2', $_POST['dad'], PDO::PARAM_STR);
$stmt->bindParam(':var3', $_POST['muvekkil'], PDO::PARAM_STR);
$stmt->bindParam(':var4', $_POST['aciklama'], PDO::PARAM_STR);
$stmt->bindParam(':var5', $_POST['t1'], PDO::PARAM_STR);
$stmt->bindParam(':var6', $_POST['t2'], PDO::PARAM_STR);
$stmt->bindParam(':var7', $durum, PDO::PARAM_STR);
$stmt->execute();
}
if ($_POST['event'] == 'update') {

$stmt = $baglanti->prepare("UPDATE bts_dava
SET
dosyano     =   :var1,
dosyadi       =   :var2,
muvekkil       =   :var3,
aciklama       =   :var4,
tarih       =   :var5,
mahkemetarih       =   :var6,
durum       =   :var7
WHERE id=   :kod");
$stmt->bindParam(':var1', $_POST['dno'], PDO::PARAM_STR);
$stmt->bindParam(':var2', $_POST['dad'], PDO::PARAM_STR);
$stmt->bindParam(':var3', $_POST['muvekkil'], PDO::PARAM_STR);
$stmt->bindParam(':var4', $_POST['aciklama'], PDO::PARAM_STR);
$stmt->bindParam(':var5', $_POST['t1'], PDO::PARAM_STR);
$stmt->bindParam(':var6', $_POST['t2'], PDO::PARAM_STR);
$stmt->bindParam(':var7', $_POST['durum'], PDO::PARAM_STR);
$stmt->bindParam(':kod', $_POST['kod'], PDO::PARAM_STR);
$stmt->execute();
}
}
$dbsorgu = $baglanti->prepare("SELECT * FROM bts_dava  where durum = 'bitti'");
$dbsorgu->execute();
$dbsorgu2 = $baglanti->prepare("SELECT * FROM bts_dava  where durum = 'devam'");
$dbsorgu2->execute();
?>
<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"><?php echo $_SESSION['isim'];?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link pull-right" href="admin/cikis.php" >Oturumu Kapat</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Yeni Dava Ekle</button>
          &nbsp;
          
        </form>
      </div>
    </nav>
    <main role="main" class="container">
      
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Devam Eden Davalar</h6>
        <?php  while($dbrow = $dbsorgu2->fetch()) {  ?>
        <div class="media text-muted pt-3">
          <div class="p-1 mb-2 bg-info text-white"><?=$dbrow['dosyano']?></div>
          &nbsp;
          <div class="media-body pb-1 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong id="listeisim" class="text-gray-dark"><?=$dbrow['dosyadi']?> - <?=$dbrow['muvekkil']?></strong>
              <a href="#" data-toggle="modal" onclick="islemyap(<?=$dbrow['id']?>,'<?=$dbrow['isim']?>','<?=$dbrow['total']?>')" data-target="#islemyap<?=$dbrow['id']?>" id="islem">İşlem Yap</a>
            </div>
            <span class="d-block"><?=$dbrow['aciklama']?> - <b>Dava Tarih :</b> <?=$dbrow['mahkemetarih']?></span>
          </div>
        </div>
        <div class="modal fade" id="islemyap<?=$dbrow['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=$dbrow['dosyadi']?> - <?=$dbrow['muvekkil']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="index.php">
                  <div class="row">
                    <div class="col">
                      <input type="text" value="<?=$dbrow['dosyadi']?>" class="form-control" name="dad" placeholder="Dosya Adı">
                    </div>
                    <div class="col">
                      <input type="number" value="<?=$dbrow['dosyano']?>" class="form-control" name="dno" placeholder="Dosya No">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col">
                      <input type="text" value="<?=$dbrow['muvekkil']?>" class="form-control" name="muvekkil" placeholder="Muvekkil">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <label>Açılış Tarih</label>
                      <input type="date" value="<?=$dbrow['tarih']?>" name="t1" class="form-control" >
                    </div>
                    <div class="col-md-6">
                      <label>Mahkeme Tarih</label>
                      <input type="date" value="<?=$dbrow['mahkemetarih']?>" name="t2" class="form-control" >
                    </div>
                    <br> <br>
                    <div class="col-md-12">
                      <label class="text-muted" for="exampleFormControlTextarea1">Açıklama</label>
                      <textarea class="form-control" name="aciklama" id="exampleFormControlTextarea1" rows="3"><?=$dbrow['aciklama']?></textarea>
                    </div>
                    <br>
                    <div class="col-md-12">
                      <label>Durum</label>
                      <select class="form-control" name="durum">
                        <option <?php if($dbrow['durum'] == 'bitti') {echo " selected ";}?> value="bitti">Bitti</option>
                        <option <?php if($dbrow['durum'] == 'devam') {echo " selected ";}?> value="devam">Devam Ediyor</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" value="<?=$dbrow['id']?>" name="kod">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                  <button type="submit" name="event" value="update" class="btn btn-primary">Kaydet</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <?php  } ?>
      </div>

       <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Sonuçlanan Davalar</h6>
        <?php  while($dbrow = $dbsorgu->fetch()) {  ?>
        <div class="media text-muted pt-3">
          <div class="p-1 mb-2 bg-info text-white"><?=$dbrow['dosyano']?></div>
          &nbsp;
          <div class="media-body pb-1 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong id="listeisim" class="text-gray-dark"><?=$dbrow['dosyadi']?> - <?=$dbrow['muvekkil']?></strong>
              <a href="#" data-toggle="modal" onclick="islemyap(<?=$dbrow['id']?>,'<?=$dbrow['isim']?>','<?=$dbrow['total']?>')" data-target="#islemyap<?=$dbrow['id']?>" id="islem">İşlem Yap</a>
            </div>
            <span class="d-block"><?=$dbrow['aciklama']?> - <b>Dava Tarih :</b> <?=$dbrow['mahkemetarih']?></span>
          </div>
        </div>
        <div class="modal fade" id="islemyap<?=$dbrow['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=$dbrow['dosyadi']?> - <?=$dbrow['muvekkil']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="index.php">
                  <div class="row">
                    <div class="col">
                      <input type="text" value="<?=$dbrow['dosyadi']?>" class="form-control" name="dad" placeholder="Dosya Adı">
                    </div>
                    <div class="col">
                      <input type="number" value="<?=$dbrow['dosyano']?>" class="form-control" name="dno" placeholder="Dosya No">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col">
                      <input type="text" value="<?=$dbrow['muvekkil']?>" class="form-control" name="muvekkil" placeholder="Muvekkil">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <label>Açılış Tarih</label>
                      <input type="date" value="<?=$dbrow['tarih']?>" name="t1" class="form-control" >
                    </div>
                    <div class="col-md-6">
                      <label>Mahkeme Tarih</label>
                      <input type="date" value="<?=$dbrow['mahkemetarih']?>" name="t2" class="form-control" >
                    </div>
                    <br> <br>
                    <div class="col-md-12">
                      <label class="text-muted" for="exampleFormControlTextarea1">Açıklama</label>
                      <textarea class="form-control" name="aciklama" id="exampleFormControlTextarea1" rows="3"><?=$dbrow['aciklama']?></textarea>
                    </div>
                    <br>
                    <div class="col-md-12">
                      <label>Durum</label>
                      <select class="form-control" name="durum">
                        <option <?php if($dbrow['durum'] == 'bitti') {echo " selected ";}?> value="bitti">Bitti</option>
                        <option <?php if($dbrow['durum'] == 'devam') {echo " selected ";}?> value="devam">Devam Ediyor</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" value="<?=$dbrow['id']?>" name="kod">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                  <button type="submit" name="event" value="update" class="btn btn-primary">Kaydet</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <?php  } ?>
      </div>
      
    </main>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yeni Kayıt Aç</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="index.php">
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" name="dad" placeholder="Dosya Adı">
                </div>
                <div class="col">
                  <input type="number" class="form-control" name="dno" placeholder="Dosya No">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" name="muvekkil" placeholder="Muvekkil">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <label>Açılış Tarih</label>
                  <input type="date"  name="t1" class="form-control" >
                </div>
                <div class="col-md-6">
                  <label>Mahkeme Tarih</label>
                  <input type="date"  name="t2" class="form-control" >
                </div>
                <br> <br>
                <div class="col-md-12">
                  <label class="text-muted" for="exampleFormControlTextarea1">Açıklama</label>
                  <textarea class="form-control" name="aciklama" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
              <button type="sumbit" name="event" value="ekle" class="btn btn-primary">Oluştur</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    
  </body>
</html>