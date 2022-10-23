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
        
        $isi ='';
        $isi .='
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th> LP </th>
                        <th> KK </th>
                        <th> JIWA </th>
                        <th> DEWASA </th>
                        <th> ANAK-ANAK </th>
                        <th> BAPTIS </th>
                        <th> SIDI </th>
                        <th> NIKAH </th>
                        <th> ANAK SM </th>
                        <th> REMAJA </th>
                        <th> PEMUDA </th>
                        <th> KI </th>
                        <th> KB </th>
                        <th> JND </th>
                        <th> DD </th>
                        <th> YATIM </th>
                        <th> PIATU </th>
                        <th> YP </th>
                        <th> LANSIA </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        ';
        return $isi;
    }
    
}
