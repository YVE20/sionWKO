<nav class="navbar navbar-expand-lg navbar-light bg-light my-navbar" id="navbar">
    <a class="navbar-brand" href="#">
        <img src="{{asset('/img/Gereja SION WKO.png')}}" style="max-width:80px" alt="">
        <span style="line-height: 1;display:inline-block;margin-left:10px;font-size:16px !important;font-weight:bold;vertical-align:middle;color:black;">
            GEREJA MASEHI <br> INJILI DI HALMAHERA 
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#frontend-navbar"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ml-auto " id="frontend-navbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/')}}"> <font style="color:white;" id="fontHome"> HOME </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/jadwalIbadah')}}"> <font style="color:white;" id="fontIbadah"> IBADAH </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#berita"> <font style="color:white;" id="fontBerita"> BERITA </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#about"> <font style="color:white;" id="fontTentangKami"> TENTANG KAMI </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#event"> <font style="color:white;" id="fontEvent"> EVENT </font> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= url('/kesaksian') ?>"> <font style="color:white;" id="fontKesaksian"> KESAKSIAN </font> </a>
            </li>
        </ul>
    </div>
</nav>
