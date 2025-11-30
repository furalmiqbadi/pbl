--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

-- Started on 2025-12-01 03:11:21

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
-- TOC entry 217 (class 1259 OID 25607)
-- Name: admin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.admin (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.admin OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 25610)
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
-- TOC entry 5081 (class 0 OID 0)
-- Dependencies: 218
-- Name: admin_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.admin_id_seq OWNED BY public.admin.id;


--
-- TOC entry 219 (class 1259 OID 25611)
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
-- TOC entry 220 (class 1259 OID 25618)
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
-- TOC entry 5082 (class 0 OID 0)
-- Dependencies: 220
-- Name: berita_artikel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.berita_artikel_id_seq OWNED BY public.berita_artikel.id;


--
-- TOC entry 221 (class 1259 OID 25619)
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
-- TOC entry 222 (class 1259 OID 25624)
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
-- TOC entry 5083 (class 0 OID 0)
-- Dependencies: 222
-- Name: daftar_proyek_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.daftar_proyek_id_seq OWNED BY public.daftar_proyek.id;


--
-- TOC entry 223 (class 1259 OID 25625)
-- Name: deskripsi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.deskripsi (
    id integer NOT NULL,
    isi_deskripsi text NOT NULL
);


ALTER TABLE public.deskripsi OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 25630)
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
-- TOC entry 5084 (class 0 OID 0)
-- Dependencies: 224
-- Name: deskripsi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.deskripsi_id_seq OWNED BY public.deskripsi.id;


--
-- TOC entry 225 (class 1259 OID 25631)
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
-- TOC entry 226 (class 1259 OID 25636)
-- Name: galeri; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.galeri (
    id integer NOT NULL,
    deskripsi text NOT NULL,
    gambar_galeri character varying(255) NOT NULL
);


ALTER TABLE public.galeri OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 25641)
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
-- TOC entry 5085 (class 0 OID 0)
-- Dependencies: 227
-- Name: galeri_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.galeri_id_seq OWNED BY public.galeri.id;


--
-- TOC entry 228 (class 1259 OID 25642)
-- Name: kategori; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kategori (
    id integer NOT NULL,
    nama_kategori character varying(100) NOT NULL
);


ALTER TABLE public.kategori OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 25645)
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
-- TOC entry 5086 (class 0 OID 0)
-- Dependencies: 229
-- Name: kategori_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.kategori_id_seq OWNED BY public.kategori.id;


--
-- TOC entry 230 (class 1259 OID 25646)
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
-- TOC entry 231 (class 1259 OID 25649)
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
-- TOC entry 5087 (class 0 OID 0)
-- Dependencies: 231
-- Name: mahasiswa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mahasiswa_id_seq OWNED BY public.mahasiswa.id;


--
-- TOC entry 232 (class 1259 OID 25650)
-- Name: mahasiswa_proyek; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mahasiswa_proyek (
    id integer NOT NULL,
    mahasiswa_id integer NOT NULL,
    proyek_id integer NOT NULL
);


ALTER TABLE public.mahasiswa_proyek OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 25653)
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
-- TOC entry 5088 (class 0 OID 0)
-- Dependencies: 233
-- Name: mahasiswa_proyek_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mahasiswa_proyek_id_seq OWNED BY public.mahasiswa_proyek.id;


--
-- TOC entry 234 (class 1259 OID 25654)
-- Name: misi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.misi (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    isi_misi text NOT NULL
);


ALTER TABLE public.misi OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 25659)
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
-- TOC entry 5089 (class 0 OID 0)
-- Dependencies: 235
-- Name: misi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.misi_id_seq OWNED BY public.misi.id;


--
-- TOC entry 236 (class 1259 OID 25660)
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
-- TOC entry 237 (class 1259 OID 25665)
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
-- TOC entry 5090 (class 0 OID 0)
-- Dependencies: 237
-- Name: nilai_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.nilai_id_seq OWNED BY public.nilai.id;


--
-- TOC entry 238 (class 1259 OID 25666)
-- Name: partner; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.partner (
    id integer NOT NULL,
    nama_brand character varying(255) NOT NULL,
    gambar_brand character varying(255) NOT NULL
);


ALTER TABLE public.partner OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 25671)
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
-- TOC entry 5091 (class 0 OID 0)
-- Dependencies: 239
-- Name: partner_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.partner_id_seq OWNED BY public.partner.id;


--
-- TOC entry 240 (class 1259 OID 25672)
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
-- TOC entry 241 (class 1259 OID 25677)
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
-- TOC entry 5092 (class 0 OID 0)
-- Dependencies: 241
-- Name: pengunjung_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengunjung_id_seq OWNED BY public.pengunjung.id;


--
-- TOC entry 242 (class 1259 OID 25678)
-- Name: prodi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prodi (
    id integer NOT NULL,
    nama_prodi character varying(100) NOT NULL
);


ALTER TABLE public.prodi OWNER TO postgres;

--
-- TOC entry 243 (class 1259 OID 25681)
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
-- TOC entry 5093 (class 0 OID 0)
-- Dependencies: 243
-- Name: prodi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prodi_id_seq OWNED BY public.prodi.id;


--
-- TOC entry 244 (class 1259 OID 25682)
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
-- TOC entry 245 (class 1259 OID 25687)
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
-- TOC entry 5094 (class 0 OID 0)
-- Dependencies: 245
-- Name: sejarah_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sejarah_id_seq OWNED BY public.sejarah.id;


--
-- TOC entry 246 (class 1259 OID 25688)
-- Name: struktur_organisasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.struktur_organisasi (
    id integer NOT NULL,
    gambar_organisasi character varying(255) NOT NULL
);


ALTER TABLE public.struktur_organisasi OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 25691)
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
-- TOC entry 5095 (class 0 OID 0)
-- Dependencies: 247
-- Name: struktur_organisasi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.struktur_organisasi_id_seq OWNED BY public.struktur_organisasi.id;


--
-- TOC entry 248 (class 1259 OID 25692)
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
-- TOC entry 5096 (class 0 OID 0)
-- Dependencies: 248
-- Name: tim_kreatif_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tim_kreatif_id_seq OWNED BY public.dosen_multimedia.id;


--
-- TOC entry 249 (class 1259 OID 25693)
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
-- TOC entry 250 (class 1259 OID 25697)
-- Name: visi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.visi (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    isi_visi text NOT NULL
);


ALTER TABLE public.visi OWNER TO postgres;

--
-- TOC entry 251 (class 1259 OID 25702)
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
-- TOC entry 5097 (class 0 OID 0)
-- Dependencies: 251
-- Name: visi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.visi_id_seq OWNED BY public.visi.id;


--
-- TOC entry 4826 (class 2604 OID 25703)
-- Name: admin id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin ALTER COLUMN id SET DEFAULT nextval('public.admin_id_seq'::regclass);


--
-- TOC entry 4827 (class 2604 OID 25704)
-- Name: berita_artikel id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.berita_artikel ALTER COLUMN id SET DEFAULT nextval('public.berita_artikel_id_seq'::regclass);


--
-- TOC entry 4830 (class 2604 OID 25705)
-- Name: daftar_proyek id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.daftar_proyek ALTER COLUMN id SET DEFAULT nextval('public.daftar_proyek_id_seq'::regclass);


--
-- TOC entry 4831 (class 2604 OID 25706)
-- Name: deskripsi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.deskripsi ALTER COLUMN id SET DEFAULT nextval('public.deskripsi_id_seq'::regclass);


--
-- TOC entry 4832 (class 2604 OID 25707)
-- Name: dosen_multimedia id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen_multimedia ALTER COLUMN id SET DEFAULT nextval('public.tim_kreatif_id_seq'::regclass);


--
-- TOC entry 4833 (class 2604 OID 25708)
-- Name: galeri id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.galeri ALTER COLUMN id SET DEFAULT nextval('public.galeri_id_seq'::regclass);


--
-- TOC entry 4834 (class 2604 OID 25709)
-- Name: kategori id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori ALTER COLUMN id SET DEFAULT nextval('public.kategori_id_seq'::regclass);


--
-- TOC entry 4835 (class 2604 OID 25710)
-- Name: mahasiswa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa ALTER COLUMN id SET DEFAULT nextval('public.mahasiswa_id_seq'::regclass);


--
-- TOC entry 4836 (class 2604 OID 25711)
-- Name: mahasiswa_proyek id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa_proyek ALTER COLUMN id SET DEFAULT nextval('public.mahasiswa_proyek_id_seq'::regclass);


--
-- TOC entry 4837 (class 2604 OID 25712)
-- Name: misi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.misi ALTER COLUMN id SET DEFAULT nextval('public.misi_id_seq'::regclass);


--
-- TOC entry 4838 (class 2604 OID 25713)
-- Name: nilai id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nilai ALTER COLUMN id SET DEFAULT nextval('public.nilai_id_seq'::regclass);


--
-- TOC entry 4839 (class 2604 OID 25714)
-- Name: partner id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partner ALTER COLUMN id SET DEFAULT nextval('public.partner_id_seq'::regclass);


--
-- TOC entry 4840 (class 2604 OID 25715)
-- Name: pengunjung id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengunjung ALTER COLUMN id SET DEFAULT nextval('public.pengunjung_id_seq'::regclass);


--
-- TOC entry 4843 (class 2604 OID 25716)
-- Name: prodi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prodi ALTER COLUMN id SET DEFAULT nextval('public.prodi_id_seq'::regclass);


--
-- TOC entry 4844 (class 2604 OID 25717)
-- Name: sejarah id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sejarah ALTER COLUMN id SET DEFAULT nextval('public.sejarah_id_seq'::regclass);


--
-- TOC entry 4845 (class 2604 OID 25718)
-- Name: struktur_organisasi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.struktur_organisasi ALTER COLUMN id SET DEFAULT nextval('public.struktur_organisasi_id_seq'::regclass);


--
-- TOC entry 4846 (class 2604 OID 25719)
-- Name: visi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visi ALTER COLUMN id SET DEFAULT nextval('public.visi_id_seq'::regclass);


--
-- TOC entry 5042 (class 0 OID 25607)
-- Dependencies: 217
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.admin (id, username, password) FROM stdin;
1	admin	123
\.


--
-- TOC entry 5044 (class 0 OID 25611)
-- Dependencies: 219
-- Data for Name: berita_artikel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.berita_artikel (id, judul, isi_berita, gambar_berita, created_at, updated_at, kategori_id) FROM stdin;
1	Workshop Editing Video	Kegiatan workshop editing video dilaksanakan oleh mahasiswa semester 3.	workshop1.jpg	2025-11-26 17:14:01.54328	2025-11-26 17:14:01.54328	\N
3	Pelatihan Desain Poster	Pelatihan desain poster dengan Adobe Illustrator.	poster1.jpg	2025-11-26 17:14:01.54328	2025-11-26 17:14:01.54328	\N
4	Kunjungan Industri	Mahasiswa mengunjungi perusahaan media kreatif ternama.	kunjungan1.jpg	2025-11-26 17:14:01.54328	2025-11-26 17:14:01.54328	\N
2	Lomba Animasi Nasional	Tim animasi Polinema meraih juara 1 tingkat nasional.	animasi1.jpg	2025-11-26 17:14:01.54328	2025-11-26 17:14:01.54328	\N
\.


--
-- TOC entry 5046 (class 0 OID 25619)
-- Dependencies: 221
-- Data for Name: daftar_proyek; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.daftar_proyek (id, judul, isi_proyek, gambar_proyek, kategori_id, tahun, nama_tim) FROM stdin;
7	UI/UX 1	UI/UX1	assets/images/uploads/1764336468_6929a354a9d14.jpg	16	2025	Designer handal
6	UI/UX2	UI/UX2	assets/images/uploads/1764336563_6929a3b3bd6d3.jpg	16	2023	Designer jago
4	UI/UX3	UI/UX3	assets/images/uploads/1764336642_6929a402a765b.jpg	16	2025	Designer berkelas
3	AR/VR1	AR/VR 1	assets/images/uploads/1764336688_6929a4301ce87.png	15	2025	Bismillah Gemastik
8	AR/VR2	AR/VR 2	assets/images/uploads/1764336761_6929a479b884d.png	15	2025	Bismillah Gemastik
9	AR/VR3	AR/VR 3	assets/images/uploads/1764336810_6929a4aa2060f.png	15	2024	Bismillah Gemastik
10	Silent Hill	Silent Hill	assets/images/uploads/1764336892_6929a4fce0112.jpg	14	2023	Bismillah Gemastik
11	GTA 6	GTA 6	assets/images/uploads/1764336952_6929a5387dd86.jpg	14	2025	Bismillah Gemastik
12	Valorant	Valorant	assets/images/uploads/1764336983_6929a557ddcb0.png	14	2025	Bismillah Gemastik
13	A Plague Tale Innocence	A Plague Tale Innocence	assets/images/uploads/1764337041_6929a591cca2e.jpg	14	2025	Bismillah Gemastik
\.


--
-- TOC entry 5048 (class 0 OID 25625)
-- Dependencies: 223
-- Data for Name: deskripsi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.deskripsi (id, isi_deskripsi) FROM stdin;
\.


--
-- TOC entry 5050 (class 0 OID 25631)
-- Dependencies: 225
-- Data for Name: dosen_multimedia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dosen_multimedia (id, nama, jabatan, gambar_tim, link_linkedin, link_instagram, link_github, nidn) FROM stdin;
1	Dr. Budi Santoso	Kepala Laboratorium	dosen1.png	https://linkedin.com	https://instagram.com	https://github.com	1000000001
2	Andi Wijaya, M.Kom	Sekretaris Laboratorium	dosen2.png	https://linkedin.com	https://instagram.com	https://github.com	1000000002
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
\.


--
-- TOC entry 5051 (class 0 OID 25636)
-- Dependencies: 226
-- Data for Name: galeri; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.galeri (id, deskripsi, gambar_galeri) FROM stdin;
1	Kegiatan di Lab Multimedia	galeri1.jpg
2	Dokumentasi Belajar Editing	galeri2.jpg
3	Sesi Pemotretan Produk	galeri3.jpg
4	Kegiatan Outdoor Class	galeri4.jpg
\.


--
-- TOC entry 5053 (class 0 OID 25642)
-- Dependencies: 228
-- Data for Name: kategori; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kategori (id, nama_kategori) FROM stdin;
14	Game Development
15	AR/VR
16	UI/UX
\.


--
-- TOC entry 5055 (class 0 OID 25646)
-- Dependencies: 230
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
-- TOC entry 5057 (class 0 OID 25650)
-- Dependencies: 232
-- Data for Name: mahasiswa_proyek; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mahasiswa_proyek (id, mahasiswa_id, proyek_id) FROM stdin;
\.


--
-- TOC entry 5059 (class 0 OID 25654)
-- Dependencies: 234
-- Data for Name: misi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.misi (id, judul, isi_misi) FROM stdin;
\.


--
-- TOC entry 5061 (class 0 OID 25660)
-- Dependencies: 236
-- Data for Name: nilai; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.nilai (id, judul, gambar_nilai, deskripsi) FROM stdin;
\.


--
-- TOC entry 5063 (class 0 OID 25666)
-- Dependencies: 238
-- Data for Name: partner; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.partner (id, nama_brand, gambar_brand) FROM stdin;
\.


--
-- TOC entry 5065 (class 0 OID 25672)
-- Dependencies: 240
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
\.


--
-- TOC entry 5067 (class 0 OID 25678)
-- Dependencies: 242
-- Data for Name: prodi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prodi (id, nama_prodi) FROM stdin;
14	D4-Teknik Informatika
15	D4-Sistem Informasi Bisnis
16	D2-Pengembangan Piranti Lunak Situs
\.


--
-- TOC entry 5069 (class 0 OID 25682)
-- Dependencies: 244
-- Data for Name: sejarah; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sejarah (id, judul, isi, tahun) FROM stdin;
\.


--
-- TOC entry 5071 (class 0 OID 25688)
-- Dependencies: 246
-- Data for Name: struktur_organisasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.struktur_organisasi (id, gambar_organisasi) FROM stdin;
1	1764439401_struktur.png
\.


--
-- TOC entry 5074 (class 0 OID 25697)
-- Dependencies: 250
-- Data for Name: visi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.visi (id, judul, isi_visi) FROM stdin;
\.


--
-- TOC entry 5098 (class 0 OID 0)
-- Dependencies: 218
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admin_id_seq', 1, true);


--
-- TOC entry 5099 (class 0 OID 0)
-- Dependencies: 220
-- Name: berita_artikel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.berita_artikel_id_seq', 4, true);


--
-- TOC entry 5100 (class 0 OID 0)
-- Dependencies: 222
-- Name: daftar_proyek_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.daftar_proyek_id_seq', 13, true);


--
-- TOC entry 5101 (class 0 OID 0)
-- Dependencies: 224
-- Name: deskripsi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.deskripsi_id_seq', 1, false);


--
-- TOC entry 5102 (class 0 OID 0)
-- Dependencies: 227
-- Name: galeri_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.galeri_id_seq', 4, true);


--
-- TOC entry 5103 (class 0 OID 0)
-- Dependencies: 229
-- Name: kategori_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kategori_id_seq', 16, true);


--
-- TOC entry 5104 (class 0 OID 0)
-- Dependencies: 231
-- Name: mahasiswa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mahasiswa_id_seq', 250, true);


--
-- TOC entry 5105 (class 0 OID 0)
-- Dependencies: 233
-- Name: mahasiswa_proyek_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mahasiswa_proyek_id_seq', 1, false);


--
-- TOC entry 5106 (class 0 OID 0)
-- Dependencies: 235
-- Name: misi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.misi_id_seq', 1, false);


--
-- TOC entry 5107 (class 0 OID 0)
-- Dependencies: 237
-- Name: nilai_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.nilai_id_seq', 1, false);


--
-- TOC entry 5108 (class 0 OID 0)
-- Dependencies: 239
-- Name: partner_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.partner_id_seq', 1, true);


--
-- TOC entry 5109 (class 0 OID 0)
-- Dependencies: 241
-- Name: pengunjung_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengunjung_id_seq', 22, true);


--
-- TOC entry 5110 (class 0 OID 0)
-- Dependencies: 243
-- Name: prodi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prodi_id_seq', 16, true);


--
-- TOC entry 5111 (class 0 OID 0)
-- Dependencies: 245
-- Name: sejarah_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sejarah_id_seq', 2, true);


--
-- TOC entry 5112 (class 0 OID 0)
-- Dependencies: 247
-- Name: struktur_organisasi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.struktur_organisasi_id_seq', 1, true);


--
-- TOC entry 5113 (class 0 OID 0)
-- Dependencies: 248
-- Name: tim_kreatif_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tim_kreatif_id_seq', 15, true);


--
-- TOC entry 5114 (class 0 OID 0)
-- Dependencies: 251
-- Name: visi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.visi_id_seq', 1, false);


--
-- TOC entry 4848 (class 2606 OID 25721)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id);


--
-- TOC entry 4850 (class 2606 OID 25723)
-- Name: admin admin_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_username_key UNIQUE (username);


--
-- TOC entry 4852 (class 2606 OID 25725)
-- Name: berita_artikel berita_artikel_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.berita_artikel
    ADD CONSTRAINT berita_artikel_pkey PRIMARY KEY (id);


--
-- TOC entry 4854 (class 2606 OID 25727)
-- Name: daftar_proyek daftar_proyek_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.daftar_proyek
    ADD CONSTRAINT daftar_proyek_pkey PRIMARY KEY (id);


--
-- TOC entry 4856 (class 2606 OID 25729)
-- Name: deskripsi deskripsi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.deskripsi
    ADD CONSTRAINT deskripsi_pkey PRIMARY KEY (id);


--
-- TOC entry 4858 (class 2606 OID 25731)
-- Name: dosen_multimedia dosen_multimedia_nidn_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen_multimedia
    ADD CONSTRAINT dosen_multimedia_nidn_key UNIQUE (nidn);


--
-- TOC entry 4862 (class 2606 OID 25733)
-- Name: galeri galeri_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.galeri
    ADD CONSTRAINT galeri_pkey PRIMARY KEY (id);


--
-- TOC entry 4864 (class 2606 OID 25735)
-- Name: kategori kategori_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori
    ADD CONSTRAINT kategori_pkey PRIMARY KEY (id);


--
-- TOC entry 4866 (class 2606 OID 25737)
-- Name: mahasiswa mahasiswa_nim_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT mahasiswa_nim_key UNIQUE (nim);


--
-- TOC entry 4868 (class 2606 OID 25739)
-- Name: mahasiswa mahasiswa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT mahasiswa_pkey PRIMARY KEY (id);


--
-- TOC entry 4870 (class 2606 OID 25741)
-- Name: mahasiswa_proyek mahasiswa_proyek_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa_proyek
    ADD CONSTRAINT mahasiswa_proyek_pkey PRIMARY KEY (id);


--
-- TOC entry 4874 (class 2606 OID 25743)
-- Name: misi misi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.misi
    ADD CONSTRAINT misi_pkey PRIMARY KEY (id);


--
-- TOC entry 4876 (class 2606 OID 25745)
-- Name: nilai nilai_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nilai
    ADD CONSTRAINT nilai_pkey PRIMARY KEY (id);


--
-- TOC entry 4878 (class 2606 OID 25747)
-- Name: partner partner_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partner
    ADD CONSTRAINT partner_pkey PRIMARY KEY (id);


--
-- TOC entry 4880 (class 2606 OID 25749)
-- Name: pengunjung pengunjung_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengunjung
    ADD CONSTRAINT pengunjung_pkey PRIMARY KEY (id);


--
-- TOC entry 4884 (class 2606 OID 25751)
-- Name: prodi prodi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prodi
    ADD CONSTRAINT prodi_pkey PRIMARY KEY (id);


--
-- TOC entry 4886 (class 2606 OID 25753)
-- Name: sejarah sejarah_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sejarah
    ADD CONSTRAINT sejarah_pkey PRIMARY KEY (id);


--
-- TOC entry 4888 (class 2606 OID 25755)
-- Name: struktur_organisasi struktur_organisasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.struktur_organisasi
    ADD CONSTRAINT struktur_organisasi_pkey PRIMARY KEY (id);


--
-- TOC entry 4860 (class 2606 OID 25757)
-- Name: dosen_multimedia tim_kreatif_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen_multimedia
    ADD CONSTRAINT tim_kreatif_pkey PRIMARY KEY (id);


--
-- TOC entry 4872 (class 2606 OID 25759)
-- Name: mahasiswa_proyek uniq_mahasiswa_proyek; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa_proyek
    ADD CONSTRAINT uniq_mahasiswa_proyek UNIQUE (mahasiswa_id, proyek_id);


--
-- TOC entry 4882 (class 2606 OID 25761)
-- Name: pengunjung unique_visit_per_day; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengunjung
    ADD CONSTRAINT unique_visit_per_day UNIQUE (ip_address, tanggal);


--
-- TOC entry 4890 (class 2606 OID 25763)
-- Name: visi visi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visi
    ADD CONSTRAINT visi_pkey PRIMARY KEY (id);


--
-- TOC entry 4891 (class 2606 OID 25764)
-- Name: berita_artikel berita_artikel_kategori_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.berita_artikel
    ADD CONSTRAINT berita_artikel_kategori_id_fkey FOREIGN KEY (kategori_id) REFERENCES public.kategori(id) ON DELETE SET NULL;


--
-- TOC entry 4892 (class 2606 OID 25769)
-- Name: daftar_proyek daftar_proyek_kategori_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.daftar_proyek
    ADD CONSTRAINT daftar_proyek_kategori_id_fkey FOREIGN KEY (kategori_id) REFERENCES public.kategori(id) ON DELETE SET NULL;


--
-- TOC entry 4893 (class 2606 OID 25774)
-- Name: mahasiswa mahasiswa_prodi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT mahasiswa_prodi_id_fkey FOREIGN KEY (prodi_id) REFERENCES public.prodi(id) ON DELETE CASCADE;


--
-- TOC entry 4894 (class 2606 OID 25779)
-- Name: mahasiswa_proyek mahasiswa_proyek_mahasiswa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa_proyek
    ADD CONSTRAINT mahasiswa_proyek_mahasiswa_id_fkey FOREIGN KEY (mahasiswa_id) REFERENCES public.mahasiswa(id) ON DELETE CASCADE;


--
-- TOC entry 4895 (class 2606 OID 25784)
-- Name: mahasiswa_proyek mahasiswa_proyek_proyek_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa_proyek
    ADD CONSTRAINT mahasiswa_proyek_proyek_id_fkey FOREIGN KEY (proyek_id) REFERENCES public.daftar_proyek(id) ON DELETE CASCADE;


-- Completed on 2025-12-01 03:11:22

--
-- PostgreSQL database dump complete
--

