<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Project</title>
</head>
<body>
    <div>
        <?php
          if(DB::connection()->getPdo()){
             echo "connect successfully",DB::connection()->getDatabase
          }

        ?>
    </div>
</body>
</html>