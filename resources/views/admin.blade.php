<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - Event Manager</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
      color: #111;
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
    }
    header, footer {
      background: #fff;
      border-bottom: 1px solid #e5e7eb;
    }
    header {
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .header-content {
      max-width: 1100px;
      margin: 0 auto;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 60px;
    }
    .logo {
      font-size: 18px;
      font-weight: 700;
      color: #667eea;
    }
    nav {
      display: flex;
      gap: 24px;
    }
    nav a, nav button {
      color: #6b7280;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: color 0.3s;
      border: none;
      background: none;
      cursor: pointer;
      padding: 0;
    }
    nav a:hover, nav button:hover {
      color: #667eea;
    }
    .container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 40px 20px;
    }
    h1 {
      font-size: 32px;
      margin-bottom: 30px;
      color: #111;
    }
    h2 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #111;
    }
    .tabs {
      display: flex;
      gap: 12px;
      margin-bottom: 30px;
      flex-wrap: wrap;
    }
    .tab-btn {
      padding: 12px 20px;
      border: 1px solid #e5e7eb;
      background: #fff;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 500;
      font-size: 14px;
      color: #6b7280;
      transition: all 0.3s;
    }
    .tab-btn.active {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      border-color: #667eea;
    }
    .tab-btn:hover {
      border-color: #667eea;
      color: #667eea;
    }
    .tab-content {
      display: none;
      animation: fadeIn 0.3s;
    }
    .tab-content.active {
      display: block;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    .form-group {
      margin-bottom: 16px;
      display: grid;
      gap: 6px;
    }
    label {
      font-weight: 500;
      font-size: 13px;
      color: #374151;
    }
    input, textarea, select {
      padding: 10px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      font-size: 14px;
      font-family: inherit;
    }
    input:focus, textarea:focus, select:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    textarea {
      min-height: 100px;
      resize: vertical;
    }
    .form-container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      max-width: 600px;
    }
    .btn {
      display: inline-block;
      padding: 10px 16px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      font-size: 13px;
      cursor: pointer;
      border: none;
      transition: all 0.3s;
    }
    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      width: 100%;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }
    .btn-danger {
      background: #ef4444;
      color: #fff;
    }
    .btn-danger:hover {
      background: #dc2626;
    }
    .btn-secondary {
      background: #f3f4f6;
      color: #374151;
    }
    .btn-secondary:hover {
      background: #e5e7eb;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 24px;
    }
    .card {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }
    .card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      background: linear-gradient(135deg, #f0f4ff 0%, #f8faff 100%);
    }
    .card-content {
      padding: 20px;
    }
    .card h3 {
      font-size: 16px;
      margin-bottom: 8px;
      color: #111;
    }
    .card-meta {
      font-size: 12px;
      color: #6b7280;
      margin-bottom: 12px;
    }
    .card-actions {
      display: flex;
      gap: 8px;
    }
    .registrations-list {
      background: #fff;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      overflow: hidden;
    }
    .registration-item {
      padding: 16px 20px;
      border-bottom: 1px solid #f3f4f6;
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 16px;
      align-items: center;
    }
    .registration-info {
      display: grid;
      gap: 4px;
    }
    .calendar {
      background: #fff;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      padding: 20px;
    }
    /* Calendar styles (aligned with home page) */
    .calendar-container { margin-top: 12px; }
    .calendar-header { display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 12px; }
    .calendar-header button { padding: 6px 10px; border: 1px solid #e5e7eb; background: #fff; border-radius: 6px; cursor: pointer; }
    .weekdays { display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; font-size: 12px; color: #6b7280; margin-bottom: 8px; }
    .weekdays div { padding: 8px 0; }
    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 8px; }
    .calendar-day { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; min-height: 90px; padding: 8px; position: relative; }
    .calendar-day.other-month { background: #fafafa; color: #9ca3af; }
    .day-number { font-size: 12px; color: #374151; font-weight: 600; }
    .calendar-day.today { box-shadow: 0 0 0 2px rgba(102,126,234,0.3) inset; }
    .calendar-day.has-event .day-number { display: inline-block; background: #667eea; color: #fff; padding: 2px 6px; border-radius: 999px; }
    .calendar-event { margin-top: 6px; font-size: 11px; background: #eef2ff; color: #1f2937; padding: 3px 6px; border-radius: 6px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    footer {
      margin-top: 60px;
      padding: 30px 0;
      text-align: center;
      color: #6b7280;
      border-top: 1px solid #e5e7eb;
    }
  </style>
</head>
<body>
  <header>
    <div class="header-content">
      <div class="logo">🎪 Event Manager</div>
      <nav>
        <a href="/">Home</a>
        <a href="/admin/options">Admin Dashboard</a>
        <form method="post" action="/logout" style="display: inline;">
          @csrf
          <button type="submit">Logout</button>
        </form>
      </nav>
    </div>
  </header>

  <main class="container">
    <h1>Admin Dashboard</h1>

    <div class="tabs">
      <button class="tab-btn active" onclick="showTab('events')">Events</button>
      <button class="tab-btn" onclick="showTab('create-event')">Create Event</button>
      <button class="tab-btn" onclick="showTab('categories')">Categories</button>
      <button class="tab-btn" onclick="showTab('create-category')">Create Category</button>
      <button class="tab-btn" onclick="showTab('registrations')">Registrations</button>
      <button class="tab-btn" onclick="showTab('calendar')">Calendar</button>
    </div>

    <!-- Events Tab -->
    <div id="events" class="tab-content active">
      <h2>Existing Events</h2>
      @if(count($events) > 0)
        <div class="grid">
          @foreach($events as $event)
            <div class="card">
              @if($event->banner_path)
                <img src="{{ htmlspecialchars($event->banner_path, ENT_QUOTES) }}" alt="{{ $event->title }}">
              @else
                <div style="height: 160px; background: linear-gradient(135deg, #f0f4ff 0%, #f8faff 100%);"></div>
              @endif
              <div class="card-content">
                <h3>{{ htmlspecialchars($event->title, ENT_QUOTES) }}</h3>
                <div class="card-meta">
                  <div>📍 {{ htmlspecialchars($event->location, ENT_QUOTES) }}</div>
                  <div>📅 {{ $event->start_at->format('M d, Y H:i') }}</div>
                  <div>📂 {{ htmlspecialchars($event->category->name ?? '—', ENT_QUOTES) }}</div>
                </div>
                <div class="card-actions">
                  <button class="btn btn-secondary" onclick="editEvent('{{ $event->_id }}')">Edit</button>
                  <form method="post" action="/admin/events/{{ $event->_id }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this event?')">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p>No events yet. <a href="#create-event" onclick="showTab('create-event')">Create one</a></p>
      @endif
    </div>

    <!-- Create Event -->
    <div id="create-event" class="tab-content">
      <h2>Create New Event</h2>
      <form method="post" action="/admin/events" enctype="multipart/form-data" class="form-container">
        @csrf
        <div class="form-group">
          <label for="title">Event Title</label>
          <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea id="description" name="description"></textarea>
        </div>

        <div class="form-group">
          <label for="category_id">Category</label>
          <select id="category_id" name="category_id" required>
            <option value="">Select a category</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->_id }}">{{ htmlspecialchars($cat->name, ENT_QUOTES) }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="location">Location</label>
          <input type="text" id="location" name="location" required>
        </div>

        <div class="form-group">
          <label for="start_at">Start Date & Time</label>
          <input type="datetime-local" id="start_at" name="start_at" required>
        </div>

        <div class="form-group">
          <label for="end_at">End Date & Time</label>
          <input type="datetime-local" id="end_at" name="end_at" required>
        </div>

        <div class="form-group">
          <label for="banner_path">Banner Image URL</label>
          <input type="url" id="banner_path" name="banner_path" placeholder="https://example.com/image.jpg">
        </div>

        <button type="submit" class="btn btn-primary">Create Event</button>
      </form>
    </div>

    <!-- Categories -->
    <div id="categories" class="tab-content">
      <h2>Categories</h2>
      @if(count($categories) > 0)
        <div style="background: #fff; border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden;">
          @foreach($categories as $cat)
            <div style="padding: 16px 20px; border-bottom: 1px solid #f3f4f6; display: grid; grid-template-columns: 1fr auto; gap: 16px; align-items: center;">
              <div>
                <div style="font-weight: 500; color: #111;">{{ htmlspecialchars($cat->name, ENT_QUOTES) }}</div>
                @if($cat->description)
                  <div style="font-size: 13px; color: #6b7280;">{{ htmlspecialchars($cat->description, ENT_QUOTES) }}</div>
                @endif
              </div>
              <div style="display: flex; gap: 8px;">
                <button class="btn btn-secondary" onclick="editCategory('{{ $cat->_id }}')">Edit</button>
                <form method="post" action="/admin/categories/{{ $cat->_id }}" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p>No categories yet.</p>
      @endif
    </div>

    <!-- Create Category -->
    <div id="create-category" class="tab-content">
      <h2>Create New Category</h2>
      <form method="post" action="/admin/categories" class="form-container">
        @csrf
        <div class="form-group">
          <label for="cat-name">Category Name</label>
          <input type="text" id="cat-name" name="name" required>
        </div>

        <div class="form-group">
          <label for="cat-description">Description</label>
          <textarea id="cat-description" name="description"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Category</button>
      </form>
    </div>

    <!-- Registrations -->
    <div id="registrations" class="tab-content">
      <h2>Event Registrations</h2>
      @if(count($registrations) > 0)
        <div class="registrations-list">
          @foreach($registrations as $reg)
            <div class="registration-item">
              <div class="registration-info">
                <div class="registration-user">{{ htmlspecialchars($reg->user_name ?? $reg->user->name ?? 'Unknown User', ENT_QUOTES) }}</div>
                <div class="registration-email">{{ htmlspecialchars($reg->user_email ?? $reg->user->email ?? 'No Email', ENT_QUOTES) }}</div>
                <div class="registration-event">Registered for <strong>{{ htmlspecialchars($reg->event_title ?? $reg->event->title ?? 'Deleted Event', ENT_QUOTES) }}</strong></div>
                <div class="registration-date">{{ $reg->created_at->format('M d, Y H:i') }}</div>
              </div>
              <div style="font-size: 12px; color: #6b7280;">
                <span style="display: inline-block; background: #dbeafe; color: #1e40af; padding: 4px 8px; border-radius: 4px;">{{ htmlspecialchars($reg->status, ENT_QUOTES) }}</span>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p>No registrations yet.</p>
      @endif
    </div>

    <!-- Calendar -->
    <div id="calendar" class="tab-content">
      <h2>Event Calendar</h2>
      <div class="calendar">
        <div class="calendar-container">
          <div class="calendar-header">
            <button id="adminPrevMonth">&lt;</button>
            <h3 id="adminCurrentMonth" style="margin: 0;"></h3>
            <button id="adminNextMonth">&gt;</button>
          </div>
          <div class="weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
          </div>
          <div id="admin-calendar-days" class="calendar-grid"></div>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="container">
      <p>&copy; 2025 Event Manager. Admin Dashboard</p>
    </div>
  </footer>

  <script>
    function showTab(tabName) {
      document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
      document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
      document.getElementById(tabName).classList.add('active');
      event.target.classList.add('active');

      // When switching to calendar tab, ensure calendar renders
      if (tabName === 'calendar' && typeof renderAdminCalendar === 'function') {
        renderAdminCalendar(currentMonth, currentYear);
      }
    }
    
    function editEvent(eventId) {
      // Create edit event tab if it doesn't exist
      let editTab = document.getElementById('edit-event');
      if (!editTab) {
        editTab = document.createElement('div');
        editTab.id = 'edit-event';
        editTab.className = 'tab-content';
        document.querySelector('main.container').appendChild(editTab);
      }
      
      // Fetch event data via web route (JSON), avoids Sanctum API auth
      fetch(`/admin/events/${eventId}/json`)
        .then(response => response.json())
        .then(event => {
          // Format dates for datetime-local input
          const startDate = new Date(event.start_at);
          const endDate = new Date(event.end_at);
          const formatDate = (date) => {
            return date.toISOString().slice(0, 16);
          };
          
          // Populate edit form
          editTab.innerHTML = `
            <h2>Edit Event: ${event.title}</h2>
            <form method="post" action="/admin/events/${eventId}" enctype="multipart/form-data" class="form-container">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="edit-title">Event Title</label>
                <input type="text" id="edit-title" name="title" value="${event.title}" required>
              </div>
              
              <div class="form-group">
                <label for="edit-description">Description</label>
                <textarea id="edit-description" name="description">${event.description || ''}</textarea>
              </div>
              
              <div class="form-group">
                <label for="edit-category_id">Category</label>
                <select id="edit-category_id" name="category_id" required>
                  <option value="">Select a category</option>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->_id }}">{{ htmlspecialchars($cat->name, ENT_QUOTES) }}</option>
                  @endforeach
                </select>
              </div>
              
              <div class="form-group">
                <label for="edit-location">Location</label>
                <input type="text" id="edit-location" name="location" value="${event.location}" required>
              </div>
              
              <div class="form-group">
                <label for="edit-start_at">Start Date & Time</label>
                <input type="datetime-local" id="edit-start_at" name="start_at" value="${formatDate(startDate)}" required>
              </div>
              
              <div class="form-group">
                <label for="edit-end_at">End Date & Time</label>
                <input type="datetime-local" id="edit-end_at" name="end_at" value="${formatDate(endDate)}" required>
              </div>
              
              <div class="form-group">
                <label for="edit-banner_path">Banner Image URL</label>
                ${event.banner_path ? `<div><img src="${event.banner_path}" style="max-width: 200px; margin-bottom: 10px;"></div>` : ''}
                <input type="url" id="edit-banner_path" name="banner_path" value="${event.banner_path || ''}" placeholder="https://example.com/image.jpg">
              </div>
              
              <button type="submit" class="btn btn-primary">Update Event</button>
              <button type="button" class="btn btn-secondary" onclick="showTab('events')">Cancel</button>
            </form>
          `;
          
          // Set the selected category
          const categorySelect = document.getElementById('edit-category_id');
          Array.from(categorySelect.options).forEach(option => {
            if (option.value === event.category_id) {
              option.selected = true;
            }
          });
          
          // Show the edit tab
          showTab('edit-event');
        })
        .catch(error => {
          console.error('Error fetching event:', error);
          // Silenced alert per request; keep console for debugging
        });
    }
    
    function editCategory(categoryId) {
      // Create edit category tab if it doesn't exist
      let editTab = document.getElementById('edit-category');
      if (!editTab) {
        editTab = document.createElement('div');
        editTab.id = 'edit-category';
        editTab.className = 'tab-content';
        document.querySelector('main.container').appendChild(editTab);
      }
      
      // Fetch category data via web route (JSON)
      fetch(`/admin/categories/${categoryId}/json`)
        .then(response => response.json())
        .then(category => {
          // Populate edit form
          editTab.innerHTML = `
            <h2>Edit Category: ${category.name}</h2>
            <form method="post" action="/admin/categories/${categoryId}" class="form-container">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="edit-cat-name">Category Name</label>
                <input type="text" id="edit-cat-name" name="name" value="${category.name}" required>
              </div>
              
              <div class="form-group">
                <label for="edit-cat-description">Description</label>
                <textarea id="edit-cat-description" name="description">${category.description || ''}</textarea>
              </div>
              
              <button type="submit" class="btn btn-primary">Update Category</button>
              <button type="button" class="btn btn-secondary" onclick="showTab('categories')">Cancel</button>
            </form>
          `;
          
          // Show the edit tab
          showTab('edit-category');
        })
        .catch(error => {
          console.error('Error fetching category:', error);
          // Silenced alert per request
        });
    }

    // Admin calendar rendering (aligned with home page)
    const adminEvents = @json($events);
    const adminCalendarDays = document.getElementById('admin-calendar-days');
    const adminCurrentMonthElement = document.getElementById('adminCurrentMonth');
    const adminPrevMonthButton = document.getElementById('adminPrevMonth');
    const adminNextMonthButton = document.getElementById('adminNextMonth');

    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function renderAdminCalendar(month, year) {
      if (!adminCalendarDays) return;
      adminCalendarDays.innerHTML = '';

      const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
      adminCurrentMonthElement.textContent = `${monthNames[month]} ${year}`;

      const firstDay = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      // previous month padding
      const prevMonthDays = new Date(year, month, 0).getDate();
      for (let i = firstDay - 1; i >= 0; i--) {
        const el = document.createElement('div');
        el.className = 'calendar-day other-month';
        el.textContent = prevMonthDays - i;
        adminCalendarDays.appendChild(el);
      }

      const today = new Date();
      for (let i = 1; i <= daysInMonth; i++) {
        const el = document.createElement('div');
        el.className = 'calendar-day';
        const num = document.createElement('div');
        num.className = 'day-number';
        num.textContent = i;
        el.appendChild(num);

        if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
          el.classList.add('today');
        }

        const dayEvents = adminEvents.filter(evt => {
          const d = new Date(evt.start_at);
          return d.getDate() === i && d.getMonth() === month && d.getFullYear() === year;
        });
        if (dayEvents.length > 0) {
          el.classList.add('has-event');
          dayEvents.forEach(evt => {
            const item = document.createElement('div');
            item.className = 'calendar-event';
            item.textContent = evt.title;
            el.appendChild(item);
          });
        }

        adminCalendarDays.appendChild(el);
      }

      // next month padding to complete 6 rows
      const totalCells = 42;
      const remaining = totalCells - (firstDay + daysInMonth);
      for (let i = 1; i <= remaining; i++) {
        const el = document.createElement('div');
        el.className = 'calendar-day other-month';
        el.textContent = i;
        adminCalendarDays.appendChild(el);
      }
    }

    // Initialize and navigation
    if (adminPrevMonthButton && adminNextMonthButton) {
      adminPrevMonthButton.addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) { currentMonth = 11; currentYear--; }
        renderAdminCalendar(currentMonth, currentYear);
      });
      adminNextMonthButton.addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) { currentMonth = 0; currentYear++; }
        renderAdminCalendar(currentMonth, currentYear);
      });
    }

    // Render immediately if calendar tab is default active (not the case here)
    // but ensure it renders once on load so switching is instant
    document.addEventListener('DOMContentLoaded', () => {
      renderAdminCalendar(currentMonth, currentYear);
    });
  </script>
</body>
</html>
