<?php
$handle = fopen("tags", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $line = preg_replace('/[^a-zA-Z0-9\.\-\:]/','', $line);

        /*$elem = str_replace("'", '', $line);
        $elem = str_replace("$\n", '', $elem);*/

        $version = explode(':', $line);
        $versionElems = explode('-', $version[1]);

        $path = $version[0] . '-dev';

        if ($versionElems) {
            foreach ($versionElems as $elem) {
                $path .= '/' . $elem;
            }
        }

        if (!is_dir($path) && !mkdir($path,0775, true)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
        }

        $content = file_get_contents('Dockerfile.template');
        $content = str_replace('{{ env.wordpressTag }}', $line, $content);
        file_put_contents($path.'/Dockerfile', $content);
    }

    fclose($handle);
}