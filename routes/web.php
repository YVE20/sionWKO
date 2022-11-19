<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//User
Route::get('/','homeController@home');
Route::get('/login','loginController@readLogin');
//Route::get('/home','homeController@home');
Route::get('/signOut','loginController@signOut');
Route::get('/downloadDataJemaat','dataJemaatController@downloadDataJemaat');
Route::post('/hubungiKami','homeController@hubungiKami');
Route::get('/downloadManageJemaat','dataJemaatController@downloadManageJemaat');
Route::get('/jadwalIbadah','homeController@jadwalIbadah');
Route::get('/kesaksian','homeController@kesaksian');
Route::get('/renungan','homeController@renungan');
Route::get('/event','homeController@event');
Route::post('/loadAyatHarianDB','homeController@loadAyatHarianDB');
Route::post('/loadAyatHarianAPI','homeController@loadAyatHarianAPI');
Route::post('/isiRenunganHarian','homeController@isiRenunganHarian');
Route::post('/getRenunganById','homeController@getRenunganById');
Route::post('/dataStatistikJemaat','homeController@dataStatistikJemaat');
Route::post('/viewInfoBulletin','homeController@viewInfoBulletin');
Route::post('/renunganHarianForToday','dashboardController@renunganHarianForToday');
Route::get('/tentangKami','homeController@tentangKami');

//Admin
Route::group(['prefix' => 'adm'],function(){
    Route::get('/dashboard','dashboardController@readAdminDashboard');
    Route::get('/ibadah','ibadahController@readIbadah');
    Route::get('/bulletin','bulletinController@readBulletin');
    Route::get('/dataJemaat','dataJemaatController@readDataJemaat');
        Route::get('/dataJemaat/baptis','baptisController@readBaptis');
        Route::get('/dataJemaat/sidi','sidiController@readSIDI');
        Route::get('/dataJemaat/kartuKeluarga','kartuKeluargaController@readKartuKeluarga');
    //Route::get('/pelayan');
        Route::get('/pelayan/rapatEvaluasi','rapatEvaluasiController@readRapatEvaluasi');
        //Route::get('/pelayan/pembagianTugas','pembagianTugasController@readPembagianTugas');
            Route::get('pelayan/pembagianTugas/majelisIbadahMinggu','majelisIbadahMingguController@readMajelisIbadahMinggu');
            Route::get('pelayan/pembagianTugas/khadim','khadimController@readKhadim');
            Route::get('pelayan/pembagianTugas/penataanBunga','penataanBungaController@readPenataanBunga');
            Route::get('pelayan/pembagianTugas/pemusik','pemusikController@readPemusik');
            Route::get('pelayan/pembagianTugas/pujian','pujianController@readPujian');
            Route::get('pelayan/pembagianTugas/penerimaTamu','penerimaTamuController@readPenerimaTamu');
        Route::get('/pelayanan/pembagianMajelis','pembagianMajelisController@readPembagianMajelis');
    Route::get('/event','eventController@readEvent');
        Route::get('/event/HUT','hutController@readHUT');
        Route::get('/event/reformasiGereja','reformasiGerejaController@readReformasiGereja');
        Route::get('/event/perjamuanKudus', 'perjamuanKudusController@readPerjamuanKudus');

        Route::get('/website/kesaksian','kesaksianController@readKesaksian');
        Route::get('/website/renungan','renunganController@readRenungan');
    Route::get('/ayatHarian','alkitabController@readAlkitab');

    Route::get('/bulletin/downloadBulletin/{bulan}','bulletinController@downloadBulletin');

    Route::post('/login/cekPassword','loginController@cekPassword');
    Route::get('/dashboard/database', 'dashboardController@database');
    Route::post('/dashboard/getDataJemaat', 'dashboardController@getDataJemaat');
    Route::post('/dashboard/getEventGereja', 'dashboardController@getEventGereja');
    Route::post('/dashboard/getStatistikJemaat','dashboardController@getStatistikJemaat');
    
    //POST
    Route::post('/ibadah/createIbadah', 'ibadahController@createIbadah');
    Route::post('/ibadah/createKategoriIbadah', 'ibadahController@createKategoriIbadah');
    Route::post('/dataJemaat/createBaptis', 'baptisController@createBaptis');
    Route::post('/dataJemaat/createSIDI', 'sidiController@createSIDI');
    Route::post('/dataJemaat/createKartuKeluarga','kartuKeluargaController@createKartuKeluarga');
    Route::post('/dataJemaat/createTempDetailKartuKeluarga','kartuKeluargaController@createTempDetailKartuKeluarga');
    Route::post('/event/createHUT', 'hutController@createHUT');
    Route::post('/event/createReformasiGereja','reformasiGerejaController@createReformasiGereja');
    Route::post('/event/createPerjamuanKudus','perjamuanKudusController@createPerjamuanKudus');
    Route::post('/dataJemaat/createDataJemaat','dataJemaatController@createDataJemaat');
    Route::post('/pelayanan/pembagianTugas/majelisIbadahMinggu/createMajelisIbadahMinggu','majelisIbadahMingguController@createMajelisIbadahMinggu');
    Route::post('/pelayanan/pembagianTugas/khadim/createKhadim','khadimController@createKhadim');
    Route::post('/pelayanan/pembagianTugas/penataanBunga/createPenataanBunga','penataanBungaController@createPenataanBunga');
    Route::post('/pelayanan/pembagianTugas/pemusik/createPemusik','pemusikController@createPemusik');
    Route::post('/pelayanan/pembagianTugas/pujian/createPujian','pujianController@createPujian');
    Route::post('/pelayanan/pembagianTugas/penerimaTamu/createPenerimaTamu','penerimaTamuController@createPenerimaTamu');
    Route::post('/pelayanan/rapatEvaluasi/createRapatEvaluasi', 'rapatEvaluasiController@createRapatEvaluasi');
    Route::post('/pelayanan/pembagianMajelis/createPembagianMajelis', 'pembagianMajelisController@createPembagianMajelis');
    Route::post('/bulletin/createBulletinCover','bulletinController@createBulletinCover');
    Route::post('/website/createKesaksian','kesaksianController@createKesaksian');
    Route::post('/website/createRenungan','renunganController@createRenungan');

    //GET
    Route::post('/ibadah/getWorshipByCategoryId','ibadahController@getWorshipByCategoryId');
    Route::post('/event/getEventByEventCategoryId','hutController@getEventByEventCategoryId');

    Route::post('/ibadah/getAllWorship', 'ibadahController@getAllWorship');
    Route::post('/ibadah/getLainlainWorship','ibadahController@getLainlainWorship');
    Route::post('/ibadah/getAllKategoriIbadah', 'ibadahController@getAllKategoriIbadah');
    Route::post('/dataJemaat/getAllSIDI','sidiController@getAllSIDI');
    Route::post('/dataJemaat/getAllBaptis', 'baptisController@getAllBaptis');
    Route::post('/dataJemaat/getAllKartuKeluarga', 'kartuKeluargaController@getAllKartuKeluarga');
    Route::post('/event/getAllHUT', 'hutController@getAllHUT');
    Route::post('/event/getAllReformasiGereja','reformasiGerejaController@getAllReformasiGereja');
    Route::post('/event/getAllPerjamuanKudus','perjamuanKudusController@getAllPerjamuanKudus');
    Route::post('/dataJemaat/getAllDataJemaat', 'dataJemaatController@getAllDataJemaat');
    Route::post('/dataJemaat/getTempDetailKartuKeluarga', 'kartuKeluargaController@getTempDetailKartuKeluarga');
    Route::post('/dataJemaat/getDetailKartuKeluarga', 'kartuKeluargaController@getDetailKartuKeluarga');
    Route::post('/pelayanan/pembagianTugas/majelisIbadahMinggu/getAllMajelisIbadahMinggu','majelisIbadahMingguController@getAllMajelisIbadahMinggu');
    Route::post('/pelayanan/pembagianTugas/khadim/getAllKhadim','khadimController@getAllKhadim');
    Route::post('/pelayanan/pembagianTugas/penataanBunga/getAllPenataanBunga','penataanBungaController@getAllPenataanBunga');
    Route::post('/pelayanan/pembagianTugas/pemusik/getAllPemusik','pemusikController@getAllPemusik');
    Route::post('/pelayanan/pembagianTugas/pujian/getAllPujian','pujianController@getAllPujian');
    Route::post('/pelayanan/pembagianTugas/penerimaTamu/getAllPenerimaTamu','penerimaTamuController@getAllPenerimaTamu');
    Route::post('/pelayanan/rapatEvaluasi/getAllRapatEvaluasi', 'rapatEvaluasiController@getAllRapatEvaluasi');
    Route::post('/pelayanan/pembagianMajelis/getAllPembagianMajelis', 'pembagianMajelisController@getAllPembagianMajelis');
    Route::post('/bulletin/getAllBulletin','bulletinController@getAllBulletin');
    Route::post('/bulletin/getAllBulletinCover','bulletinController@getAllBulletinCover');
    Route::post('/website/getAllKesaksian','kesaksianController@getAllKesaksian');
    Route::post('/website/getAllRenungan','renunganController@getAllRenungan');

    //PUT
    Route::post('/ibadah/updateIbadah', 'ibadahController@updateIbadah');
    Route::post('/ibadah/updateKategoriIbadah','ibadahController@updateKategoriIbadah');
    Route::post('/dataJemaat/updateSIDI', 'sidiController@updateSIDI');
    Route::post('/dataJemaat/updateBaptis', 'baptisController@updateBaptis');
    Route::post('/dataJemaat/updateDetailKartuKeluarga', 'kartuKeluargaController@updateDetailKartuKeluarga');
    Route::post('/dataJemaat/updateTempDetailKartuKeluarga','kartuKeluargaController@updateTempDetailKartuKeluarga');
    Route::post('/event/updateHUT','hutController@updateHUT');
    Route::post('/event/updateReformasiGereja','reformasiGerejaController@updateReformasiGereja');
    Route::post('/event/updatePerjamuanKudus','perjamuanKudusController@updatePerjamuanKudus');
    Route::post('/dataJemaat/updateDataJemaat','dataJemaatController@updateDataJemaat');
    Route::post('/dataJemaat/updateKartuKeluarga','kartuKeluargaController@updateKartuKeluarga');
    Route::post('/pelayanan/pembagianTugas/majelisIbadahMinggu/updateMajelisIbadahMinggu','majelisIbadahMingguController@updateMajelisIbadahMinggu');
    Route::post('/pelayanan/pembagianTugas/khadim/updateKhadim','khadimController@updateKhadim');
    Route::post('/pelayanan/pembagianTugas/penataanBunga/updatePenataanBunga','penataanBungaController@updatePenataanBunga');
    Route::post('/pelayanan/pembagianTugas/pemusik/updatePemusik','pemusikController@updatePemusik');
    Route::post('/pelayanan/pembagianTugas/pujian/updatePujian','pujianController@updatePujian');
    Route::post('/pelayanan/pembagianTugas/penerimaTamu/updatePenerimaTamu','penerimaTamuController@updatePenerimaTamu');
    Route::post('/pelayanan/rapatEvaluasi/updateRapatEvaluasi', 'rapatEvaluasiController@updateRapatEvaluasi');
    Route::post('/pelayanan/pembagianMajelis/updatePembagianMajelis', 'pembagianMajelisController@updatePembagianMajelis');
    Route::post('/bulletin/updateBulletinCover','bulletinController@updateBulletinCover');
    Route::post('/website/updateKesaksian','kesaksianController@updateKesaksian');
    Route::post('/website/updateRenungan','renunganController@updateRenungan');

    //SHOW
    Route::post('/ibadah/showIbadahModel', 'ibadahController@showIbadahModel');
    Route::post('/ibadah/showKategoriIbadahModel', 'ibadahController@showKategoriIbadahModel');
    Route::post('/dataJemaat/showBaptisModel', 'baptisController@showBaptisModel');
    Route::post('/dataJemaat/showSIDIModel','sidiController@showSIDIModel');
    Route::post('/dataJemaat/showKartuKeluargaModel', 'kartuKeluargaController@showKartuKeluargaModel');
    Route::post('/dataJemaat/showDetailKartuKeluargaModel/{cmd}', 'kartuKeluargaController@showDetailKartuKeluargaModel');
    Route::post('/dataJemaat/showTempDetailKartuKeluargaModel/{cmd}','kartuKeluargaController@showTempDetailKartuKeluarga');
    Route::post('/event/showAllEventModel', 'eventController@showAllEventModel');
    Route::post('/dataJemaat/showDataJemaat','dataJemaatController@showDataJemaat');
    Route::post('/pelayanan/pembagianTugas/majelisIbadahMinggu/showMajelisIbadahMingguModel','majelisIbadahMingguController@showMajelisIbadahMingguModel');
    Route::post('/pelayanan/pembagianTugas/khadim/showKhadimModel','khadimController@showKhadimModel');
    Route::post('/pelayanan/pembagianTugas/penataanBunga/showPenataanBungaModel','penataanBungaController@showPenataanBungaModel');
    Route::post('/pelayanan/pembagianTugas/pemusik/showPemusikModel','pemusikController@showPemusikModel');
    Route::post('/pelayanan/pembagianTugas/pujian/showPujianModel','pujianController@showPujianModel');
    Route::post('/pelayanan/pembagianTugas/penerimaTamu/showPenerimaTamuModel','penerimaTamuController@showPenerimaTamuModel');
    Route::post('/pelayanan/rapatEvaluasi/showRapatEvaluasiModel', 'rapatEvaluasiController@showRapatEvaluasiModel');
    Route::post('/pelayanan/pembagianMajelis/showPembagianMajelisModel', 'pembagianMajelisController@showPembagianMajelisModel');
    Route::post('/bulletin/showBulletinCoverModel','bulletinController@showBulletinCoverModel');
    Route::post('/website/showKesaksianModel','kesaksianController@showKesaksianModel');
    Route::post('/website/showRenunganModel','renunganController@showRenunganModel');

    //DELETE
    Route::post('/ibadah/deleteIbadah', 'ibadahController@deleteIbadah');
    Route::post('/ibadah/deleteKategoriIbadah', 'ibadahController@deleteKategoriIbadah');
    Route::post('/dataJemaat/deleteSIDI', 'sidiController@deleteSIDI');
    Route::post('/dataJemaat/deleteBaptis', 'baptisController@deleteBaptis');
    Route::post('/dataJemaat/deleteDetailKartuKeluarga', 'kartuKeluargaController@deleteDetailKartuKeluarga');
    Route::post('/dataJemaat/deleteTempDetailKartuKeluarga','kartuKeluargaController@deleteTempDetailKartuKeluarga');
    Route::post('/event/deleteHUT','hutController@deleteHUT');
    Route::post('/event/deleteReformasiGereja', 'reformasiGerejaController@deleteReformasiGereja');
    Route::post('/event/deletePerjamuanKudus','perjamuanKudusController@deletePerjamuanKudus');
    Route::post('/dataJemaat/deleteDataJemaat','dataJemaatController@deleteDataJemaat');
    Route::post('/dataJemaat/deleteKartuKeluarga','kartuKeluargaController@deleteKartuKeluarga');
    Route::post('/pelayanan/pembagianTugas/majelisIbadahMinggu/deleteMajelisIbadahMinggu','majelisIbadahMingguController@deleteMajelisIbadahMinggu');
    Route::post('/pelayanan/pembagianTugas/khadim/deleteKhadim','khadimController@deleteKhadim');
    Route::post('/pelayanan/pembagianTugas/penataanBunga/deletePenataanBunga','penataanBungaController@deletePenataanBunga');
    Route::post('/pelayanan/pembagianTugas/pemusik/deletePemusik','pemusikController@deletePemusik');
    Route::post('/pelayanan/pembagianTugas/pujian/deletePujian','pujianController@deletePujian');
    Route::post('/pelayanan/pembagianTugas/penerimaTamu/deletePenerimaTamu','penerimaTamuController@deletePenerimaTamu');
    Route::post('/pelayanan/rapatEvaluasi/deleteRapatEvaluasi', 'rapatEvaluasiController@deleteRapatEvaluasi');
    Route::post('/pelayanan/pembagianMajelis/deletePembagianMajelis', 'pembagianMajelisController@deletePembagianMajelis');
    Route::post('/bulletin/deleteBulletinCover','bulletinController@deleteBulletinCover');
    Route::post('/website/deleteKesaksian','kesaksianController@deleteKesaksian');
    Route::post('/website/deleteRenungan','renunganController@deleteRenungan');

});



//Login
Route::post('/cekLogin','loginController@cekLogin');



