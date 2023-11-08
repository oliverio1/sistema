<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laboratorio Clínico de Referencia B-Lab</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('favicons/favicon-16x16.png') }}" rel="icon">
  <link href="{{ asset('favicons/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('admin/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  {{-- Datatables --}}            
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.css"/>
  <!-- Template Main CSS File -->
  <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
  <style>
    .enviar {
      background-color: #929AE4;
      color: white
    }
  </style>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      {{-- <a href="#" class="logo"><img src="{{ asset('global/img/logo2.png') }}" alt="" class="img-fluid"></a> --}}
      <h1 class="logo"><a href="route">Laboratorio Clínico de Referencia B-Lab</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="#about">Acerca de</a></li>
          <li><a class="nav-link scrollto" href="#services">Servicios</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Catálogo</a></li>
          <li><a class="nav-link scrollto" href="#team">Equipo</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contáctanos</a></li>
          <li><a class="nav-link scrollto" href="{{ route('quejas')}}">Quejas y sugerencias</a></li>
          <li>
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Sistema</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" style="text-decoration: none">Ingresar</a>
                    @endauth
                </div>
            @endif
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
      <h1>Bienvenido a Laboratorio Clínico de Referencia B-Lab</h1>
      <h2>Nos mueve tu salud!</h2>
    </div>
  </section><!-- End Hero -->
  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
            <img src="{{ asset('global/img/6152022_general2_13.jpg') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
            <h3>Acerca de nosotros</h3>
            <p class="fst-italic">
              Laboratorio Clínico B-Lab esta conformado por personal altamente capacitado y especializado en diferentes áreas con la finalidad de ofrecer un servicio integral.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> Contamos con especialistas técnicos, administrativos, de logística, TI con la finalidad de brindar un servicio integral a nuestros socios comerciales</li>
              <li><i class="bi bi-check-circle"></i> Trabajamos con los más altos estándares de calidad, apegandonos a todas las normativas vigentes</li>
              <li><i class="bi bi-check-circle"></i> Buscamos estar siempre a la vanguardia con las tecnologías, tanto técnicas como logísticas para ofrecer el mejor servicio posible</li>
            </ul>
            <h4>Misión y Visión</h4>
            <p>
              Laboratorio Clínico de Referencia B-Lab tiene como misión el mejorar la calidad de vida de la población mexicana ofreciendo un servicio integral tanto al paciente final como a médicos, laboratorios, hospitales y empresas relacionadas al área de la salud.
              Tenemos como objetivo, adaptarnos a las necesidades de cada uno de nuestros clientes y ofrecer todas las facilidades para conseguir un diagnostico oportuno para el paciente final.
              <br/>La visión de la empresa es posicionarse como un Laboratorio de Referencia reconocido por el servicio y la calidad ofrecida a nuestros socios abarcando el territorio nacional en el mediano plazo.
            </p>
          </div>
        </div>

      </div>
    </section>
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <span>Servicios</span>
          <h2>Servicios</h2>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Tomas a domicilio</a></h4>
              <p>Contamos con personal capacitado para acudir a tu domicilio a realizar la toma de muestra para los estudios que necesitas</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="150">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Servicio a empresas</a></h4>
              <p>Tenemos la capacidad de coordinar proyectos empresariales, ofreciendo apoyo en logística, papeleria, reportes y en general, cualquier necesidad que el proyecto requiera</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Tomas a empresas</a></h4>
              <p>Podemos apoyar en jornadas de salud en donde nos encargamos de realizar la toma de muestra al personal solicitado. No te preocupes, nosotros nos encargamos de la logística</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->
    
    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title">
          <span>Catálogo de estudios</span>
          <h2>Catálogo de estudios</h2>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 mt-12 mt-md-0" data-aos="zoom-in">
            <div class="box featured">
              <table id="studies" class="table">
                <thead>
                  <tr>
                    <th>Folio</th>
                    <th>Estudio</th>
                    <th>Especimen</th>
                    <th>Contenedor</th>
                    <th>Tiempo de entrega (DH)</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($estudios as $study)
                    <tr>
                      <td>{{ $study->code }}</td>
                      <td>{{ $study->name }}</td>
                      <td>
                        @foreach($study->specimens as $specimen)
                          <li>{{ $specimen->name }}</li>
                        @endforeach
                      </td>
                      <td>
                        @foreach($study->containers as $container)
                          <li>{{ $container->name }}</li>
                        @endforeach
                      </td>
                      <td>{{ $study->delivery }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title">
          <span>Equipo</span>
          <h2>Equipo</h2>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
            <div class="member">
              {{-- <img src="assets/img/team/team-1.jpg" alt=""> --}}
              <h4>Dr. Oliver Martínez</h4>
              <span>Director ejecutivo</span>
              <p>
                Egresado de la Facultad de Química, UNAM. 10 años de experiencia en la coordinación de laboratorios clínicos
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
            <div class="member">
              {{-- <img src="assets/img/team/team-2.jpg" alt=""> --}}
              <h4>I.Q. Josué Gutiérrez</h4>
              <span>Director administrativo</span>
              <p>
                Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
            <div class="member">
              {{-- <img src="assets/img/team/team-3.jpg" alt=""> --}}
              <h4>Lic. Carlos Ponce</h4>
              <span>Director financiero</span>
              <p>
                Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-2"></div>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
            <div class="member">
              {{-- <img src="assets/img/team/team-2.jpg" alt=""> --}}
              <h4>Q.F.B. Gibran Garcia</h4>
              <span>Jefe de Laboratorio</span>
              <p>
                Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
            <div class="member">
              {{-- <img src="assets/img/team/team-3.jpg" alt=""> --}}
              <h4>Lic. Alejandro Sandoval</h4>
              <span>Coordinador de Logística</span>
              <p>
                Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <span>Contacto</span>
          <h2>Contacto</h2>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-5">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Dirección</h3>
              <p>Prolongación Ignacio Aldama 151a<br>Pasesos del Sur, Xochimilco. CP 16010</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Correo electrónico</h3>
              <p>contacto@laboratorioblab.com</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Teléfono</h3>
              <p>55 6917 7811 (Laboratorio)</p>
              <p>55 1550 3685 (Administración)</p>
              <p>55 4153 6624 (Logística)</p>
            </div>
          </div>

        </div>

        <div class="row" data-aos="fade-up">

          <div class="col-lg-6 ">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1883.084121207662!2d-99.1269163723687!3d19.275048488040678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce01137ecb8e47%3A0x31f1ee4c04a77a53!2sProlongaci%C3%B3n%20Ignacio%20Aldama%20151a%2C%20Paseos%20del%20Sur%2C%20Xochimilco%2C%2016010%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1696941385277!5m2!1ses-419!2smx" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>          </div>

          <div class="col-lg-6">
            @livewire('contact-us')
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>B-Lab</h3>
              <p>
                Prolongación Ignacio Aldama 151a<br>Pasesos del Sur, Xochimilco. CP 16010<br><br>
                <strong>Teléfono:</strong> 55 6917 7811<br>
                <strong>Correo:</strong> contacto@blaboratorio.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 ml-6 footer-links">
            <h4></h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Inicio</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Acerca de</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Servicios</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Política de privacidad</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Nuestros servicios</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Toma a domicilio</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Servicios a empresas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Programas especiales</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Logística</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Análisis de datos</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Day</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('admin/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/swiper/swiper-bundle.min.js') }}"></script>
  {{-- <script src="{{ asset('admin/vendor/php-email-form/validate.js') }}"></script> --}}
  <!-- Template Main JS File -->
  <script src="{{ asset('admin/js/main.js') }}"></script>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  {{-- Datatables --}}
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function () {
        $('#studies').DataTable({
            dom: '<"area-fluid"<"row"<"col"B><"col"f>>>rti',
            "columnDefs": [
                { "type": "num", "targets": 2 }
            ],
            paging: true,
            info: false,
            "order": [[ 0, "asc" ]],
            buttons: [
            ],
            language: {
                url: '/datatables.json'
            }
        });
    });
</script>

</body>

</html>