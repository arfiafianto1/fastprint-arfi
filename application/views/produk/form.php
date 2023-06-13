<form action="<?= base_url("produk/save") ?>" method="POST" id="form-product">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title"><?= $title ?></h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="<?= base_url("produk") ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                    
                    <hr class="">
                    <div class="form-group row">
                        <label for="produk_id_produk" class="col-md-3 col-form-label">ID Produk</label>
                        <div class="col-md-7">
                            <input type="text" name="id_produk" class="form-control" value="<?= !empty($product) ? $product->id_produk : "" ?>" id="produk_id_produk" placeholder="Masukkan ID Produk">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="produk_nama_produk" class="col-md-3 col-form-label">Nama Produk</label>
                        <div class="col-md-7">
                            <textarea name="nama_produk" id="produk_nama_produk" class="form-control" rows="3" placeholder="Masukkan Nama Produk"><?= !empty($product) ? $product->nama_produk : "" ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-3 col-form-label">Kategori</label>
                        <div class="col-md-7">
                            <div class="d-flex" style="column-gap: 1rem;">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input kategori_option" id="kategori_existed" name="kategori_option" required value="existed" checked>
                                    <label class="form-check-label mb-0" for="kategori_existed">Dari Database</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input kategori_option" id="kategori_new" name="kategori_option" required value="new">
                                    <label class="form-check-label mb-0" for="kategori_new">Kategori Baru</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row div-kategori-existed">
                        <label for="" class="col-md-3 col-form-label"></label>
                        <div class="col-md-7">
                            <?php $product_category = !empty($product) ? $product->kategori : "" ?>
                            <select name="kategori" class="kategori form-control" id="produk_kategori_existed">
                                <!-- <option value="">Pilih Kategori</option> -->
                                <?php foreach($categories as $category): ?>
                                    <option <?= $category->kategori == $product_category ? "selected" : "" ?>><?= $category->kategori ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row div-kategori-new" style="display: none;">
                        <label for="" class="col-md-3 col-form-label"></label>
                        <div class="col-md-7">
                            <input type="text" name="kategori" class="kategori form-control" id="produk_kategori_new" placeholder="Masukkan Kategori Produk" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="produk_harga" class="col-md-3 col-form-label">Harga</label>
                        <div class="col-md-7">
                            <input type="text" name="harga" class="form-control currency-expense text-end" value="<?= !empty($product) ? $product->harga : "" ?>" id="produk_harga" placeholder="Masukkan Harga Produk">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="produk_status" class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-7">
                            <div class="d-flex" style="column-gap: 1rem;">
                                <?php $status = !empty($product) ? $product->status : "bisa dijual" ?>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="customControlValidation2" name="status" required value="bisa dijual" <?= $status == "bisa dijual" ? "checked" : "" ?>>
                                    <label class="form-check-label mb-0" for="customControlValidation2"><i class="fas fa-check text-success" style="margin-right: .2rem;"></i>Dijual</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="customControlValidation3" name="status" required value="tidak bisa dijual" <?= $status == "tidak bisa dijual" ? "checked" : "" ?>>
                                    <label class="form-check-label mb-0" for="customControlValidation3"><i class="fas fa-times text-danger" style="margin-right: .2rem;"></i>Tidak Dijual</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="hidden" name="id" value="<?= !empty($product) ? $product->id : "" ?>">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>