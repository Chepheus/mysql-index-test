<?php

try {
    $pdo = new PDO("mysql:host=mysql;dbname=test;port=3306;charset=utf8", 'test', 'test', [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    function placeholders($text, $count = 0, $separator = ','){
        $result = [];
        if($count > 0){
            for($x = 0; $x < $count; $x++){
                $result[] = $text;
            }
        }

        return implode($separator, $result);
    }

    $data = [];
    for ($i = 0; $i < 10000; $i++) {
        $email = uniqid('', true) . '@test.com';
        $first_name = uniqid('', true);
        $last_name = uniqid('', true);
        $role_id = random_int(1, 3);
        $birthday = (new DateTime())->sub(new DateInterval('P' . random_int(1, 1000) . 'DT' . random_int(1, 23) . 'H'));

        $data[] = [$email, $first_name, $last_name, $role_id, $birthday->format('Y-m-d H:i:s')];
    }

    $pdo->beginTransaction(); // also helps speed up your inserts.
    $insert_values = [];
    $datafields = ['email', 'first_name', 'last_name', 'role_id', 'birthday'];

    foreach($data as $d) {
        $question_marks[] = '('  . placeholders('?', count($d)) . ')';
        $insert_values = array_merge($insert_values, array_values($d));
    }

    $sql = "INSERT INTO users (" . implode(',', $datafields ) . ") VALUES " .
        implode(',', $question_marks);

    $stmt = $pdo->prepare ($sql);
    try {
        $stmt->execute($insert_values);
    } catch (PDOException $e){
        echo $e->getMessage();
    }
    $pdo->commit();

}
catch (\Exception $e) {
    var_dump($e->getMessage());
    exit;
}