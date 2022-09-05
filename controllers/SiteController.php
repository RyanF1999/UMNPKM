<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\BlogItem;
use app\components\DownloadItem;
use app\components\KontakItem;
use app\components\ProfilTable;
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {   
        // carousel variable digunakan untuk mengatur data di dalam carousel
        // sediakan data gambar saja
        $baseurl = Url::base();
        $carousel = [
            "{$baseurl}/carousel/1.jpeg",
            "{$baseurl}/carousel/2.jpeg",
            "{$baseurl}/carousel/3.jpeg",
            "{$baseurl}/carousel/4.jpeg",
            "{$baseurl}/carousel/5.jpeg",
            "{$baseurl}/carousel/6.jpeg",
            "{$baseurl}/carousel/7.jpeg",
            "{$baseurl}/carousel/8.jpeg",
            "{$baseurl}/carousel/9.jpeg",
            "{$baseurl}/carousel/10.jpeg"
        ];


        // acara dan pengumuman menggunakan widget BlogItem
        // sehingga data yang diperlukan merupakan array dari obj
        // yang memiliki property: title, deskripsi, img
        $kegiatan = [
            new BlogItem('Bantu Pelaku Usaha Berdaya Saing, UMN Gelar Program UMKM Cakap Digital', 'Program Studi Magister Manajemen Teknologi (MMT) Universitas Multimedia Nusantara (UMN) menggelar program UMKM Cakap Digital di Kabupaten Tangerang mulai Juli hingga Agustus 2022.', 'https://cdn-2.tstatic.net/tribunnews/foto/bank/images/umn-umkm.jpg'),
            new BlogItem('Studi Banding Desa Binaan Tim PKM LPPM UMN dan UMKM Jabar Siap Kolaborasi', 'Tim Pengabdian Kepada Masyarakat (PKM) Lembaga Penelitian dan Pengabdian Masyarakat (LPPM) Universita Multimedia Nusantara (UMN) mengajak Desa Binaan UMN melakukan kunjungan studi banding ke Floating Market Lembang Bandung.', 'https://liputankota.com/wp-content/uploads/2022/07/Studi-Banding-Desa-Binaan-Tim-PKM-LPPM-UMN-dan-UMKM-Jabar-Siap-Kolaborasi.ist_.jpeg'),
            new BlogItem('Jadi Youtuber Bisa Hasilkan Uang, MIO Bersama UMN Berikan Pelatihan', 'Guna memahami Konten YouTube yang menjadi pembahasan dimasyarakat umum dengan cara mengikuti pelatihan yang di laksanakan bersama sama Media Independen Online Indonesia (MIO) Dan Universitas Multimedia Nusantara (UMN), di Gedung C UMN Lantai 7 No 707, Rabu (25/5/22).', 'https://bantenjurnalisnews.com/wp-content/uploads/2022/05/R421260522.jpg'),
            new BlogItem('Hari Pajak Nasional, JMSI Banten Bareng UMN Gelar Pelatihan Pengisian SPT Pajak Tahunan Badan', 'Bertepatan dengan Hari Pajak Nasional yang diselenggarakan setiap 14 Juli, Jaringan Media Siber Indonesia (JMSI) Pengda Banten bersama Universitas Multimedia Nusantara (UMN) dan Direktorat Jenderal Pajak (DJP) Kanwil Banten menggelar pelatihan pengisian Surat Pemberitahuan Tahunan (SPT) Badan.', 'https://suaratimurnews.com/wp-content/uploads/2022/07/IMG-20220714-WA0167-1536x1152.jpg'),
        ];

        $pengumuman = [
            new BlogItem('PKM CSR', "Konferensi Nasional Pengabdian kepada masyarakat dan Corporate Social Responsibility 2022 bertema Peran Perguruan Tinggi dan Dunia Usaha dalam Akselerasi Pemulihan Dampak Pandemi yang akan dilaksanakan pada 20-22 Oktober 2022 secara Offline dan Online. Konferensi Nasional Pengabdian Masyarakat dan Corporate Social Responsibility (PkM CSR) merupakan konferensi yang diprakasai oleh empat Perguruan Tinggi Swasta dan satu Perguruan Tinggi Negeri terkemuka yaitu Universitas Multimedia Nusantara (UMN), Universitas Pelita Harapan (UPH), Swiss German University (SGU), Universitas Pradita, Universitas Sebelas Maret (UNS), Universitas Wijaya Putra (UWP). Pada tahun 2022, kami bekerja sama dengan Universitas Katolik Santo Thomas dan Stikes Mitra Husada, Medan sebagai co-host.", "{$baseurl}/blog/PosterPKMCSR2022.jpeg"),
            new BlogItem('Perpanjangan Pemutakhiran Data SINTA', "Berdasarkan surat plt. Direktur Riset, Teknologi, dan Pengabdian Kepada Masyarakat Nomor
            0620/E5.5/AL.04/2022 tanggal 17 Juli 2022 perihal Pemberitahuan untuk Pemutakhiran Data pada
            SINTA, dengan beberapa pertimbangan dan kondisi terkait proses pemutakhiran data saat ini, maka kami
            informasikan hal-hal sebagai berikut", "{$baseurl}/blog/SuratPerpanjanganPemutakhiranDataSINTA.jpeg"),
        ];

        return $this->render('index', [
            'carousel' => $carousel,
            'kegiatan' => $kegiatan,
            'pengumuman' => $pengumuman
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionKontak()
    {
        // kontak terdiri dari 
        // kategori, nama, no wa, dan email
        // nomor wa otomatis menjadi link wa
        $kontak = [
            new KontakItem('Kepala Biro Pengabdian Kepada Masyarakat', 'Andy Firmansyah, S.Ikom. M.M.', 'andy.firmansyah@umn.ac.id'),
            new KontakItem('Community Outreach Officer', 'Esmeralda Ida Romauli S.T.', 'esmeralda.ida@umn.ac.id'),
            new KontakItem('Community Outreach Administrative Assistant', 'Wuri Hardini Veronica S.A.P.', 'wuri.veronica@umn.ac.id'),
        ];

        return $this->render('kontak', [
            'kontak' => $kontak,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionProfil()
    {
        $baseurl = Url::base();
        $visi = "MENJADI LEMBAGA YANG UNGGUL, INOVATIF,DAN PROAKTIF MELALUI PENERAPAN ILMU SOSIAL, TEKNOLOGI DAN SENI DALAM MEWUJUDKAN KESEJAHTERAAN DAN KAPASITAS MASYARAKAT SECARA BERKELANJUTAN DI ERA TRANSFORMASI DAN DISRUPSI";
        $misi = [
            "PENINGKATAN KUALITAS PELAKSANAAN TRIDHARMAPERGURUAN TINGGI KHUSUSNYA PENGABDIANMASYAKARAT MELALUI PENYEDIAAN INFORMASI DESABINAAN BAGI DOSEN DAN MAHASISWA", 
            "PENINGKATAN KESEJAHTERAAN DAN KUALITAS SDMMASYARAKAT (DESA, SEKOLAH, DAN KELOMPOKMASYARAKAT BINAAN UMN)", 
            "PENERAPAN SMART VILLAGE BAGI SELURUH DESABINAAN UMN",
        ];
        $img = "https://cdn5.vectorstock.com/i/1000x1000/38/64/business-hierarchy-structure-vector-3403864.jpg";
        $table = [
            new ProfilTable("{$baseurl}/potrait/winarno.jpeg", 'Dr. Ir. PM Winarno M.kom', 'Direktur LPPM'),
            new ProfilTable("{$baseurl}/potrait/NiMadeSatvika.jpeg", 'Dr. Ni Made Satvika Iswari, S.T. M.T.', 'Kepala Biro Penelitian'),
            new ProfilTable("{$baseurl}/potrait/AriefIswariyadi.jpeg", 'Arief Iswariyadi, M.Sc. Ph.D.', 'Kepala Biro Inovasi'),
            new ProfilTable("{$baseurl}/potrait/AndyFirmansyah.jpeg", 'Andy Firmansyah, S.Ikom. M.M.', 'Kepala Biro Pengabdian Kepada Masyarakat'),
            new ProfilTable("{$baseurl}/potrait/Marcella.jpeg", 'Marcella Margaretta, S.Si', 'Administrative Assistant'),
            new ProfilTable("{$baseurl}/potrait/Esmeralda.jpeg", 'Esmeralda Ida Romauli S.T.', 'Community Outreach Officer'),
            new ProfilTable("{$baseurl}/potrait/Wuri.jpeg", 'Wuri Hardini Veronica S.A.P.', 'Community Outreach Administrative Assistant'),
        ];
        $tugasfungsi = [
            "tugas 1",
            "tugas 2",
        ];

        return $this->render('profil', [
            'visi' => $visi,
            'misi' => $misi,
            'img' => $img,
            'table' => $table,
            'tugasfungsi' => $tugasfungsi,
        ]);
    }

    public function actionPublikasi()
    {
        return $this->render('publikasi');
    }

    public function actionDownload()
    {
        $baseurl = Url::base();

        // berkas download memiliki 2 parameter
        // title dan url
        // gunakan url untuk mengarahkan ke file yang ingin didownload
        $berkas = [
            new DownloadItem('Panduan Pengabdian Masyarakat UMN', "{$baseurl}/download/PanduanPengabdianMasyarakatUMN.pdf"),
            new DownloadItem('Rencana Strategis PKM UMN 2021 - 2026', "{$baseurl}/download/RencanaStrategisPKMUMN2021-2026.pdf"),
            new DownloadItem('RIP PKM', "{$baseurl}/download/RIPPKM.pdf"),
        ];

        return $this->render('download', [
            'berkas' => $berkas
        ]);
    }
}
