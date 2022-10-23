<!-- SIDI Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addSIDIModal">
  <div class="modal-dialog  modal-xl" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> DISINI JUDUL </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" method="POST" id="tampilModalSIDI" enctype="multipart/form-data">
            <div class="modal-body">   
                @csrf  
                <div id="isiModalSIDI"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="cmd" type="submit"> DISINI FOOTER </button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- SIDI Modal -->
<div class="modal" tabindex="-1" role="dialog" id="zoomMarriageCertificateModal">
  <div class="modal-dialog  modal-xl" role="document" >
    <div class="modal-content">
        <div class="modal-body">   
        </div>
    </div>
  </div>
</div>