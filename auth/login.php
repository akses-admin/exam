<?php

if (isset($_POST['login'])) {
	validate([
		'email' => 'required|email',
		'password' => 'required',
		'level' => 'required'
	]);

	$email    = post('email');
	$password = post('password');
	$level    = post('level');

	if (!in_array($level, ['siswa', 'admin'])) {
		abort('404');
	}

	$check_user = mysqli_query($conn, "SELECT * FROM $level WHERE email = '$email'");
	if (mysqli_num_rows($check_user) > 0) {
		$user = mysqli_fetch_assoc($check_user);
	} else {
		set_flash('danger', 'Email atau password salah!');
		back();
	}

	
	if ($user && password_verify($password, $user['password'])) {

		
		$_SESSION['login'] = true;
		$_SESSION['user_id'] = $user['id_' . $level];
		$_SESSION['level'] = post('level');

		
		if ($level == 'admin') {
			header('Location: index.php?page=home');
			exit;		
		}else{
			header('Location: index.php?page=home_siswa');
			exit;	
		}
		
	} else {
		set_flash('danger', 'Email atau password salah!');
		back();
	}
}

?>

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-lg-5">
			<div class="card shadow-lg mb-5">
				<div class="card-header">
					<h5 class="card-title mb-0 py-2">Login Page</h5>
				</div>
				<div class="card-body">
					<?php flash() ?>

					<form method="POST">
						<div class="mb-3">
							<label for="email" class="form-label">Email Address</label>
							<input type="text" class="form-control <?= has_error('email') ? 'is-invalid' : '' ?>" name="email" id="email" value="<?= old('email') ?>">
							<div class="invalid-feedback"><?= error('email') ?></div>
						</div>

						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control <?= has_error('password') ? 'is-invalid' : '' ?>" name="password" id="password">
							<div class="invalid-feedback"><?= error('password') ?></div>
						</div>

						<div class="mb-3">
							<label for="level" class="form-label">Level</label>
							<select class="form-select <?= has_error('level') ? 'is-invalid' : '' ?>" name="level" id="level">
								<option value="siswa" <?= select_old('siswa', last_value('level')) ?>>Siswa</option>
								<option value="admin" <?= select_old('admin', last_value('level')) ?>>Administrator</option>
							</select>
							<div class="invalid-feedback"><?= error('level') ?></div>
						</div>

						<button type="submit" name="login" class="btn btn-primary col-lg-12">Login</button>
					</form>
				</div>
			</div>

			
		</div>
	</div>
</div>