<div class="float-left bg-blue-gray cr-pointer text-white" id="side_bar">
    <a class="row d-block bg-blue-gray cr-pointer shadow" href="{{asset('/adm/dashboard')}}">
        <div class="p-3">
            <i class="fas fa-tachometer-alt h5"></i>
            <font class="h5 pl-2"> Dashboard </font>
        </div>
    </a>
    <a class="row d-block bg-blue-gray cr-pointer shadow" href="{{asset('/adm/ibadah')}}">
        <div class="p-3">
            <i class="fas fa-list h5"></i>
            <font class="h5 pl-2"> Ibadah </font>
        </div>
    </a>
    <a class="row d-block bg-blue-gray cr-pointer shadow" href="{{asset('/adm/bulletin')}}">
        <div class="p-3">
            <i class="fas fa-file-alt h5"></i>
            <font class="h5 pl-2"> Bulletin Gereja </font>
        </div>
    </a>
    <a class="row d-block bg-blue-gray cr-pointer shadow" id="data_jemaat" href="javascript:void(0)">
        <div class="p-3">
            <i class="fas fa-users h5"></i>
            <font class="h5 pl-2"> Data Jemaat </font>
        </div>
    </a>
        <a class="row bg-danger shadow" id="manajemen_jemaat" href="{{asset('/adm/dataJemaat')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-cogs h5"></i>
                <font class="h5 pl-2"> Manajemen Jemaat </font>
            </div>
        </a>
        <a class="row bg-danger shadow" id="baptis" href="{{asset('/adm/dataJemaat/baptis')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-hand-holding-water h5"></i>
                <font class="h5 pl-2"> Baptis </font>
            </div>
        </a>
        <a class="row bg-danger shadow" id="sidi" href="{{asset('/adm/dataJemaat/sidi')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-people-arrows h5"></i>
                <font class="h5 pl-2"> SIDI </font>
            </div>
        </a>
        <a class="row bg-danger shadow" id="kartu_keluarga" href="{{asset('/adm/dataJemaat/kartuKeluarga')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-newspaper h5"></i>
                <font class="h5 pl-2"> Kartu Keluarga </font>
            </div>
        </a>
    <a class="row d-block bg-blue-gray cr-pointer shadow" id="manajemen_pelayan" href="javascript:void(0)">
        <div class="p-3">
            <i class="fas fa-praying-hands h5"></i>
            <font class="h5 pl-2"> Pelayan </font>
        </div>
    </a>
        <a class="row bg-danger shadow" id="rapat_evaluasi" href="{{asset('/adm/pelayan/rapatEvaluasi')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-people-carry h5"></i>
                <font class="h5 pl-2"> Rapat Evaluasi </font>
            </div>
        </a>
        <a class="row bg-danger shadow" id="pembagian_tugas"  style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-sitemap h5"></i>
                <font class="h5 pl-2"> Pembagian Tugas </font>
            </div>
        </a>
            <a class="row bg-primary shadow" id="majelis_ibadah_minggu" href="{{asset('/adm/pelayan/pembagianTugas/majelisIbadahMinggu')}}" style="display: none">
                <div class="p-3 ml-4">
                    <i class="fas fa-user-tie h5"></i>
                    <font class="pl-2" style="font-size:16px;font-weight:bold;"> Majelis Ibadah Minggu </font>
                </div>
            </a>
            <a class="row bg-primary shadow" id="khadim" href="{{asset('/adm/pelayan/pembagianTugas/khadim')}}" style="display: none">
                <div class="p-3 ml-4">
                    <i class="fas fa-book-reader h5"></i>
                    <font class="pl-2" style="font-size:16px;font-weight:bold;"> Khadim </font>
                </div>
            </a>
            <a class="row bg-primary shadow" id="penataan_bunga" href="{{asset('/adm/pelayan/pembagianTugas/penataanBunga')}}" style="display: none">
                <div class="p-3 ml-4">
                    <i class="fas fa-spa h5"></i> 
                    <font class="pl-2" style="font-size:16px;font-weight:bold;"> Penataan Bunga </font>
                </div>
            </a>
            <a class="row bg-primary shadow" id="pemusik" href="{{asset('/adm/pelayan/pembagianTugas/pemusik')}}" style="display: none">
                <div class="p-3 ml-4">
                    <i class="fas fa-drum h5"></i>
                    <font class="pl-2" style="font-size:16px;font-weight:bold;"> Pemusik </font>
                </div>
            </a>
            <a class="row bg-primary shadow" id="pujian" href="{{asset('/adm/pelayan/pembagianTugas/pujian')}}" style="display: none">
                <div class="p-3 ml-4">
                    <i class="fas fa-music h5"></i>
                    <font class="pl-2" style="font-size:16px;font-weight:bold;"> Pujian </font>
                </div>
            </a>
            <a class="row bg-primary shadow" id="penerima_tamu" href="{{asset('/adm/pelayan/pembagianTugas/penerimaTamu')}}" style="display: none">
                <div class="p-3 ml-4">
                    <i class="fas fa-door-open h5"></i>
                    <font class="pl-2" style="font-size:16px;font-weight:bold;"> Penerima Tamu </font>
                </div>
            </a>
        <a class="row bg-danger shadow" id="pembagian_majelis" href="{{asset('/adm/pelayanan/pembagianMajelis')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-newspaper h5"></i>
                <font class="h5 pl-2"> Pembagian Majelis </font>
            </div>
        </a>
    <a class="row d-block bg-blue-gray cr-pointer shadow" id="event" href="javascript:void(0)">
        <div class="p-3">
            <i class="fas fa-calendar-alt h5"></i>
            <font class="h5 pl-2"> Event </font>
        </div>
    </a>
        <a class="row bg-danger shadow" id="hut" href="{{asset('/adm/event/HUT')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-birthday-cake h5"></i>
                <font class="h5 pl-2"> Hari Ulang Tahun </font>
            </div>
        </a>
        <a class="row bg-danger shadow" id="hari_reformasi_gereja" href="{{asset('/adm/event/reformasiGereja')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-church h5"></i>
                <font class="h5 pl-2"> Hari Reformasi Gereja </font>
            </div>
        </a>
        <a class="row bg-danger shadow" id="perjamuan_kudus" href="{{asset('/adm/event/perjamuanKudus')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-wine-glass h5"></i>
                <font class="h5 pl-2"> Perjamuan Kudus </font>
            </div>
        </a> 
    <a class="row d-block bg-blue-gray cr-pointer shadow" id="website" href="javascript:void(0)">
        <div class="p-3">
            <i class="fab fa-chrome h5"></i>    
            <font class="h5 pl-2"> Website </font>
        </div>
    </a>
        <a class="row bg-secondary shadow" id="slideshow" href="{{asset('/adm/website/slideshow')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-images h5"></i>
                <font class="h5 pl-2"> Slideshow </font>
            </div>
        </a>
        <a class="row bg-secondary shadow" id="aboutUs" href="{{asset('/adm/website/tentangKami')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-user-tie h5"></i>
                <font class="h5 pl-2"> Tentang Kami </font>
            </div>
        </a>
        <a class="row bg-secondary shadow" id="service" href="{{asset('/adm/website/pelayanan')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-praying-hands h5"></i>
                <font class="h5 pl-2"> Pelayanan </font>
            </div>
        </a>
        <a class="row bg-secondary shadow" id="bulletin" href="{{asset('/adm/website/bulletin')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-newspaper h5"></i>
                <font class="h5 pl-2"> Berita Gereja </font>
            </div>
        </a>
        <a class="row bg-danger shadow" id="testimony" href="{{asset('/adm/website/kesaksian')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-volume-up h5"></i>
                <font class="h5 pl-2"> Kesaksian </font>
            </div>
        </a>
        <a class="row bg-danger shadow" id="renungan" href="{{asset('/adm/website/renungan')}}" style="display: none">
            <div class="p-3 ml-2">
                <i class="fas fa-book-open h5"></i>
                <font class="h5 pl-2"> Renungan </font>
            </div>
        </a>
    <a class="row d-block bg-blue-gray cr-pointer shadow" id="pengaturan">
        <div class="p-3">
           <i class="fas fa-tools h5"></i>
            <font class="h5 pl-2"> Pengaturan </font>
        </div>
    </a>
    <a class="row d-block bg-blue-gray cr-pointer shadow" href="{{asset('/signOut')}}">
        <div class="p-3">
            <i class="fas fa-sign-out-alt h5"></i>
            <font class="h5 pl-2"> Sign Out </font>
        </div>
    </a>
    <!-- Ibadah Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="pengaturanModal" style="color:black;">
        <div class="modal-dialog  modal-xl" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" > <i class="fas fa-cog"></i> Pengaturan </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</>
                    </button>
                </div>
                <div class="modal-body">  
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <td> <i class="fas fa-database h5"></i> Database Backup</td>
                            </tr>
                        </table>
                        <a href="{{url('/adm/dashboard/database')}}" class="btn btn-primary mt-5"> Proses <i class="fas fa-arrow-alt-circle-right"></i> </a>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal"> Close </button>
                </div>
            </div>
        </div>
    </div>
</div>