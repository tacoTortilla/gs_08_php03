<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>text and image 保存（入力画面）</title>
</head>

<body>
  <form action="txt_image_create.php" method="POST" enctype="multipart/form-data">
    <fieldset>
      <legend>text and image 保存（入力画面）</legend>
      <a href="txt_image_read.php">一覧画面</a>
      <!-- <div>
        image: <input type="file" name="image" required>
      </div> -->
      <div>
        image: <input type="file" name="image" id="imageInput" accept="image/*" required>
        <div>
          <img id="thumbnail" style="display: none; max-width: 150px; max-height: 150px;" alt="サムネイル">
        </div>
      </div>
      <div>
        title: <input type="text" name="title">
      </div>
      <div>
        todo:  <textarea name="todo" rows="4" cols="30"></textarea>
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

  <script>
    // サムネイルを表示するためのJavaScript
    document.getElementById('imageInput').addEventListener('change', function(event) {
      const file = event.target.files[0];
      const thumbnail = document.getElementById('thumbnail');

      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();

        // ファイル読み込み完了時の処理
        reader.onload = function(e) {
          thumbnail.src = e.target.result; // サムネイルの画像ソースを設定
          thumbnail.style.display = 'block'; // サムネイルを表示
        };

        reader.readAsDataURL(file); // ファイルを読み込む
      } else {
        thumbnail.style.display = 'none'; // 画像がない場合は非表示
        thumbnail.src = '';
      }
    });
  </script>

</body>

</html>