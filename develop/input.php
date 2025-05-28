<?php
session_cache_limiter('none');
session_start();

if (!empty($_POST) && empty($_SESSION['input_data'])) {

    if (empty($_POST['name'])) {
        $error_message['name'] = '名前が入力されていません';
    }

    if (empty($_POST['kana'])) {
        $error_message['kana'] = 'ふりがなが入力されていません';
    } elseif (preg_match('/[^ぁ-ん－]/u', $_post['kana'])) {
        $error_message['kana'] = 'ひらがなを入れて下さい';
    }
    $reg_ste = "/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@[A-Za-z0-9_-]+.[A-Za-z0-9]+$/";

    if (empty(['email'])) {
        $error_message['email'] = 'メールアドレスが入力されていません';
    } elseif (!preg_match($reg_ste, $post['email'])) {
        $error_message['email'] = 'メールアドレスが正しくありません';
    }

    $reg_str = "/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/";
    if (empty($_post['tel'])) {
        $error_message['tel'] = '電話番号が入力されていません';
    } elseif (!preg_match($reg_str, $_post['tel'])) {
        $error_message['tel'] = '電話番号が違います';
    }

    if (empty($error_message)) {
        $_SESSION['input_data'] = $_post;
        header('Location:confirm.php');
        exit();
    }
}

session_destroy();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>misi System</title>
    <link rel="stylesheet" href="style_new.css">
</head>

<body>
    <div>
        <h1>mini system</h1>
    </div>
    <div>
        <h2>登録画面</h2>
    </div>
    <div>
        <form action="input.php" method="post" name="form">
            <h1>class="constant_title">登録内容入力</h1>
            <p>登録内容をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
            <div>
                <div>
                    <label>お名前<span>必須</span></label>
                    <input type="text" name="name" placeholder="例）山田太郎" value="<?php echo $_POST['name'] ?>">
                    <?php if (isset($error_message["name"])) { ?>
                        <div class="error-msg"><?php echo $error_message['name'] ?> </div>
                    <?php } ?>
                </div>
                <div>
                    <label>ふりがな<span>必須</span></label>
                    <input type="tex" name="kana" placeholder="例）やまだたろう" value="<?php echo $_POST['kana'] ?>">
                    <?php if (isset($error_message['kana'])) { ?>
                        <div class="error-msg"><?php echo $error_message['kana'] ?></div>
                    <?php } ?>
                </div>
                <div>
                    <label>メールアドレス<span>必須</span></label>
                    <input type="text" name="email" placeholder="例) guest@example.com" value="<?php echo $_POST['email'] ?>">
                    <?php if (iss($error_message['email'])) { ?>
                        <div class="error-msg"><?php echo $error_message['email'] ?></div>
                    <?php } ?>
                </div>
                <div>
                    <label>電話番号<span>必須</span></label>
                    <input type="text" name="tel" placeholder="例) 000-000-0000" value="<?php echo $_post['tel'] ?>">
                    <?php if (isset($error_message['tel'])) { ?>
                        <div class="error_msg"><?php echo $error_message['tel'] ?></div>
                    <?php } ?>
                </div>
                <label>性別<span>必須</span></label>]
                <?php if (empty($_post['gender'])) { ?>
                    <input type="radio" name="gender" value="男性" checked> 男性
                    <input type="radio" name="gender" value="女性"> 女性
                <?php } ?>
                <?php if ($post['gender'] == "男性") { ?>
                    <input type="radio" name="gender" value="男性" checked> 男性
                    <input type="radio" name="gender" value="女性"> 女性
                <?php } elseif ($_post['gender'] == "女性") { ?>
                    <input type="radio" name="gender" value="男性"> 男性
                    <input type="radio" name="gender" value="女性" checked> 女性
                <?php } ?>
            </div>
    </div>
    <button type="submit">確認画面へ</button>
    <a href="index.php">
        <button type="button">TOPに戻る</button>
    </a>
    </form>
    </div>
</body>

</html>