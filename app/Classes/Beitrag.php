<?php
declare(strict_types=1);
namespace MHN\Akademie;

/**
 * Created by PhpStorm.
 * User: guido
 * Date: 04.08.17
 * Time: 21:19
 */
class Beitrag
{
    private $data = null;

    // Felder und Defaults
    const felder = [
        'vid' => null, 'referenten' => [], 'vTitel' => '', 'beitragsform' => '',
        'beitragssprache' => '', 'beschrTeilnehmeranzahl' => '', 'maxTeilnehmeranzahl' => '', 'abstract' => '', 'programm_raum' => '', 'programm_beginn' => null, 'programm_ende' => null];

    /**
     * privater Konstruktor, um das direkte Erstellen von Objekten zu verhindern
     * Benutze die Funktion Vortrag::lade($vid)
     */
    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function set($feld, $value)
    {
        if (in_array($feld, array_keys(self::felder))) {
            $this->data[$feld] = $value;
        }
    }

    /**
     * Liest eine Eigenschaft
     */
    public function get($feld)
    {
        switch ($feld) {
            case 'beitragsform':
                switch ($this->data['beitragsform']) {
                    case 'w': return 'Workshop'; break;
                    case 's': return 'Sonstiges'; break;
                    case 'r': return 'Rahmenprogramm'; break;
                    default: return 'Vortrag'; break;
                }
                break;
            case 'programm_beginn':
            case 'programm_ende':
                $value = $this->data[$feld];
                if (!$value) {
                    return null;
                } elseif (is_array($value)) {
                    return new \DateTime($value['date'], new \DateTimeZone($value['timezone']));
                } else {
                    return new \DateTime($value);
                }
            default:
                if (isset($this->data[$feld])) return $this->data[$feld];
                else if (in_array($feld, array_keys(self::felder))) return null;     // Eigenschaft existiert, aber ist null
                else die("Unbekannte Eigenschaft: " . $feld);
        }
    }
}
