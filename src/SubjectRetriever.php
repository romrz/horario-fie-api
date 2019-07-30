<?php 

/*
    Retrieves the raw HTML that contains
    the subject information
*/
class SubjectRetriever
{
    const URL = 'https://escolar.fie.umich.mx/actual/estudiante/materia-rom.php';

    public static function all()
    {
        $fields = [
            'materia' => $subjectId,
        ];

        $connection = new CurlPersistentConnection;
        $html = $connection->get(self::URL, $fields); // Subject info request

        return $html;
    }

    public static function get($subjectId)
    {
        $connection = new CurlPersistentConnection;
        $html = $connection->get(self::URL . '?materia=' . $subjectId);

        return $html;
    }
}