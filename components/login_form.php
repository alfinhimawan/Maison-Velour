<?php if (!empty($errors)): ?>
    <div style="background:#fff5f5; border:1px solid #ffe0e0; padding:12px 16px; margin-bottom:18px; font-size:12px; color:#c00;">
        <?php foreach ($errors as $error): ?><p style="margin:0 0 4px;"><?php echo htmlspecialchars($error); ?></p><?php endforeach; ?>
    </div>
<?php endif; ?>
<form method="POST" action="index.php">
    <input type="email" name="email" class="v-input" placeholder="Your email / phone number" required>
    <input type="password" name="password" class="v-input" placeholder="Password" required>


    <!-- Mock reCAPTCHA for localhost/UI purposes -->
    <div style="width: 100%; max-width: 304px; height: 78px; background: #f9f9f9; border: 1px solid #d3d3d3; border-radius: 3px; display: flex; align-items: center; justify-content: space-between; padding: 0 12px 0 12px; margin-bottom: 18px; box-sizing: border-box;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <input type="checkbox" style="width: 28px; height: 28px; border: 2px solid #c1c1c1; border-radius: 2px; cursor: pointer; background: #fff; appearance: none; -webkit-appearance: none; outline: none; box-shadow: none;" onchange="this.style.background = this.checked ? '#fff url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMDBjYjUxIiBzdHJva2Utd2lkdGg9IjQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PHBvbHlsaW5lIHBvaW50cz0iMjAgNiA5IDE3IDQgMTIiLz48L3N2Zz4=) no-repeat center center / 20px 20px' : '#fff'; this.style.borderColor = this.checked ? '#fff' : '#c1c1c1';">
            <span style="font-family: 'Roboto', sans-serif; font-size: 14px; color: #555;">I'm not a robot</span>
        </div>
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" style="width: 32px; height: 32px; margin-bottom: 2px;">
            <div style="font-family: 'Roboto', sans-serif; font-size: 10px; color: #555;">reCAPTCHA</div>
            <div style="font-family: 'Roboto', sans-serif; font-size: 8px; color: #999; margin-top: 2px;">Privacy - Terms</div>
        </div>
    </div>

    <p style="font-size: 10px; color: #999; margin-bottom: 18px; line-height: 1.5;">
        This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy" style="color:#000; text-decoration:underline;">Privacy Policy</a> and <a href="https://policies.google.com/terms" style="color:#000; text-decoration:underline;">Terms of Service</a> apply.
    </p>
    <button type="submit" name="login_user" class="v-btn-dark">NEXT</button>
    <p class="modal-switch">Don't have an account? Signup
        <a href="" data-toggle="modal" data-target="#Modal_register" data-dismiss="modal">here</a>
    </p>
</form>