<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <script src="/vendors/jquery/dist/jquery.min.js"></script>
        <link href="/css/test/test.css" rel="stylesheet">
    </head>
    <body>
    <?php if($_FILES) var_dump($_FILES); ?>
        <form action="./droparea.php" method="post" enctype="multipart/form-data">
            <input type="text">
            <div class="dropWrap">
                <div class="dropRow">
                    <div class="dropCol">
                        <div class="dropArea">
                            <div class="area">
                                <input type="file" class="fileInput" name="mainImage" accept=".jpg,.jpeg,.png" capture="camera">
                            </div>
                            <div class="view portraito">
                                <span class="dropText">【メイン】<br>画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1600 x 960px【横長】</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="dropCol">
                        <div class="dropArea">
                            <div class="area">
                                <input type="file" class="fileInput" name="avatarImage" accept=".jpg,.jpeg,.png" capture="camera">
                            </div>
                            <div class="view avatar">
                                <span class="dropText">画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1000 x 1000px【正方形】</small></span>
                                <button class="dropButton" data-value="enable"><i class="fa fa-trash"></i></button>
                                <div class="dropImages" style="background-image: url(/images/instructor/inst-thumb-01.jpg);"></div>
                            </div>
                        </div>
                    </div>
                    <div class="dropCol">
                        <div class="dropArea">
                            <div class="area">
                                <input type="file" class="fileInput" name="logoImage" accept=".jpg,.jpeg,.png" capture="camera">
                            </div>
                            <div class="view logo">
                                <span class="dropText">画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1000 x 1000px【正方形】</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="dropCol">
                        <div class="dropArea">
                            <div class="area">
                                <input type="file" class="fileInput" name="otherImage[]" accept=".jpg,.jpeg,.png" capture="camera">
                            </div>
                            <div class="view portraito">
                                <span class="dropText">画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1000 x 600px【横長】</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="dropCol">
                        <div class="dropArea">
                            <div class="area">
                                <input type="file" class="fileInput" name="otherImage[]" accept=".jpg,.jpeg,.png" capture="camera">
                            </div>
                            <div class="view portraito">
                                <span class="dropText">画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1000 x 600px【横長】</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="dropCol">
                        <div class="dropArea">
                            <div class="area">
                                <input type="file" class="fileInput" name="otherImage[]" accept=".jpg,.jpeg,.png" capture="camera">
                            </div>
                            <div class="view portraito">
                                <span class="dropText">画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1000 x 600px【横長】</small></span>
                            </div>
                        </div>
                    </div>
                    <div class="dropCol">
                        <div class="dropArea">
                            <div class="area">
                                <input type="file" class="fileInput" name="otherImage[]" accept=".jpg,.jpeg,.png" capture="camera">
                            </div>
                            <div class="view portraito">
                                <span class="dropText">画像をドラッグするか、<br>クリックしてファイルを選択してください<br><small>推奨：1000 x 600px【横長】</small></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button>アップロード</button>
        </form>
        <script src="/js/script-droparea.js"></script>
    </body>
</html>