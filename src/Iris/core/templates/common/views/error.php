<!DOCTYPE html>
<html>
<body>
    <p>Ошибка:
        <?php
            echo isset($data['errorMessage']) ? $data['errorMessage'] : '';
        ?>
    </p>
</body>
</html>