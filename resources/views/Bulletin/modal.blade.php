<!-- Bulletin Cover Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addBulletinCoverModal">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> DISINI JUDUL </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" method="POST" id="tampilBulletinCoverModal" enctype="multipart/form-data">
            <div class="modal-body">   
                @csrf  
                <div id="isiBulletinCoverModal"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="cmd" type="submit"> DISINI FOOTER </button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- Bulletin Cover Modal -->
<div class="modal" tabindex="-1" role="dialog" id="viewBulletinCoverModal">
  <div class="modal-dialog modal-xl" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> DISINI JUDUL </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">   
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th> ID Cover </th>
                        <th> Cover </th>
                        <th> Bulan </th>
                        <th> Tema </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody id="isiDataBulletinCoverModal">

                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" id="cmd" type="submit"> DISINI FOOTER </button>
        </div>
    </div>
  </div>
</div>