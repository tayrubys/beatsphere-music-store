<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

    <style>
        /* Senin temanın login sayfasına özel bazı CSS kuralları */
        .login-header { background: linear-gradient(135deg, #141E30 0%, #243B55 100%); color: white; padding: 40px 0; }
        .login_box_area { margin-top: 50px; margin-bottom: 50px; }
       .login_box_img { background: linear-gradient(135deg, #141E30 0%, #243B55 100%); color: white; text-align: center; height: 100%; display: flex; align-items: center; justify-content: center; padding: 50px; border-radius: 10px 0 0 10px; }
        .button-account { border: 1px solid white; color: white; padding: 10px 30px; border-radius: 5px; text-decoration: none; transition: 0.3s; display: inline-block; margin-top: 20px;}
        .button-account:hover { background: white; color: #333; }
        
        .login_form_inner { padding: 50px; border: 1px solid #eee; border-radius: 0 10px 10px 0; height: 100%; box-shadow: 0 0 15px rgba(0,0,0,0.05); }
        .login_form_inner h3 { margin-bottom: 30px; font-weight: bold; color: #333; text-align: center; }
        .form-control { border-radius: 0; margin-bottom: 15px; border-color: #ddd; }
        .button-login { background: #2c3e50; color: white; border: none; padding: 12px; border-radius: 5px; font-weight: bold; transition: 0.3s; }
        .button-login:hover { background: #1a252f; color: white; }
        
        .creat_account { margin-bottom: 15px; }
        .creat_account label { margin-left: 5px; color: #777; }
        
    </style>
   <section class="login-header text-center mb-5">
        <div class="container">
            <h1 class="display-5 fw-bold">Giriş Yap</h1>
        </div>
    </section>
    <section class="login_box_area">
        <div class="container">
            <div class="row align-items-stretch">
                
                <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-0">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Web sitemizde yeni misiniz?</h4>
                            <p>"Müzik tutkunuza ortak olalım! En sevdiğiniz sanatçıların albümlerine hızlıca ulaşmak, koleksiyonunuzu genişletmek ve müziğin ritmini yakalamak için hemen ücretsiz hesabınızı oluşturun."</p>
                            <a class="button button-account" href="<?= base_url('register') ?>">Hesap Oluştur</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 ps-lg-0">
                    <div class="login_form_inner bg-white">
                        <h3>Giriş Yap</h3>
                    

<?php if (session()->getFlashdata('hata')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('hata') ?>
    </div>
<?php endif; ?>

<form action="<?= site_url('login-kontrol') ?>" method="post">
                      <form action="<?= site_url('login-kontrol') ?>" method="post">
                        <div class="col-md-12 form-group">
                         <input type="email" class="form-control" name="eposta" placeholder="E-posta" required>
                        </div>
                        <div class="col-md-12 form-group">
                          <input type="password" class="form-control" name="sifre" placeholder="Şifre" required>
                        </div>
                        <div class="col-md-12 form-group text-center mt-4">
                         <button type="submit" class="button button-login w-100">Giriş Yap</button>
                         </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?= $this->endSection() ?>