<?php
//declare(strict_types=1);
namespace MHN\Akademie;

use Parsedown;

/**
 * @author Henrik Gebauer <mensa@henrik-gebauer.de>
 * @license https://creativecommons.org/publicdomain/zero/1.0/ CC0 1.0
 */

// Für Frontend-Skripte: Buffering aktivieren
if (!defined('no_output_buffering')) {
    ob_start();

    register_shutdown_function(function () {
        Tpl::onShutdown();
    });
}

/**
 * Output-Buffering und Template-Engine
 */
class Tpl
{
    const TEMPLATES_PATH = __DIR__ . '/../Resources/Private/Templates';

    private static $vars = ['htmlHead' => '', 'htmlBody' => '', 'htmlFoot' => ''];
    private static $headSent = false;
    private static $bodySent = false;

    public static $bodyTmp = '';
    public static $disableOnShutdown = false;

    /**
     * Setzt eine Variable*
     *
     * @param string $var
     * @param mixed $val
     * @param bool $escape HTML-Kontrollzeichen ersetzen (bei arrays auch rekursiv)
     * @throws \InvalidArgumentException Wenn $val ein Objekt enthält und $escape==true ist
     */
    public static function set(string $var, $val, $escape = true)
    {
        if ($escape) {
            if (is_array($val)) {
                array_walk_recursive($val, function (&$v) {
                    if (is_object($v) && !in_array(get_class($v), ['DateTime'], true)) {
                        throw new \InvalidArgumentException('Nicht unterstütztes Objekt an Tpl::set() mit $escape==true übergeben.', 1493681395);
                    } elseif (is_string($v)) {
                        $v = htmlspecialchars($v);
                    }
                });
            } elseif (is_string($val)) {
                $val = htmlspecialchars($val);
            } elseif (is_object($val) && !in_array(get_class($val), ['DateTime'], true)) {
                throw new \InvalidArgumentException('Nicht unterstütztes Objekt an Tpl::set() mit $escape==true übergeben.', 1493681418);
            }
        }
        self::$vars[$var] = $val;
    }

    public static function push($var, $val)
    {
        if (!isset(self::$vars[$var])) {
            self::$vars[$var] = [];
        }
        self::$vars[$var][] = $val;
    }

    /**
     * Fügt einen String zum HTML-Head hinzu
     * @param string $text
     */
    public static function headPut($text)
    {
        self::$vars['htmlHead'] .= $text;
    }

    /**
     * Zwischen den Aufrufen von headStart() und headEnd() werden Ausgaben in den Head geschrieben (z.B. CSS)
     */
    public static function headStart()
    {
        ob_start();
    }

    public static function headEnd()
    {
        self::headPut(ob_get_contents());
        ob_end_clean();
    }

    /**
     * Fügt einen String zum HTML-Foot hinzu
     * @param string $text
     */
    public static function footPut($text)
    {
        self::$vars['htmlFoot'] .= $text;
    }

    /**
     * Zwischen den Aufrufen von footStart() und footEnd() werden Ausgaben ans Ende des Footers gehängt (z.B. Javascript)
     */
    public static function footStart()
    {
        ob_start();
    }

    public static function footEnd()
    {
        self::footPut(ob_get_contents());
        ob_end_clean();
    }

    /**
     * Sendet den HTML-Head.
     * Sollte möglichst früh ausgelöst werden, damit der Client schonmal das CSS laden kann.
     * wird ggf. automatisch von submit ausgelöst
     */
    public static function sendHead()
    {
        if (self::$headSent) {
            return;
        }

        // Ausgabe des Bodys unterbrechen
        $body = ob_get_contents();
        ob_end_clean();

        // Head senden
        self::render('Layout/htmlHead');
        flush();
        self::$headSent = true;

        // Ausgabe des Bodys fortsetzen
        ob_start();
        echo $body;
    }

    /**
     * Sendet den HTML-Fuß.
     */
    public static function sendFoot()
    {
        self::render('Layout/htmlFoot');
    }

    /**
     * Stellt die komplette Seite im Standard-Layout dar
     * $layout ist das Layout-Template
     * @param string $layout
     */
    public static function submit($layout = 'Layout/layout')
    {
        if (self::$bodySent) {
            return;
        }
        self::$vars['htmlBody'] = ob_get_contents();

        ob_end_clean();

        if (empty(self::$vars['title'])) {
            self::$vars['title'] = '';
            if (preg_match('/<h1>(.*?)<\/h1>/', self::$vars['htmlBody'], $matches)) {
                self::$vars['htmlBody'] = preg_replace('/<h1>(.*?)<\/h1>/', '', self::$vars['htmlBody'], 1);
                self::$vars['title'] = $matches[1];
            }
        }
        if (empty(self::$vars['htmlTitle'])) {
            self::$vars['htmlTitle'] = self::$vars['title'];
        }

        self::sendHead();
        self::render($layout);
        self::sendFoot();
        self::$bodySent = true;
    }

    /**
     * Stellt ein Template dar.
     *
     * @param string $tpl
     * @throws \UnexpectedValueException wenn das Template nicht existiert
     */
    public static function render($tpl)
    {
        if (is_file(self::TEMPLATES_PATH . "/$tpl.tpl.php")) {
            extract(self::$vars);
            include self::TEMPLATES_PATH . "/$tpl.tpl.php";
        } elseif (is_file(self::TEMPLATES_PATH . "/$tpl.md") || is_file(self::TEMPLATES_PATH . "/$tpl.txt") || is_file(self::TEMPLATES_PATH . "/$tpl.html")) {
            $output = '';
            if (is_file(self::TEMPLATES_PATH . "/$tpl.md")) {
                $output = (new Parsedown())->text(file_get_contents(self::TEMPLATES_PATH . "/$tpl.md"));
            } elseif (is_file(self::TEMPLATES_PATH . "/$tpl.html")) {
                $output = file_get_contents(self::TEMPLATES_PATH . "/$tpl.html");
            } else {
                $output = file_get_contents(self::TEMPLATES_PATH . "/$tpl.txt");
            }

            // Variablen {$name} ersetzen
            $output = preg_replace_callback('/\{\$([a-z0-9_]+)\}/is', function ($m) use ($tpl) {
                if (!isset(self::$vars[$m[1]])) {
                    throw new \unexpectedvalueexception('Variable ' . $m[1] . ', benötigt in Template ' . $tpl . ', ist nicht gesetzt');
                }
                return self::$vars[$m[1]];
            }, $output);

            echo $output;
        } else {
            throw new \UnexpectedValueException("Template $tpl existiert nicht.", 1493681481);
        }
    }

    /**
     * Generiert ein Inhaltsverzeichnis
     *
     * @param string $tpl Markdown-Template
     * @throws \UnexpectedValueException wenn das Template nicht existiert
     */
    public static function getTableOfContents($tpl)
    {
        if (is_file(self::TEMPLATES_PATH . "/$tpl.tpl.php") || is_file(self::TEMPLATES_PATH . "/$tpl.txt") || is_file(self::TEMPLATES_PATH . "/$tpl.html")) {
            throw new \UnexpectedValueException("Inhaltsverzeichnis können nur für Markdown-Templates generiert werden.", 1560617128);
        } elseif (!is_file(self::TEMPLATES_PATH . "/$tpl.md")) {
            throw new \UnexpectedValueException("Template $tpl existiert nicht.", 1560617129);
        }

        $toc = '';
        $inContents = false;
        foreach (file(self::TEMPLATES_PATH . "/$tpl.md") as $line) {
            $line = trim($line);

            if (!$inContents) {
                if ($line === '<!-- begin contents -->') {
                    $inContents = true;
                } else {
                    continue;
                }
            }

            if ($line === '<!-- end contents -->') {
                $inContents = false;
                break;
            }

            if (preg_match('/^## (<a name="(.*?)"><\\/a> )?(.*?)$/', $line, $matches)) {
                if ($toc) {
                    $toc .= "</ul>\n";
                }
                if ($matches[1]) {
                    $toc .= "<h2><a href='#" . htmlspecialchars($matches[2], ENT_QUOTES) . "'>" . htmlspecialchars($matches[3], ENT_QUOTES) . "</h2>\n<ul>";
                } else {
                    $toc .= "<h2>" . htmlspecialchars($matches[3], ENT_QUOTES) . "</h2>\n<ul>";
                }
            }

            if (preg_match('/^### <a name="(.*?)"><\\/a> (.*?)$/', $line, $matches)) {
                $toc .= "   <li><a href='#" . htmlspecialchars($matches[1], ENT_QUOTES) . "'>" . htmlspecialchars($matches[2], ENT_QUOTES) . "</a></li>\n";
            }
        }

        if ($toc) {
            $toc .= "</ul>\n";
        }

        return $toc;
    }

    /**
     * Spätestens am Ende der Skriptausführung muss die Seite gerendert werden.
     */
    public static function onShutdown()
    {
        if (!self::$disableOnShutdown) {
            self::submit();
        }
    }

    /**
     * Output-Buffering unterbrechen
     */
    public static function pause()
    {
        self::$bodyTmp = ob_get_contents();
        self::$disableOnShutdown = true;
        ob_end_clean();
    }

    /**
     * Output-Buffering wieder aufnehmen
     */
    public static function resume()
    {
        ob_start();
        echo self::$bodyTmp;
        self::$disableOnShutdown = false;
    }
}
