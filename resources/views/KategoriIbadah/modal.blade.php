<!-- Ibadah Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addIbadahModal">
  <div class="modal-dialog  modal-xl" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> DISINI JUDUL </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{url('/adm/ibadah/createIbadah')}}" method="POST" id="tampilModalIbadah">
            <div class="modal-body">   
                @csrf  
                <div id="isiModalIbadah"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit"> DISINI FOOTER </button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- Create Kategori Ibadah -->
<div class="modal" tabindex="-1" role="dialog" id="addKategoriIbadahModal">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> DISINI JUDUL </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" method="POST" id="tampilKategoriModalIbadah">
            <div class="modal-body">   
                @csrf  
                <div id="isiModalKategoriIbadah"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="cmd" type="submit"> DISINI FOOTER </button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- Kategori Ibadah Modal -->
<div class="modal" tabindex="-1" role="dialog" id="viewKategoriIbadahModal">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> <i class="far fa-eye"></i>  Kategori Ibadah </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">    
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th> Kategori ID </th>
                        <th> Kategori </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody id="isiKategoriIbadah">

                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>