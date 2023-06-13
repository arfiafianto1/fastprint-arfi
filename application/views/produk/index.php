<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-title">Data Produk</h5>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?= base_url("produk/new") ?>" class="btn btn-success text-white"><i class="fas fa-plus"></i> Produk Baru</a>
            </div>
        </div>
        <form action="">
            <div class="row mt-5">
                <div class="col-md-4 form-group">
                    <label for="">Pilih Kategori</label>
                    <select name="kategori" class="kategori form-control">
                        <option value="">Semua Kategori</option>
                        <?php foreach($categories as $category): ?>
                            <option <?= $category->kategori == $this->input->get("kategori") ? "selected" : "" ?>><?= $category->kategori ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="">Pilih Status</label>
                    <div class="d-flex" style="column-gap: 1rem;">
                        <?php $status = !empty($this->input->get("status")) ? $this->input->get("status") : "dijual" ?>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="customControlValidation1" name="status" required value="semua" <?= $status == "semua" ? "checked" : "" ?>>
                            <label class="form-check-label mb-0" for="customControlValidation1">Semua Produk</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="customControlValidation2" name="status" required value="dijual" <?= $status == "dijual" ? "checked" : "" ?>>
                            <label class="form-check-label mb-0" for="customControlValidation2">Dijual</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="customControlValidation3" name="status" required value="tidak_dijual" <?= $status == "tidak_dijual" ? "checked" : "" ?>>
                            <label class="form-check-label mb-0" for="customControlValidation3">Tidak Dijual</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-search"></i> Terapkan</button>
                </div>  
            </div>
        </form>
    </div>
    <hr class="mt-0">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="40">#</th>
                    <th width="100">ID Produk</th>
                    <th>Nama Produk</th>
                    <th width="200">Kategori</th>
                    <th width="140" class="text-end">Harga</th>
                    <th>Status</th>
                    <th width="140"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $i => $product): ?>
                <tr>
                    <th scope="row"><?= $i+1 ?></th>
                    <td><a href="<?= base_url("produk/edit/".$product->id) ?>">#<?= $product->id_produk ?></a></td>
                    <td><?= $product->nama_produk ?></td>
                    <td><?= $product->kategori ?></td>
                    <td class="text-end">Rp. <?= to_currency($product->harga) ?></td>
                    <td><div class="badge bg-<?= $product->status == "bisa dijual" ? "success" : "warning" ?> p-2"><?= $product->status ?></div></td>
                    <td>
                        <a href="<?= base_url("produk/edit/".$product->id) ?>" class="btn btn-secondary btn-sm btn-icon"><i class="fas fa-pencil-alt"></i></a>
                        <button type="button" class="btn btn-danger btn-sm btn-icon btn-delete" data-url="<?= base_url("produk/delete/".$product->id) ?>" data-message="Anda akan menghapus data Produk <?= $product->nama_produk ?>"><i class="fas fa-trash-alt text-white"></i></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>