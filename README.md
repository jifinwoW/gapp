# 📅 Google Event Call Reminder (CodeIgniter 4)

This is a web application built using **CodeIgniter 4**, **Google Calendar API**, and **Twilio**, allowing users to authenticate with Google, access their calendar events, and receive automated phone call reminders before upcoming events.

---

## 🚀 Features

- 🔐 Google OAuth 2.0 login
- 📆 Google Calendar integration
- 📱 Twilio phone call notifications
- 🔄 Cron job to check and trigger calls for events starting in next 5 minutes
- 📞 User phone number management
- 👨‍💻 Built with CodeIgniter 4 using MVC best practices

---

## 🛠️ Technologies

- PHP 8.x
- CodeIgniter 4.6+
- Google API PHP Client
- Twilio PHP SDK
- MySQL (with migrations)
- Composer

---

## 📦 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/google-event-caller.git
cd google-event-caller
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

Copy the example environment file and fill in your credentials:

```bash
cp env .env
```

Edit `.env`:

```env
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

GOOGLE_CLIENT_ID = your-google-client-id
GOOGLE_CLIENT_SECRET = your-google-client-secret
GOOGLE_REDIRECT_URI = http://localhost:8080/auth/callback

TWILIO_SID = your-twilio-sid
TWILIO_TOKEN = your-twilio-token
TWILIO_FROM = your-twilio-verified-number
```

---

### 4. Run Migrations

```bash
php spark migrate
```

---

### 5. Serve the App

```bash
php spark serve
```

Visit: [http://localhost:8080](http://localhost:8080)

---

### 6. Run the Event Reminder Command (Cron Job)

To simulate cron manually:

```bash
php spark event:reminder
```

To automate:

Set up a cron to run this every minute/hour:

```bash
* * * * * /usr/bin/php /path-to-your-project/spark event:reminder
```

> On Windows, use Task Scheduler for this.

---

## 📂 Folder Structure

```
app/
├── Controllers/
│   ├── Auth.php
│   ├── Dashboard.php
├── Commands/
│   └── EventReminder.php
├── Models/
│   └── UserModel.php
├── Views/
│   └── dashboard.php
├── Database/
│   └── Migrations/
│       └── CreateUsersTable.php
```

---

## 🔐 Security Notes

- Tokens are securely stored
- Session-based login validation
- API credentials via `.env`

---

## 🎥 Demo

> (Add GIF or link if available)

---

## 🧑‍💻 Author

**Jifin KJ** — Machine Test for **WebCastle Media Pvt Ltd**

---

## 📄 License

MIT — use it, modify it, rule the world 🌍