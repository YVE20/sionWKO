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
        @if(count($detailKartuKeluargaModel) <= 0)
            <tr>
                <th colspan="7"> <center> TIDAK ADA DATA </center>  </th>
            </tr>
        @else
            @foreach($detailKartuKeluargaModel as $dKKM)
                <tr>
                    <td> {{$dKKM->NIK}} </td>
                    <td> {{$dKKM->fullName}} </td>
                    <td> {{$dKKM->gender == "male" ? "Laki-laki" : "Perempuan"}} </td>
                    <td> {{$dKKM->blood}} </td>
                    <td> {{$dKKM->education}} </td>
                    <td> {{$dKKM->family_status}} </td>
                    <td>
                        <button onclick="editDetailKartuKeluarga('{{$dKKM->NIK}}')" id="cmdDetailKK" type="button" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                        <button onclick="deleteDetailKartuKeluarga('{{$dKKM->NIK}}')" type="button" class="btn btn-danger"> <i class="fas fa-trash"></i> </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>