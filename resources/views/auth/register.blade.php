<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Event Manager</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #111;
    }
    .container {
      max-width: 480px;
      width: 100%;
      padding: 40px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    h1 { font-size: 28px; margin-bottom: 30px; color: #111; text-align: center; }
    .form-group {
      margin-bottom: 20px;
      display: grid;
      gap: 8px;
    }
    label {
      font-weight: 500;
      color: #374151;
      font-size: 14px;
    }
    input {
      padding: 12px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s;
      font-family: inherit;
    }
    input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    .password-container {
      position: relative;
    }
    .toggle-password {
      position: absolute;
      right: 12px;
      top: 38px;
      cursor: pointer;
      color: #667eea;
      font-size: 12px;
      font-weight: 500;
      user-select: none;
    }
    button {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      width: 100%;
      transition: transform 0.2s, box-shadow 0.2s;
      font-size: 14px;
    }
    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }
    .error {
      color: #dc2626;
      font-size: 13px;
      margin-top: 4px;
    }
    .links {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
    }
    .links a {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
    }
    .links a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Create Account</h1>
    <form method="post" action="/register">
      @csrf

      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required value="{{ old('name') }}">
        @error('name')
          <span class="error">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required value="{{ old('email') }}">
        @error('email')
          <span class="error">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <div class="password-container">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required minlength="8">
          <span class="toggle-password" onclick="togglePassword('password')">Show</span>
        </div>
        @error('password')
          <span class="error">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <div class="password-container">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8">
          <span class="toggle-password" onclick="togglePassword('password_confirmation')">Show</span>
        </div>
      </div>

      <button type="submit">Create Account</button>
    </form>

    <div class="links">
      <p>Already have an account? <a href="/login">Login here</a></p>
    </div>
  </div>

  <script>
    function togglePassword(fieldId) {
      const passwordInput = document.getElementById(fieldId);
      const toggleButton = event.target;

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.textContent = 'Hide';
      } else {
        passwordInput.type = 'password';
        toggleButton.textContent = 'Show';
      }
    }
  </script>
</body>
</html>
