<!-- Start your project here-->  
<div id="cssload">
  <span class="loader">
    <span class="loader-inner"></span>
  </span>
  </div>
  <img src="<?= base_url(); ?>/assets/img/other/banner.png" class="img-fluid w-100" alt="">
  <div class="container">
    <div class="text-center p-3">
      
    </div>
    <!-- Card -->
    <h5 class="card-title">Administrasi Masyarakat</h5>
    <div class="card">
      <!-- Card content -->
      <div class="card-body">
        <div class="row text-center">
          <div class="col-4">
            <i class="far fa-address-card fa-3x cyan-text"></i>
            <div class="fa-sm">Permohonan KTP</div>
          </div>
          <div class="col-4">
            <i class="far fa-file-alt fa-3x light-green-text"></i>
            <div class="fa-sm">Permohonan KK</div>
          </div>
          <div class="col-4">
            <i class="far fa-file fa-3x yellow-text"></i>
            <div class="fa-sm">Surat Keterangan Domisili</div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-4">
            <i class="fas fa-file-alt fa-3x light-blue-text"></i>
            <div class="fa-sm">Pengantar SKCK</div>
          </div>
          <div class="col-4">
            <i class="fas fa-address-card fa-3x red-text"></i>
            <div class="fa-sm">Pengantar SIM</div>
          </div>
          <div class="col-4">
            <i class="fas fa-walking fa-3x teal-text"></i>
            <div class="fa-sm">Lainnya</div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <h5 class="card-title">Warta</h5>
    <div class="row">
      <?php
      foreach ($berita as $key => $value) {
      ?>
      <div class="col-6">
        <div class="card">

          <!-- Card image -->
          <div class="view view-cascade overlay">
            <img  class="card-img-top" src="<?= base_url(); ?>/data_upload/berita/<?= $value->foto; ?>" alt="<?= $value->judul; ?>">
            <a href="#!">
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <!-- Card content -->
          <div class="card-body">

            <!-- Title -->
            <h6 class="card-title "><?= $value->judul; ?></h6>
            <!-- Text -->
            <p class="card-text fa-sm"><?= $value->isi; ?></p>
            <!-- Button -->
            <a href="#" class="">Lihat</a>

          </div>

        </div>
        <div class="text-right">
          <span class="badge badge-default ">Lihat warta lainnya</span>
        </div>
      </div>
      <?php
      }
      ?>
    </div>
    <br>
    <h5 class="card-title">Potensi Desa</h5>
    <?php
    foreach ($potensi_desa as $key => $value) {
    ?>
    <div class="card">

      <!-- Card image -->
      <div class="view view-cascade overlay">
        <img  class="card-img-top" src="<?= base_url(); ?>/data_upload/potensi_desa/<?= $value->foto; ?>" alt="<?= $value->judul; ?>">
        <a href="#!">
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>
      <!-- Card content -->
      <div class="card-body">

        <!-- Title -->
        <h6 class="card-title "><?= $value->judul; ?></h6>
        <!-- Text -->
        <p class="card-text fa-sm"><?= $value->isi; ?></p>
        <!-- Button -->
        <a href="#" class="">Lihat</a>

      </div>
    </div>
    <?php
    }
    ?>
    <br>
    <h5 class="card-title">APBDES 2020</h5>
    <div class="col-12">
      <canvas id="myChart" style="max-width: 500px;"></canvas>
    </div>
    <br>
    <h5 class="card-title">Peta Wilayah</h5>
    s
  </div>

    <script type="text/javascript">
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
        }]
        },
        options: {
        scales: {
        yAxes: [{
        ticks: {
        beginAtZero: true
        }
        }]
        }
        }
        });



    </script>