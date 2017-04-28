<?

if ($_FILES['upload']) {
    if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name']))) {
        $message = "Вы не выбрали файл";
    } else if ($_FILES['upload']["size"] == 0 OR $_FILES['upload']["size"] > 4050000) {
        $message = "Размер файла не соответствует нормам";
    } else if (($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png")) {
        $message = "Допускается загрузка только картинок JPG и PNG.";
    } else if (!is_uploaded_file($_FILES['upload']["tmp_name"])) {
        $message = "Что-то пошло не так. Попытайтесь загрузить файл ещё раз.";
    } else {
        $extension = strtolower(pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION));
        $name = 'art-' . rand(1, 100000) . '-' . md5($_FILES['upload']['name']) . '.' . $extension;

        if (!move_uploaded_file($_FILES['upload']['tmp_name'], "template/img/articles/" . $name)) {
            $message = "Изображение не было загружено. Попробуйте позже или выберите новое";
        }

        $full_path = '/template/img/articles/' . $name;
        $message = "Файл " . $_FILES['upload']['name'] . " загружен";
    }

    $callback = $_REQUEST['CKEditorFuncNum'];
    echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("' . $callback . '", "' . $full_path . '", "' . $message . '" );</script>';
}
?>