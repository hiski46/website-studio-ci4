<?php

use function PHPUnit\Framework\isNan;

/**
 * Get Bootstrap Icon (https://icons.getbootstrap.com/)
 * @param string $icon icon class, contoh '0-circle'
 * 
 * @return string svg script
 */
function icon($icon, $w = 16, $h = 16)
{
    $icon = file_get_contents(ROOTPATH . 'public/icon/' . $icon . '.svg');
    $dom = new DOMDocument();
    $dom->loadXML($icon);
    $icon_new = $dom->getElementsByTagName('svg')[0];
    $icon_new->setAttribute("width", $w);
    $icon_new->setAttribute("height", $h);
    return $icon_new->C14N();
}


/**
 * Mengecek apakah halaman yang dibuka adalah menu yang dipilih.
 * @param string $key nama path yang ingin dicek
 * @param int $segment urutan segment yang ingin dicek (segment[1] = index.pxp )
 * 
 * @return string
 */
function isAktif($key, $segment = 2)
{
    if ($key === current_url(true)->getSegment($segment)) {
        return 'active';
    }
    return false;
}


/**
 * Print Breadcrumb
 * untuk mengubah nama url yang ditampilakan pada breadcrumb bisa dilakukan pada "App\Config\Breadcrump.php"
 * @return string
 */
function breadcrumb()
{

    $Config = new Config\Breadcrumb();
    $listUrl = $Config->listUrl;
    $url = str_replace(base_url() . '/index.php' . '/', '', current_url());
    $urlArr = explode('/', $url);
    $html = '<nav style="--bs-breadcrumb-divider: ' . "'/'" . ';" aria-label="breadcrumb">
        <ol class="breadcrumb">';
    for ($i = 0; $i < count($urlArr); $i++) {
        $url = $urlArr[$i];
        if (isset($listUrl[$url])) {
            $url = lang($listUrl[$url]);
        }
        $url = ucwords($url);
        if ($i == 0) {
            $html .= ' <li class="breadcrumb-item"><a class="breadcoumb" href="/dashboard">Dashboard</a></li>';
        }
        if ($i == count($urlArr) - 1) {
            if ((int)$urlArr[$i] == 0) {
                $html .= '<li class="breadcrumb-item active" aria-current="page">' . $url . '</li>';
            }
        } else {
            if ((int)$urlArr[$i + 1] > 0) {
                $html .= '<li class="breadcrumb-item active" aria-current="page">' . $url . '</li>';
            } else {
                $html .= ' <li class="breadcrumb-item"><a class="breadcoumb" href="/' . $urlArr[$i] . '">' . $url . '</a></li>';
            }
        }
    }
    $html .= '</>
    </nav>';

    echo $html;
}

/** Mencari Data berdasarkan id 
 * ini untuk mengakali eager load di CI4
 * @param array $data array yang ingin ditelusuri
 * @param int $id id yang dicar
 * 
 * @return array
 */
function findById($data, $id)
{
    $result = array_filter($data, fn ($val) => $val->id == $id);
    return array_values($result);
}

function nilaiUang($nilai)
{
    return number_format($nilai, 0, ',', '.');
}
