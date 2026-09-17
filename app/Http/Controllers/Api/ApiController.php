<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use App\Models\MUser;
use App\Models\MAgenda;
use App\Models\MSiswaUser;
use App\Models\MAgendaSiswa;
use App\Models\MAbsensi;
use App\Models\MPendamping;
use App\Services\FonnteService;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ApiController extends Controller
{



    public function Test(Request $request)
    {
        $bidang = DB::table('m_role')
            ->get();

        $BidangToArray = $bidang->toArray();

        if ($BidangToArray !== []) {
            return response()->json([
                'code' => 200,
                'dataUsers' => $BidangToArray
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada data user, silahkan periksa username dan password anda'
            ], 200);
        }

    }

    public function Login(Request $request)
    {
        //$base_url = "https://hilmyblaze.icu/siagan_api/api/Login";
        $base_url = "https://hirumi.xyz/agenda_api/api/Login";

        $username = $request->input("username");
        $password = $request->input("password");
        $firebase_token = $request->input("firebase_token");




        if ($username == "bupati" && $password == "12345678") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 1,
                        "username" => "BUPATI",
                        "password" => '$2y$10$cUFLuDJdWR/T2zFkRU.y3OgA.2NznydSuCvq9Yh9UvgYspVw.DIN.',
                        "firebase_token" => "dP7I2yZSQWWK5TSOKrUGh7:APA91bHDidtbjO8tH6uk0OHcMhUaQJsuYnirsyGJguU7e0UIrAvUlIq5CGRbfs-fvpQJUNPIgKYahj4MCTTxtJmgm9GB1ZzMZmVp32ChEHtXMaY937pVkmdOc7R0i4UaIt9rX6q8jk-3",
                        "id_pegawai" => 1,
                        "level" => 1,
                        "nm_lengkap" => "H.M. DADANG SUPRIATNA, S.IP., M.Si.",
                        "nip" => "1",
                        "nik" => "BUPATI",
                        "email" => "kulutuk8@gmail.com",
                        "jabatan" => "BUPATI",
                        "jabatan_id" => 1,
                        "id_skpd_master" => 1,
                        "skpdnama" => "BUPATI"
                    ]
                )
            ], 200);
        } else if ($username == "asisten bupati" && $password == "12345678") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 109332,
                        "username" => "asisten bupati",
                        "password" => '$2y$10$cUFLuDJdWR/T2zFkRU.y3OgA.2NznydSuCvq9Yh9UvgYspVw.DIN.',
                        "firebase_token" => null,
                        "id_pegawai" => 5,
                        "level" => 5,
                        "nm_lengkap" => "ASISTEN BUPATI",
                        "nip" => "3",
                        "nik" => null,
                        "email" => null,
                        "jabatan" => "ASISTEN BUPATI",
                        "jabatan_id" => 5,
                        "id_skpd_master" => 1,
                        "skpdnama" => "Pemerintah Kabupaten Bandung"
                    ]
                )
            ], 200);
        } else if ($username == "bagian prokopim" && $password == "12345678") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 8717,
                        "username" => "BAGIAN PROKOPIM",
                        "password" => '$2y$10$cUFLuDJdWR/T2zFkRU.y3OgA.2NznydSuCvq9Yh9UvgYspVw.DIN.',
                        "firebase_token" => "dP7I2yZSQWWK5TSOKrUGh7:APA91bHDidtbjO8tH6uk0OHcMhUaQJsuYnirsyGJguU7e0UIrAvUlIq5CGRbfs-fvpQJUNPIgKYahj4MCTTxtJmgm9GB1ZzMZmVp32ChEHtXMaY937pVkmdOc7R0i4UaIt9rX6q8jk-3",
                        "id_pegawai" => 38547,
                        "level" => 5,
                        "nm_lengkap" => "BAGIAN PROKOPIM",
                        "nip" => "bagian prokopim",
                        "nik" => "BAGIAN PROKOPIM",
                        "email" => "kulutuk8@gmail.com",
                        "jabatan" => "TENAGA AHLI",
                        "jabatan_id" => 38547,
                        "id_skpd_master" => 146,
                        "skpdnama" => "BAGIAN PROKOPIM"
                    ]
                )
            ], 200);
        } else if ($username == "inspektorat" && $password == "12345678") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 8717,
                        "username" => "BAGIAN PROKOPIM",
                        "password" => '$2y$10$cUFLuDJdWR/T2zFkRU.y3OgA.2NznydSuCvq9Yh9UvgYspVw.DIN.',
                        "firebase_token" => "dP7I2yZSQWWK5TSOKrUGh7:APA91bHDidtbjO8tH6uk0OHcMhUaQJsuYnirsyGJguU7e0UIrAvUlIq5CGRbfs-fvpQJUNPIgKYahj4MCTTxtJmgm9GB1ZzMZmVp32ChEHtXMaY937pVkmdOc7R0i4UaIt9rX6q8jk-3",
                        "id_pegawai" => 38547,
                        "level" => 5,
                        "nm_lengkap" => "INSPEKTORAT",
                        "nip" => "bagian prokopim",
                        "nik" => "INSPEKTORAT",
                        "email" => "kulutuk8@gmail.com",
                        "jabatan" => "TENAGA AHLI",
                        "jabatan_id" => 38547,
                        "id_skpd_master" => 146,
                        "skpdnama" => "BAGIAN PROKOPIM"
                    ]
                )
            ], 200);

        } else if ($username == "198704042019032004" && $password == "081312229386") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 14216,
                        "username" => "198704042019032004",
                        "password" => "",
                        "firebase_token" => null,
                        "id_pegawai" => 43933,
                        "level" => 5,
                        "nm_lengkap" => "NOVITA NOVIANA PRIATNA S.I.Kom",
                        "nip" => "198704042019032004",
                        "nik" => null,
                        "email" => "novitanpriatna@yahoo.com",
                        "jabatan" => "PENELAAH TEKNIS KEBIJAKAN",
                        "jabatan_id" => 43933,
                        "id_skpd_master" => 135,
                        "skpdnama" => "SEKRETARIAT DAERAH"
                    ]
                )
            ], 200);

        } else if ($username == "200304042025101005" && $password == "081312229386") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 14216,
                        "username" => "200304042025101005",
                        "password" => "",
                        "firebase_token" => null,
                        "id_pegawai" => 54298,
                        "level" => 5,
                        "nm_lengkap" => "THEOFILUS IMANUEL TAMASURA GINTING, S.Tr.I.P.",
                        "nip" => "200304042025101005",
                        "nik" => null,
                        "email" => "theofilusimanuel2003@gmail.com",
                        "jabatan" => "PENATA KEPROTOKOLAN",
                        "jabatan_id" => 12958,
                        "id_skpd_master" => 135,
                        "skpdnama" => "SEKRETARIAT DAERAH"
                    ]
                )
            ], 200);

        } else if ($username == "199601062025051002" && $password == "Bedas2025") {
            return response()->json([
                'code' => 200,
                'dataUsers' => array(
                    [
                        "id" => 52944,
                        "username" => "199601062025051002",
                        "password" => "",
                        "firebase_token" => null,
                        "id_pegawai" => 52944,
                        "level" => 5,
                        "nm_lengkap" => "GELAR ALDI SUGIARA S.I.Kom",
                        "nip" => "198704042019032004",
                        "nik" => null,
                        "email" => "gelaaraldis@gmail.com",
                        "jabatan" => "PENATA KEPROTOKOLAN",
                        "jabatan_id" => 12958,
                        "id_skpd_master" => 135,
                        "skpdnama" => "SEKRETARIAT DAERAH"
                    ]
                )
            ], 200);

        } else {
            $response = Http::post($base_url, [
                'username' => $username,
                'password' => $password,
            ]);
            return json_decode($response);
        }
    }



    public function InsertPermohonanAgendaOPD(Request $request)
    {
        $validator = validator::make($request->all(), [
            'id_pegawai' => 'required',
            'nip' => 'required',
            'skpdnama' => 'required',
            // 'waktu_mulai' => 'required',
            // 'waktu_selesai' => 'required',
            'tanggal_mulai' => 'required',
            'acara' => 'required',
            'tempat' => 'required',
            'leading_sektor' => 'required',
            'surat' => 'required',
        ]);

        $surat = null;

        if ($request->hasFile('surat')) {
            $file = $request->file('surat');
            $destinationPath = 'public/uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $surat = $file->getClientOriginalName();
        }

        $id_pegawai = $request->input("id_pegawai");
        $nip = $request->input("nip");
        $skpdnama = $request->input("skpdnama");
        $waktu_mulai = $request->input("waktu_mulai");
        $waktu_selesai = $request->input("waktu_selesai");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $acara = $request->input("acara");
        $tempat = $request->input("tempat");
        $leading_sektor = $request->input("leading_sektor");
        $status_agenda = 0;

        $mulai = $tanggal_mulai . " " . $waktu_mulai . ":00.000000";
        $selesai = $tanggal_mulai . " " . $waktu_selesai . ":00.000000";

        $agenda = new MAgenda;
        $agenda->id_pegawai = $id_pegawai;
        $agenda->nip = $nip;
        $agenda->skpdnama = $skpdnama;
        $agenda->waktu_mulai = $waktu_mulai == null ? null : $mulai;
        $agenda->waktu_selesai = $waktu_selesai == null ? null : $selesai;
        $agenda->tanggal_mulai = $tanggal_mulai;
        $agenda->acara = $acara;
        $agenda->tempat = $tempat;
        $agenda->leading_sektor = $leading_sektor;
        $agenda->surat = $surat;
        $agenda->status_agenda = $status_agenda;

        //cek agenda jika waktu ditentukan
        $cek_agenda = null;
        if ($waktu_mulai != null) {
            $timeMulai = Carbon::parse($mulai);
            $timeMulai->addMinutes(-29);
            $timeAkhir = Carbon::parse($mulai);
            $timeAkhir->addMinutes(29);
            // print("mulai: " . $timeMulai . " selesai: " . $timeAkhir);

            $cek_agenda = DB::select(DB::raw("SELECT id, waktu_mulai, waktu_selesai 
                        FROM t_agenda
                        WHERE 
                        tanggal_mulai = '" . $tanggal_mulai . "'
                        AND ((waktu_mulai BETWEEN '" . $timeMulai . "' AND '" . $timeAkhir . "'))
                        AND status_agenda = 1
                        ORDER BY waktu_mulai ASC
                        "));
        }


        if ($cek_agenda != null) {
            return response()->json([
                'code' => 201,
                'message' => 'Agenda bupati sudah ada pada waktu tersebut'
            ], 200);
        } else {
            $agenda->save();

            if ($agenda != null) {
                return response()->json([
                    'code' => 200,
                    'id' => $agenda->id,
                    'message' => 'Berhasil membuat agenda'
                ], 200);
            } else {
                return response()->json([
                    'code' => 201,
                    'message' => 'Gagal membuat agenda'
                ], 200);
            }
        }


    }



    public function GetSurat(Request $request)
    {
        $filename = $request->input("filename");

        $file = public_path() . "/uploads/" . $filename;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, $filename, $headers);
    }

    public function InsertAgendaAjudan(Request $request)
    {
        $validator = validator::make($request->all(), [
            'id_pegawai' => 'required',
            'nip' => 'required',
            'skpdnama' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'tanggal_mulai' => 'required',
            'acara' => 'required',
            'tempat' => 'required',
            'leading_sektor' => 'required',
            'pendamping' => 'pendamping',
            'penugasan' => 'penugasan',
            'no_hp' => 'no_hp'
        ]);

        $id_pegawai = $request->input("id_pegawai");
        $nip = $request->input("nip");
        $skpdnama = $request->input("skpdnama");
        $waktu_mulai = $request->input("waktu_mulai");
        $waktu_selesai = $request->input("waktu_selesai");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $acara = $request->input("acara");
        $tempat = $request->input("tempat");
        $leading_sektor = $request->input("leading_sektor");
        $pendamping = $request->input("pendamping");
        $penugasan = $request->input("penugasan");
        $surat = $request->input("surat");
        $status_agenda = 1;
        $no_hp = $request->input("no_hp");

        $mulai = $tanggal_mulai . " " . $waktu_mulai . ":00.000000";
        $selesai = $tanggal_mulai . " " . $waktu_selesai . ":00.000000";

        $agenda = new MAgenda;
        $agenda->id_pegawai = $id_pegawai;
        $agenda->nip = $nip;
        $agenda->skpdnama = $skpdnama;
        $agenda->waktu_mulai = $tanggal_mulai . " " . $waktu_mulai . ":00.000000";
        $agenda->waktu_selesai = $tanggal_mulai . " " . $waktu_selesai . ":00.000000";
        $agenda->tanggal_mulai = $tanggal_mulai;
        $agenda->acara = $acara;
        $agenda->tempat = $tempat;
        $agenda->leading_sektor = $leading_sektor;
        $agenda->pendamping = $pendamping;
        $agenda->penugasan = $penugasan;
        $agenda->surat = $surat;
        $agenda->status_agenda = $status_agenda;
        $agenda->no_hp = $no_hp;

        $cek_agenda = DB::select(DB::raw("SELECT id, waktu_mulai, waktu_selesai 
                        FROM t_agenda
                        WHERE 
                        tanggal_mulai = '" . $tanggal_mulai . "'
                        AND ((waktu_mulai BETWEEN '" . $mulai . "' AND '" . $selesai . "') OR (waktu_selesai BETWEEN '" . $mulai . "' AND '" . $selesai . "'))
                        AND status_agenda = 1
                        ORDER BY waktu_mulai ASC
                        "));

        if ($cek_agenda != null) {
            return response()->json([
                'code' => 201,
                'message' => 'Agenda bupati sudah ada pada waktu tersebut'
            ], 200);
        } else {
            $agenda->save();

            if ($agenda != null) {
                return response()->json([
                    'code' => 200,
                    'id' => $agenda->id,
                    'message' => 'Berhasil membuat agenda'
                ], 200);
            } else {
                return response()->json([
                    'code' => 201,
                    'message' => 'Gagal membuat agenda'
                ], 200);
            }
        }
    }


    public function KonfirmasiAgenda(Request $request)
    {
        $id = $request->input("id");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $waktu_mulai = $request->input("waktu_mulai");
        $waktu_selesai = $request->input("waktu_selesai");
        $pendamping = $request->input("pendamping");
        $penugasan = $request->input("penugasan");
        $keterangan = $request->input("keterangan");
        $status_agenda = $request->input("status_agenda");


        $status_update = DB::table('t_agenda')
            ->where('id', $id)
            ->update([
                'tanggal_mulai' => $tanggal_mulai,
                'waktu_mulai' => $waktu_mulai == null ? null : $tanggal_mulai . " " . $waktu_mulai . ":00.000000",
                'waktu_selesai' => $waktu_selesai == null ? null : $tanggal_mulai . " " . $waktu_selesai . ":00.000000",
                'pendamping' => $pendamping,
                'penugasan' => $penugasan,
                'keterangan' => $keterangan,
                'status_agenda' => $status_agenda,

            ]);

        if ($status_update !== []) {
            if ($status_agenda == 2 && !empty($pendamping)) {
                $this->kirimWhatsappPerwakilan($id, $pendamping, $tanggal_mulai, $waktu_mulai, $keterangan);
            }

            return response()->json([
                'code' => 200,
                'message' => 'Acc Agenda berhasil'
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Acc Agenda gagal'
            ], 200);
        }
    }

    public function GetPendamping(Request $request)
    {
        $pendamping = MPendamping::orderBy('nama', 'ASC')->get();

        if ($pendamping->toArray() !== []) {
            return response()->json([
                'code' => 200,
                'data' => $pendamping
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada data pendamping'
            ], 200);
        }
    }

    protected function kirimWhatsappPerwakilan($agendaId, $pendamping, $tanggal_mulai, $waktu_mulai, $keterangan)
    {
        try {
            $master = MPendamping::whereRaw('LOWER(nama) = ?', [strtolower(trim($pendamping))])
                ->where('aktif', true)
                ->first();

            if ($master === null || empty($master->no_hp)) {
                return;
            }

            $message = "Yth. {$master->nama}\n\n"
                . "Anda ditunjuk sebagai perwakilan untuk menghadiri agenda berikut:\n"
                . "Tanggal: {$tanggal_mulai}" . ($waktu_mulai ? " {$waktu_mulai}" : "") . "\n"
                . ($keterangan ? "Keterangan: {$keterangan}\n" : "")
                . "\nMohon konfirmasi kehadiran. Terima kasih.";

            (new FonnteService())->send($master->no_hp, $message, [
                'agenda_id' => $agendaId,
                'pendamping_id' => $master->id,
                'nama_pendamping' => $master->nama,
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim notifikasi WhatsApp perwakilan', [
                'pendamping' => $pendamping,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function UpdateAgenda(Request $request)
    {
        $id = $request->input("id");
        $acara = $request->input("acara");
        $tempat = $request->input("tempat");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $waktu_mulai = $request->input("waktu_mulai");
        $waktu_selesai = $request->input("waktu_selesai");
        $no_hp = $request->input("no_hp");

        // $pendamping = $request->input("pendamping");
        // $penugasan = $request->input("penugasan");
        // $keterangan = $request->input("keterangan");
        // $status_agenda = $request->input("status_agenda");

        $status_update = DB::table('t_agenda')
            ->where('id', $id)
            ->update([
                'acara' => $acara,
                'tempat' => $tempat,
                'tanggal_mulai' => $tanggal_mulai,
                'waktu_mulai' => $tanggal_mulai . " " . $waktu_mulai . ":00.000000",
                'waktu_selesai' => $tanggal_mulai . " " . $waktu_selesai . ":00.000000",
                'no_hp' => $no_hp
                // 'pendamping' => $pendamping,
                // 'penugasan' => $penugasan,
                // 'keterangan' => $keterangan,
                // 'status_agenda' => $status_agenda
            ]);


        if ($status_update !== []) {
            return response()->json([
                'code' => 200,
                'message' => 'Acc Agenda berhasil'
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Acc Agenda gagal'
            ], 200);
        }
    }


    // public function UpdateAgenda(Request $request)
    // {
    //     $id = $request->input("id");
    //     $status_agenda = $request->input("status_agenda");

    //     $status_update = DB::table('t_agenda')
    //         ->where('id', $id)
    //         ->update(['status_agenda' => $status_agenda]);

    //     if ($status_update !== []) {
    //         return response()->json([
    //             'code' => 200,
    //             'message' => 'Update Agenda berhasil'
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'code' => 201,
    //             'message' => 'Update Agenda gagal'
    //         ], 200);
    //     }
    // }

    public function HapusAgenda(Request $request)
    {
        $id = $request->input("id");

        $status_update = DB::table('t_agenda')
            ->where('id', $id)
            ->delete();

        // $status_hapus  = DB::table('m_inbox')
        // ->where('id_agenda', $id)
        // ->delete();

        if ($status_update !== []) {
            return response()->json([
                'code' => 200,
                'message' => 'Agenda berhasil di hapus'
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Agenda baca gagal di hapus'
            ], 200);
        }
    }

    public function DashboardPegawai(Request $request)
    {
        $id_pegawai = $request->input("id_pegawai");

        $dashboardPegawai = DB::select(DB::raw("SELECT
        (select count(id) as total_konfirmasi from t_agenda WHERE status_agenda = 2 and id_pegawai = " . $id_pegawai . ") as total_ditolak,
        (select count(id) as total_konfirmasi from t_agenda WHERE status_agenda = 1 and id_pegawai = " . $id_pegawai . ") as total_diacc,
        (select count(id) as total_konfirmasi from t_agenda WHERE (status_agenda = 0 or status_agenda = 3) and id_pegawai = " . $id_pegawai . ") as total_konfirmasi"));

        return response()->json([
            'code' => 200,
            'data' => $dashboardPegawai
        ], 200);
    }

    public function DashboardAjudan(Request $request)
    {
        $id_pegawai = $request->input("id_pegawai");

        $dashboardAjudan = DB::select(DB::raw("SELECT
        (select count(id) as total_konfirmasi from t_agenda WHERE status_agenda = 2 ) as total_ditolak,
        (select count(id) as total_konfirmasi from t_agenda WHERE status_agenda = 1 ) as total_diacc,
        (select count(id) as total_konfirmasi from t_agenda WHERE (status_agenda = 0) ) as total_konfirmasi"));

        return response()->json([
            'code' => 200,
            'data' => $dashboardAjudan
        ], 200);
    }

    public function GetAgendaByPegawai(Request $request)
    {
        $id_pegawai = $request->input("id_pegawai");
        $status = $request->input("status");
        $limit = $request->input("limit");
        $index = $request->input("index");

        $agenda;

        if ($status == null) {
            $agenda = DB::table('t_agenda')
                ->select(
                    'id',
                    'id_pegawai',
                    'nip',
                    'skpdnama',
                    'waktu_mulai',
                    'waktu_selesai',
                    'tanggal_mulai',
                    'acara',
                    'tempat',
                    'leading_sektor',
                    'pendamping',
                    'penugasan',
                    'surat',
                    'status_agenda',
                    'keterangan',
                    'no_hp'
                )
                ->where('id_pegawai', '=', $id_pegawai)
                // ->where('surat.status_surat', '=', 1)
                ->limit($limit)
                ->offset($index)
                ->orderBy('tanggal_mulai', 'DESC')
                ->orderBy('waktu_mulai', 'ASC')
                ->get();
        } else {
            if ($status == 0) {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp'
                    )
                    ->where('id_pegawai', '=', $id_pegawai)
                    ->where('status_agenda', '=', $status)
                    ->orWhere('status_agenda', '=', 3)
                    // ->where('surat.status_surat', '=', 1)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('status_agenda', 'DESC')
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')

                    ->get();
            } else {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp'
                    )
                    ->where('id_pegawai', '=', $id_pegawai)
                    ->where('status_agenda', '=', $status)
                    // ->where('surat.status_surat', '=', 1)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')
                    ->get();
            }

        }
        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetFilterAgendaByPegawai(Request $request)
    {
        $id_pegawai = $request->input("id_pegawai");
        $tanggal_mulai = $request->input("tanggal_mulai");
        $status = $request->input("status");
        $limit = $request->input("limit");
        $index = $request->input("index");

        // $agenda;

        if ($status == null) {
            $agenda = DB::table('t_agenda')
                ->select(
                    'id',
                    'id_pegawai',
                    'nip',
                    'skpdnama',
                    'waktu_mulai',
                    'waktu_selesai',
                    'tanggal_mulai',
                    'acara',
                    'tempat',
                    'leading_sektor',
                    'pendamping',
                    'penugasan',
                    'surat',
                    'status_agenda',
                    'keterangan',
                    'no_hp'
                )
                ->where('id_pegawai', '=', $id_pegawai)
                ->where('tanggal_mulai', '>=', $tanggal_mulai)
                // ->where('surat.status_surat', '=', 1)
                ->limit($limit)
                ->offset($index)
                ->orderBy('tanggal_mulai', 'DESC')
                ->orderBy('waktu_mulai', 'ASC')
                ->get();
        } else {
            if ($status == 0) {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp'
                    )
                    ->where('id_pegawai', '=', $id_pegawai)
                    ->where('status_agenda', '=', $status)
                    ->where('tanggal_mulai', '>=', $tanggal_mulai)
                    // ->orWhere('status_agenda', '=', 3)
                    // ->where('surat.status_surat', '=', 1)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('status_agenda', 'DESC')
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')

                    ->get();
            } else {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp'
                    )
                    ->where('id_pegawai', '=', $id_pegawai)
                    ->where('status_agenda', '=', $status)
                    ->where('tanggal_mulai', '>=', $tanggal_mulai)
                    // ->where('surat.status_surat', '=', 1)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')
                    ->get();
            }

        }
        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetCatatanBulanan(Request $request)
    {
        $limit = $request->input("limit");
        $index = $request->input("index");
        $status = $request->input("status");
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp'
            )
            // ->where('status_agenda', '=', $status)
            ->whereBetween('tanggal_mulai', [$tanggalMulai, $tanggalAkhir])
            ->limit($limit)
            ->offset($index)
            ->orderBy('tanggal_mulai', 'ASC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $agendaToArray = $agenda->toArray();

        //fungsi untuk memisahkan response berdasarkan tanggal
        $items = [];
        $currentTanggal = '';
        foreach ($agendaToArray as $key => $a) {
            if ($currentTanggal == $a->tanggal_mulai) {
                continue;
            }
            $currentTanggal = $a->tanggal_mulai;

            $perTanggalItems = [];
            foreach ($agendaToArray as $key2 => $a2) {
                if ($a2->tanggal_mulai == $currentTanggal) {
                    $perTanggalItems[] = $a2;

                }
            }

            $items[] = ['tanggal' => $currentTanggal, 'agendas' => $perTanggalItems];
        }

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $items
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }


    public function GetSingleAgenda(Request $request)
    {
        $id = $request->input("id");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp'
            )
            ->where('id', '=', $id)
            ->get();

        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetFilterAjudan(Request $request)
    {
        $limit = $request->input("limit");
        $index = $request->input("index");
        $status = $request->input("status");
        $tanggal_mulai = $request->input("tanggal_mulai");

        $agenda;

        if ($status == null) {
            $agenda = DB::table('t_agenda')
                ->select(
                    'id',
                    'id_pegawai',
                    'nip',
                    'skpdnama',
                    'waktu_mulai',
                    'waktu_selesai',
                    'tanggal_mulai',
                    'acara',
                    'tempat',
                    'leading_sektor',
                    'pendamping',
                    'penugasan',
                    'surat',
                    'status_agenda',
                    'keterangan',
                    'no_hp'
                )
                ->where('status_agenda', '!=', 2)
                ->limit($limit)
                ->offset($index)
                ->orderBy('tanggal_mulai', 'DESC')
                ->orderBy('waktu_mulai', 'ASC')
                ->get();
        } else {
            if ($status == 0) {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp'
                    )
                    ->where('status_agenda', '=', $status)
                    ->where('tanggal_mulai', '=', $tanggal_mulai)
                    // ->orWhere('status_agenda', '=', 3)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('status_agenda', 'DESC')
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')

                    ->get();
            } else {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp'
                    )
                    ->where('status_agenda', '=', $status)
                    ->where('tanggal_mulai', '=', $tanggal_mulai)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')
                    ->get();
            }

        }



        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetAgendaForAjudan(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp'
            )
            ->where('status_agenda', '=', 1)
            ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();


        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetAgendaPerwakilanForAjudan(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp'
            )
            ->where('status_agenda', '=', 2)
            ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();


        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetAgendaBupati(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp'
            )
            ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->where('status_agenda', '=', 1)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetAgendaKonfirmasiBupati(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp'
            )
            ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->where('status_agenda', '=', 0)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function GetFilterAgendaAjudan(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");
        $status_agenda = $request->input("status_agenda");
        $limit = $request->input("limit");
        $index = $request->input("index");
        $akan_datang = $request->input("akan_datang");

        // $agenda;

        if ($status_agenda != null && $tanggal_mulai != null) {
            $agenda = DB::table('t_agenda')
                ->select(
                    'id',
                    'id_pegawai',
                    'nip',
                    'skpdnama',
                    'waktu_mulai',
                    'waktu_selesai',
                    'tanggal_mulai',
                    'acara',
                    'tempat',
                    'leading_sektor',
                    'pendamping',
                    'penugasan',
                    'surat',
                    'status_agenda',
                    'keterangan',
                    'no_hp'
                )
                ->where('status_agenda', '=', $status_agenda)
                ->where('tanggal_mulai', $akan_datang == null ? "=" : ">=", $tanggal_mulai)
                ->limit($limit)
                ->offset($index)
                ->orderBy('tanggal_mulai', 'DESC')
                ->orderBy('waktu_mulai', 'ASC')
                ->get();


        } else {
            if ($status_agenda != null) {
                $agenda = DB::table('t_agenda')
                    ->select(
                        'id',
                        'id_pegawai',
                        'nip',
                        'skpdnama',
                        'waktu_mulai',
                        'waktu_selesai',
                        'tanggal_mulai',
                        'acara',
                        'tempat',
                        'leading_sektor',
                        'pendamping',
                        'penugasan',
                        'surat',
                        'status_agenda',
                        'keterangan',
                        'no_hp'
                    )
                    ->where('status_agenda', '=', $status_agenda)
                    ->limit($limit)
                    ->offset($index)
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->orderBy('waktu_mulai', 'ASC')
                    ->get();
            } else {
                if ($tanggal_mulai != null) {
                    $agenda = DB::table('t_agenda')
                        ->select(
                            'id',
                            'id_pegawai',
                            'nip',
                            'skpdnama',
                            'waktu_mulai',
                            'waktu_selesai',
                            'tanggal_mulai',
                            'acara',
                            'tempat',
                            'leading_sektor',
                            'pendamping',
                            'penugasan',
                            'surat',
                            'status_agenda',
                            'keterangan',
                            'no_hp'
                        )
                        ->where('tanggal_mulai', '=', $tanggal_mulai)
                        ->limit($limit)
                        ->offset($index)
                        ->orderBy('tanggal_mulai', 'DESC')
                        ->orderBy('waktu_mulai', 'ASC')
                        ->get();
                } else {
                    $agenda = DB::table('t_agenda')
                        ->select(
                            'id',
                            'id_pegawai',
                            'nip',
                            'skpdnama',
                            'waktu_mulai',
                            'waktu_selesai',
                            'tanggal_mulai',
                            'acara',
                            'tempat',
                            'leading_sektor',
                            'pendamping',
                            'penugasan',
                            'surat',
                            'status_agenda',
                            'keterangan',
                            'no_hp'
                        )
                        // ->where('tanggal_mulai', '=', $tanggal_mulai)
                        ->where('status_agenda', '=', $status_agenda)
                        ->limit($limit)
                        ->offset($index)
                        ->orderBy('tanggal_mulai', 'DESC')
                        ->orderBy('waktu_mulai', 'ASC')
                        ->get();
                }
            }


        }



        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    public function PrintAgenda(Request $request)
    {
        $tanggal_mulai = $request->input("tanggal_mulai");

        $agenda = DB::table('t_agenda')
            ->select(
                'id',
                'id_pegawai',
                'nip',
                'skpdnama',
                'waktu_mulai',
                'waktu_selesai',
                'tanggal_mulai',
                'acara',
                'tempat',
                'leading_sektor',
                'pendamping',
                'penugasan',
                'surat',
                'status_agenda',
                'keterangan',
                'no_hp'
            )
            ->where('tanggal_mulai', '=', $tanggal_mulai)
            ->orderBy('tanggal_mulai', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();

        $agendaToArray = $agenda->toArray();

        if ($agendaToArray !== []) {
            return response()->json([
                'code' => 200,
                'agenda' => $agenda
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada agenda'
            ], 200);
        }
    }

    // public function SendNotification(Request $request)
    // {

    //     $token          = $request->input("token");
    //     $body           = $request->input("body");
    //     $title          = $request->input("title");
    //     $server_key     = "AAAA3neawNg:APA91bEoMqGthnqv_GsCa87qtXuIXGvZPcqMciURjBeKHkoSJitcFHMlrJ3qu76_xhGadWxkPUnc_avpUW6LYDGMWVNOPi1GCEwSy97Wz-IW5wWTzCXSsuk-BhJsMJRu4nSXR9zjk2wA";

    //     $url = 'https://fcm.googleapis.com/fcm/send';


    //     $json = '{
    //                 "to" : "'.$token.'",
    //                 "notification":{
    //                     "body":"'.$body.'",
    //                     "title":"'.$title.'"
    //                 },
    //                 "android":{
    //                     "priority":"normal"
    //                 },
    //                 "apns":{
    //                     "headers":{
    //                     "apns-priority":"5"
    //                     }
    //                 },
    //                 "webpush": {
    //                     "headers": {
    //                     "Urgency": "high"
    //                     }
    //                 }
    //             }';

    //     $jsonRequest = json_decode($json);  

    //     $headers = array(
    //         'Content-Type:application/json',
    //         'Authorization:key='.$server_key
    //     );

    //     // -- connect to API e-bpr

    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL,            $url );
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    //     curl_setopt($ch, CURLOPT_POST,           1 );
    //     curl_setopt($ch, CURLOPT_POSTFIELDS,     $json); 
    //     curl_setopt($ch, CURLOPT_HTTPHEADER,     $headers); 
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //     $result=curl_exec ($ch);

    //     $obj = json_decode($result, true);



    //     $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     curl_close($ch);

    //     // echo $response;

    //     $jsonResult = json_decode($result, true);
    //     return response()->json([
    //         'code' => 200,
    //         'jsonRequest' => $jsonRequest,
    //         'resultFirebase' => $jsonResult
    //     ], 200);
    // }


    // Test Berkat

    public function TestSiswa(Request $request)
    {
        $test = DB::table('m_siswa')
            ->get();

        $testToArray = $test->toArray();

        if ($testToArray !== []) {
            return response()->json([
                'code' => 200,
                'dataSiswa' => $testToArray
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Tidak ada data siswa'
            ], 200);
        }

    }

    public function GetSiswaByNisn(Request $request)
    {
        $nisn = $request->input("nisn");

        $siswa = DB::table('m_siswa')
            ->where('nisn', '=', $nisn)
            ->first();

        // $siswaToArray = $siswa->toArray();

        if ($siswa !== null) {
            $user = DB::table('m_siswa_user')
                ->where('id_siswa', '=', $siswa->id)
                ->first();
            // $userToArray = $user->toArray();
            if ($user !== null) {
                return response()->json([
                    'code' => 200,
                    'dataSiswa' => $siswa,
                    'username' => $user->username
                ], 200);
            } else {
                return response()->json([
                    'code' => 202,
                    'dataSiswa' => $siswa,
                    'username' => null
                ], 200);
            }

        } else {
            return response()->json([
                'code' => 201,
                'dataSiswa' => null,
                'username' => null
            ], 200);
        }

    }

    public function GetUserById(Request $request)
    {
        $id_siswa = $request->input("id_siswa");

        $siswa = DB::table('m_siswa_user')
            ->where('id_siswa', '=', $id_siswa)
            ->get();

        $siswaToArray = $siswa->toArray();

        if ($siswaToArray !== []) {
            return response()->json([
                'code' => 200,
                'dataSiswa' => $siswaToArray
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'dataSiswa' => []
            ], 200);
        }

    }

    public function Register(Request $request)
    {
        $username = $request->input("username");
        $password = Hash::make($request->input("password"));
        $id_siswa = $request->input("id_siswa");

        $create_user = new MSiswaUser;
        $create_user->username = $username;
        $create_user->password = $password;
        $create_user->id_siswa = $id_siswa;
        $create_user->save();

        if ($create_user != null) {
            return response()->json([
                'code' => 200,
                'dataUsers' => 'Berhasil mendaftarkan akun',
                'id' => $create_user->id,
                'username' => $create_user->username,
                'password' => $create_user->password
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'dataUsers' => 'Gagal mendaftarkan akun'
            ], 200);
        }

    }

    public function LoginSiswa(Request $request)
    {
        $username = $request->input("username");
        $password = $request->input("password");

        $Users;

        $Users = DB::table('m_siswa_user as user')
            ->select(
                'user.id as useri_id',
                'user.id_siswa',
                'user.username',
                'user.password',
                'siswa.nisn',
                'siswa.nama',
                'siswa.kelas'
            )
            ->join('m_siswa as siswa', 'siswa.id', '=', 'user.id_siswa')
            ->where('user.username', '=', $username)
            ->first();


        if ($Users && Hash::check($password, $Users->password)) {
            $Data_Users = DB::table('m_siswa_user as user')
                ->select(
                    'user.id as useri_id',
                    'user.id_siswa',
                    'user.username',
                    'user.password',
                    'siswa.nisn',
                    'siswa.nama',
                    'siswa.kelas'
                )
                ->join('m_siswa as siswa', 'siswa.id', '=', 'user.id_siswa')
                ->where('user.username', '=', $username)
                ->get();

            $UsersToArray = $Data_Users->toArray();

            if ($UsersToArray !== []) {
                return response()->json([
                    'code' => 200,
                    'dataUsers' => $Data_Users
                ], 200);
            } else {
                return response()->json([
                    'code' => 201,
                    'dataUsers' => [],
                    'message' => 'Tidak ada data user, silahkan periksa username dan password anda'
                ], 200);
            }

        } else if ($Users == null) {
            return response()->json([
                'code' => 201,
                'dataUsers' => [],
                'message' => 'Tidak ada data user, silahkan periksa username dan password anda'
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'dataUsers' => [],
                'message' => 'Tidak ada data user, silahkan periksa username dan password anda'
            ], 200);
        }
    }

    public function CreateAgendaSiswa(Request $request)
    {
        $id_siswa = $request->input("id_siswa");
        $nama_agenda = $request->input("nama_agenda");
        $tanggal = $request->input("tanggal");
        $jam_mulai = $request->input("jam_mulai");

        $create_agenda = new MAgendaSiswa;
        $create_agenda->id_siswa = $id_siswa;
        $create_agenda->nama_agenda = $nama_agenda;
        $create_agenda->tanggal = $tanggal;
        $create_agenda->jam_mulai = $jam_mulai;
        $create_agenda->save();

        if ($create_agenda != null) {
            return response()->json([
                'code' => 200,
                'dataAgenda' => 'Berhasil menambahkan agenda',
                'id' => $create_agenda->id,
                'namaAgenda' => $create_agenda->nama_agenda,
                'tanggal' => $create_agenda->tanggal
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'dataUsers' => 'Gagal menambahkan agenda'
            ], 200);
        }

    }

    public function UpdateAgendaSiswa(Request $request)
    {
        $id = $request->input("id");
        $kode = $request->input("kode");
        $jam_selesai = $request->input("jam_selesai");
        $nama_agenda = $request->input("nama_agenda");

        $status_update;

        if ($kode == 1) {
            $status_update = DB::table('t_agenda_siswa')
                ->where('id', $id)
                ->update(['jam_selesai' => $jam_selesai]);
        } else if ($kode == 2) {
            $status_update = DB::table('t_agenda_siswa')
                ->where('id', $id)
                ->update(['nama_agenda' => $nama_agenda]);
        } else {
            $status_update = DB::table('t_agenda_siswa')->delete($id);
        }


        if ($status_update !== []) {
            return response()->json([
                'code' => 200,
                'message' => 'Update Agenda berhasil'
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Update Agenda gagal'
            ], 200);
        }

    }

    public function GetAgenda(Request $request)
    {
        $id_siswa = $request->input("id_siswa");

        $dataAgenda = DB::table('t_agenda_siswa')
            ->where('id_siswa', '=', $id_siswa)
            ->get();

        if ($dataAgenda !== []) {
            return response()->json([
                'code' => 200,
                'message' => "data agenda ada",
                'dataAgenda' => $dataAgenda
            ], 200);
        } else {
            return response()->json([
                'code' => 200,
                'message' => "data agenda ada",
                'dataAgenda' => []
            ], 200);
        }

    }

    public function AbsenMasuk(Request $request)
    {
        $id_siswa = $request->input("id_siswa");
        $tanggal = $request->input("tanggal");
        $jam_masuk = $request->input("jam_masuk");

        $create_absensi = new MAbsensi;
        $create_absensi->id_siswa = $id_siswa;
        $create_absensi->tanggal = $tanggal;
        $create_absensi->jam_masuk = $jam_masuk;
        $create_absensi->save();

        if ($create_absensi != null) {
            return response()->json([
                'code' => 200,
                'dataAgenda' => 'Berhasil menambahkan absen',
                'id' => $create_absensi->id,
                'jamMasuk' => $create_absensi->jam_masuk,
                'tanggal' => $create_absensi->tanggal
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'dataUsers' => 'Gagal menambahkan absen'
            ], 200);
        }

    }

    public function AbsenPulang(Request $request)
    {
        $id = $request->input("id");
        $jam_pulang = $request->input("jam_pulang");

        $status_update = DB::table('t_absensi')
            ->where('id', $id)
            ->update(['jam_pulang' => $jam_pulang]);

        if ($status_update !== []) {
            return response()->json([
                'code' => 200,
                'message' => 'Update Absen berhasil'
            ], 200);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Update Absen gagal'
            ], 200);
        }

    }

    public function GetAbsensi(Request $request)
    {
        $id_siswa = $request->input("id_siswa");

        $dataAbsensi = DB::table('t_absensi')
            ->where('id_siswa', '=', $id_siswa)
            ->get();

        if ($dataAbsensi !== []) {
            return response()->json([
                'code' => 200,
                'message' => "data absensi ada",
                'dataAbsensi' => $dataAbsensi
            ], 200);
        } else {
            return response()->json([
                'code' => 200,
                'message' => "data absensi tidak ada",
                'dataAbsensi' => []
            ], 200);
        }

    }

    public function CekAbsen(Request $request)
    {
        $id_siswa = $request->input("id_siswa");
        $tanggal = $request->input("tanggal");

        $dataAbsensi = DB::table('t_absensi')
            ->where('id_siswa', '=', $id_siswa)
            ->where('tanggal', '=', $tanggal)
            ->get();

        if ($dataAbsensi !== []) {
            return response()->json([
                'code' => 200,
                'message' => "data absensi ada",
                'dataAbsensi' => $dataAbsensi
            ], 200);
        } else {
            return response()->json([
                'code' => 200,
                'message' => "data absensi tidak ada",
                'dataAbsensi' => []
            ], 200);
        }

    }


}
