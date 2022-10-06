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
use app\components\PkmItem;

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

        // list tahun pkm
        $tahun = [2018, 2019, 2020, 2021, 2022];
        

        return $this->render('index', [
            'carousel' => $carousel,
            'kegiatan' => $kegiatan,
            'pengumuman' => $pengumuman,
            'tahun' => $tahun
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

    public function actionListpkm()
    {
        $year = Yii::$app->getRequest()->getQueryParam('year');

        // data list pkm perlu di isi manual per tahun
        // jika ada tahun baru buat lah variable baru
        // isi list pkm berupa no, pelaksana, judul
        $list2018 = [
            new PkmItem(1, "Seng Hansun, S.Si., M.Cs. / Muhammad Salehuddin, S.T., M.T. / Marcel Bonar Kristanda, S.Kom., M.Sc.", "Rancang Bangun dan Penerapan Aplikasi E-RT di Kelurahan Periuk Kota Tangerang"),
            new PkmItem(2, "Makbul Mubarak, S.IP., M.A. / Kus Sudarsono, S.E., M.Sn. / Annita, s.Pd., M.F.A./ Ina L. Riyanto, S.Pd., M.A./ Perdana Kartawiyudha, M.Sn.,", "Film Indonesia (TKFI) 2018 di Sukabumi"),
            new PkmItem(3, "Camelia, Adi Wibowo", "Pelatihan Literasi Komputer dan Blogging untuk Guru-Guru Sekolah di SD Negeri Cihuni 2"),
            new PkmItem(4, "Ririn Ikana Desanti, S.Kom., M.Kom/Friska Natalia, Ph.D./Wira Munggana, S.Si., M.Sc./Ir. Raymond Sunardi Oetama, M.C.I.S. Marcelli Indriana, S.Kom., M.Sc.", "Pengembangan dan Pelatihan Website Gereja Katolik Paroki St. Agustinus Karawaci"),
            new PkmItem(5, "Johan Setiawan, S.Kom., M.M., M.B.A./Enrico Siswanto, S.Kom., MBA./Yustinus Eko Seoelistio, S. Kom., M.M./Wella, S.Kom., M.MSI., COBIT5", "Pengembangan dan Pelatihan Website Sekolah St. Fidelis Gading Serpong"),
            new PkmItem(6, "Ardiles Akyuwen, S.Sn., M. Sn.", "Pemberian Materi pada Logawa Photo Workshop yang Ketiga"),
            new PkmItem(7, "Helga Liliani Cakra Dewi, S.I.Kom., M.Comm./Maria Advenita Gita Elmada, S.I.Kom., M.Si.", "Kegiatan Pengabdian Masyarakat Bidang Pendidikan dan Sosial Desa Sampora, Kecamatan Cisauk"),
            new PkmItem(8, "Cendera Rizky Anugerah Bangun, Intan Primadini", "Kegiatan Pengabdian Masyarakat Bidang Pendidikan dan Sosial Desa Cibogo, Kecamatan Cisauk"),
        ];

        $list2019 = [
            new PkmItem(1, "Oqke Prawira, S.ST, M.Si. Par / Kevin Juliawan, S.E, B.A, M.Par/ Tiki Danawiranti, M.Sc./ Adela Riana, M.Hum.", "Pendampingan dalam Pengelolaan Manajemen Dapur Restoran Saung Cisadane, Desa Keranggan, Kota Tangerang Selatan"),
            new PkmItem(2, "Septi Fahmi Choirisa, M.Par./ Adestya Ayu, S.ST, M.Si. Par/ Yoanita Alexandra, S.E, B.A, M.Par/ Edi Purnomo, M. Hum.", "Pelatihan Dasar Pramusaji Restoran di Desa Keranggan, Kota Tangerang Selatan"),
            new PkmItem(3, "Adestya Ayu, S.ST, M.Si. Par / Oqke Prawira, S.ST, M.Si Par/ Kevin Juliawan Surya, S.E, B.A, M.Par/ Yoanita Alexandra, S.E, B.A, M.Par/Septi Fahmi Choirisa, M.Par/ Tiki Danawiranti, M.Sc.", "Pelatihan Pembuatan Kue Durian Khas Desa Padabeunghar, Kuningan Jawa Barat"),
            new PkmItem(4, "Dyah Ayu Anggreini Tuasikal, S.T., M.T/ Ahmad Syahril Muharom, S.Pd., M.T/ Dwi Dharma Arta Kusuma, S.T., M. Eng/ Dr. Indiwan Seto Wahjuwibowo, M.Si", "Pengolahan Sampah Organik dan Anorganik pada Desa Lengkong Kulon"),
            new PkmItem(5, "Ardiles Akyuwen, S.Sn., M.Sn./ Clemens Felix Setiyawan, S.Sn., M.Hum./ Rezki Gautama Tanrere, S.Ds., M.Ds./ Fransisca Retno Setyowati Rahardjo, S.Ds., M.Ds./ Tomy Faisal Alim, S.Sn., M.Sn.", "Pelatihan Tradisional Art and Craft Batik Desa Padabeunghar Kecamatan Pesawahan Kabupaten Kuningan Jawa Barat"),
            new PkmItem(6, "Clemens Felix Setiyawan, S.Sn., M.Hum./ Ardiles Akyuwen, S.Sn., M.Sn./ Rezki Gautama Tanrere, S.Ds., M.Ds./ Fransisca Retno Setyowati Rahardjo, S.Ds., M.Ds./ Tomy Faisal Alim, S.Sn., M.Sn.", "Pembuatan Website Desa Padabeunghar Kecamatan Pesawahan Kabupaten Kuningan Jawa Barat"),
            new PkmItem(7, "Rezki Gautama Tanrere, S.Ds., M.Ds./ Clemens Felix Setiyawan, S.Sn., M.Hum./ Ardiles Akyuwen, S.Sn., M.Sn./ Fransisca Retno Setyowati Rahardjo, S.Ds., M.Ds./ Tomy Faisal Alim, S.Sn., M.Sn.", "Pembuatan Video Profile Desa Padabeunghar Kecamatan Pesawahan Kabupaten Kuningan Jawa Barat"),
            new PkmItem(8, "Johan Setiawan, S.Kom., M.M. / Tan Thing Heng, B.Sc., M.Stat./ Agus Sulaiman, S.Kom., M.M./ Enrico Siswanto, S.Kom., M.B.A./ Wendy, S.Kom., M.MSI.", "Pelatihan Pembuatan Konten Pembelajaran pada Sekolah SMA SantoThomas Aquino”"),
            new PkmItem(9, "Wella, S.Kom., M.MSI., COBIT5. /  Mellisa Indah Fianty, S.Kom., M.MSI./ Iwan Prasetiawan, S.Kom., M.M./   Fransiscus Ati Halim, S.Kom., M.M. / Marcelli Indriana, S.Kom., M.Sc.\n", "“Pembuatan Website Kepengurusan Majelis Buddhayana Indonesia Provinsi Banten”"),
            new PkmItem(10, "Aminuddin Rizal, S.T., M.Sc./ Fenina Adline Twince Tobing, S.Kom., M.Kom./ Dwi Dharma Arta Kusuma, S.T., M.Eng./ Dareen", "\"Pengukuran Body Mass Index (BMI) untuk Anak – anak di Lembaga Pembinaan Khusus Anak (LPKA) Kelas I Tangerang\""),
            new PkmItem(11, "Ir. Raymond Sunardi Oetama, MCIS / Yustinus Eko Soelistio, S.Kom., M.M./ Yanti, S.Kom., M.MSI / David Tjahjana, S.Kom., M/MSI ", "“Pembangunan Website Vihara Dharma Ratna”"),
            new PkmItem(12, "Dr. Florentina Kurniasari, S.Sos., M.B.A. /Farica Perdana Putri, M.Sc\n", "“Penerapan Aplikasi Okupansi Kamar Rawat Inap pada Puskesmas Keranggan Tangerang Selatan”"),
            new PkmItem(13, "Hendrico Firzandy, S.T., M.Ars. / Irma Desiyana, S.Ars., M.Arch. / Yosephine Sitanggang, S.Ars., M.Ars", "“Perencanaan dan Perancangan Sentra Kuliner di Desa Lengkong Kulon”"),
            new PkmItem(14, "Elissa Dwi Lestari, S.Sos., M.S.M./ Purnamaningsih, S.E., M.S.M./ Nosica Rizkalla, S.E., M.Sc./ Dyah Ayu Anggreini, S.T., M.T./ Cynthia Sari Dewi, S.E., M.Sc.", "“Penyediaan, Pembuatan Media Belajar Anak sebagai Program Peningkatan Kualitas Pembelajaran di Perkampungan Pemulung di Bintaro Permai III”"),
            new PkmItem(15, "Adhi Kusnadi, S.T., M.Si. / Nunik Afriliana, S.Kom., M.M.S.I.", "“Menuju Siswa-Siswi Madrasah Aliyah Raudatul Irfan Tersertifikasi Keahlian Ms. Office oleh UMN”"),
            new PkmItem(16, "Marlinda Vasty Overbeek, S.Kom., M.Kom. / Nabila Husna Shabrina, S.T., M.T./ Nurina Putri Handayani, S.E., M.M./ Melissa Indah Fianty, S.Kom., M.M.S.I.", "“Program Peningkatan Keterampilan Teknologi Informasi di SLB B-C Nurasih Jakarta Selatan”\n\n"),
            new PkmItem(17, "Dr. Indiwan Seto Wahjuwibowo, M.Si./ Dr. Ir. Winarno, M.Kom./ Dyah Ayu Anggreini Tuasikal, S.T., M.T/ Drs. Yohanes Langgar Billy, M.M.", "“Pendampingan Desa Binaan UMN : Pelatihan dan Marketing Komunikasi Pembuatan Pupuk Cair di Desa Lengkong Kulon Kabupaten Tangerang”"),
        ];

        $list2020 = [
            new PkmItem(1, "Dr. Florentina Kurniasari T., S.Sos., M.B.A / Ika Yanuarti, S.E., M.S.F., CSA / Farica Perdana Putri, S.Kom., M.Sc / Purnamaningsih, S.E., M.S.M / Elissa Dwi Lestari, S.Sos., M.S.M ", "Pengembangan Aplikasi Sistem Puskesmas Terpadu (SIPURA) Keranggan, Tangerang Selatan")
        ];

        $list2021 = [
            new PkmItem(1, "Yoanita Alexandra, S.E, B.A, M.Par, Dr. Ringkar Situmorang", "Webinar Protokol Kesehatan Industri Perhotelan Selama Masa Pandemi Covid-19 Bagi Siswa SMKN 7 Tangerang"),
            new PkmItem(2, "Adhi Kusnadi, S.T, M.Si., Yaman Khaeruzzaman, M.Sc., Marlinda Vasty Overbeek, S.Kom., M.Kom, Moeljono Widjaja, B.Sc., M.Sc., Ph.D., Dennis Gunawan, S.Kom, M.Sc", "Rancang Bangun, Sosialisasi dan Pelatihan Aplikasi Mobile Layanan Administrasi Surat-Surat Keterangan Untuk Warga Desa/Kelurahan"),
            new PkmItem(3, "Oqke Prawira., S.ST, M.Si.Par, Adestya Ayu Armelia., S.St, M.Si.Par", "Bimbingan dan Konseling Karir di Industri Hospitaliti Bagi Siswa SMKN 7, Tangerang"),
            new PkmItem(4, "Septi Fahmi Choirisa, M.Par, Anton Harianto, M.M ", "Pelatihan Pengembangan diri Bagi Siswa Perhotelan di Tangerang, Indonesia"),
            new PkmItem(5, "Dr. techn. Rahmi Andarini, S.T., M.Eng.Sc, Fahmi Rinanda Saputri, S.T., M.Eng", "Pelatihan Peningkatan Kesadaran Efisiensi Energi dan Konservasi Energi Pada Sektor Industri Rumah Tangga"),
            new PkmItem(6, "Fenina Adline Twince Tobing, S.Kom., M.Kom., Marlinda Vasty Overbeek, S.Kom., M.Kom., Eunike Endariahna Surbakti, S.Kom., M.T.I., Fahmy Rinanda Saputri, S.T., M.Eng.", "Aplikasi Laporan Pengelolaan Keuangan DWP LPKA Kelas II Jakarta "),
            new PkmItem(7, "Iqbal Maimun Umar., S.Sn., M.Ds., Joni Nur Budi, S.Sn., M.Ds", "Pelatihan Ketrampilan Membuat Pot Untuk Anak"),
            new PkmItem(8, "Adestya Ayu Armielia, S.ST. M.Si.Par., Oqke Prawira., S.ST, M.Si.Par", "Pelatihan Pembuatan Konten Tur Virtual"),
            new PkmItem(9, "Samiaji Bintang Nusantara S.T., M.A, Veronika S.Sos., M.Si., Taufan Wijaya S.Sos., M.A., Nasrullah S.Sos., M.I.kom., Aditya Heru Wardhana S.T.P., M.A.", "Pelatihan Social Media Storytelling Untuk Warga dan Komunitas Adat "),
            new PkmItem(10, "Simon Petrus Wenehenubun, S.S., M.M, Dr. Indiwan Seto Wahju Wibowo, M.Si, Drs. Yohanes Langgar Billy, M.M.", "Pelatihan Seni Memimpin Organisasi Bagi Pengurus Osis SMA/SMK Mitra UMN di Kabupaten Tangerang, Banten"),
            new PkmItem(11, "Irwan Fakhruddin, S.Sn., M.I.Kom., Agus Kustiwa, S.Sos., M.Si., Albertus Magnus Prestianta, S.I.Kom., M.A., Nosica Rizkalla, S.E., M.Sc.", "Peningkatan Kapasitas Kesiapsiagaan Menghadapi Bencana Tsunami Selatan Jawa Bagi Masyarakat Desa Panggarangan, Kecamatan Panggarangan, Kabupaten Lebak"),
            new PkmItem(12, "Dr. Florentina Kurniasari, S.Sos., M.B.M.Dr Prio Utomo, ST., MPC, Purnamaningsih, S.E., M.S.M,Farica Perdana Putri, S.Kom., M.Sc ,Agatha Masie Tjandra, S.Sn., M.Sn", "Peningkatan Kesehatan Masyarakat Melalui Aplikasi Berbasis Android Pada Dinas Kesehatan Kota Tangerang Selatan"),
            new PkmItem(13, "Rossalyn Ayu Asmarantika, S.Hum., M.A.,Irwan Fakhruddin, S.Sn., M.I.Kom., Mujiono, S.I.Kom., M.I.Kom., Sita Winiawati Dewi, S.Ikom, MPAS. ", "Pelatihan Konten Digital & Digital Marketing Dalam Rangka Re Aktivasi Kegiatan Bumdes Serdang Wetan Pasca Pandemi Covid-19"),
            new PkmItem(14, "Fenina Adline Twince Tobing, S.Kom., M.Kom., Dr. Indiwan Seto Wahjuwibowo, M.Si.,Marlinda Vasty Overbeek, S.Kom., M.Kom.,Eunike Endariahna Surbakti, S.Kom., M.T.I", "Kegiatan Pengabdian Kepada Masyarakat Dharma Wanita Persatuan (DWP) LPKA Jakarta Pelatihan Dasar Membatik dan Tie Dye"),
            new PkmItem(15, "Maria Advenita Gita Elmada, M.Si., Angga Ariestya, M.Si, Irwan Fakhruddin, M.I.Kom.", "Upaya Penyadartahuan Masyarakat Khususnya Generasi Z Terkait Isu Pengelolaan Sisa Makanan "),
            new PkmItem(16, "Yoanita Alexandra, S.E, B.A, M.Par", "Perancangan Menu Bagi UMKM Kuliner  "),
            new PkmItem(17, "Melissa Indah Fianty, S.Kom., MMSI,Nabila Husna Shabrina, S.T., M.T., Fahmy Rinanda Saputri, S.T., M.Eng", "Peningkatan Kompetensi Dalam Menyajikan Presentasi Menarik Dan Interaktif Pembelajaran Daring Bagi Guru Madrasah Aliyah Raudhlatul Irfan Desa Lengkong Kulon Dengan Pelatihan Dan Evaluasi Microsoft Power Point"),
            new PkmItem(18, "Megantara Pura, S.T., M.T., Ahmad Syahril Muharrom, S.Pd., M.T., Muhammad Bima Nugraha, S.T., M.T. ,Dr. Rangga Winantyo, Ph.D., M.Sc, BCS ,Marojahan Tampubolon, S.T., M.Sc., Ph.D.", "Alat Pengukur Kesehatan Untuk Ruang Isolasi Orang Tanpa Gejala (OTG) Kecamatan Cisauk"),
            new PkmItem(19, "Joni Nur Budi Kawulur, S.Sn., M.Ds. , Iqbal Maimun Umar, S.Sn., M.Ds.", "Workshop Ketrampilan Membuat Wastafel"),
            new PkmItem(20, "Ir. Arief Iswariyadi, M.Sc., Ph.D., Dr. Mohammad Annas, S.Tr.Par, MM, CSCP, Oqke Prawira, SST.Par, M.Si.Par, Adestya Ayu Armielia, S.ST.M.Si.Par, Erwin Alfian, S.Sn., M.Ds.", "Sosialisasi Dan Pendampingan Implementasi Good Business Practices Bagi Pelaku UMKM Kuliner di Kecamatan Tenjo, Kabupaten Bogor"),
            new PkmItem(21, "Rahmi Elsa Diana, S.T., M.T., Freta Oktarina, S.Sn., M.Ars.", "Workshop dan Pengenalan Profesi Arsitek untuk Jenjang Sekolah Dasar SDIT Al-Fityan School Tangerang"),
            new PkmItem(22, "Oqke Prawira., S.ST, M.Si. Par", "Pelatihan Food Safety bagi Pelaku Kuliner di Tangerang"),
            new PkmItem(23, "Oqke Prawira. T., S.ST, M.Si. Par", "Pelatihan Program CHSE bagi Pelaku UMKM di Tangerang"),
        ];

        $list2022 = [
            new PkmItem(1, "Ir. Arief Iswariyadi, M.Sc., Ph.D. / Dr. Mohammad Annas, S.Tr.Par., M.M /Oqke Prawira, SST.Par, M.Si.Par/ Adestya Ayu Armiela, SST.Par, M.Si.Par /Erwin Alfian, S.Sn., M.Ds.", "Sosialisasi Dan Pendampingan Implementasi Good Business Practices Bagi Pelaku UMKM Dodol Di Kecamatan Tenjo, Kabupaten Bogor"),
            new PkmItem(2, "Darfi Rizkavirwan, S.Sn, M.Ds./Aditya Satyagraha, S.Sn., M.Ds./Adhreza Brahma, M.Ds./Maria Advenita Gita Elmada, S.I.Kom., M.Si./Yohanes Merci Widiastomo S.Sn., M.M.", "Kampanye Tanggap Mitigasi Bencana Tsunami Selatan Jawa Bagi Masyarakat Desa Panggarangan, Kecamatan Panggarangan, Kabupaten Lebak"),
            new PkmItem(3, "Megantara Pura, S.T., M.T. /Ahmad Syahril Muharrom, S.Pd., M.T. / Muhammad Bima Nugraha, S.T., M.T./ Dr. Rangga Winantyo, Ph.D., M.Sc, BCS / Marojahan Tampubolon, S.T., M.Sc., Ph.D.", "Alat Pengukur Kesehatan Untuk Deteksi Awal Gejala Covid-19"),
            new PkmItem(4, "Septi Fahmi Choirisa, M.Par/Ringkar Situmorang, PhD/Yoanita Alexandra, S.E., M.Par.", "Soft-Skills Development Workshop For Hotel Vocational School"),
            new PkmItem(5, "Ririn Ikana Desanti, S.Kom., M.Kom. /Wella, S.Kom., MMSI./ Suryasari, S.Kom., M.T./Jansen Wiratama, S.Kom., M.Kom./Samuel Ady Sanjaya, S.T., M.T.", "Perancangan dan Penerapan Sistem E-Commerce untuk Divisi Pengembangan Usaha Sosial dan Modal (PUSM) Gereja Santo Agustinus Karawaci"),
            new PkmItem(6, "Putu Yani Pratiwi, S.T., M.M. / Nosica Rizkalla, S.E., M.Sc / Elissa Dwi Lestari, S.Sos., M.S.M./Purnamaningsih, S.E., M.S.M.", "Pemberian Kredit Modal Usaha Untuk Penyediaan Produk Kebutuhan Rumah Tangga Ramah Lingkungan"),
            new PkmItem(7, "Dr. Ringkar Situmorang., MBA/Yoanita Alexandra M.Par/Septi Fahmi Choirisa., M.Par", "Pelatihan Kreasi Minuman Kopi Bagi Masyarakat Desa Lengkong Kulon"),
            new PkmItem(8, "Irwan Fakhruddin, S.Sn., M.I.Kom./Agus Kustiwa, S.Sos., M.Si./Albertus Magnus Prestianta, S.I.Kom., M.A./Nosica Rizkalla, S.E., M.Sc. /Elissa Dwi Lestari, S.Sos., M.S.M.", "Peningkatan Kapasitas Kesiapsiagaan Menghadapi Bencana Tsunami Selatan Jawa Bagi Masyarakat Desa Panggarangan, Kecamatan Panggarangan, Kabupaten Lebak"),
            new PkmItem(9, "Dian Fitria, M.Sc./Rizky Tridamayanti Siregar, S.PD., M.Sc./Yuninda Mukty Ardyanny, S.T., M. Ars.", "Desain Bangunan Inklusif dan Hijau pada Bangunan Fungsi Edukasi di Sekolah Mata Alam"),
            new PkmItem(10, "Iqbal Maimun Umar, S.Sn., M.Ds./ Joni Nur Budi Kawulur, S.Sn., M.Ds.", "Pelatihan Ketrampilan Rajut, Keramik Dan Vidiografi Di Kampung Jatirangon"),
            new PkmItem(11, "Petrus Damiami Sitepu, S.Sn., M.I.Kom. / Wida Kurnianda Djamil BFA, MA./Ari Dina Krestiawan, S.Sos., M.Sn./Ignatius Krismawan, S.P./Sita Winiawati Dewi, S.I.Kom., MPAS", "Educational Video Gratifikasi Oleh Komisi Pemberantasan Korupsi Kepada Masyarakat"),
            new PkmItem(12, "Fenina Adline Twince Tobing, S.Kom., M.Kom/Eunike Endariahna Surbakti, S.Kom., M.T.I./ Marlinda Vasty Overbeek, S.Kom., M.Kom.", "Aplikasi Laporan Pengelolaan Keuangan DWP LPKA Kelas II Jakarta (Lanjutan)"),
            new PkmItem(13, "Melissa Indah Fianty, S.Kom., MMSI / Nabila Husna Shabrina, S.T., M.T\t/ Fahmy Rinanda Saputri, S.T., M.Eng", "\nPelatihan Project-Based Learning dengan Google Classroom bagi Guru Madrasah Aliyah Raudhlatul Irfan Desa Lengkong Kulon"),
            new PkmItem(14, "Tomy Faisal Alim S.Sn., M.Sn./ Dr. Indiwan Seto WahjuwibowoM.Si./Rezky Gautama Tanrere S.Ds., M.Ds/Drs. Daru Paramayuga M.Ds.", "Pembuatan Lukisan Mural Dan Signage Di Saung Cisadane Desa Ecowisata Kranggan"),
            new PkmItem(15, "Oqke Prawira., S.ST, M.Si.Par/ Adestya Ayu A., S.ST. M.Si.Par.", "Pelatihan Program HACCP Bagi Pengusaha UMKM di Wilayah Tangerang"),
            new PkmItem(16, "Dr Indiwan Seto Wahjuwibowo /Clemens Felix/Ardiles", "Pelatihan video marketing untuk produk batik kemuning"),
            new PkmItem(17, "Yoanita Alexandra M.Par/Dr. Ringkar Situmorang / Savira Rizki Pradiati", "Pelatihan Coffee Manual Brew bagi Masyarakat Desa Serdang Wetan, Tangerang"),
            new PkmItem(18, "Marojahan Tampubolon, S.T., M.Sc., Ph.D. / Ahmad Syahril Muharrom, S.Pd.,M.T./ M.B. Nugraha, S.T., M.T./ Dr. Rangga Winantyo, Ph.D., MSc, BCS/ Megantara Pura, S.T, M.T", "Penerapan Penggunaan Lampu Penerangan Umum dengan Tenaga Surya di Pedesaan"),
            new PkmItem(19, "Zul Tinarbuko, S.Sn.,M.F.A. / Raden Adhitya Indrayuana, S.Pd,. M.Sn", "Lokakarya Produksi Dokumenter Animasi untuk Para Penyintas Migran (Pengungsi & Pencari Suaka)"),
            new PkmItem(20, "Riatun, S.Sos., M. Si./ Helga Liliani Cakra Dewi /Nicky Stephani / Silvanus Alvin /Mujiono ", "Menuju Smart School: Penerapan Learning Management System (LMS) di Sekolah Dasar Desa Rancagong"),
            new PkmItem(21, "Veronika, S.Sos., M.Si. / Maria Advenita Gita Elmada, S.I.Kom., M.Si./Helga Liliani Cakra Dewi, S.I.Kom., M.Comm./Taufan Wijaya, S.Sos., M.A. / Ignatius Haryanto", "Peningkatan Komunikasi Digital Komsos Keuskupan Bogor"),
            new PkmItem(22, "Ardiles Akyuwen, S.Sn., M.Ds./ Clemens Felix Setiyawan, S.Sn., M.Hum./ Rezki Gautama Tanrere, S.Ds., M.Ds./ Mohammad Rizaldi, ST, M.Ds./ Dedy Arpan, S.Ds., M.Ds.", "Perancangan Website pada Kelurahan Keranggan dan Desa Lengkong Kulon sebagai Sarana Informasi"),
        ];

        $list = [];

        // buat lah if statement baru jika ada variable tahun baru
        if($year == 2018) {
            $list = $list2018;
        } else if($year == 2019) {
            $list = $list2019;
        } else if($year == 2020) {
            $list = $list2020;
        } else if($year == 2021) {
            $list = $list2021;
        } else if($year == 2022) {
            $list = $list2022;
        }

        return $this->render('listpkm', [
            'list' => $list
        ]);
    }
}
