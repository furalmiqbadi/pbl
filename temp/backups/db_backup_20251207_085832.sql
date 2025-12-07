--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: admin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.admin (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.admin OWNER TO postgres;

--
-- Name: admin_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.admin_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.admin_id_seq OWNER TO postgres;

--
-- Name: admin_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.admin_id_seq OWNED BY public.admin.id;


--
-- Name: berita_artikel; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.berita_artikel (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    isi_berita text NOT NULL,
    gambar_berita character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT now(),
    updated_at timestamp without time zone DEFAULT now(),
    kategori_id integer
);


ALTER TABLE public.berita_artikel OWNER TO postgres;

--
-- Name: berita_artikel_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.berita_artikel_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.berita_artikel_id_seq OWNER TO postgres;

--
-- Name: berita_artikel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.berita_artikel_id_seq OWNED BY public.berita_artikel.id;


--
-- Name: daftar_proyek; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.daftar_proyek (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    isi_proyek text NOT NULL,
    gambar_proyek character varying(255) NOT NULL,
    kategori_id integer,
    tahun character varying(20),
    nama_tim character varying(100)
);


ALTER TABLE public.daftar_proyek OWNER TO postgres;

--
-- Name: daftar_proyek_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.daftar_proyek_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.daftar_proyek_id_seq OWNER TO postgres;

--
-- Name: daftar_proyek_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.daftar_proyek_id_seq OWNED BY public.daftar_proyek.id;


--
-- Name: deskripsi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.deskripsi (
    id integer NOT NULL,
    isi_deskripsi text NOT NULL
);


ALTER TABLE public.deskripsi OWNER TO postgres;

--
-- Name: deskripsi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.deskripsi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.deskripsi_id_seq OWNER TO postgres;

--
-- Name: deskripsi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.deskripsi_id_seq OWNED BY public.deskripsi.id;


--
-- Name: dosen_multimedia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dosen_multimedia (
    id integer NOT NULL,
    nama character varying(255) NOT NULL,
    jabatan character varying(255) NOT NULL,
    gambar_tim character varying(255) NOT NULL,
    link_linkedin text,
    link_instagram text,
    link_github text,
    nidn character varying(20)
);


ALTER TABLE public.dosen_multimedia OWNER TO postgres;

--
-- Name: galeri; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.galeri (
    id integer NOT NULL,
    deskripsi text NOT NULL,
    gambar_galeri character varying(255) NOT NULL
);


ALTER TABLE public.galeri OWNER TO postgres;

--
-- Name: galeri_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.galeri_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.galeri_id_seq OWNER TO postgres;

--
-- Name: galeri_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.galeri_id_seq OWNED BY public.galeri.id;


--
-- Name: kategori; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kategori (
    id integer NOT NULL,
    nama_kategori character varying(100) NOT NULL,
    jenis character varying(20) DEFAULT 'proyek'::character varying
);


ALTER TABLE public.kategori OWNER TO postgres;

--
-- Name: kategori_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kategori_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kategori_id_seq OWNER TO postgres;

--
-- Name: kategori_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.kategori_id_seq OWNED BY public.kategori.id;


--
-- Name: mahasiswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mahasiswa (
    id integer NOT NULL,
    nim character varying(20) NOT NULL,
    nama character varying(66) NOT NULL,
    prodi_id integer NOT NULL
);


ALTER TABLE public.mahasiswa OWNER TO postgres;

--
-- Name: mahasiswa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mahasiswa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.mahasiswa_id_seq OWNER TO postgres;

--
-- Name: mahasiswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mahasiswa_id_seq OWNED BY public.mahasiswa.id;


--
-- Name: mahasiswa_proyek; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mahasiswa_proyek (
    id integer NOT NULL,
    mahasiswa_id integer NOT NULL,
    proyek_id integer NOT NULL
);


ALTER TABLE public.mahasiswa_proyek OWNER TO postgres;

--
-- Name: mahasiswa_proyek_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mahasiswa_proyek_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.mahasiswa_proyek_id_seq OWNER TO postgres;

--
-- Name: mahasiswa_proyek_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mahasiswa_proyek_id_seq OWNED BY public.mahasiswa_proyek.id;


--
-- Name: misi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.misi (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    isi_misi text NOT NULL
);


ALTER TABLE public.misi OWNER TO postgres;

--
-- Name: misi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.misi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.misi_id_seq OWNER TO postgres;

--
-- Name: misi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.misi_id_seq OWNED BY public.misi.id;


--
-- Name: nilai; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nilai (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    gambar_nilai character varying(255) NOT NULL,
    deskripsi text
);


ALTER TABLE public.nilai OWNER TO postgres;

--
-- Name: nilai_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.nilai_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.nilai_id_seq OWNER TO postgres;

--
-- Name: nilai_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.nilai_id_seq OWNED BY public.nilai.id;


--
-- Name: partner; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.partner (
    id integer NOT NULL,
    nama_brand character varying(255) NOT NULL,
    gambar_brand character varying(255) NOT NULL
);


ALTER TABLE public.partner OWNER TO postgres;

--
-- Name: partner_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.partner_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.partner_id_seq OWNER TO postgres;

--
-- Name: partner_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.partner_id_seq OWNED BY public.partner.id;


--
-- Name: pengunjung; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengunjung (
    id integer NOT NULL,
    ip_address character varying(50) NOT NULL,
    tanggal date DEFAULT CURRENT_DATE NOT NULL,
    waktu timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.pengunjung OWNER TO postgres;

--
-- Name: pengunjung_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengunjung_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pengunjung_id_seq OWNER TO postgres;

--
-- Name: pengunjung_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengunjung_id_seq OWNED BY public.pengunjung.id;


--
-- Name: prodi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prodi (
    id integer NOT NULL,
    nama_prodi character varying(100) NOT NULL
);


ALTER TABLE public.prodi OWNER TO postgres;

--
-- Name: prodi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prodi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.prodi_id_seq OWNER TO postgres;

--
-- Name: prodi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prodi_id_seq OWNED BY public.prodi.id;


--
-- Name: sejarah; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sejarah (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    isi text NOT NULL,
    tahun character varying(10)
);


ALTER TABLE public.sejarah OWNER TO postgres;

--
-- Name: sejarah_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sejarah_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sejarah_id_seq OWNER TO postgres;

--
-- Name: sejarah_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sejarah_id_seq OWNED BY public.sejarah.id;


--
-- Name: struktur_organisasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.struktur_organisasi (
    id integer NOT NULL,
    gambar_organisasi character varying(255) NOT NULL
);


ALTER TABLE public.struktur_organisasi OWNER TO postgres;

--
-- Name: struktur_organisasi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.struktur_organisasi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.struktur_organisasi_id_seq OWNER TO postgres;

--
-- Name: struktur_organisasi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.struktur_organisasi_id_seq OWNED BY public.struktur_organisasi.id;


--
-- Name: tim_kreatif_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tim_kreatif_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tim_kreatif_id_seq OWNER TO postgres;

--
-- Name: tim_kreatif_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tim_kreatif_id_seq OWNED BY public.dosen_multimedia.id;


--
-- Name: v_berita_proyek; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_berita_proyek AS
 SELECT berita_artikel.id,
    berita_artikel.judul,
    berita_artikel.isi_berita AS isi,
    berita_artikel.gambar_berita AS gambar,
    'berita'::text AS tipe
   FROM public.berita_artikel
UNION ALL
 SELECT daftar_proyek.id,
    daftar_proyek.judul,
    daftar_proyek.isi_proyek AS isi,
    daftar_proyek.gambar_proyek AS gambar,
    'proyek'::text AS tipe
   FROM public.daftar_proyek
  ORDER BY 1 DESC;


ALTER VIEW public.v_berita_proyek OWNER TO postgres;

--
-- Name: visi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.visi (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    isi_visi text NOT NULL
);


ALTER TABLE public.visi OWNER TO postgres;

--
-- Name: visi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.visi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.visi_id_seq OWNER TO postgres;

--
-- Name: visi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.visi_id_seq OWNED BY public.visi.id;


--
-- Name: admin id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin ALTER COLUMN id SET DEFAULT nextval('public.admin_id_seq'::regclass);


--
-- Name: berita_artikel id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.berita_artikel ALTER COLUMN id SET DEFAULT nextval('public.berita_artikel_id_seq'::regclass);


--
-- Name: daftar_proyek id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.daftar_proyek ALTER COLUMN id SET DEFAULT nextval('public.daftar_proyek_id_seq'::regclass);


--
-- Name: deskripsi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.deskripsi ALTER COLUMN id SET DEFAULT nextval('public.deskripsi_id_seq'::regclass);


--
-- Name: dosen_multimedia id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen_multimedia ALTER COLUMN id SET DEFAULT nextval('public.tim_kreatif_id_seq'::regclass);


--
-- Name: galeri id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.galeri ALTER COLUMN id SET DEFAULT nextval('public.galeri_id_seq'::regclass);


--
-- Name: kategori id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori ALTER COLUMN id SET DEFAULT nextval('public.kategori_id_seq'::regclass);


--
-- Name: mahasiswa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa ALTER COLUMN id SET DEFAULT nextval('public.mahasiswa_id_seq'::regclass);


--
-- Name: mahasiswa_proyek id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa_proyek ALTER COLUMN id SET DEFAULT nextval('public.mahasiswa_proyek_id_seq'::regclass);


--
-- Name: misi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.misi ALTER COLUMN id SET DEFAULT nextval('public.misi_id_seq'::regclass);


--
-- Name: nilai id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nilai ALTER COLUMN id SET DEFAULT nextval('public.nilai_id_seq'::regclass);


--
-- Name: partner id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partner ALTER COLUMN id SET DEFAULT nextval('public.partner_id_seq'::regclass);


--
-- Name: pengunjung id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengunjung ALTER COLUMN id SET DEFAULT nextval('public.pengunjung_id_seq'::regclass);


--
-- Name: prodi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prodi ALTER COLUMN id SET DEFAULT nextval('public.prodi_id_seq'::regclass);


--
-- Name: sejarah id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sejarah ALTER COLUMN id SET DEFAULT nextval('public.sejarah_id_seq'::regclass);


--
-- Name: struktur_organisasi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.struktur_organisasi ALTER COLUMN id SET DEFAULT nextval('public.struktur_organisasi_id_seq'::regclass);


--
-- Name: visi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visi ALTER COLUMN id SET DEFAULT nextval('public.visi_id_seq'::regclass);


--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.admin (id, username, password) FROM stdin;
1	admin	admin
\.


--
-- Data for Name: berita_artikel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.berita_artikel (id, judul, isi_berita, gambar_berita, created_at, updated_at, kategori_id) FROM stdin;
4	Kunjungan Industri	Mahasiswa mengunjungi perusahaan media kreatif ternama.	assets/images/uploads/1764924907_69329deb016cd.jpg	2025-11-26 17:14:01.54328	2025-12-05 15:55:07.010416	20
3	Pelatihan Desain Poster	Pelatihan desain poster dengan Adobe Illustrator.	assets/images/uploads/1764924967_69329e27876e4.jpg	2025-11-26 17:14:01.54328	2025-12-05 15:56:07.558112	20
5	Inovasi Game Engine Lokal: Mahasiswa Lab Multimedia Kembangkan RPG Berbasis Budaya Nusantara	Dalam upaya melestarikan kebudayaan Indonesia melalui teknologi interaktif, tim riset Laboratorium Multimedia dan Game Development resmi meluncurkan purwarupa game RPG (Role-Playing Game) terbaru berjudul "The Heritage of Majapahit". Proyek ini dikerjakan selama enam bulan penuh menggunakan Unreal Engine 5 untuk mencapai kualitas grafis fotorealistik yang memukau.\r\n\r\n    Ketua tim pengembang menyatakan bahwa tantangan terbesar dalam proyek ini adalah mengadaptasi aset visual candi dan artefak sejarah ke dalam bentuk model 3D yang optimal tanpa mengurangi detail aslinya. "Kami melakukan fotogrametri langsung ke situs Trowulan untuk mendapatkan tekstur yang akurat. Harapannya, game ini tidak hanya menjadi sarana hiburan, tetapi juga media edukasi interaktif bagi generasi muda," ujarnya.\r\n    \r\n    Selain aspek visual, tim juga memfokuskan pengembangan pada mekanik gameplay yang menggabungkan unsur pencak silat. Sistem pertarungan dirancang dinamis dengan animasi yang direkam menggunakan teknologi Motion Capture yang tersedia di fasilitas laboratorium kampus. Game ini rencananya akan dipamerkan pada ajang Game Prime tahun depan dan diharapkan dapat menarik minat investor industri game nasional.	https://images.unsplash.com/photo-1552820728-8b83bb6b773f?q=80&w=1200&auto=format&fit=crop	2025-12-01 03:17:32.080834	2025-12-05 15:58:05.451726	18
7	Workshop UI/UX Design 2025: Membedah Tren Desain Aplikasi Mobile yang Human-Centric	Menghadapi persaingan industri teknologi yang semakin ketat, Himpunan Mahasiswa Informatika bekerja sama dengan Lab Multimedia menggelar workshop intensif bertajuk "Designing for Humans: The Future of UI/UX". Acara ini menghadirkan praktisi senior dari unicorn teknologi Indonesia untuk membedah tren desain antarmuka yang diprediksi akan mendominasi pasar pada tahun 2026.\r\n    \r\n    Materi workshop mencakup pembahasan mendalam mengenai Micro-interactions, Neumorphism 2.0, hingga aksesibilitas bagi pengguna difabel. Peserta diajak untuk tidak hanya membuat desain yang estetik, tetapi juga fungsional dan mudah digunakan. Sesi praktik dilakukan menggunakan tools industri standar seperti Figma dan Adobe XD, di mana peserta ditantang untuk melakukan redesign aplikasi layanan publik dalam waktu 3 jam.\r\n    \r\n    "UI/UX bukan sekadar tentang warna dan font, tapi tentang empati terhadap pengguna. Bagaimana kita menyelesaikan masalah user dengan solusi desain yang efisien," ungkap salah satu pemateri. Antusiasme peserta sangat tinggi, terlihat dari banyaknya pertanyaan kritis mengenai riset pengguna (User Research) dan pengujian kegunaan (Usability Testing) yang menjadi pondasi utama dalam pengembangan produk digital.	https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?q=80&w=1200&auto=format&fit=crop	2025-12-01 03:17:32.080834	2025-12-05 15:58:20.171952	19
6	Revolusi Edukasi Digital: Peluncuran Modul Pembelajaran Anatomi Tubuh Berbasis Virtual Reality (VR)	Laboratorium Multimedia kembali menorehkan prestasi dengan merilis modul pembelajaran kedokteran berbasis Virtual Reality (VR). Teknologi ini memungkinkan mahasiswa kedokteran untuk membedah anatomi tubuh manusia secara virtual tanpa perlu menggunakan kadaver sungguhan, memberikan pengalaman belajar yang imersif dan mendetail.\r\n    \r\n    Sistem ini dikembangkan menggunakan Unity 3D dan dioptimalkan untuk perangkat Meta Quest 3. Dosen pembimbing proyek menjelaskan bahwa akurasi medis menjadi prioritas utama. "Setiap organ, jaringan otot, hingga sistem saraf dimodelkan dengan presisi tinggi berdasarkan data MRI asli. Mahasiswa dapat memutar, memperbesar, dan melihat potongan melintang organ tubuh hanya dengan gestur tangan," jelasnya.\r\n    \r\n    Penerapan teknologi AR/VR di lingkungan akademis ini merupakan langkah strategis kampus untuk menyongsong era Metaverse dalam dunia pendidikan. Selain anatomi, tim Lab Multimedia saat ini juga sedang merancang simulasi mitigasi bencana gempa bumi menggunakan teknologi Augmented Reality (AR) yang dapat diakses melalui smartphone, guna meningkatkan kesadaran keselamatan masyarakat.	https://images.unsplash.com/photo-1626379953822-baec19c3accd?q=80&w=1200&auto=format&fit=crop	2025-12-01 03:17:32.080834	2025-12-05 15:58:42.152178	19
1	Workshop Editing Video	Kegiatan workshop editing video dilaksanakan oleh mahasiswa semester 3.	assets/images/uploads/1764924800_69329d8056c71.jpg	2025-11-26 17:14:01.54328	2025-12-05 15:58:57.097604	17
2	Lomba Animasi Nasional	Tim animasi Polinema meraih juara 1 tingkat nasional.	assets/images/uploads/1764924860_69329dbc43b84.jpg	2025-11-26 17:14:01.54328	2025-12-05 15:59:07.107462	17
9	Penerapan Artificial Intelligence (AI) untuk NPC Cerdas dalam Proyek Game Mahasiswa	Mahasiswa semester akhir konsentrasi Game Development berhasil membuat terobosan baru dengan menerapkan algoritma Machine Learning pada karakter Non-Playable Character (NPC). Jika biasanya NPC hanya mengikuti pola skrip yang kaku, proyek berjudul "Smart Villager" ini memungkinkan NPC untuk belajar dari perilaku pemain dan merespons percakapan secara dinamis menggunakan integrasi API Large Language Model (LLM).\r\n    \r\n    "Tantangan utamanya adalah optimasi memori. Kami harus memastikan AI berjalan ringan tanpa membebani frame rate game," ungkap ketua tim pengembang. Dengan teknologi ini, pemain bisa mengetikkan pertanyaan apa saja kepada NPC, dan NPC akan menjawab sesuai dengan kepribadian dan latar belakang cerita yang telah ditanamkan, menciptakan pengalaman role-playing yang tanpa batas.\r\n    \r\n    Dosen pembimbing mengapresiasi inovasi ini sebagai langkah maju penggabungan ilmu Data Science dan Game Design. Proyek ini rencananya akan dipublikasikan dalam jurnal teknologi internasional dan dikembangkan lebih lanjut menjadi modul plugin yang bisa digunakan oleh developer game indie lainnya di Indonesia.	assets/images/uploads/1764924744_69329d4893370.jpg	2025-12-01 03:18:29.168166	2025-12-05 15:52:24.606752	20
12	Kolaborasi Industri: Kunjungan Studio Animasi Terbesar Asia ke Laboratorium Multimedia	Sebuah kehormatan besar bagi kampus menerima kunjungan delegasi dari "Infinite Studios", salah satu studio animasi dan produksi film terbesar di Asia Tenggara yang berbasis di Batam dan Singapura. Kunjungan ini bertujuan untuk menjajaki peluang kerjasama magang (internship) dan rekrutmen lulusan (fresh graduate) dari prodi Teknik Informatika dan Multimedia.\r\n    \r\n    Dalam sesi kuliah tamu, Art Director studio tersebut membedah proses produksi film animasi kelas dunia, mulai dari storyboarding, modeling, rigging, hingga rendering. Mahasiswa tampak antusias bertanya mengenai standar portofolio yang dilirik oleh industri global. "Skill teknis itu penting, tapi attitude dan kemauan belajar adalah yang utama," pesannya kepada ratusan mahasiswa yang memadati auditorium.\r\n    \r\n    Acara ditutup dengan penandatanganan MoA (Memorandum of Agreement) yang meresmikan program "Campus Hiring". Mulai semester depan, mahasiswa berprestasi akan mendapatkan kesempatan fast-track untuk bekerja di proyek-proyek animasi internasional tanpa perlu melalui masa percobaan yang panjang.	https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200&auto=format&fit=crop	2025-12-01 03:18:29.168166	2025-12-05 15:56:49.358871	20
11	Studi Kasus UI/UX: Merancang Aplikasi Fintech yang Ramah bagi Lansia dan Difabel Netra	Inklusivitas menjadi tema utama dalam pameran tugas akhir mahasiswa Desain Antarmuka (UI/UX) semester ini. Salah satu karya yang paling menonjol adalah "EasyBank", sebuah konsep aplikasi perbankan yang dirancang khusus untuk pengguna lanjut usia dan penyandang tunanetra. Tim pengembang melakukan riset mendalam dengan metode empati untuk memahami kesulitan user dalam mengakses layanan keuangan digital.\r\n    \r\n    Fitur unggulan aplikasi ini mencakup penggunaan tipografi berukuran besar dengan kontras tinggi (AAA standard), navigasi berbasis suara (Voice Command), dan feedback haptic (getaran) yang berbeda untuk setiap jenis transaksi sukses atau gagal. "Kami membuang elemen dekoratif yang membingungkan dan fokus pada alur transaksi linear yang lurus dan jelas," jelas desainer utama proyek tersebut.\r\n    \r\n    Proyek ini mendapatkan atensi dari salah satu bank BUMN yang hadir sebagai tamu undangan. Mereka tertarik untuk mengadopsi prinsip desain sistem tersebut ke dalam aplikasi mobile banking versi terbaru mereka, membuktikan bahwa desain yang baik adalah desain yang bisa diakses oleh semua kalangan.	https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1200&auto=format&fit=crop	2025-12-01 03:18:29.168166	2025-12-05 15:56:58.985381	20
8	Turnamen E-Sports Kampus 2025: Mencari Bakat Terpendam di Arena MOBA dan FPS	Suasana riuh rendah memenuhi aula utama kampus saat babak final Turnamen E-Sports Antar Jurusan resmi digelar akhir pekan lalu. Kompetisi yang diinisiasi oleh Unit Kegiatan Mahasiswa Game Development ini mempertandingkan dua genre utama, yakni Multiplayer Online Battle Arena (MOBA) dan First-Person Shooter (FPS). Tidak hanya sebagai ajang hiburan, turnamen ini juga menjadi wadah pencarian bakat bagi tim yang akan mewakili universitas di tingkat nasional.\r\n\r\n    Koordinator acara menjelaskan bahwa infrastruktur jaringan dan perangkat yang digunakan didukung penuh oleh Laboratorium Multimedia. "Kami menggunakan server lokal low-latency yang dikonfigurasi khusus oleh mahasiswa jaringan, serta PC spesifikasi RTX 40-series dari lab untuk memastikan pengalaman bermain tanpa lag," ujarnya. Hal ini membuktikan bahwa fasilitas kampus sangat mumpuni untuk menggelar event bertaraf profesional.\r\n    \r\n    Di penghujung acara, tim "Garuda Cyber" dari prodi Teknik Informatika berhasil menyabet juara pertama setelah pertarungan sengit selama 50 menit. Kemenangan ini menjadi bukti bahwa strategi dan kerjasama tim (teamwork) yang dipelajari dalam pengembangan perangkat lunak juga sangat relevan diterapkan di dalam arena permainan kompetitif.	https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=1200&auto=format&fit=crop	2025-12-01 03:18:29.168166	2025-12-05 15:57:17.902097	18
10	Digitalisasi Pariwisata: Peluncuran Aplikasi AR "Jelajah Candi" untuk Wisatawan Mancanegara	Bekerja sama dengan Dinas Pariwisata daerah, tim riset Augmented Reality (AR) Lab Multimedia meluncurkan aplikasi mobile bernama "Jelajah Candi". Aplikasi ini memungkinkan wisatawan untuk mengarahkan kamera smartphone mereka ke reruntuhan candi dan melihat rekonstruksi utuh bangunan tersebut secara real-time di layar ponsel, lengkap dengan pemandu wisata virtual.\r\n    \r\n    Teknologi markerless tracking yang digunakan memungkinkan aplikasi mendeteksi permukaan tanah dan struktur bangunan tanpa perlu memindai kode QR fisik yang seringkali mengganggu estetika situs sejarah. Selain visual 3D, aplikasi ini juga menyuguhkan narasi sejarah dalam 5 bahasa asing, memudahkan turis mancanegara memahami konteks budaya lokal.\r\n    \r\n    "Ini adalah solusi cerdas di mana teknologi tidak menggantikan pengalaman fisik, melainkan memperkayanya. Wisatawan tetap datang ke lokasi, tapi mendapatkan lapisan informasi digital yang edukatif," kata Kepala Dinas Pariwisata saat sesi pemotongan pita peresmian. Aplikasi ini sudah tersedia di Play Store dan App Store mulai bulan ini.	https://images.unsplash.com/photo-1555679427-1f6dfcce943b?q=80&w=1200&auto=format&fit=crop	2025-12-01 03:18:29.168166	2025-12-05 15:57:54.252536	18
\.


--
-- Data for Name: daftar_proyek; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.daftar_proyek (id, judul, isi_proyek, gambar_proyek, kategori_id, tahun, nama_tim) FROM stdin;
13	A Plague Tale Innocence	A Plague Tale adalah seri game aksi-petualangan yang kelam dan berbasis cerita, berlatar di Prancis abad pertengahan yang dilanda wabah. Game ini mengikuti Amicia muda dan saudara laki-lakinya yang terjangkit secara misterius, Hugo, saat mereka melarikan diri dari Inkuisisi dan kawanan tikusbesar-besaran. Game ini memadukan strategi siluman, teka-teki lingkungan, dan pertarungan untuk bertahan hidup di dunia yang brutal sambil mengungkap hubungan supernatural Hugo dengan para tikus. Game ini dikenal karena ikatan emosional antarsaudara, visual yang memukau, suara yang atmosferik, dan narasi fantasi-historis yang muram, yang berevolusi dari perjuangan untuk bertahan hidup menjadi pencarian putus asa untuk mengendalikan kekuatan Hugo. 	assets/images/uploads/1764337041_6929a591cca2e.jpg	14	2025	Bismillah Gemastik
12	Valorant	Valorant adalah permainan tembak-menembak orang pertama (FPS) taktis 5v5 gratis yang dikembangkan oleh Riot Games, di mana tim penyerang dan bertahan bersaing untuk menanam atau menjinakkan perangkat yang disebut "Spike". Pemain memilih dari daftar "agen", masing-masing dengan kemampuan unik, dan pertandingan terdiri dari beberapa ronde di mana tim bergantian antara menyerang dan bertahan di sasaran, dengan satu nyawa per ronde.	assets/images/uploads/1764336983_6929a557ddcb0.png	14	2025	Bismillah Gemastik
11	GTA 6	Grand Theft Auto (GTA) adalah seri gim video aksi-petualanganpopulerdari Rockstar Games yang dikenal denganlingkungan dunia terbuka, tema kriminal, dan pendekatan satir terhadap budaya Amerika. Di sini, pemain menyelesaikan misi, terlibat dalam perampokan, mengendarai kendaraan, dan membangun reputasi kriminal di kota-kota fiksi seperti Los Santos (LA) atau Liberty City (NYC). Gameplay-nya menawarkan kebebasan untuk menjelajah, bertualang, dan menciptakan kekacauan, mengikuti alur cerita yang melibatkan karakter-karakter unik dengan keahlian unik. Versi modernnya menampilkan visual yang memukau dan mode multipemain daring. 	assets/images/uploads/1764336952_6929a5387dd86.jpg	14	2025	Bismillah Gemastik
10	Silent Hill	Silent Hill adalah kota Amerika yang selalu diselimuti kabut dan berhantu, yang terkenal dengan kengerian supernatural, yang mewujudkan rasa bersalah dan trauma batin para tokohnya ke dalam makhluk-makhluk mengerikan dan lingkungan yang mengerikan ("Dunia Lain"), didorong oleh aliran sesat dan kekuatan kuno, menciptakan mimpi buruk psikologis yang surealis, di mana realitas berubah bentuk, ditandai oleh sirene yang menakutkan, karat, dan darah.	assets/images/uploads/1764336892_6929a4fce0112.jpg	14	2023	Bismillah Gemastik
3	AR/VR 1	Proyek ini merupakan pengembangan aplikasi Virtual Reality (VR) yang memungkinkan calon mahasiswa dan masyarakat umum untuk menjelajahi lingkungan kampus secara virtual tanpa harus datang ke lokasi. Dibangun menggunakan Unity 3D dan Blender, aplikasi ini menyajikan pengalaman imersif 360 derajat.	assets/images/uploads/1764336688_6929a4301ce87.png	15	2025	Bismillah Gemastik
8	AR/VR 2	Sebuah simulasi pelatihan Kesehatan dan Keselamatan Kerja (K3) berbasis Virtual Reality yang dirancang untuk industri manufaktur. Proyek ini bertujuan untuk mengurangi risiko kecelakaan kerja dengan melatih karyawan dalam lingkungan virtual yang aman sebelum terjun ke lapangan.	assets/images/uploads/1764336761_6929a479b884d.png	15	2025	Bismillah Gemastik
9	AR/VR 3	Aplikasi Augmented Reality (AR) interaktif yang dirancang sebagai alat bantu ajar biologi untuk siswa sekolah menengah. Dengan memindai kartu marker khusus menggunakan kamera smartphone, pengguna dapat melihat model 3D organ tubuh manusia melayang di atas meja.	assets/images/uploads/1764336810_6929a4aa2060f.png	15	2024	Bismillah Gemastik
7	UI/UX 1	Studi kasus perancangan ulang antarmuka aplikasi mobile banking dengan pendekatan User-Centered Design. Proyek ini berfokus pada penyederhanaan alur transfer uang dan pembayaran tagihan yang selama ini dikeluhkan pengguna karena terlalu rumit.	assets/images/uploads/1764336468_6929a354a9d14.jpg	16	2025	Designer handal
6	UI/UX 2	Perancangan UI/UX untuk aplikasi yang menghubungkan petani langsung dengan pembeli (konsumen rumah tangga dan restoran). Tantangan utama dalam desain ini adalah menciptakan antarmuka yang sangat mudah digunakan oleh petani yang mungkin kurang fasih dengan teknologi (tech-savvy).	assets/images/uploads/1764336563_6929a3b3bd6d3.jpg	16	2023	Designer jago
4	UI/UX 3	Desain pengalaman pengguna untuk aplikasi kesehatan mental yang menyediakan layanan konseling daring dengan psikolog profesional. Fokus utama desain adalah menciptakan rasa tenang, aman, dan privasi bagi pengguna.	assets/images/uploads/1764336642_6929a402a765b.jpg	16	2025	Designer berkelas
\.


--
-- Data for Name: deskripsi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.deskripsi (id, isi_deskripsi) FROM stdin;
1	Laboratorium Multimedia dan Game Development adalah pusat inovasi digital yang berfokus pada pengembangan teknologi interaktif, visualisasi kreatif, dan pengalaman pengguna yang imersif. Kami memfasilitasi mahasiswa untuk mengeksplorasi potensi terbaik mereka di bidang Game Development, Augmented & Virtual Reality (AR/VR), serta UI/UX Design dengan dukungan perangkat keras terkini dan kurikulum berbasis industri.
\.


--
-- Data for Name: dosen_multimedia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dosen_multimedia (id, nama, jabatan, gambar_tim, link_linkedin, link_instagram, link_github, nidn) FROM stdin;
1	Dr. Budi Santoso	Kepala Laboratorium	dosen1.png	https://linkedin.com	https://instagram.com	https://github.com	1000000001
3	Rudi Hermawan, S.T	Teknisi / Laboran	dosen3.png	https://linkedin.com	https://instagram.com	https://github.com	1000000003
4	Prof. Hendra Setiawan	Dosen Pembina	dosen4.png	https://linkedin.com	https://instagram.com	https://github.com	1000000004
5	Eko Prasetyo, M.Cs	Anggota	dosen5.png	https://linkedin.com	https://instagram.com	https://github.com	1000000005
6	Fajar Nugroho, M.T	Anggota	dosen6.png	https://linkedin.com	https://instagram.com	https://github.com	1000000006
7	Gilang Ramadhan, S.Kom	Anggota	dosen7.png	https://linkedin.com	https://instagram.com	https://github.com	1000000007
8	Hadi Kurniawan, M.Kom	Anggota	dosen8.png	https://linkedin.com	https://instagram.com	https://github.com	1000000008
9	Indra Lesmana, S.T	Anggota	dosen9.png	https://linkedin.com	https://instagram.com	https://github.com	1000000009
10	Joko Susilo, M.Eng	Anggota	dosen10.png	https://linkedin.com	https://instagram.com	https://github.com	1000000010
11	Kiki Firmansyah, M.Cs	Anggota	dosen11.png	https://linkedin.com	https://instagram.com	https://github.com	1000000011
12	Lukman Hakim, S.Kom	Anggota	dosen12.png	https://linkedin.com	https://instagram.com	https://github.com	1000000012
13	Muhammad Rizky, M.T	Anggota	dosen13.png	https://linkedin.com	https://instagram.com	https://github.com	1000000013
14	Novan Saputra, M.Kom	Anggota	dosen14.png	https://linkedin.com	https://instagram.com	https://github.com	1000000014
15	Oscar Pratama, S.Kom	Anggota	dosen15.png	https://linkedin.com	https://instagram.com	https://github.com	1000000015
2	Andi Wijaya, M.Kom	Sekretaris Laboratorium	dosen2.png	https://linkedin.com	https://instagram.com		1000000002
\.


--
-- Data for Name: galeri; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.galeri (id, deskripsi, gambar_galeri) FROM stdin;
5	Suasana kegiatan coding game marathon (Game Jam) di mana mahasiswa bekerja tim untuk menyelesaikan prototipe game dalam waktu 48 jam.	https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=800&auto=format&fit=crop
8	Diskusi kelompok tim UI/UX Designer sedang melakukan brainstorming wireframe menggunakan papan tulis dan sticky notes.	https://images.unsplash.com/photo-1531403009284-440f080d1e12?q=80&w=800&auto=format&fit=crop
9	Setup komputer high-end di laboratorium yang dilengkapi dual monitor untuk mendukung rendering 3D dan pemrograman kompleks.	https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?q=80&w=800&auto=format&fit=crop
10	Pameran karya mahasiswa akhir semester menampilkan poster proyek dan demo aplikasi kepada pengunjung umum.	https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=800&auto=format&fit=crop
13	Tim pengembang game sedang melakukan debugging kode program (coding) bersama di layar monitor ganda.	https://images.unsplash.com/photo-1571171637578-41bc2dd41cd2?q=80&w=800&auto=format&fit=crop
14	Foto bersama tim pemenang Gold Medal kategori Desain Inovatif pada kompetisi Gemastik tingkat nasional.	https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=800&auto=format&fit=crop
15	Detail pengerjaan sketsa karakter 2D menggunakan pen tablet Wacom di studio gambar digital.	https://images.unsplash.com/photo-1611162617474-5b21e879e113?q=80&w=800&auto=format&fit=crop
11	Mahasiswa sedang melakukan kalibrasi perangkat headset VR Oculus Quest 2 sebelum memulai simulasi lingkungan virtual.	assets/images/uploads/1764925536galeri6.jpg
7	Fasilitas studio Green Screen dan Motion Capture yang digunakan untuk produksi aset animasi karakter game dan film pendek.	assets/images/uploads/1764925561galeri7.jpg
12	Sesi presentasi prototype aplikasi mobile di depan dosen penguji menggunakan proyektor interaktif di ruang sidang.	assets/images/uploads/1764925591galeri8.jpg
6	Sesi pengujian perangkat Virtual Reality (VR) terbaru oleh tim riset untuk simulasi lingkungan 3D yang imersif.	assets/images/uploads/1764927057galeri11.jpg
4	Kegiatan Outdoor Class	assets/images/uploads/1764927089galeri12.jpg
3	Sesi Pemotretan Produk	assets/images/uploads/1764927115galeri13.jpg
2	Dokumentasi Belajar Editing	assets/images/uploads/1764927141galeri14.jpg
1	Kegiatan di Lab Multimedia	assets/images/uploads/1764927175galeri15.jpg
\.


--
-- Data for Name: kategori; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kategori (id, nama_kategori, jenis) FROM stdin;
14	Game Development	proyek
15	AR/VR	proyek
16	UI/UX	proyek
17	Prestasi	berita
18	Kegiatan	berita
19	Pengumuman	berita
20	Artikel	berita
\.


--
-- Data for Name: mahasiswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mahasiswa (id, nim, nama, prodi_id) FROM stdin;
1	2400001	Dinda Alif Sukma	15
2	2400002	Bayu Zainal Cahyono	15
3	2400003	Indah Jaya Kusumawati	14
4	2400004	David Nanda Kartika	15
5	2400005	Erlangga Setiawan Firmansyah	15
6	2400006	Arman Jamil Hakim	15
7	2400007	Sri Latif Ramadhan	14
8	2400008	Darian Oki Santoso	16
9	2400009	Fauzan Hikmah Novitasari	15
10	2400010	Clarissa Nur Wulandari	14
11	2400011	Rifqi Chandra Damayanti	14
12	2400012	Bagus Lukman Santika	16
13	2400013	Satria Oki Wibowo	14
14	2400014	Bella Jaya Yuliani	16
15	2400015	Erlangga Wahyu Wardani	16
16	2400016	Tiara Haris Novitasari	16
17	2400017	Ariel Setiawan Pertiwi	14
18	2400018	Aditya Alif Sukma	14
19	2400019	Anisa Oki Mulyono	14
20	2400020	Budi Kurnia Astuti	16
21	2400021	Rafael Galih Sariyah	16
22	2400022	Tito Heru Wulandari	15
23	2400023	Ghazali Zainal Hidayat	16
24	2400024	Clarissa Daffa Susanti	15
25	2400025	Rifqi Unggul Wahyuni	15
26	2400026	Fauzan Fadly Firmansyah	15
27	2400027	Aditya Kezia Kurniati	14
28	2400028	Muhammad Zainal Handayani	14
29	2400029	Bagus Latif Wibowo	16
30	2400030	David Seno Sulistyo	16
31	2400031	David Qori Damayanti	15
32	2400032	Fauzan Kiki Hasanah	14
33	2400033	Siti Laras Nasution	16
34	2400034	Eko Latif Erlina	15
35	2400035	Putri Tegar Halimah	14
36	2400036	Bagus Azka Wardani	16
37	2400037	Slamet Setiawan Kurniati	14
38	2400038	Bella Vicky Sulistyo	15
39	2400039	Yogi Fadly Astuti	14
40	2400040	Dimas Azka Yulianto	15
41	2400041	Ahmad Arif Pratama	15
42	2400042	Kevin Nur Permana	15
43	2400043	Anisa Lukman Hidayat	14
44	2400044	David Eka Suyanto	16
45	2400045	Yusuf Tegar Saputra	16
46	2400046	Farhan Galih Wardani	16
47	2400047	Putri Heru Cahyono	16
48	2400048	Rafael Imam Pertiwi	14
49	2400049	Hendra Dian Sari	14
50	2400050	Kevin Wahyu Kurniati	15
51	2400051	Rani Seno Prasetyo	14
52	2400052	Lestari Dian Hasanah	15
53	2400053	Rizal Evan Suyanto	16
54	2400054	David Evan Pertiwi	15
55	2400055	Rizky Endra Permana	15
56	2400056	Indah Hikmah Sari	15
57	2400057	Eko Zainal Rahman	15
58	2400058	Satria Jamal Sari	15
59	2400059	Yusuf Yoga Setiawan	14
60	2400060	Tito Galih Saputra	15
61	2400061	Dewi Endra Cahyono	14
62	2400062	Muhammad Ferry Fauzi	15
63	2400063	Sri Rama Kusuma	16
64	2400064	Satria Jamal Saputra	14
65	2400065	Fitri Arif Yusuf	14
66	2400066	Rani Arif Hidayat	16
67	2400067	Nadya Guntur Indriyani	14
68	2400068	Michael Bram Novitasari	16
69	2400069	Farhan Kezia Hasanah	14
70	2400070	Ratna Cahyo Kusuma	14
71	2400071	Erlangga Taufik Mulyani	14
72	2400072	Bella Rendy Firmansyah	15
73	2400073	Michael Laras Kartika	15
74	2400074	Dinda Jaya Kusumawati	16
75	2400075	Yogi Hikmah Siregar	16
76	2400076	Doni Icha Mulyono	14
77	2400077	Rifqi Nanda Kusuma	14
78	2400078	Fitri Azka Wibowo	14
79	2400079	Rizky Zainal Wibowo	15
80	2400080	Aditya Rio Yulianto	16
81	2400081	Rina Haris Setiawan	14
82	2400082	Slamet Fikri Cahyono	15
83	2400083	Bayu Haris Hakim	16
84	2400084	Lestari Mawar Nasution	14
85	2400085	Reza Xaverius Anggraini	14
86	2400086	Lestari Xaverius Utama	15
87	2400087	Ricky Chandra Ramadhan	15
88	2400088	Nadya Kiki Putri	16
89	2400089	Satria Alif Putri	14
90	2400090	Rizky Pian Handayani	15
91	2400091	Budi Seno Putri	15
92	2400092	Tito Haris Nugroho	16
93	2400093	Nadia Icha Wijaya	16
94	2400094	Nadia Jamal Susanti	14
95	2400095	Aditya Fikri Putri	15
96	2400096	David Pandu Erlina	14
97	2400097	Ahmad Yoga Pratiwi	14
98	2400098	Doni Dwi Permana	15
99	2400099	Putri Latif Hidayat	14
100	2400100	Yusuf Chandra Sari	14
101	2400101	Satria Vicky Nasution	14
102	2400102	Indah Daffa Prayogo	16
103	2400103	Rina Arif Kurniati	14
104	2400104	Kevin Setiawan Indriyani	14
105	2400105	Helmi Jamal Lestari	14
106	2400106	Clarissa Maulana Pratama	16
107	2400107	Rizal Hadi Setiawan	15
108	2400108	Wulan Daffa Novitasari	14
109	2400109	Putri Hikmah Yusuf	14
110	2400110	Dewi Nur Yusuf	16
111	2400111	Yogi Alif Pertiwi	15
112	2400112	Bayu Tegar Yulianto	16
113	2400113	Rafael Nabila Anggraini	16
114	2400114	Ghazali Rio Ramadhan	14
115	2400115	Indah Vicky Wijayanti	16
116	2400116	Nadia Fikri Siregar	15
117	2400117	Clarissa Galih Anggraini	16
118	2400118	Yusuf Jamal Sukma	16
119	2400119	Tito Nabila Halimah	16
120	2400120	Michael Rama Sariyah	15
121	2400121	Ricky Alif Salamah	15
122	2400122	Ariel Latif Cahyono	16
123	2400123	Dewi Evan Erlina	16
124	2400124	Rizky Daffa Cahyono	16
125	2400125	Rizky Oki Santoso	14
126	2400126	Siti Heru Wahyuni	15
127	2400127	Satria Chandra Santoso	14
128	2400128	Michael Pandu Rahmawati	15
129	2400129	Fitri Catur Wardani	16
130	2400130	Ayu Jamal Santoso	15
131	2400131	Adel Bimo Putri	14
132	2400132	Ricky Nanda Lestari	14
133	2400133	Wulan Ade Hakim	14
134	2400134	Ariel Pian Hasanah	14
135	2400135	Nadya Seno Wijaya	14
136	2400136	Ahmad Evan Suyanto	16
137	2400137	Erlangga Ferry Indriyani	14
138	2400138	Siti Oki Halimah	14
139	2400139	Rani Daffa Sariyah	14
140	2400140	Eko Ferry Handayani	15
141	2400141	Aditya Jamal Yusuf	14
142	2400142	Ricky Evan Pratama	14
143	2400143	Darian Fajar Cahyono	15
144	2400144	Muhammad Fadly Wibisono	16
145	2400145	Putri Ghazal Rismaya	15
146	2400146	Bayu Rio Wardani	16
147	2400147	Nadya Pandu Adiningrum	16
148	2400148	Bella Latif Hakim	14
149	2400149	Bella Xaverius Siregar	14
150	2400150	Aditya Dwi Wardani	14
151	2400151	Slamet Arif Handayani	16
152	2400152	Eko Kiki Santoso	14
153	2400153	Darian Fadly Bachtiar	15
154	2400154	Anisa Pandu Rismaya	15
155	2400155	Gita Guntur Yusuf	15
156	2400156	Rani Guntur Bachtiar	16
157	2400157	Yusuf Bram Wulandari	14
158	2400158	Siti Icha Pertiwi	16
159	2400159	Tito Daffa Wibowo	16
160	2400160	Bella Chandra Wijaya	16
161	2400161	Ricky Gilang Cahyono	15
162	2400162	Tito Guntur Novitasari	15
163	2400163	Fathan Mawar Safitri	14
164	2400164	Ayu Setiawan Utama	16
165	2400165	Nur Laras Puspitasari	14
166	2400166	Reza Ghazal Puspitasari	16
167	2400167	Michael Oki Indriyani	14
168	2400168	Slamet Nabila Indriyani	14
169	2400169	Ariel Laras Sari	15
170	2400170	Joko Kezia Wijayanti	14
171	2400171	Rina Kurnia Sukma	15
172	2400172	Kevin Bimo Cahyono	16
173	2400173	Reza Imam Puspitasari	15
174	2400174	Dinda Tegar Utama	14
175	2400175	Wulan Evan Kurniati	15
176	2400176	Siti Imam Yusuf	14
177	2400177	Arman Lukman Sari	15
178	2400178	Naufal Daffa Hasanah	16
179	2400179	Bayu Heru Putri	14
180	2400180	Ilham Fajar Prasetyo	14
181	2400181	Nadia Bram Firmansyah	15
182	2400182	Budi Daffa Hasanah	16
183	2400183	Satria Dian Sari	16
184	2400184	Ghazali Latif Halimah	14
185	2400185	Satria Nur Suyanto	16
186	2400186	Bagus Zainal Adiningrum	15
187	2400187	Erlangga Cahyo Wijayanti	16
188	2400188	Tito Bimo Hakim	14
189	2400189	Muhammad Indra Saputra	15
190	2400190	Kevin Lukman Wijaya	16
191	2400191	Aisyah Tri Nugroho	15
192	2400192	Bella Bimo Rahman	15
193	2400193	Naufal Eka Handayani	16
194	2400194	Rina Jamil Suyanto	14
195	2400195	Rifqi Tegar Hidayat	15
196	2400196	Nadia Daffa Putri	14
197	2400197	Dinda Rendy Adiningrum	15
198	2400198	Michael Vicky Astuti	14
199	2400199	Helmi Azka Yuliani	14
200	2400200	Ayu Nabila Cahyono	14
201	2400201	Bagus Lukman Wijayanti	14
202	2400202	Tiara Gilang Santoso	16
203	2400203	Citra Eka Kusuma	15
204	2400204	Kevin Bimo Fauzi	14
205	2400205	Helmi Imam Bachtiar	14
206	2400206	Clarissa Oki Sari	14
207	2400207	Dewi Kiki Kusumawati	15
208	2400208	Darian Qori Safitri	14
209	2400209	Aisyah Jamil Siregar	14
210	2400210	Tiara Rama Puspitasari	14
211	2400211	Ghazali Latif Susanti	16
212	2400212	Rifqi Imam Saputra	15
213	2400213	Joko Ferry Putri	14
214	2400214	Tito Bima Novitasari	14
215	2400215	Yogi Bimo Siregar	15
216	2400216	Ahmad Haris Zahra	15
217	2400217	Ayu Rama Halimah	15
218	2400218	Budi Seno Wulandari	14
219	2400219	Ricky Vicky Mulyani	16
220	2400220	Citra Cahyo Wulandari	16
221	2400221	Slamet Vicky Salamah	14
222	2400222	Citra Tri Zahra	15
223	2400223	Rina Jamil Safitri	14
224	2400224	Anisa Eka Rahman	14
225	2400225	Gita Galih Pertiwi	14
226	2400226	Rafael Ferry Utama	14
227	2400227	Indah Setiawan Ramadhan	14
228	2400228	Rafael Kezia Lestari	14
229	2400229	Citra Bimo Safitri	14
230	2400230	Sri Pandu Wulandari	14
231	2400231	Ilham Rendy Indriyani	16
232	2400232	Ricky Laras Kurniati	15
233	2400233	Yogi Hikmah Kusuma	14
234	2400234	Fauzan Pandu Zahra	15
235	2400235	Kevin Hadi Kartika	16
236	2400236	Ilham Hikmah Ramadhan	16
237	2400237	Doni Kezia Handayani	15
238	2400238	Ayu Azka Cahyono	16
239	2400239	Rani Unggul Sariyah	14
240	2400240	Putri Nico Wardani	15
241	2400241	Anisa Nur Anggraini	14
242	2400242	Siti Ghazal Fauzi	14
243	2400243	Erlangga Jamal Sukma	14
244	2400244	Ayu Kurnia Handayani	14
245	2400245	Arman Bima Prayogo	15
246	2400246	Ahmad Cahyo Rismaya	15
247	2400247	Rifqi Setiawan Saputra	14
248	2400248	Muhammad Yoga Susanti	16
249	2400249	Maya Latif Fauzi	14
250	2400250	Bella Mawar Mulyono	16
\.


--
-- Data for Name: mahasiswa_proyek; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mahasiswa_proyek (id, mahasiswa_id, proyek_id) FROM stdin;
40	131	13
41	18	13
42	150	13
43	131	12
44	18	12
45	150	12
46	131	11
47	18	11
48	150	11
49	131	10
50	18	10
51	150	10
52	131	3
53	18	3
54	150	3
55	131	8
56	18	8
57	150	8
58	131	9
59	18	9
60	150	9
61	131	7
62	18	7
63	150	7
64	131	6
65	18	6
66	150	6
67	131	4
68	18	4
69	150	4
\.


--
-- Data for Name: misi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.misi (id, judul, isi_misi) FROM stdin;
1	Pendidikan	Menyelenggarakan pendidikan vokasi berbasis praktik yang adaptif terhadap perkembangan teknologi game dan media interaktif.
2	Penelitian	Mengembangkan riset terapan yang menghasilkan produk inovatif di bidang AR/VR dan UI/UX yang bermanfaat bagi masyarakat dan industri.
3	Kolaborasi	Membangun jejaring kerjasama strategis dengan studio game, startup teknologi, dan komunitas kreatif.
\.


--
-- Data for Name: nilai; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.nilai (id, judul, gambar_nilai, deskripsi) FROM stdin;
1	Creativity	1764656077_nilai.jpg	Kami percaya bahwa imajinasi tanpa batas adalah kunci melahirkan inovasi.
2	Collaboration	1764656088_nilai.jpg	Sukses adalah hasil kerja tim yang solid, bukan kerja individu.
3	Excellence	1764656099_nilai.jpg	Kami selalu mengejar standar kualitas tertinggi dalam setiap karya.
\.


--
-- Data for Name: partner; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.partner (id, nama_brand, gambar_brand) FROM stdin;
2	Google	1764655099_partner.png
3	Microsoft	1764655121_partner.png
5	MEta	1764655366_partner.png
6	polinema	1764655380_partner.png
4	apple	1764655903_partner.png
\.


--
-- Data for Name: pengunjung; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengunjung (id, ip_address, tanggal, waktu) FROM stdin;
1	10.1.1.1	2025-11-30	2025-11-30 02:11:37.019849
2	10.1.1.2	2025-11-30	2025-11-30 02:11:37.019849
3	10.1.1.3	2025-11-30	2025-11-30 02:11:37.019849
4	10.1.1.4	2025-11-30	2025-11-30 02:11:37.019849
5	10.1.1.5	2025-11-30	2025-11-30 02:11:37.019849
6	10.2.1.1	2025-11-29	2025-11-30 02:11:37.019849
7	10.2.1.2	2025-11-29	2025-11-30 02:11:37.019849
8	10.2.1.3	2025-11-29	2025-11-30 02:11:37.019849
9	10.3.1.1	2025-11-28	2025-11-30 02:11:37.019849
10	10.3.1.2	2025-11-28	2025-11-30 02:11:37.019849
11	10.3.1.3	2025-11-28	2025-11-30 02:11:37.019849
12	10.3.1.4	2025-11-28	2025-11-30 02:11:37.019849
13	10.3.1.5	2025-11-28	2025-11-30 02:11:37.019849
14	10.3.1.6	2025-11-28	2025-11-30 02:11:37.019849
15	10.3.1.7	2025-11-28	2025-11-30 02:11:37.019849
16	10.3.1.8	2025-11-28	2025-11-30 02:11:37.019849
17	::1	2025-11-29	2025-11-30 02:13:51.959926
20	::1	2025-11-30	2025-11-30 14:37:39.426185
128	::1	2025-12-02	2025-12-02 07:35:19.781353
200	::1	2025-12-03	2025-12-03 18:10:24.113141
210	::1	2025-12-05	2025-12-05 13:51:39.153224
339	::1	2025-12-06	2025-12-06 08:06:53.469357
356	::1	2025-12-07	2025-12-07 11:08:45.054649
\.


--
-- Data for Name: prodi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prodi (id, nama_prodi) FROM stdin;
14	D4-Teknik Informatika
15	D4-Sistem Informasi Bisnis
16	D2-Pengembangan Piranti Lunak Situs
\.


--
-- Data for Name: sejarah; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sejarah (id, judul, isi, tahun) FROM stdin;
3	Pendirian Awal	Laboratorium ini pertama kali didirikan sebagai unit pendukung praktikum desain grafis dasar dengan fasilitas 20 komputer.	2015
4	Transformasi Digital	Melakukan pembaruan kurikulum besar-besaran dengan memasukkan fokus Game Development dan pengadaan perangkat High-End PC.	2019
5	Era Imersif	Meresmikan divisi riset AR/VR dengan pengadaan perangkat Oculus dan Hololens, serta memenangkan hibah penelitian nasional.	2023
6	Pusat Unggulan	Ditetapkan sebagai Center of Excellence (CoE) bidang Teknologi Kreatif di lingkungan kampus.	2025
\.


--
-- Data for Name: struktur_organisasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.struktur_organisasi (id, gambar_organisasi) FROM stdin;
1	1764655580_struktur.jpg
\.


--
-- Data for Name: visi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.visi (id, judul, isi_visi) FROM stdin;
1	Visi Utama	Menjadi pusat unggulan riset dan pengembangan teknologi multimedia kreatif tingkat nasional yang menghasilkan talenta digital berdaya saing global pada tahun 2030.
\.


--
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admin_id_seq', 1, true);


--
-- Name: berita_artikel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.berita_artikel_id_seq', 12, true);


--
-- Name: daftar_proyek_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.daftar_proyek_id_seq', 18, true);


--
-- Name: deskripsi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.deskripsi_id_seq', 1, true);


--
-- Name: galeri_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.galeri_id_seq', 15, true);


--
-- Name: kategori_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kategori_id_seq', 20, true);


--
-- Name: mahasiswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mahasiswa_id_seq', 250, true);


--
-- Name: mahasiswa_proyek_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mahasiswa_proyek_id_seq', 69, true);


--
-- Name: misi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.misi_id_seq', 3, true);


--
-- Name: nilai_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.nilai_id_seq', 3, true);


--
-- Name: partner_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.partner_id_seq', 6, true);


--
-- Name: pengunjung_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengunjung_id_seq', 386, true);


--
-- Name: prodi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prodi_id_seq', 16, true);


--
-- Name: sejarah_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sejarah_id_seq', 6, true);


--
-- Name: struktur_organisasi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.struktur_organisasi_id_seq', 1, true);


--
-- Name: tim_kreatif_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tim_kreatif_id_seq', 15, true);


--
-- Name: visi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.visi_id_seq', 1, true);


--
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id);


--
-- Name: admin admin_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_username_key UNIQUE (username);


--
-- Name: berita_artikel berita_artikel_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.berita_artikel
    ADD CONSTRAINT berita_artikel_pkey PRIMARY KEY (id);


--
-- Name: daftar_proyek daftar_proyek_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.daftar_proyek
    ADD CONSTRAINT daftar_proyek_pkey PRIMARY KEY (id);


--
-- Name: deskripsi deskripsi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.deskripsi
    ADD CONSTRAINT deskripsi_pkey PRIMARY KEY (id);


--
-- Name: dosen_multimedia dosen_multimedia_nidn_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen_multimedia
    ADD CONSTRAINT dosen_multimedia_nidn_key UNIQUE (nidn);


--
-- Name: galeri galeri_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.galeri
    ADD CONSTRAINT galeri_pkey PRIMARY KEY (id);


--
-- Name: kategori kategori_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori
    ADD CONSTRAINT kategori_pkey PRIMARY KEY (id);


--
-- Name: mahasiswa mahasiswa_nim_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT mahasiswa_nim_key UNIQUE (nim);


--
-- Name: mahasiswa mahasiswa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT mahasiswa_pkey PRIMARY KEY (id);


--
-- Name: mahasiswa_proyek mahasiswa_proyek_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa_proyek
    ADD CONSTRAINT mahasiswa_proyek_pkey PRIMARY KEY (id);


--
-- Name: misi misi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.misi
    ADD CONSTRAINT misi_pkey PRIMARY KEY (id);


--
-- Name: nilai nilai_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nilai
    ADD CONSTRAINT nilai_pkey PRIMARY KEY (id);


--
-- Name: partner partner_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partner
    ADD CONSTRAINT partner_pkey PRIMARY KEY (id);


--
-- Name: pengunjung pengunjung_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengunjung
    ADD CONSTRAINT pengunjung_pkey PRIMARY KEY (id);


--
-- Name: prodi prodi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prodi
    ADD CONSTRAINT prodi_pkey PRIMARY KEY (id);


--
-- Name: sejarah sejarah_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sejarah
    ADD CONSTRAINT sejarah_pkey PRIMARY KEY (id);


--
-- Name: struktur_organisasi struktur_organisasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.struktur_organisasi
    ADD CONSTRAINT struktur_organisasi_pkey PRIMARY KEY (id);


--
-- Name: dosen_multimedia tim_kreatif_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen_multimedia
    ADD CONSTRAINT tim_kreatif_pkey PRIMARY KEY (id);


--
-- Name: mahasiswa_proyek uniq_mahasiswa_proyek; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa_proyek
    ADD CONSTRAINT uniq_mahasiswa_proyek UNIQUE (mahasiswa_id, proyek_id);


--
-- Name: pengunjung unique_visit_per_day; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengunjung
    ADD CONSTRAINT unique_visit_per_day UNIQUE (ip_address, tanggal);


--
-- Name: visi visi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visi
    ADD CONSTRAINT visi_pkey PRIMARY KEY (id);


--
-- Name: berita_artikel berita_artikel_kategori_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.berita_artikel
    ADD CONSTRAINT berita_artikel_kategori_id_fkey FOREIGN KEY (kategori_id) REFERENCES public.kategori(id) ON DELETE SET NULL;


--
-- Name: daftar_proyek daftar_proyek_kategori_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.daftar_proyek
    ADD CONSTRAINT daftar_proyek_kategori_id_fkey FOREIGN KEY (kategori_id) REFERENCES public.kategori(id) ON DELETE SET NULL;


--
-- Name: mahasiswa mahasiswa_prodi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT mahasiswa_prodi_id_fkey FOREIGN KEY (prodi_id) REFERENCES public.prodi(id) ON DELETE CASCADE;


--
-- Name: mahasiswa_proyek mahasiswa_proyek_mahasiswa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa_proyek
    ADD CONSTRAINT mahasiswa_proyek_mahasiswa_id_fkey FOREIGN KEY (mahasiswa_id) REFERENCES public.mahasiswa(id) ON DELETE CASCADE;


--
-- Name: mahasiswa_proyek mahasiswa_proyek_proyek_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa_proyek
    ADD CONSTRAINT mahasiswa_proyek_proyek_id_fkey FOREIGN KEY (proyek_id) REFERENCES public.daftar_proyek(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

