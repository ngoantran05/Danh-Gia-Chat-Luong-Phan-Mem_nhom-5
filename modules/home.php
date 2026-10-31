<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap');

    /* Màu chữ trong banner */
    .toy-hero-content .toy-hero-label {
        background: #ffffff;
        color: #e85d04;
        font-size: 15px;
        font-weight: 800;
    }

    .toy-hero-content h1 {
        color: #263859;
        font-size: 44px;
        font-weight: 800;
        line-height: 1.25;
    }

    .toy-hero-content h1 span {
        color: #ff5722;
    }

    .toy-hero-content p {
        color: #5b6475;
        font-size: 16px;
        font-weight: 600;
        line-height: 1.8;
    }

    .toy-hero-content .toy-hero-button {
        background: linear-gradient(90deg, #ff8a00, #ff5722);
        color: #ffffff;
        font-weight: 800;
        text-decoration: none;
    }

    .toy-hero-content .toy-hero-button:hover {
        background: linear-gradient(90deg, #f56b00, #e84315);
        color: #ffffff;
    }

    .home-container {
        font-family: 'Quicksand', sans-serif;
        max-width: 1280px;
        margin: 0 auto;
        padding: 24px;
        color: #293f5b;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 20px 0 28px;
    }

    .section-title {
        color: #293f5b;
        font-size: 30px;
        font-weight: 800;
        margin: 0;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 75px;
        height: 5px;
        margin-top: 9px;
        background: linear-gradient(90deg, #ff8a24, #ff6178);
        border-radius: 10px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .product-card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        padding: 12px;
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 20px;
        box-shadow: 0 5px 18px rgba(41, 63, 91, 0.07);
        transition: transform .25s ease, box-shadow .25s ease;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(255, 138, 36, 0.18);
    }

    .img-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 205px;
        margin-bottom: 14px;
        overflow: hidden;
        border-radius: 14px;
        background: #fff7f1;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform .3s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.06);
    }

    .product-info {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-name {
        height: 45px;
        margin-bottom: 8px;
        overflow: hidden;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.4;
    }

    .product-name a {
        color: #293f5b;
        text-decoration: none;
    }

    .product-name a:hover {
        color: #ff7f1f;
    }

    .product-price {
        display: block;
        margin: 5px 0 14px;
        color: #f04452;
        font-size: 20px;
        font-weight: 800;
    }

    .btn-buy {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        box-sizing: border-box;
        margin-top: auto;
        padding: 12px 8px;
        border-radius: 30px;
        background: linear-gradient(90deg, #ff8a24, #ff7418);
        color: white;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        transition: .25s ease;
    }

    .btn-buy:hover {
        background: linear-gradient(90deg, #ff6178, #ff8a24);
        color: white;
        transform: translateY(-2px);
    }

    .badge-new {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 2;
        padding: 6px 12px;
        border-radius: 20px;
        background: #ff6178;
        color: white;
        font-size: 11px;
        font-weight: 800;
        box-shadow: 0 3px 8px #ff617833;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 35px 0;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border: 1px solid #ffe2d0;
        border-radius: 50%;
        background: white;
        color: #293f5b;
        font-weight: 700;
        text-decoration: none;
    }

    .page-link:hover,
    .page-link.active {
        border-color: #ff8a24;
        background: #ff8a24;
        color: white;
    }

    @media (max-width: 1000px) {
        .product-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }
    }

    @media (max-width: 700px) {
        .home-container {
            padding: 14px;
        }

        .product-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .img-wrapper {
            height: 155px;
        }

        .section-title {
            font-size: 23px;
        }

        .product-name {
            font-size: 14px;
        }

        .product-price {
            font-size: 17px;
        }

        .btn-buy {
            font-size: 12px;
            padding: 10px 5px;
        }
    }

    /* ===== BANNER TRANG CHỦ TOYSTORE ===== */

    .toy-hero {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 35px;
        min-height: 390px;
        padding: 35px 55px;
        margin: 10px 0 45px;
        border-radius: 25px;
        background: linear-gradient(120deg, #fff0d9, #fff8eb);
        overflow: hidden;
        box-sizing: border-box;
    }

    .toy-hero-content {
        padding: 15px 0;
    }

    .toy-hero-content .toy-hero-label {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 20px;
        background: #fff;
        color: #ff7418;
        font-size: 15px;
        font-weight: 800;
    }

    .toy-hero-content h1 {
        margin: 22px 0;
        color: #263859;
        font-size: 42px;
        font-weight: 800;
        line-height: 1.3;
    }

    .toy-hero-content h1 span {
        color: #ff5722;
    }

    .toy-hero-content p {
        margin: 15px 0 25px;
        color: #5b6475;
        font-size: 16px;
        line-height: 1.8;
    }

    .toy-hero-content .toy-hero-button {
        display: inline-block;
        padding: 13px 25px;
        border-radius: 30px;
        background: linear-gradient(90deg, #ff8a00, #ff5722);
        color: white;
        font-weight: 800;
        text-decoration: none;
        transition: .3s;
    }

    .toy-hero-content .toy-hero-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px #ff8a2455;
    }

    .toy-hero-image {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 320px;
    }

    .toy-hero-image img {
        width: 100%;
        height: 100%;
        max-width: 430px;
        object-fit: contain;
        border-radius: 20px;
    }

    .toy-hero-sticker {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 12px 18px;
        border-radius: 15px;
        background: #ff6178;
        color: white;
        font-weight: 800;
        text-align: center;
        box-shadow: 0 5px 15px #ff617855;
    }

    /* Hiển thị trên điện thoại */
    @media (max-width: 700px) {
        .toy-hero {
            grid-template-columns: 1fr;
            padding: 25px;
            gap: 10px;
            text-align: center;
        }

        .toy-hero-content h1 {
            font-size: 30px;
        }

        .toy-hero-image {
            height: 230px;
        }

        .toy-hero-image img {
            max-width: 280px;
        }
    }
</style>

<div class="home-container">

    <!-- Banner lớn ToyStore -->
    <section class="toy-hero">
        <div class="toy-hero-content">
            <span class="toy-hero-label">Thế giới đồ chơi</span>
            <h1>Mang niềm vui<br><span>đến cho bé!</span></h1>
            <p>Đồ chơi đáng yêu · Khơi nguồn sáng tạo · Niềm vui mỗi ngày</p>

            <a href="#san-pham" class="toy-hero-button">
                Khám phá ngay →
            </a>
        </div>

        <div class="toy-hero-image">
            <img src="/Toy_Store-main/assets/images/gau_bong.jpg" alt="Gấu bông dễ thương">
        </div>
    </section>

    <div class="section-header">
        <h2 class="section-title">
            <i class="fa fa-rocket"></i> ĐỒ CHƠI MỚI VỀ
        </h2>
    </div>

    <div class="product-grid" id="san-pham">
        <?php if (!empty($data['products'])): ?>
            <?php foreach ($data['products'] as $row): ?>
                <div class="product-card">
                    <span class="badge-new">NEW</span>


                    <a href="index.php?mod=detail&id=<?php echo $row['id']; ?>" class="img-wrapper">

                        <?php
                        $imageName = trim($row['image'] ?? '');

                        if (empty($imageName)) {
                            $imagePath = 'assets/images/no-image.png';
                        } elseif (strpos($imageName, 'assets/images/') === 0) {
                            $imagePath = $imageName;
                        } else {
                            $imagePath = 'assets/images/' . basename($imageName);
                        }
                        ?>

                        <img src="/Toy_Store-main/<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>"
                            class="product-img" alt="<?php echo htmlspecialchars($row['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            onerror="this.onerror=null; this.src='/Toy_Store-main/assets/images/no-image.png';">

                    </a>


                    <div class="product-info">
                        <div class="product-name">
                            <a href="index.php?mod=detail&id=<?php echo $row['id']; ?>">
                                <?php echo $row['name']; ?>
                            </a>
                        </div>
                        <span class="product-price"><?php echo number_format($row['price']); ?> đ</span>

                        <a href="index.php?mod=cart&act=add&id=<?php echo $row['id']; ?>" class="btn-buy"
                            onclick="return confirm('Đã thêm sản phẩm vào giỏ hàng! Đi đến giỏ hàng ngay?');">
                            <i class="fa fa-cart-plus"></i> Chọn mua
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 80px; color: #999;">
                <i class="fa fa-box-open" style="font-size: 60px; margin-bottom: 20px; opacity: 0.5;"></i>
                <p>Cửa hàng đang cập nhật sản phẩm...</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($data['total_pages'] > 1): ?>
        <div class="pagination">
            <?php if ($data['current_page'] > 1): ?>
                <a href="index.php?mod=home&p=<?php echo $data['current_page'] - 1; ?>" class="page-link"><i
                        class="fa fa-angle-left"></i></a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
                <a href="index.php?mod=home&p=<?php echo $i; ?>"
                    class="page-link <?php echo ($i == $data['current_page']) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($data['current_page'] < $data['total_pages']): ?>
                <a href="index.php?mod=home&p=<?php echo $data['current_page'] + 1; ?>" class="page-link"><i
                        class="fa fa-angle-right"></i></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>