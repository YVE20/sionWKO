<!-- Perjamuan Kudus Modal -->
<div class="modal" tabindex="-1" role="dialog" id="viewPenataanBungaModal">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> DISINI JUDUL </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" method="POST" id="tampilPenataanBungaModal" enctype="multipart/form-data">
            <div class="modal-body">   
                @csrf  
                <div id="isiModalPenataanBunga"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="cmd" type="submit"> DISINI FOOTER </button>
            </div>
        </form>
    </div>
  </div>
</div>