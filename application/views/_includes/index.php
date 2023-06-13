<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <title>Tes Programmer - Fast Print - Arfi</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>public/assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>public/assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>public/dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php $this->load->view("_includes/_header") ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php $this->load->view("_includes/_sidebar") ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb d-none">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php $this->load->view($content_file) ?>    
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php $this->load->view("_includes/_footer") ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>public/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url() ?>public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>public/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?= base_url() ?>public/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url() ?>public/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url() ?>public/dist/js/custom.min.js"></script>
    <script src="<?= base_url() ?>public/dist/js/jquery.maskMoney.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <script>
        function format_currency() {
            $('.currency-decimal').maskMoney('destroy');
            $('.currency-decimal').maskMoney({thousands:'.', decimal:','});
            $('.currency-decimal').maskMoney('mask');

            $('.currency-expense').maskMoney('destroy');
            $('.currency-expense').maskMoney({thousands:'.', precision: 0});
            $('.currency-expense').maskMoney('mask');
            
            $('.currency-rate').maskMoney('destroy');
            $('.currency-rate').maskMoney({thousands:'.', decimal:',', precision: 3});
            $('.currency-rate').maskMoney('mask');
        }

        $(document).ready(function(){
            format_currency();
        })
        .on("click",".btn-delete",function() {
            let url = $(this).data("url");
            let message = $(this).data("message");

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Saya yakin!',
                cancelButtonText: 'Tidak, Batalkan!',
                // reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: "delete",
                        dataType: "json",
                        success:function(data){
                            if (data.status == 200) {
                                Swal.fire({
                                    title: 'Pemberitahuan!',
                                    text: data.message,
                                    icon: 'success',
                                }).then((result)=>{
                                    location.reload();
                                })
                            }else{
                                Swal.fire({
                                    title: 'Peringatan!',
                                    text: data.message,
                                    icon: 'warning',
                                })
                            }
                        }
                    })
                }
            });
        })
        .on("click",".kategori_option",function() {
            let value = $(this).val();
            if (value == "new") {
                $(".div-kategori-existed").hide();
                $(".div-kategori-new").show();
                $("#produk_kategori_existed").attr("disabled","disabled");
                $("#produk_kategori_new").removeAttr("disabled");
            }else if(value == "existed"){
                $(".div-kategori-existed").show();
                $(".div-kategori-new").hide();
                $("#produk_kategori_existed").removeAttr("disabled");
                $("#produk_kategori_new").attr("disabled","disabled");
            }
        })
        .on("submit","#form-product",function(e) {
            e.preventDefault();
            let form = $(this);
            let button = $(form).find("button[type=submit]");
            let old_text = $(button).text();
            $.ajax({
                url: $(form).attr("action"),
                method: $(form).attr("method"),
                dataType: "json",
                data:$(form).serialize(),
                beforeSend:function(){
                    $(button).attr("disabled","disabled");
                    $(button).text("Loading");
                },
                success:function(data){
                    $(".error-message").remove();
                    if (data.status == 400) {
                        $.each(data.errors,function(column_name,error_message){
                           parent = $(`#${data.table_name}_${column_name}`).parents(".form-group");
                           first_div = $(parent).find("div").first();
                           $(first_div).append(`<small class="error-message text-danger">${error_message}</small>`);
                        });
                    }else if(data.status == 200){
                        Swal.fire({ text: data.message, icon: "success" }).then((result)=>{ location.href = data.url });
                    }else if(data.status == 401){
                        Swal.fire({ text: data.message, icon: "warning" });
                    }
                },
                complete:function(){
                    $(button).removeAttr("disabled");
                    $(button).text(old_text);
                }
            })
        })
        .on("click",".btn-request-api",function(){
            let button = $(this);
            let old_text = $(button).text();
            Swal.fire({
                title: 'Konfirmasi terkahir!',
                text: "Apakah anda yakin ingin melakukan Request Data ke API. Data produk yang ada sekarang akan dikosongkan, kemudian diisi ulang dengan data dari API",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Saya yakin!',
                cancelButtonText: 'Tidak, Batalkan!',
                // reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= base_url("api/setup_product_from_api") ?>`,
                        method: "get",
                        dataType: "json",
                        beforeSend:function(){
                            $(button).text("Sedang memproses....");
                            $(button).attr("disabled","disabled");
                        },
                        success:function(data){
                            Swal.fire({ text: data.message, icon: (data.status == 200 ? "success" : "warning") });
                        },
                        complete:function(){
                            $(button).text(old_text);
                            $(button).removeAttr("disabled");
                        }
                    });
                }
            })
        })
        ;
    </script>
</body>

</html>