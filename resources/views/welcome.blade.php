<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .hero {
      background: url('https://source.unsplash.com/1600x900/?organization') no-repeat center center/cover;
      height: 100vh;
      color: rgb(0, 119, 167);
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
    }

    .hero .hero-text {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
    }

    .hero .btn {
      margin-top: 20px;
    }

    .services, .about {
      padding: 60px 0;
    }

    footer {
      background-color: #f8f9fa;
      padding: 40px 0;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">Jombang Kota</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#about">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
          <li class="nav-item disabled">
            <a class="nav-link" href="#contact">|</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero d-flex justify-content-center align-items-center">
    <div class="hero-text">
      <h1>Welcome to Jombang Kota</h1>
      <p>Making a difference in the world</p>
      <a href="#about" class="btn btn-primary">Learn More</a>
    </div>
  </section>

  <!-- About Us Section -->
  <section id="about" class="about bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h2>About Us</h2>
          <p>Our organization is dedicated to bringing positive change and improving the quality of life for individuals and communities. We focus on sustainable development, education, and social innovation.</p>
          <a href="#services" class="btn btn-primary mt-3">Our Services</a>
        </div>
        <div class="col-lg-6">
          <img src="https://source.unsplash.com/600x400/?team" class="img-fluid rounded" alt="About us image">
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="services">
    <div class="container">
      <div class="text-center mb-5">
        <h2>Our Services</h2>
        <p>We offer a wide range of services to meet the needs of our communities.</p>
      </div>
      <div class="row text-center">
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">Community Development</h5>
              <p class="card-text">Empowering local communities through sustainable projects and education programs.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">Education</h5>
              <p class="card-text">Providing access to quality education and resources for underprivileged communities.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">Social Innovation</h5>
              <p class="card-text">Driving change through innovative solutions to social and environmental challenges.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="bg-light py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2>Contact Us</h2>
        <p>We'd love to hear from you. Get in touch with us for more information.</p>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Your Name">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Your Email">
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" rows="4" placeholder="Your Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="col-lg-6">
          <h5>Our Location</h5>
          <p>123 Organization St., City, Country</p>
          <h5>Email</h5>
          <p>contact@organization.com</p>
          <h5>Phone</h5>
          <p>+123 456 7890</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center">
    <div class="container">
      <p>&copy; 2024 Muhdani Boyrendi Erlan Azhari. All Rights Reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
