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
