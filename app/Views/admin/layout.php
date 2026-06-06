<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= base_url('/assets/css/style.css') ?>" rel="stylesheet">
  
     <title><?= isset($page_title) ? "Forum - " . $page_title : "Forum" ?></title>
</head>
<body>
    <div class="navbar">
        <p id="user">Hello <a href="<?= base_url('user/') . session()->get('user_id') ?>"><?= session()->get('user_username') ?></a></p>

        <ul>
            <li><a href="<?= base_url('/search') ?>">Search</a></li>
            <li><a href="<?= base_url('/topic/new') ?>">Create Topic</a></li>
            <li><a href="<?= base_url('/update-profile') ?>">Update Profile</li>
            <li><a href="<?= base_url('/logout') ?>">Log Out</a></li>
        </ul>
    </div>
    
    <div class="container">
        <h1><a href="<?= base_url() ?>">Forum</a></h1>

        <h2><a href="<?= base_url('/admin') ?>">Admin Panel</a></h2>

        <?= $this->renderSection('content') ?>

        <div class="footer">
            <p>&copy; Forum <?= date('Y') ?></p>
        </div>
    </div>
</body>
</html>