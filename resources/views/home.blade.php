<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>All Events - Event Manager</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
      color: #111;
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
    }
    
    .calendar-event {
      font-size: 10px;
      background-color: #4a6cf7;
      color: white;
      padding: 2px 4px;
      border-radius: 3px;
      margin-top: 2px;
      cursor: pointer;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    
    .day-events {
      margin-top: 2px;
      max-height: 40px;
      overflow: hidden;
    }
    
    .more-events {
      font-size: 9px;
      color: #666;
      text-align: center;
    }
    
    .registration-message {
      margin-top: 8px;
      padding: 5px;
      border-radius: 4px;
      font-size: 14px;
      font-weight: 500;
    }
    
    .highlight {
      animation: highlight-pulse 1s ease-in-out;
    }
    
    @keyframes highlight-pulse {
      0% { box-shadow: 0 0 0 0 rgba(74, 108, 247, 0.7); }
      70% { box-shadow: 0 0 0 10px rgba(74, 108, 247, 0); }
      100% { box-shadow: 0 0 0 0 rgba(74, 108, 247, 0); }
    }
    
    .nav-btn {
      padding: 8px 16px;
      margin-left: 10px;
      border-radius: 4px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .login-btn {
      background-color: #4a6cf7;
      color: white;
    }
    
    .register-btn {
      background-color: #6c757d;
      color: white;
    }
    
    .admin-btn {
      background-color: #28a745;
      color: white;
    }
    
    .logout-btn {
      background-color: #dc3545;
      color: white;
      border: none;
      cursor: pointer;
    }
    
    .welcome-user {
      margin-right: 10px;
      font-weight: 500;
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
      font-size: 24px;
      margin-bottom: 8px;
      color: #111;
    }
    .subtitle {
      color: #6b7280;
      margin-bottom: 32px;
    }
    .filters {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 32px;
    }
    .filter-group {
      display: grid;
      gap: 8px;
    }
    label {
      font-size: 14px;
      font-weight: 500;
      color: #374151;
    }
    input, select {
      padding: 10px 12px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      font-size: 14px;
      color: #111;
      background: #fff;
    }
    input:focus, select:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 24px;
    }
    .card {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      border: 1px solid #e5e7eb;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 20px rgba(0,0,0,0.1);
    }
    .card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
    }
    .card-placeholder {
      width: 100%;
      height: 160px;
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
    .badge {
      display: inline-block;
      padding: 4px 8px;
      background: #f3f4f6;
      color: #374151;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 500;
      margin-bottom: 16px;
    }
    .button-group {
      display: flex;
      gap: 8px;
    }
    .btn {
      display: inline-block;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      text-align: center;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
      border: none;
      width: 100%;
    }
    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
    }
    .btn-primary:hover {
      opacity: 0.9;
    }
    .btn-secondary {
      background: #f3f4f6;
      color: #374151;
    }
    .btn-secondary:hover {
      background: #e5e7eb;
    }
    footer {
      margin-top: 60px;
      padding: 30px 0;
      text-align: center;
      color: #6b7280;
      border-top: 1px solid #e5e7eb;
    }
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #6b7280;
    }
    .empty-state h2 {
      color: #111;
      margin-bottom: 10px;
    }
    /* Tabs styling */
    .tabs {
      display: flex;
      gap: 16px;
      margin-bottom: 24px;
      border-bottom: 1px solid #e5e7eb;
      padding-bottom: 16px;
    }
    .tab-btn {
      background: none;
      border: none;
      padding: 8px 16px;
      font-size: 16px;
      font-weight: 500;
      color: #6b7280;
      cursor: pointer;
      transition: color 0.3s;
      border-radius: 6px;
    }
    .tab-btn:hover {
      color: #667eea;
    }
    .tab-btn.active {
      color: #667eea;
      background: rgba(102, 126, 234, 0.1);
    }
    .tab-content {
      display: none;
    }
    .tab-content.active {
      display: block;
    }
    /* Calendar styling */
    .calendar-container {
      margin-top: 24px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      overflow: hidden;
      background: #fff;
      padding: 24px;
      margin-bottom: 32px;
    }
    .calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px;
      background: #f9fafb;
      border-bottom: 1px solid #e5e7eb;
      margin-bottom: 16px;
    }
    .calendar-header button {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 4px;
      width: 32px;
      height: 32px;
      font-size: 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .calendar-header button:hover {
      background: #e5e7eb;
    }
    .weekdays {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      background: #f9fafb;
      border-bottom: 1px solid #e5e7eb;
      text-align: center;
      font-weight: 500;
      color: #6b7280;
      margin-bottom: 8px;
    }
    .weekdays div {
      padding: 12px;
      font-size: 14px;
    }
    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 8px;
    }
    .calendar-day {
      min-height: 100px;
      padding: 8px;
      border-right: 1px solid #e5e7eb;
      border-bottom: 1px solid #e5e7eb;
      position: relative;
    }
    .calendar-day:nth-child(7n) {
      border-right: none;
    }
    .day-number {
      font-size: 14px;
      margin-bottom: 4px;
    }
    .calendar-day:hover {
      background-color: #f9fafb;
    }
    .calendar-day.today {
      background-color: #f0f9ff;
    }
    .today .day-number {
      font-weight: bold;
    }
    .calendar-day.has-event {
      background-color: #f8fafc;
    }
    .calendar-day.other-month {
      color: #d1d5db;
      background: #f9fafb;
    }
    .event-indicator {
      width: 6px;
      height: 6px;
      background-color: #667eea;
      border-radius: 50%;
      margin: 2px auto 0;
    }
    .event-popup {
      position: absolute;
      z-index: 10;
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      padding: 12px;
      width: 200px;
      top: 100%;
      left: 50%;
      transform: translateX(-50%);
      display: none;
    }
    .event-popup h4 {
      font-size: 14px;
      margin-bottom: 4px;
    }
    .event-popup p {
      font-size: 12px;
      color: #6b7280;
    }
  </style>
</head>
<body>
  <header>
    <div class="header-content">
      <div class="logo">🎪 Event Manager</div>
      <nav>
        <a href="/">Home</a>
        @if(auth()->check())
          <span class="welcome-user">Welcome, {{ auth()->user()->name }}</span>
          @if(auth()->user()->role === 'admin')
            <a href="/admin/options" class="nav-btn admin-btn">Admin Dashboard</a>
          @endif
          <form method="post" action="/logout" style="display: inline;">
            @csrf
            <button type="submit" class="nav-btn logout-btn">Logout</button>
          </form>
        @else
          <a href="/login" class="nav-btn login-btn">Login</a>
          <a href="/register" class="nav-btn register-btn">Register</a>
        @endif
      </nav>
    </div>
  </header>

  <main class="container">
    <div class="tabs">
      <button class="tab-btn active" onclick="showTab('events')">All Events</button>
      <button class="tab-btn" onclick="showTab('calendar')">Calendar View</button>
    </div>

    <div id="events" class="tab-content active">
      <h1>All Events</h1>
      <p class="subtitle">Discover and register for amazing events happening near you</p>

      <div class="filters">
        <div class="filter-group">
          <label for="search">Search by Title or Location</label>
          <input type="text" id="search" placeholder="Search events...">
        </div>
        <div class="filter-group">
          <label for="category">Filter by Category</label>
          <select id="category">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->_id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    
    <div id="calendar" class="tab-content">
      <h1>Event Calendar</h1>
      <p class="subtitle">View upcoming events in calendar format</p>
      
      <div class="calendar-container">
        <div class="calendar-header">
          <button id="prevMonth">&lt;</button>
          <h2 id="currentMonth"></h2>
          <button id="nextMonth">&gt;</button>
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
        <div id="calendar-days" class="calendar-grid"></div>
      </div>
    </div>
    </div>

    @if(count($events) > 0)
      <div class="grid">
        @foreach($events as $event)
          <div class="card" data-category-id="{{ $event->category->_id ?? '' }}">
            @if($event->banner_path)
              <img src="{{ htmlspecialchars($event->banner_path, ENT_QUOTES) }}" alt="{{ $event->title }}">
            @else
              <div class="card-placeholder"></div>
            @endif
            <div class="card-content">
              <h3>{{ htmlspecialchars($event->title, ENT_QUOTES) }}</h3>
              <div class="card-meta">
                <div>📍 {{ htmlspecialchars($event->location, ENT_QUOTES) }}</div>
                <div>📅 {{ $event->start_at->format('M d, Y H:i') }} – {{ $event->end_at->format('H:i') }}</div>
              </div>
              <span class="badge">{{ htmlspecialchars($event->category->name ?? '—', ENT_QUOTES) }}</span>
              <div class="button-group">
                @if(auth()->check() && auth()->user()->role === 'attendee')
                  <form class="event-registration-form" data-event-id="{{ $event->_id }}" style="width: 100%;">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->_id }}">
                    <button type="submit" class="btn btn-primary">Register for Event</button>
                  </form>
                  <div class="registration-message" id="reg-message-{{ $event->_id }}" style="display: none;"></div>
                @elseif(!auth()->check())
                  <a href="/login" class="btn btn-secondary">Login to Register</a>
                @else
                  <button class="btn btn-secondary" disabled>View Event</button>
                @endif
              </div>
            </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="empty-state">
        <h2>No Events Found</h2>
        <p>Check back soon for upcoming events!</p>
      </div>
    @endif
  </main>

  <footer>
    <div class="container">
      <p>&copy; 2025 Event Manager. All rights reserved.</p>
    </div>
  </footer>

  <script>
    // Tab functionality
    function showTab(tabName) {
      document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
      document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
      
      document.getElementById(tabName).classList.add('active');
      document.querySelector(`.tab-btn[onclick="showTab('${tabName}')"]`).classList.add('active');
    }
    
    // Search functionality
    document.getElementById('search')?.addEventListener('input', function(e) {
      const query = e.target.value.toLowerCase();
      document.querySelectorAll('.card').forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const location = card.querySelector('.card-meta div:first-child').textContent.toLowerCase();
        card.style.display = (title.includes(query) || location.includes(query)) ? '' : 'none';
      });
    });

    document.getElementById('category')?.addEventListener('change', function(e) {
      const categoryId = e.target.value;
      document.querySelectorAll('.card').forEach(card => {
        if (!categoryId) {
          card.style.display = '';
          return;
        }
        const badge = card.querySelector('.badge').textContent;
        const categoryMatch = card.dataset.categoryId === categoryId;
        card.style.display = categoryMatch ? '' : 'none';
      });
    });
    
    // Calendar functionality
    document.addEventListener('DOMContentLoaded', function() {
      // Check if there's a pending registration after login
      if ({{ auth()->check() ? 'true' : 'false' }}) {
        const pendingEventId = localStorage.getItem('pending_registration_event_id');
        if (pendingEventId) {
          // Clear the pending registration
          localStorage.removeItem('pending_registration_event_id');
          
          // Get the CSRF token
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          
          // Auto-register for the event
          fetch(`/api/events/${pendingEventId}/register`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ event_id: pendingEventId }),
            credentials: 'same-origin'
          })
          .then(response => {
            if (!response.ok) {
              if (response.status === 409) {
                return response.json(); // Already registered is not an error
              }
              throw new Error('Registration failed');
            }
            return response.json();
          })
          .then(data => {
            // Show success message
            const messageContainer = document.getElementById(`reg-message-${pendingEventId}`);
            if (messageContainer) {
              messageContainer.style.display = 'block';
              messageContainer.textContent = data.message || 'Successfully registered';
              messageContainer.className = 'registration-message success';
              
              // Update button state
              const form = document.querySelector(`.event-registration-form[data-event-id="${pendingEventId}"]`);
              if (form) {
                const submitButton = form.querySelector('button[type="submit"]');
                if (submitButton) {
                  submitButton.disabled = true;
                  submitButton.textContent = 'Registered';
                }
              }
            }
          })
          .catch(error => {
            console.error('Auto-registration error:', error);
          });
        }
      }
      
      // Rest of your existing DOMContentLoaded code
      const events = @json($events);
      const calendarDays = document.getElementById('calendar-days');
      const currentMonthElement = document.getElementById('currentMonth');
      const prevMonthButton = document.getElementById('prevMonth');
      const nextMonthButton = document.getElementById('nextMonth');
      
      let currentDate = new Date();
      let currentMonth = currentDate.getMonth();
      let currentYear = currentDate.getFullYear();
      
      // Initialize calendar
      renderCalendar(currentMonth, currentYear);
      
      // Event listeners for month navigation
      prevMonthButton.addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
          currentMonth = 11;
          currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
      });
      
      nextMonthButton.addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
          currentMonth = 0;
          currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
      });
      
      // Event registration handling
      const registrationForms = document.querySelectorAll('.event-registration-form');
      registrationForms.forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          const eventId = this.dataset.eventId;
          const messageContainer = document.getElementById(`reg-message-${eventId}`);
          const submitButton = this.querySelector('button[type="submit"]');
          
          // Disable button during submission
          submitButton.disabled = true;
          messageContainer.style.display = 'block';
          messageContainer.textContent = 'Processing...';
          
          // Get the CSRF token from meta tag
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          
          fetch(`/events/${eventId}/register`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ event_id: eventId }),
            credentials: 'same-origin'
          })
          .then(response => {
            if (response.status === 401) {
              // Store that we were trying to register for this event
              localStorage.setItem('pending_registration_event_id', eventId);
              // Redirect to login
              window.location.href = '/login?redirect=' + encodeURIComponent(window.location.pathname);
              throw new Error('Please log in to register for events');
            }
            if (!response.ok) {
              return response.json().then(err => {
                throw new Error(err.message || 'Error registering for event');
              });
            }
            return response.json();
          })
          .then(data => {
            if (data.message === 'Already registered') {
              messageContainer.textContent = 'You are already registered for this event';
              messageContainer.style.color = '#e67e22';
              submitButton.textContent = 'Registered';
              submitButton.disabled = true;
            } else {
              // Success case - the registration was created
              messageContainer.textContent = 'Successfully registered for this event!';
              messageContainer.style.color = '#2ecc71';
              submitButton.textContent = 'Registered';
              submitButton.disabled = true;
            }
          })
          .catch(error => {
            console.error('Error:', error);
            if (error.message !== 'Please log in to register for events') {
              messageContainer.textContent = error.message || 'Error registering for event';
              messageContainer.style.color = '#e74c3c';
              submitButton.disabled = false;
            }
          });
        });
        
        // Check if user is already registered for this event
        const checkRegistration = (eventId) => {
          const messageContainer = document.getElementById(`reg-message-${eventId}`);
          const submitButton = form.querySelector('button[type="submit"]');
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          
          fetch(`/api/events/${eventId}/check-registration`, {
            method: 'GET',
            headers: {
              'Accept': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
              'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
          })
          .then(response => {
            if (response.status === 401) {
              // User is not logged in, but we don't need to show an error
              return { registered: false };
            }
            return response.json();
          })
          .then(data => {
            if (data.registered) {
              messageContainer.textContent = 'You are already registered for this event';
              messageContainer.style.display = 'block';
              messageContainer.style.color = '#e67e22';
              submitButton.textContent = 'Registered';
              submitButton.disabled = true;
            }
          })
          .catch(error => {
            console.error('Error checking registration:', error);
          });
        };
        
        // Check registration status when page loads
        checkRegistration(form.dataset.eventId);
      });
      
      function renderCalendar(month, year) {
        // Clear previous calendar
        calendarDays.innerHTML = '';
        
        // Set current month text
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        currentMonthElement.textContent = `${monthNames[month]} ${year}`;
        
        // Get first day of month and total days
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        
        // Previous month's days
        const prevMonthDays = new Date(year, month, 0).getDate();
        for (let i = firstDay - 1; i >= 0; i--) {
          const dayElement = document.createElement('div');
          dayElement.className = 'calendar-day other-month';
          dayElement.textContent = prevMonthDays - i;
          calendarDays.appendChild(dayElement);
        }
        
        // Current month's days
        const today = new Date();
        for (let i = 1; i <= daysInMonth; i++) {
          const dayElement = document.createElement('div');
          dayElement.className = 'calendar-day';
          
          // Create day number element
          const dayNumber = document.createElement('div');
          dayNumber.className = 'day-number';
          dayNumber.textContent = i;
          dayElement.appendChild(dayNumber);
          
          // Check if it's today
          if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
            dayElement.classList.add('today');
          }
          
          // Check for events on this day
          const dayEvents = events.filter(event => {
            const eventDate = new Date(event.start_at);
            return eventDate.getDate() === i && eventDate.getMonth() === month && eventDate.getFullYear() === year;
          });
          
          if (dayEvents.length > 0) {
            dayElement.classList.add('has-event');
            
            // Add event names directly to the day cell
            dayEvents.forEach(event => {
              const eventItem = document.createElement('div');
              eventItem.className = 'calendar-event';
              eventItem.textContent = event.title;
              eventItem.setAttribute('data-event-id', event._id);
              eventItem.addEventListener('click', (e) => {
                e.stopPropagation();
                showEventDetails(event._id);
              });
              dayElement.appendChild(eventItem);
            });
            
            // Add event details on click
            dayElement.addEventListener('click', function() {
              showEventDetails(dayEvents, dayElement);
            });
          }
          
          calendarDays.appendChild(dayElement);
        }
        
        // Next month's days
        const totalCells = 42; // 6 rows of 7 days
        const remainingCells = totalCells - (firstDay + daysInMonth);
        for (let i = 1; i <= remainingCells; i++) {
          const dayElement = document.createElement('div');
          dayElement.className = 'calendar-day other-month';
          dayElement.textContent = i;
          calendarDays.appendChild(dayElement);
        }
      }
      
      function showEventDetails(eventId) {
        // Find the event card with this ID and scroll to it
        const eventCard = document.querySelector(`.card[data-event-id="${eventId}"]`);
        if (eventCard) {
          eventCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
          eventCard.classList.add('highlight');
          setTimeout(() => {
            eventCard.classList.remove('highlight');
          }, 2000);
        }
      }
    });
  </script>
</body>
</html>
