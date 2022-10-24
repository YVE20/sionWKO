<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\dataJemaatModel;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function readDashboard(){
        return view('Dashboard.index');
    }
    public function readAdminDashboard(Request $request){
        return view('Dashboard.adminDashboard');
    }
    public function database(){
        $mysqlHostName      = env('DB_HOST','localhost');
        $mysqlUserName      = env('DB_USER','root');
        $mysqlPassword      = env('DB_PASSWORD','');
        $DbName             = env('DB_DATABASE','sionwko');
        $backup_name        = "mybackup.sql";
        $tables             = array("tb_alkitab","tb_data_baptis","tb_data_jemaat","tb_data_sidi","tb_dtl_kartu_keluarga","tb_event","tb_ibadah","tb_kartu_keluarga","tb_kategori_alkitab","tb_kategori_event","tb_kategori_ibadah","tb_temp_dtl_kartu_keluarga","tb_user"); //here your tables...

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
        /* $dataJemaat = $tempData;
        $pendidikanJemaat = $tempEducation;
        $isi ='';
        $isi .='
            <table border="1" style="text-align:center" class="table">
                <thead>
                    <tr>
                        <td rowspan="2" style="vertical-align: middle;"> LP </td>
                        <td rowspan="2" style="vertical-align: middle;"> KK </td>
                        <td colspan="3"> JIWA </td>
                        <td colspan="3"> DEWASA </td>
                        <td colspan="3"> ANAK-ANAK </td>
                        <td colspan="3"> BAPTIS </td>
                        <td colspan="3"> SIDI </td>
                        <td colspan="2"> NIKAH </td>
                        <td colspan="3"> ANAK SM </td>
                        <td colspan="3"> REMAJA </td>
                        <td colspan="3"> PEMUDA </td>
                        <td rowspan="2" style="vertical-align: middle;"> KI </td>
                        <td rowspan="2" style="vertical-align: middle;"> KB </td>
                        <td rowspan="2" style="vertical-align: middle;"> JND </td>
                        <td rowspan="2" style="vertical-align: middle;"> DD </td>
                        <td rowspan="2" style="vertical-align: middle;"> YTM </td>
                        <td rowspan="2" style="vertical-align: middle;"> PTU </td>
                        <td rowspan="2" style="vertical-align: middle;"> YP </td>
                        <td colspan="2"> LANSIA </td>
                    </tr>
                    <tr>
                        <td> L </td>
                        <td> P </td>
                        <td> JLH </td>
                        <td> L </td>
                        <td> P </td>
                        <td> JLH </td>
                        <td> L </td>
                        <td> P </td>
                        <td> JLH </td>
                        <td> L </td>
                        <td> P </td>
                        <td> JLH </td>
                        <td> L </td>
                        <td> P </td>
                        <td> JLH </td>
                        <td> SDH </td>
                        <td> BLM </td>
                        <td> L </td>
                        <td> P </td>
                        <td> JLH </td>
                        <td> L </td>
                        <td> P </td>
                        <td> JLH </td>
                        <td> L </td>
                        <td> P </td>
                        <td> JLH </td>
                        <td> L </td>
                        <td> P </td>
                    </tr>
                </thead>
                <tbody>';				
					$KK = 0;
					$JIWA_L = 0;
					$JIWA_P = 0;
					$JIWA_JLH = 0;
					$DEWASA_L = 0;
					$DEWASA_P = 0;
					$DEWASA_JLH = 0;
					$ANAK_L = 0;
					$ANAK_P = 0;
					$ANAK_JLH = 0;
					$BAPTIS_L = 0;
					$BAPTIS_P = 0;
					$BAPTIS_JLH = 0;
					$SIDI_L = 0;
					$SIDI_P = 0;
					$SIDI_JLH = 0;
					$NIKAH_SD = 0;
					$NIKAH_BLM = 0;
					$ANAK_SM_L = 0;
					$ANAK_SM_P = 0;
					$ANAK_SM_JLH = 0;
					$REMAJA_L = 0;
					$REMAJA_P = 0;
					$REMAJA_JLH = 0;
					$PEMUDA_L = 0;
					$PEMUDA_P = 0;
					$PEMUDA_JLH = 0;
					$DEWASA_L = 0;
					$DEWASA_P = 0;
					$JND = 0;
					$DD = 0;
					$YTM = 0;
					$PTU = 0;
					$YP = 0;
					$LANSIA_L = 0;
					$LANSIA_P = 0;
					foreach($dataJemaat as $data){
	    $isi .= '       <tr>
							<td>'.$data->LP.'</td>
							<td>'.$data->KK; ($KK += (int) $data->KK) .'</td>
							<td>'.$data->JIWA_L; ($JIWA_L += (int)$data->JIWA_L) .'</td>
							<td>'.$data->JIWA_P; ($JIWA_P += (int)$data->JIWA_P) .'</td>
                            <td>'.$data->JIWA_JLH; ($JIWA_JLH += (int)$data->JIWA_JLH) .'</td>
                            <td>'.$data->DEWASA_L; ($DEWASA_L += (int)$data->DEWASA_L) .'</td>
                            <td>'.$data->DEWASA_P; ($DEWASA_P += (int)$data->DEWASA_P) .'</td>
                            <td>'.$data->DEWASA_JLH; ($DEWASA_JLH += (int)$data->DEWASA_JLH) .'</td>
                            <td>'.$data->ANAK_L; ($ANAK_L += (int)$data->ANAK_L) .'</td>
                            <td>'.$data->ANAK_P; ($ANAK_P += (int) $data->ANAK_P) .'</td>
							<td>'.$data->ANAK_JLH; ($ANAK_JLH += (int) $data->ANAK_JLH) .'</td>
                            <td>'.$data->BAPTIS_L; ($BAPTIS_L += (int) $data->BAPTIS_L) .'</td>
                            <td>'.$data->BAPTIS_P; ($BAPTIS_P += (int) $data->BAPTIS_P) .'</td>
                            <td>'.$data->BAPTIS_JLH; ($BAPTIS_JLH += (int) $data->BAPTIS_JLH) .'</td>
                            <td>'.$data->SIDI_L; ($SIDI_L += (int) $data->SIDI_L) .'</td>
                            <td>'.$data->SIDI_P; ($SIDI_P += (int) $data->SIDI_P) .'</td>
                            <td>'.$data->SIDI_JLH; ($SIDI_JLH += (int) $data->SIDI_JLH) .'</td>
                            <td>'.$data->NIKAH_SD; ($NIKAH_SD += (int) $data->NIKAH_SD) .'</td>
                            <td>'.$data->NIKAH_BLM; ($NIKAH_BLM += (int) $data->NIKAH_BLM) .'</td>
                            <td>'.$data->ANAK_SM_L; ($ANAK_SM_L += (int) $data->ANAK_SM_L) .'</td>
                            <td>'.$data->ANAK_SM_P; ($ANAK_SM_P += (int) $data->ANAK_SM_P) .'</td>
                            <td>'.$data->ANAK_SM_JLH; ($ANAK_SM_JLH += (int) $data->ANAK_SM_JLH) .'</td>
                            <td>'.$data->REMAJA_L; ($REMAJA_L += (int) $data->REMAJA_L) .'</td>
                            <td>'.$data->REMAJA_P; ($REMAJA_P += (int) $data->REMAJA_P) .'</td>
                            <td>'.$data->REMAJA_JLH; ($REMAJA_JLH += (int) $data->REMAJA_JLH) .'</td>
                            <td>'.$data->PEMUDA_L; ($PEMUDA_L += (int) $data->PEMUDA_L) .'</td>
                            <td>'.$data->PEMUDA_P; ($PEMUDA_P += (int) $data->PEMUDA_P) .'</td>
                            <td>'.$data->PEMUDA_JLH; ($PEMUDA_JLH += (int) $data->PEMUDA_JLH) .'</td>
                            <td>'.$data->DEWASA_L; ($DEWASA_L += (int) $data->DEWASA_L) .'</td>
                            <td>'.$data->DEWASA_P; ($DEWASA_P += (int) $data->DEWASA_P) .'</td>
                            <td>'.$data->JND; ($JND += (int) $data->JND) .'</td>
							<td>'.$data->DD; ($DD += (int) $data->DD) .'</td>
							<td>'.$data->YTM; ($YTM += (int) $data->YTM) .'</td>
							<td>'.$data->PTU; ($PTU += (int) $data->PTU) .'</td>
							<td>'.$data->YP; ($YP += (int) $data->YP) .'</td>
							<td>'.$data->LANSIA_L; ($LANSIA_L += (int) $data->LANSIA_L) .'</td>
							<td>'.$data->LANSIA_P; ($LANSIA_P += (int) $data->LANSIA_P) .'</td>
                        </tr>';
					}
		$isi .=         '<tr>
							<th>Ttl</th>
							<th>'. $KK.'</th>
							<th>'. $JIWA_L.'</th>
							<th>'. $JIWA_P.'</th>
							<th>'. $JIWA_JLH.'</th>
							<th>'. $DEWASA_L.'</th>
							<th>'. $DEWASA_P.'</th>
							<th>'. $DEWASA_JLH.'</th>
							<th>'. $ANAK_L.'</th>
							<th>'. $ANAK_P.'</th>
							<th>'. $ANAK_JLH.'</th>
							<th>'. $BAPTIS_L.'</th>
							<th>'. $BAPTIS_P.'</th>
							<th>'. $BAPTIS_JLH.'</th>
							<th>'. $SIDI_L.'</th>
							<th>'. $SIDI_P.'</th>
							<th>'. $SIDI_JLH.'</th>
							<th>'. $NIKAH_SD.'</th>
							<th>'. $NIKAH_BLM.'</th>
							<th>'. $ANAK_SM_L.'</th>
							<th>'. $ANAK_SM_P.'</th>
							<th>'. $ANAK_SM_JLH.'</th>
							<th>'. $REMAJA_L.'</th>
							<th>'. $REMAJA_P.'</th>
							<th>'. $REMAJA_JLH.'</th>
							<th>'. $PEMUDA_L.'</th>
							<th>'. $PEMUDA_P.'</th>
							<th>'. $PEMUDA_JLH.'</th>
							<th>'. $DEWASA_L.'</th>
							<th>'. $DEWASA_P.'</th>
							<th>'. $JND.'</th>
							<th>'. $DD.'</th>
							<th>'. $YTM.'</th>
							<th>'. $PTU.'</th>
							<th>'. $YP.'</th>
							<th>'. $LANSIA_L.'</th>
							<th>'. $LANSIA_P.'</th>
						</tr>
                    </tbody>
                </table>
        ';
        return $isi; */
    }
    
}
