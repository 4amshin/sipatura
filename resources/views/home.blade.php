@extends('layout.app')

@section('title', 'Beranda')

@section('content')
    <div class="row">
        <!--Gambar-->
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-content">
                    <img src="{{ asset('assets/compiled/jpg/kantor.jpg') }}" class="card-img-top img-fluid" alt="singleminded">
                </div>
            </div>
        </div>

        <!--VISI MISI-->
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <!--VISI-->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <strong>VISI</strong>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                <div class="accordion-body">
                                    Kementrian agama yang profesional dan andal dalam membangun masyarakat yang saleh,
                                    moderat, cerdas dan unggul untuk mewujudkan indonesia maju yang berdaulat, mandiri, dan
                                    berkepribadian berdasarkan gotong royong.<br><strong><small>(Peraturan Menteri Agama Nomor 18 Tahun
                                    2020)</small></strong>
                                </div>
                            </div>
                        </div>

                        <!--MISI-->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    <strong>MISI</strong>
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample" style="">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Mewujudkan Tata Kelola Kepemerintahan Yang Bersih Dan Berwibawa</li>
                                        <li>Meningkatkan Kualitas Kerukunan Umat Beragama</li>
                                        <li>Meningkatkan Kualitas Pendidikan Agama Dan Pendidikan Keagamaan</li>
                                        <li>Meningkatkan Kualitas Agama Dan Pemberdayaan Lembaga Keagamaan</li>
                                        <li>Meningkatkan Kualitas Pelayanan Penyelenggara Haji Dan Umrah</li>
                                        <li>Meningkatkan Pelayanan Dan Pengelolaan Zakat Dan Wakaf</li>
                                    </ol>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
