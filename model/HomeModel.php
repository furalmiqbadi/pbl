<?php
require_once __DIR__ . '/../lib/Connection.php';

class HomeModel {
    private ?PDO $db;

    public function __construct() {
        $this->db = Connection::getConnection();
    }

    public function getHero(): array {
        $fallback = [
            'title' => 'Selamat Datang di Lab Multimedia',
            'subtitle' => 'Bangun pengalaman interaktif lewat game, UI/UX, dan AR/VR.',
            'cta' => 'Kenali Kami',
            'image' => 'assets/images/mmtLogo.png',
        ];

        if ($this->db === null) {
            return $fallback;
        }

        try {
            $sql = "SELECT title, subtitle, cta_label, cta, image_path, image FROM hero LIMIT 1";
            $stmt = $this->db->query($sql);
            if ($stmt) {
                $row = $stmt->fetch();
                if ($row) {
                    return [
                        'title' => trim($row['title'] ?? '') ?: $fallback['title'],
                        'subtitle' => trim($row['subtitle'] ?? '') ?: $fallback['subtitle'],
                        'cta' => trim($row['cta_label'] ?? $row['cta'] ?? '') ?: $fallback['cta'],
                        'image' => trim($row['image_path'] ?? $row['image'] ?? '') ?: $fallback['image'],
                    ];
                }
            }
        } catch (Throwable $e) {
            // gunakan fallback
        }

        return $fallback;
    }

    public function getFokus(): array {
        $fallback = [
            ['title' => 'Game Development', 'text' => 'Rancang gameplay, art, dan deployment multi-platform.'],
            ['title' => 'UI/UX Design', 'text' => 'Prototyping, usability testing, dan design system yang konsisten.'],
            ['title' => 'AR/VR', 'text' => 'Immersive experience untuk training, edukasi, dan hiburan.'],
        ];

        if ($this->db === null) {
            return $fallback;
        }

        try {
            $sql = "SELECT title, description, text FROM fokus ORDER BY COALESCE(position, sort_order, 999999), id";
            $stmt = $this->db->query($sql);
            if ($stmt) {
                $rows = $stmt->fetchAll();
                $data = [];
                foreach ($rows as $row) {
                    $data[] = [
                        'title' => trim($row['title'] ?? '') ?: 'Tanpa Judul',
                        'text' => trim($row['description'] ?? $row['text'] ?? '') ?: '',
                    ];
                }
                if (!empty($data)) {
                    return $data;
                }
            }
        } catch (Throwable $e) {
            // fallback
        }

        return $fallback;
    }

    public function getKarya(): array {
        $fallback = [
            ['title' => 'Project A', 'category' => 'Game', 'image' => 'assets/images/jtiLogo.png'],
            ['title' => 'Project B', 'category' => 'UI/UX', 'image' => 'assets/images/jtiLogo.png'],
            ['title' => 'Project C', 'category' => 'AR/VR', 'image' => 'assets/images/jtiLogo.png'],
        ];

        if ($this->db === null) {
            return $fallback;
        }

        try {
            $sql = "SELECT title, category, image_path, thumbnail, image FROM karya ORDER BY created_at DESC, id DESC";
            $stmt = $this->db->query($sql);
            if ($stmt) {
                $rows = $stmt->fetchAll();
                $data = [];
                foreach ($rows as $row) {
                    $data[] = [
                        'title' => trim($row['title'] ?? '') ?: 'Tanpa Judul',
                        'category' => trim($row['category'] ?? '') ?: 'Lainnya',
                        'image' => trim($row['image_path'] ?? $row['thumbnail'] ?? $row['image'] ?? ''),
                    ];
                }
                if (!empty($data)) {
                    return $data;
                }
            }
        } catch (Throwable $e) {
            // fallback
        }

        return $fallback;
    }

    public function getArtikel(): array {
        $fallback = [
            ['title' => 'Artikel 1', 'date' => '2025-08-12', 'excerpt' => 'Consectetur adipiscing elit. Integer semper mattis nulla.', 'image' => 'assets/images/jtiLogo.png'],
            ['title' => 'Artikel 2', 'date' => '2025-08-12', 'excerpt' => 'Aliquam erat volutpat. Proin sit amet eros sed lorem.', 'image' => 'assets/images/jtiLogo.png'],
            ['title' => 'Artikel 3', 'date' => '2025-08-12', 'excerpt' => 'Pellentesque vel feugiat turpis purus.', 'image' => 'assets/images/jtiLogo.png'],
        ];

        if ($this->db === null) {
            return $fallback;
        }

        try {
            $sql = "SELECT title, published_at, date, excerpt, summary, image_path, image FROM artikel ORDER BY published_at DESC, id DESC";
            $stmt = $this->db->query($sql);
            if ($stmt) {
                $rows = $stmt->fetchAll();
                $data = [];
                foreach ($rows as $row) {
                    $rawDate = $row['published_at'] ?? $row['date'] ?? null;
                    $displayDate = $rawDate;
                    if ($rawDate) {
                        $timestamp = strtotime($rawDate);
                        if ($timestamp !== false) {
                            $displayDate = date('Y-m-d', $timestamp);
                        }
                    }

                    $data[] = [
                        'title' => trim($row['title'] ?? '') ?: 'Tanpa Judul',
                        'date' => $displayDate ?: '',
                        'excerpt' => trim($row['excerpt'] ?? $row['summary'] ?? '') ?: '',
                        'image' => trim($row['image_path'] ?? $row['image'] ?? ''),
                    ];
                }
                if (!empty($data)) {
                    return $data;
                }
            }
        } catch (Throwable $e) {
            // fallback
        }

        return $fallback;
    }

    public function getGallery(): array {
        $fallback = [
            ['image' => 'assets/images/jtiLogo.png'],
            ['image' => 'assets/images/mmtLogo.png'],
            ['image' => 'assets/images/jtiLogo.png'],
            ['image' => 'assets/images/mmtLogo.png'],
            ['image' => 'assets/images/jtiLogo.png'],
            ['image' => 'assets/images/mmtLogo.png'],
            ['image' => 'assets/images/jtiLogo.png'],
            ['image' => 'assets/images/mmtLogo.png'],
        ];

        if ($this->db === null) {
            return $fallback;
        }

        try {
            $sql = "SELECT image_path, image FROM gallery ORDER BY created_at DESC, id DESC";
            $stmt = $this->db->query($sql);
            if ($stmt) {
                $rows = $stmt->fetchAll();
                $data = [];
                foreach ($rows as $row) {
                    $src = trim($row['image_path'] ?? $row['image'] ?? '');
                    if ($src !== '') {
                        $data[] = ['image' => $src];
                    }
                }
                if (!empty($data)) {
                    return $data;
                }
            }
        } catch (Throwable $e) {
            // fallback
        }

        return $fallback;
    }

    public function getGalleryRows(): array {
        $items = $this->getGallery();
        // Pastikan tersedia minimal 16 item untuk 2 baris penuh
        while (count($items) < 16) {
            $items = array_merge($items, $items);
        }
        $top = array_slice($items, 0, 8);
        $bottom = array_slice($items, 8, 8);
        return ['top' => $top, 'bottom' => $bottom];
    }
}
