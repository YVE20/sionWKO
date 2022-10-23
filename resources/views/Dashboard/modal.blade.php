<!-- Data Jemaat Modal -->
<div class="modal" tabindex="-1" role="dialog" id="dataJemaatModal">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="fas fa-users"></i> Data Jemaat </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">   
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th> ID Jemaat </th>
                        <th> Baptis </th>
                        <th> SIDI </th>
                        <th> Kartu Keluarga </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody id="isiDataJemaat">
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal"> Tutup </button>
        </div>
    </div>
  </div>
</div>
<!-- Event Gereja Modal -->
<div class="modal" tabindex="-1" role="dialog" id="eventGerejaModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <i class="fas fa-calendar-alt"></i> Event Gereja </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> ID Event </th>
                            <th> Event </th>
                            <th> Tanggal </th>
                            <th> Tempat </th>
                            <th> Alamat </th>
                            <th> PIC </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiEventGereja">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal"> Tutup </button>
            </div>
        </div>
    </div>
</div>
<!-- Statistik Jemaat Modal -->
<div class="modal" tabindex="-1" role="dialog" id="statistikJemaatModal">
    <div class="modal-dialog modal-xl" role="document" style="margin:0;padding-left:150px;">
        <div class="modal-content" style="width:1440px;">
            <div class="modal-header">
                <h5 class="modal-title"> <i class="fas fa-chart-bar"></i> Statistik Jemaat </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   
                <div id="isiStatistikJemaat">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal"> Tutup </button>
            </div>
        </div>
    </div>
</div>
