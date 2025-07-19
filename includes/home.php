<!-- About Section -->
  <section id="about" class="section-padding bg-light">
    <div class="container">
      <h2 class="text-center fw-bold mb-4">About Us</h2>
      <p class="text-center w-75 mx-auto">
        Our mission is to connect loving families with children in need of a home. We provide guidance and support throughout the adoption journey to ensure a safe and nurturing environment for every child.
      </p>
    </div>
  </section>

  <!-- Foster Care Statistics Section -->
  <!-- Foster Care Statistics Section -->
<section id="statistics" class="section bg-light text-center"> 
  <div class="container">
    <h2 class="fw-bold mb-3">Foster Care Statistics</h2>
    <p class="mb-5">Our commitment to connecting families with children in need of loving homes</p>
    <div class="row g-4 justify-content-center">
      
      <div class="col-md-4">
        <div class="p-4 stat-card bg-white">
          <div class="d-flex justify-content-between align-items-center">
            <div class="text-start">
              <small class="text-muted">Children in Foster Care</small>
              <h3 class="fw-bold"><?= $children_count ?></h3>
            </div>
            <div class="icon-box bg-primary">
              <i class="bi bi-people fs-4"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 stat-card bg-white">
          <div class="d-flex justify-content-between align-items-center">
            <div class="text-start">
              <small class="text-muted">Foster Care Centers</small>
              <h3 class="fw-bold"><?= $center_count ?></h3>
            </div>
            <div class="icon-box bg-success">
              <i class="bi bi-building fs-4"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 stat-card bg-white">
          <div class="d-flex justify-content-between align-items-center">
            <div class="text-start">
              <small class="text-muted">Successful Adoptions</small>
              <h3 class="fw-bold"><?= $adoption_count ?></h3>
            </div>
            <div class="icon-box bg-purple" style="background: linear-gradient(135deg, #b76df1, #8756db);">
              <i class="bi bi-heart fs-4"></i>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


  <!-- Team Section -->
  <section id="team" class="section-padding">
    <div class="container">
      <h2 class="text-center fw-bold mb-4">Meet Our Team</h2>
      <div class="row text-center">
        <div class="col-md-4">
          <img src="pages/assets/img/woman.png" style="width: 200px; height: 200px;" class="rounded-circle mb-3" alt="Team member">
          <h5>ZAYNAB HASHIM</h5>
          <p class="text-muted">Adoption Specialist</p>
        </div>
        <div class="col-md-4">
          <img src="pages/assets/img/profile.png" style="width: 200px; height: 200px;" class="rounded-circle mb-3" alt="Team member">
          <h5>ADNAN JUMA</h5>
          <p class="text-muted">Social Worker</p>
        </div>
        <div class="col-md-4">
          <img src="pages/assets/img/man.png" style="width: 200px; height: 200px;" class="rounded-circle mb-3" alt="Team member">
          <h5>NURDIN RULLO</h5>
          <p class="text-muted">Legal Advisor</p>
        </div>
      </div>
    </div>
  </section>

  <!-- How to Apply Section -->
  <section id="howtoapply" class="section-padding bg-white">
    <div class="container">
      <h2 class="fw-bold text-center mb-3">How to Apply for Adoption</h2>
      <p class="text-center text-muted mb-5">Follow these simple steps to begin your adoption journey</p>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="apply-card p-4 h-100">
            <div class="d-flex align-items-start">
              <div class="number-circle me-3">1</div>
              <div>
                <h5 class="fw-bold mb-1">Register your account and complete the application form</h5>
                <p class="text-muted mb-0">Complete your personal information and background details</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="apply-card p-4 h-100">
            <div class="d-flex align-items-start">
              <div class="number-circle me-3">2</div>
              <div>
                <h5 class="fw-bold mb-1">Upload required documents for verification</h5>
                <p class="text-muted mb-0">Provide necessary legal and medical documentation</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="apply-card p-4 h-100">
            <div class="d-flex align-items-start">
              <div class="number-circle me-3">3</div>
              <div>
                <h5 class="fw-bold mb-1">Wait for admin approval of your application</h5>
                <p class="text-muted mb-0">Our team will review your application thoroughly</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="apply-card p-4 h-100">
            <div class="d-flex align-items-start">
              <div class="number-circle me-3">4</div>
              <div>
                <h5 class="fw-bold mb-1">Browse available children and express interest</h5>
                <p class="text-muted mb-0">Connect with children who match your preferences</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="section-padding bg-light">
    <div class="container">
      <h2 class="text-center fw-bold mb-3">Contact Our Support Services</h2>
      <p class="text-center text-muted mb-5">
        Our dedicated team is here to help you through every step of the adoption process.
        Reach out to us for guidance, support, and assistance.
      </p>
      <div class="row g-4">
        <div class="col-md-3">
          <div class="contact-card p-4 h-100">
            <i class="fas fa-phone phone-icon"></i>
            <h5 class="fw-bold mt-3">Phone Support</h5>
            <p class="mb-1">+255 625575525</p>
            <p class="text-muted">Call us for immediate assistance</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="contact-card p-4 h-100">
            <i class="fas fa-envelope email-icon"></i>
            <h5 class="fw-bold mt-3">Email Support</h5>
            <p class="mb-1">support@kidswelfare.com</p>
            <p class="text-muted">Send us your questions via email</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="contact-card p-4 h-100">
            <i class="fas fa-map-marker-alt location-icon"></i>
            <h5 class="fw-bold mt-3">Office Location</h5>
            <p class="mb-1">Kijitonyama,sayansi, Dar es Salaam</p>
            <p class="text-muted">Visit our main office</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="contact-card p-4 h-100">
            <i class="fas fa-clock hours-icon"></i>
            <h5 class="fw-bold mt-3">Working Hours</h5>
            <p class="mb-1">Mon - Fri: 8AM - 6PM</p>
            <p class="text-muted">Available during business hours</p>
          </div>
        </div>
      </div>
    </div>
  </section>