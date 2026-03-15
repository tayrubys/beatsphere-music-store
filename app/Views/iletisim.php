<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

    <style>  
      .login-header { background: linear-gradient(135deg, #141E30 0%, #243B55 100%); color: white; padding: 40px 0; }     
        /* Stepper (Aşama Çizelgesi) */
        .stepper { display: flex; justify-content: space-between; position: relative; margin-top: 50px; }
        .stepper::before { content: ""; position: absolute; top: 15px; left: 0; width: 100%; height: 4px; background: #eee; z-index: 1; }
        .step { position: relative; z-index: 2; text-align: center; width: 100%; }
        .step-icon { width: 35px; height: 35px; background: #eee; color: #bbb; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; transition: 0.3s; }
        
        /* Renk Değişiklikleri: Aktif Aşama Renkleri */
        .step.active .step-icon { 
            /* Orijinal Yeşilimsi Değiştirildi */
            background: #007bff; 
            color: white; box-shadow: 0 0 15px rgba(0, 123, 255, 0.4); 
        }
        .step-text { font-size: 0.85rem; font-weight: bold; color: #777; }
        .step.active .step-text { 
            /* Orijinal Lacivert Değiştirildi */
            color: #007bff; 
        }

        .search-box { max-width: 500px; margin: 0 auto 40px; }
        
   /* Harita çerçevesi ayarları */
    .map-responsive {
      overflow: hidden;
      padding-bottom: 56.25%;
      /* 16:9 oranı korur */
      position: relative;
      height: 0;
    }

    .map-responsive iframe {
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      position: absolute;
    }
        .btn-track { 
            /* Orijinal Lacivert Değiştirildi */
            background: #007bff; 
            color: white; border-radius: 0 8px 8px 0; padding: 10px 25px; 
        }
    </style>

       <section class="login-header text-center mb-5">
        <div class="container">
            <h1 class="display-5 fw-bold">İletişim</h1>
        </div>
    </section>

    <section class="section-margin--small">
        <div class="container">
       <div class="mb-5 pb-4 map-container-custom">
        <iframe width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
          src="https://maps.google.com/maps?q=Cumhuriyet+Cd,+İzmit&t=&z=15&ie=UTF8&iwloc=&output=embed"
          style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
      </div>

            <div class="row">
                <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                    <div class="media contact-info mb-4 d-flex">
                        <span class="contact-info__icon me-3"><i class="fa-solid fa-house text-primary fs-4"></i></span>
                        <div class="media-body">
                            <h5 class="fw-bold mb-1">Kocaeli, Türkiye</h5>
                            <p class="text-muted">Cumhuriyet Cd. İzmit Merkez</p>
                        </div>
                    </div>
                    <div class="media contact-info mb-4 d-flex">
                        <span class="contact-info__icon me-3"><i class="fa-solid fa-phone text-primary fs-4"></i></span>
                        <div class="media-body">
                            <h5 class="fw-bold mb-1">+90 555 555 55 55</h5>
                            <p class="text-muted">Pzt - Cmt 09:00 - 18:00</p>
                        </div>
                    </div>
                    <div class="media contact-info d-flex">
                        <span class="contact-info__icon me-3"><i class="fa-solid fa-envelope text-primary fs-4"></i></span>
                        <div class="media-body">
                            <h5 class="fw-bold mb-1">iletisim@beatsphere.com</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">
                    <form action="#" class="form-contact contact_form" method="post" id="contactForm">
                        <div class="row g-3">
                            <div class="col-lg-5">
                                <div class="form-group mb-3">
                                    <input class="form-control p-3 border" name="name" id="name" type="text" placeholder="Adınız Soyadınız">
                                </div>
                                <div class="form-group mb-3">
                                    <input class="form-control p-3 border" name="email" id="email" type="email" placeholder="E-posta Adresiniz">
                                </div>
                                <div class="form-group mb-3">
                                    <input class="form-control p-3 border" name="subject" id="subject" type="text" placeholder="Konu">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <textarea class="form-control p-3 border w-100" name="message" id="message" cols="30" rows="7" placeholder="Mesajınız"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center text-md-end mt-3">
                            <button type="submit" class="button button--active btn btn-primary px-5 py-3 shadow">Mesajı Gönder</button>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script async src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY_HERE&callback=initMap"></script>
   <script>
    
</script>

<?= $this->endSection() ?>