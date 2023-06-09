<?php
require_once 'core/init.php';

if (!$username = Input::get('user')) {
    Redirect::to('index.php');
} else {
    $user = new User($username);
    if (!$user->exists()) {
        Redirect::to(404);
    } else {
        $data = $user->data();
?>

<?php if (Session::exists('success')) : ?>
  <div class="alert alert-success">
    <?php echo Session::flash('success'); ?>
  </div>
<?php endif; ?>

<?php if (Session::exists('error')) : ?>
  <div class="alert alert-danger">
    <?php echo Session::flash('error'); ?>
  </div>
<?php endif; ?>

<table class="table table-bordered table-striped text-white">
    <tbody>
      <tr>
        <th>Username</th>
        <td><?php echo escape($data->username); ?></td>
      </tr>
      <tr>
        <th>Name</th>
        <td><?php echo escape($data->name); ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?php echo escape($data->email); ?></td>
      </tr>
    </tbody>
  </table>
<?php
    }
}
?>
