# Frontend Draft Notifier

A lightweight WordPress plugin that displays a floating draft count on the frontend for logged-in users with specific roles. Perfect for editorial teams who want reminders of unfinished content.

## 🎯 Features

- Shows number of unpublished drafts (posts, pages, or CPTs)
- Floating button visible only on the frontend
- Configurable roles, post types, and button position
- Clean, lightweight, and easy to extend

## ⚙️ Settings

Go to **Settings → Draft Notifier** after activation:

- **Roles**: Choose which user roles see the button
- **Post Types**: Select post types to monitor for drafts
- **Position**: Choose where on screen the button appears

## 🧩 How It Works

1. The plugin checks for draft posts in selected post types.
2. If the count is greater than zero, a red button floats on the frontend.
3. Clicking it opens the admin area with a filtered draft list.

## 🛠️ Installation

1. Download or clone this repository into your `/wp-content/plugins` folder:
   ```bash
   git clone https://github.com/yourusername/frontend-draft-notifier.git
   ```
