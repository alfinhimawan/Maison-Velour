<?php if (!empty($errors)): ?>
    <div style="background:#fff5f5; border:1px solid #ffe0e0; padding:12px 16px; margin-bottom:18px; font-size:12px; color:#c00;">
        <?php foreach ($errors as $error): ?><p style="margin:0 0 4px;"><?php echo htmlspecialchars($error); ?></p><?php endforeach; ?>
    </div>
<?php endif; ?>
<form method="POST" action="index.php">
    <input type="text" name="username" class="v-input" placeholder="Your Full Name" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
    <input type="email" name="email" class="v-input" placeholder="Your email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
    <input type="password" name="password_1" class="v-input" placeholder="Password" required>
    <input type="password" name="password_2" class="v-input" placeholder="Confirm Password" required>

    <div style="margin-bottom: 24px;">
        <label style="display:block; font-size: 13px; color: #a1a1a1; margin-bottom: 8px; font-family: \'Inter\', sans-serif;">Birthday</label>
        <div style="display: flex; gap: 12px;">
            <select name="b_date" style="flex:1; width:100%; border:1px solid #e2e8f0; border-radius:8px; padding:12px 16px; font-size:13px; font-family:'Inter', sans-serif; font-weight:normal; color:#475569; background:#fff url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMWUyOTNiIiBzdHJva2Utd2lkdGg9IjIuNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cGF0aCBkPSJNNCA2bDQgNCA0LTQiLz48L3N2Zz4=') no-repeat right 16px center; background-size:14px; -webkit-appearance:none; appearance:none; outline:none; cursor:pointer;" required>
                <option value="" disabled selected>Date</option>
                <?php for ($i = 1; $i <= 31; $i++) echo "<option value='$i'>$i</option>"; ?>
            </select>
            <select name="b_month" style="flex:1; width:100%; border:1px solid #e2e8f0; border-radius:8px; padding:12px 16px; font-size:13px; font-family:'Inter', sans-serif; font-weight:normal; color:#475569; background:#fff url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMWUyOTNiIiBzdHJva2Utd2lkdGg9IjIuNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cGF0aCBkPSJNNCA2bDQgNCA0LTQiLz48L3N2Zz4=') no-repeat right 16px center; background-size:14px; -webkit-appearance:none; appearance:none; outline:none; cursor:pointer;" required>
                <option value="" disabled selected>Month</option>
                <?php
                $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                foreach ($months as $idx => $m) {
                    $val = $idx + 1;
                    echo "<option value='$val'>$m</option>";
                }
                ?>
            </select>
            <select name="b_year" style="flex:1; width:100%; border:1px solid #e2e8f0; border-radius:8px; padding:12px 16px; font-size:13px; font-family:'Inter', sans-serif; font-weight:normal; color:#475569; background:#fff url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMWUyOTNiIiBzdHJva2Utd2lkdGg9IjIuNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cGF0aCBkPSJNNCA2bDQgNCA0LTQiLz48L3N2Zz4=') no-repeat right 16px center; background-size:14px; -webkit-appearance:none; appearance:none; outline:none; cursor:pointer;" required>
                <option value="" disabled selected>Year</option>
                <?php
                $currentYear = date('Y');
                for ($i = $currentYear; $i >= ($currentYear - 100); $i--) echo "<option value='$i'>$i</option>";
                ?>
            </select>
        </div>
    </div>

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
    <button type="submit" name="reg_user" class="v-btn-dark">CREATE NEW ACCOUNT</button>
    <p class="modal-switch">Already have an account? Login
        <a href="" data-toggle="modal" data-target="#Modal_login" data-dismiss="modal">here</a>
    </p>
</form>