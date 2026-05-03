<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

<style>
    .login_box_area { margin-top: 50px; margin-bottom: 50px; }
    .login-header { background: linear-gradient(135deg, #141E30 0%, #243B55 100%); color: white; padding: 40px 0; }

    .register_box_img {
        background: linear-gradient(135deg, #141E30 0%, #243B55 100%);
        color: white;
        text-align: center;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px;
        border-radius: 0 10px 10px 0;
    }

    .register_box_img h4 {
        color: white;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .button-account {
        border: 1px solid white;
        background: transparent;
        color: white;
        padding: 10px 30px;
        border-radius: 5px;
        text-decoration: none;
        transition: 0.3s;
        display: inline-block;
        margin-top: 20px;
    }

    .button-account:hover {
        background: white;
        color: #141E30;
    }

    .login_form_inner {
        padding: 50px;
        border: 1px solid #eee;
        border-radius: 10px 0 0 10px;
        height: 100%;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
    }

    .login_form_inner h3 {
        margin-bottom: 30px;
        font-weight: bold;
        color: #333;
        text-align: center;
    }

    .form-control {
        border-radius: 0;
        margin-bottom: 15px;
        border-color: #ddd;
    }

    .button-register {
        background: #2c3e50;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 5px;
        font-weight: bold;
        transition: 0.3s;
    }

    .button-register:hover {
        background: #1a252f;
        color: white;
    }
</style>

<section class="login-header text-center mb-5">
    <div class="container">
        <h1 class="display-5 fw-bold">Kayıt Ol</h1>
    </div>
</section>

<section class="login_box_area">
    <div class="container">
        <div class="row align-items-stretch flex-row-reverse">

            <div class="col-lg-6 mb-4 mb-lg-0 ps-lg-0">
                <div class="register_box_img">
                    <div class="hover">
                        <h4>Zaten bir hesabınız var mı?</h4>
                        <p>Plak koleksiyonunuz, favori albümleriniz ve sepetiniz sizi bekliyor. Müziğin ritmine kaldığınız yerden devam etmek için hemen giriş yapın!</p>
                        <a class="button button-account" href="<?= base_url('login') ?>">Giriş Yap</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 pe-lg-0">
                <div class="login_form_inner bg-white">
                    <h3>Kayıt Ol</h3>

                    <?php if (session()->getFlashdata('hata')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('hata') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('basari')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('basari') ?>
                        </div>
                    <?php endif; ?>

                    <form class="row login_form" action="<?= base_url('register-kaydet') ?>" method="post" id="registerForm">

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="ad_soyad" name="ad_soyad" placeholder="Ad Soyad" required>
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" id="eposta" name="eposta" placeholder="E-Posta Adresi" required>
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="telefon" name="telefon" placeholder="Telefon" required>
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="sifre" name="sifre" placeholder="Şifre" required>
                        </div>

                        <div class="col-md-12 form-group text-center mt-3">
                            <button type="submit" value="submit" class="button button-register w-100">Kayıt Ol</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>