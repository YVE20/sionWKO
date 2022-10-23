<!-- Perjamuan Kudus Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addPerjamuanKudusModal">
  <div class="modal-dialog  modal-xl" role="document" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"> DISINI JUDUL </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" method="POST" id="tampilPerjamuanKudusModal" enctype="multipart/form-data">
            <div class="modal-body">   
                <input type="hidden" value="PerjamuanKudus" name="kategoriEvent" id="kategoriEvent">
                @csrf  
                <div id="isiModalPerjamuanKudus"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="cmd" type="submit"> DISINI FOOTER </button>
            </div>
        </form>
    </div>
  </div>
</div>