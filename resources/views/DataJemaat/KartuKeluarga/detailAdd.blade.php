<table class="table table-bordered w-100 mt-3" id="demo-table" style="text-align: center">
    <thead>
        <tr>
            <th> NIK </th>
            <th> Nama </th>
            <th> Jenis Kelamin </th>
            <th> Gol Darah </th>
            <th> Pendidikan </th>
            <th> Hub Keluarga </th>
            <th> Action </th>
        </tr>
    </thead>
    <tbody>
        @if(count($detailTempKartuKeluargaModel) <= 0)
            <tr>
                <th colspan="7"> <center> TIDAK ADA DATA </center>  </th>
            </tr>
        @else
            @foreach($detailTempKartuKeluargaModel as $dTKKM)
                <tr>
                    <td> {{$dTKKM->NIK}} </td>
                    <td> {{$dTKKM->fullName}} </td>
                    <td> {{$dTKKM->gender}} </td>
                    <td> {{$dTKKM->blood}} </td>
                    <td> {{$dTKKM->education}} </td>
                    <td> {{$dTKKM->family_status}} </td>
                    <td>
                        <button onclick="editTempDetailKartuKeluarga('{{$dTKKM->NIK}}')" id="cmdDetailKK" type="button"  class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                        <button onclick="deleteTempDetailKartuKeluarga('{{$dTKKM->NIK}}')" type="button" class="btn btn-danger"> <i class="fas fa-trash"></i> </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>