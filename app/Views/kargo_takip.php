<?= $this->extend('sablon/ana_sablon') ?>

<?= $this->section('icerik') ?>

    <style>
        .tracking-header { background: linear-gradient(135deg, #141E30 0%, #243B55 100%); color: white; padding: 40px 0; }
        
        /* Kargo Takip Kartı */
        .tracking-card { background: #fff; border: 1px solid #eee; border-radius: 15px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        
        /* Stepper (Aşama Çizelgesi) */
        .stepper { display: flex; justify-content: space-between; position: relative; margin-top: 50px; }
        .stepper::before { content: ""; position: absolute; top: 15px; left: 0; width: 100%; height: 4px; background: #eee; z-index: 1; }
        .step { position: relative; z-index: 2; text-align: center; width: 100%; }
        .step-icon { width: 35px; height: 35px; background: #eee; color: #bbb; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; transition: 0.3s; }
        .step.active .step-icon { background: #11998e; color: white; box-shadow: 0 0 15px rgba(17, 153, 142, 0.4); }
        .step-text { font-size: 0.85rem; font-weight: bold; color: #777; }
        .step.active .step-text { color: #141E30; }

        .search-box { max-width: 500px; margin: 0 auto 40px; }
        .btn-track { background: #243B55; color: white; border-radius: 0 8px 8px 0; padding: 10px 25px; }
    </style>

    <section class="tracking-header text-center mb-5">
        <div class="container">
            <h1 class="display-5 fw-bold"><i class="fa-solid fa-truck-fast me-3"></i>Sipariş Takibi</h1>
            <p class="lead mb-0" style="opacity: 0.8;">Albümlerinin yolculuğunu anlık olarak takip et.</p>
        </div>
    </section>

    <div class="container mb-5">
        <div class="search-box">
            <div class="input-group mb-3 shadow-sm">
                <input type="text" class="form-control border-0 p-3" placeholder="Sipariş Numaranızı Giriniz (Örn: #BEAT-2026)" style="border-radius: 8px 0 0 8px;">
                <button class="btn btn-track" type="button">Sorgula</button>
            </div>
        </div>

        <div class="tracking-card">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
               <input type="text" name="siparis_no" class="form-control border-0 p-3" placeholder="Sipariş Numaranızı Giriniz (Örn: 1025)" style="border-radius: 8px 0 0 8px;">
                <div class="text-end">
                    <span class="badge bg-success py-2 px-3">Kargoya Verildi</span>
                </div>
            </div>

            <div class="stepper">
                <div class="step active">
                    <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                    <div class="step-text">Sipariş Alındı</div>
                </div>
                <div class="step active">
                    <div class="step-icon"><i class="fa-solid fa-box-open"></i></div>
                    <div class="step-text">Hazırlanıyor</div>
                </div>
                <div class="step active">
                    <div class="step-icon"><i class="fa-solid fa-truck"></i></div>
                    <div class="step-text">Kargoya Verildi</div>
                </div>
                <div class="step">
                    <div class="step-icon"><i class="fa-solid fa-house-chimney"></i></div>
                    <div class="step-text">Teslim Edildi</div>
                </div>
            </div>

            <div class="mt-5 p-3 bg-light rounded-3">
                <p class="mb-0 small text-muted text-center">
                    <i class="fa-solid fa-circle-info me-2 text-primary"></i> 
                    <strong>Aras Kargo</strong> ile gönderilmiştir. Takip No: <strong>123456789012</strong>
                </p>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>