<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\dataJemaatModel;
use Illuminate\Support\Facades\DB;
use App\Models\renunganModel;

class dashboardController extends Controller
{
    public function readDashboard(){
        return view('Dashboard.index');
    }
    public function readAdminDashboard(Request $request){
        return view('Dashboard.adminDashboard');
    }
    public function database(){
        $mysqlHostName      = env('DB_HOST','sql624.main-hosting.eu');
        $mysqlUserName      = env('DB_USER','u960510290_euaggeliony');
        $mysqlPassword      = env('DB_PASSWORD','AdminSionWKO2022!');
        $DbName             = env('DB_DATABASE','u960510290_sionwko');
        $backup_name        = "mybackup.sql";
        $tables             = array("tb_alkitab","tb_bulletin_cover","tb_data_baptis","tb_data_jemaat","tb_data_sidi","tb_dtl_kartu_keluarga","tb_event","tb_ibadah","tb_kartu_keluarga","tb_kategori_alkitab","tb_kategori_event","tb_kategori_ibadah","tb_kategory_pelayan","tb_kesaksian","tb_khadim","tb_majelis_ibadah_minggu","tb_pembagian_majelis","tb_pemusik","tb_penataan_bunga","tb_penerima_tamu","tb_pujian","tb_rapat_evaluasi","tb_renungan","tb_temp_dtl_kartu_keluarga","tb_user"); //here your tables...

        $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $result = $statement->fetchAll();
        $output = '';
        foreach($tables as $table)
        {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            foreach($show_table_result as $show_table_row)
            {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table . "";
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for($count=0; $count<$total_row; $count++)
            {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);
                $table_value_array = array_values($single_result);
                $output .= "\nINSERT INTO $table (";
                $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                $output .= "'" . implode("','", $table_value_array) . "');\n";
            }
        }
        $file_name = 'DatabaseSIONWKO_BackupOn_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
    }
    public function getDataJemaat(){
        $dataJemaat = DB::select('select *from tb_data_jemaat order by SUBSTRING_INDEX(congregation_id, "/", -1) + 0 DESC LIMIT 10');
        $isi = '';
        if(count($dataJemaat) <= 0){
            $isi .='
                <tr>
                    <th colspan="4"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($dataJemaat as $dJ){
                $isi .='
                    <tr>
                        <td>'.$dJ->congregation_id.'</td>
                        <td>'.$dJ->baptism_id.'</td>
                        <td>'.$dJ->sidi_id.'</td>
                        <td>'.$dJ->familyCard_id.'</td>
                        <td>
                            <button class="btn btn-primary"> <i class="fas fa-info-circle"></i> </button>
                        </td>
                    </tr>
                ';
            }
        }
        return $isi;
    }
    public function getEventGereja(){
        $eventGereja = DB::select('select *from tb_event inner join tb_kategori_event on tb_event.eventCategory_id = tb_kategori_event.eventCategory_id order by SUBSTRING_INDEX(tb_event.eventCategory_id, "/", -1) + 0 DESC LIMIT 10');
        $isi = '';
        if(count($eventGereja) <= 0){
            $isi .='
                <tr>
                    <th colspan="7"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($eventGereja as $eG){
                $pisah = explode(' ',$eG->sermon_date);
                $tanggal_baru = explode('-',$pisah[0]);
                $isi .='
                    <tr>
                        <td>'.$eG->event_id.'</td>
                        <td>'.$eG->event.'</td>
                        <td>'.$tanggal_baru[2].'-'.$tanggal_baru[1].'-'.$tanggal_baru[0].'</td>
                        <td>'.$eG->place.'</td>
                        <td>'.$eG->address.'</td>
                        <td>'.$eG->contact_person.'</td>
                        <td>
                            <button class="btn btn-primary text-white"> <i class="fas fa-info-circle"></i> </button>
                        </td>
                    </tr>
                ';   
            }
        }
        return $isi;
    }
    public function getStatistikJemaat(){
        $services = dataJemaatModel::select('service_environtment')->groupBy('service_environtment')->pluck('service_environtment');
        $tempData = [

        ];
        $tempEducation = [];
        foreach($services as $service_i){
        $serviceData = DB::select('SELECT "'.$service_i.'" as LP, KK.*,JIWA.*,DEWASA.*,ANAK.*,BAPTIS.*,SIDI.*,NIKAH.*,ANAK_SM.*,REMAJA.*,PEMUDA.*,JND.*,DD.*,YTM.*,PTU.*,YP.*,LANSIA.* FROM (SELECT COUNT(DISTINCT tb_data_jemaat.familyCard_id) AS KK FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'") AS KK CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS JIWA_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS JIWA_P, COUNT(*) AS JIWA_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'") AS JIWA CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS DEWASA_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS DEWASA_P, COUNT(*) AS DEWASA_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 26 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 45) AS DEWASA CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS ANAK_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS ANAK_P, COUNT(*) AS ANAK_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 5 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 12) AS ANAK CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS BAPTIS_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS BAPTIS_P, COUNT(*) AS BAPTIS_JLH FROM tb_data_baptis) AS BAPTIS CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS SIDI_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS SIDI_P, COUNT(*) AS SIDI_JLH FROM tb_data_sidi) AS SIDI CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN marriage = "Kawin Tercatat" THEN 1 ELSE 0 END),0) AS NIKAH_SD, COALESCE(SUM(CASE WHEN marriage = "Belum Kawin" THEN 1 ELSE 0 END),0) AS NIKAH_BLM FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'") AS NIKAH CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS ANAK_SM_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS ANAK_SM_P, COUNT(*) AS ANAK_SM_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 0 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 5) AS ANAK_SM CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS REMAJA_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS REMAJA_P, COUNT(*) AS REMAJA_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 12 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 16) AS REMAJA CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS PEMUDA_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS PEMUDA_P, COUNT(*) AS PEMUDA_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 16 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 25) AS PEMUDA CROSS JOIN (SELECT COUNT(*) AS JND FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND marriage = "Cerai" AND gender = "female") AS JND CROSS JOIN (SELECT COUNT(*) AS DD FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND marriage = "Cerai" AND gender = "male") AS DD CROSS JOIN (SELECT COUNT(*) AS YTM FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND fatherName = "-" AND motherName != "-") AS YTM CROSS JOIN (SELECT COUNT(congregation_id) AS PTU FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND fatherName != "-" AND motherName = "-") AS PTU CROSS JOIN (SELECT COUNT(*) AS YP FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND fatherName = "-" AND motherName = "-") AS YP CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS LANSIA_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS LANSIA_P, COUNT(*) AS LANSIA_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id where tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 46 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 65) AS LANSIA limit 1');

        $educationData =  DB::select('SELECT "'.$service_i.'" as LP, COUNT( DISTINCT tb_data_jemaat.familyCard_id) AS KK, 
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Strata III" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_S3,
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Strata III" AND gender = "female" THEN 1 ELSE 0 END ),0) AS P_S3,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Strata II" AND gender = "male" THEN 1 ELSE 0 END ),0) AS L_S2, 
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Strata II" AND gender = "female"THEN 1 ELSE 0 END ),0) AS P_S2, 
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Diploma IV/ Strata I" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_D4_S1,
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Diploma IV/ Strata I" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_D4_S1,
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Akademi/ Diploma III/ S.Muda" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_D3,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Akademi/ Diploma III/ S.Muda" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_D3,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Diploma I / II" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_D1_D2,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Diploma I / II" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_D1_D2,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "SLTA / Sederajat" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_SLTA,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "SLTA / Sederajat" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_SLTA,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "SLTP / Sederajat" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_SLTP,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "SLTP / Sederajat" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_SLTP,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Tamat SD / Sederajat" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_SD,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Tamat SD / Sederajat" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_SD, 
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Tidak / Belum Sekolah" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_TIDAK_SEKOLAH,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Tidak / Belum Sekolah" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_TIDAK_SEKOLAH,
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Belum Tamat SD / Sederajat" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_BELUM_TAMAT,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Belum Tamat SD / Sederajat" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_BELUM_TAMAT, COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) as L_JLH, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) as P_JLH, COUNT(tb_data_jemaat.congregation_id) as TOTAL,  COALESCE(SUM(CASE WHEN gender = "male" AND tb_kartu_keluarga.address != "Maluku Utara" THEN 1 ELSE 0 END),0) as L_LUAR_DAERAH,  COALESCE(SUM(CASE WHEN gender = "female" AND tb_kartu_keluarga.address != "Maluku Utara" THEN 1 ELSE 0 END),0) as P_LUAR_DAERAH,  COALESCE(SUM(CASE WHEN tb_kartu_keluarga.address != "Maluku Utara" THEN 1 ELSE 0 END),0) as JLH_LUAR_DAERAH
        FROM tb_data_jemaat INNER JOIN tb_dtl_kartu_keluarga ON tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id INNER JOIN tb_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = '.$service_i);
            array_push($tempData,$serviceData[0]);
            array_push($tempEducation,$educationData[0]);
        }
        $data = [
            'dataJemaat' => $tempData,
            'pendidikanJemaat' => $tempEducation
        ];
        //$pdf = PDF::loadView('DataJemaat.Manage Jemaat.pdf', $data)->setPaper('a4', 'landscape');;
		//return $pdf->download('All Data Jemaat.pdf');	
        return view('DataJemaat.Manage Jemaat.pdf',$data);
    }
    public function renunganHarianForToday(){
        $dataRenungan = renunganModel::whereRaw('day(publish_date)='.date($_POST['date']))->whereRaw('year(publish_date)='.date('Y'))->get();
        $content = "";
        if($dataRenungan[0]->contents == "-"){
            $content = "<center> <b> DATA BELUM DI ISI OLEH ADMIN GEREJA </b> </center>";
        }else{
            $content = $dataRenungan[0]->contents;
        }
        $isi = '';
        $isi.='
            <div class="row" style="text-align:justify;font-size:13px">
                <div class="col-lg-12 mt-4">
                    <center><b>'.strtoupper($dataRenungan[0]->reflection_title).'</b></center>
                </div>
                <div class="col-lg-12">
                    <font>'.$dataRenungan[0]->bible_verse.'</font><br>
                    <font><i>'.$dataRenungan[0]->verse.'</i></font>
                </div>
                <div class="col-lg-12 mt-4">
                    <font>'.$content.'</font>
                </div>
                <div class="col-lg-12 mt-5 copyright" style="font-size:13px;margin-bottom:-5px;">
                    2022 OLEH GEREJA SION WKO HALMAHERA UTARA <br>
                    &copy; ALL RIGHTS RESERVED
                </div>
            </div>
        ';
        return $isi;
    }
    
}
