# 🚀 Post & Chat Laravel Web Application

A modern full-stack social media and post-sharing web application built with Laravel, featuring guest post browsing, user authentication, social interactions (following/blocking), and media uploads via Cloudinary, deployed on Render with a Supabase PostgreSQL database.

---

## 🛠️ Tech Stack

* **Backend:** Laravel (PHP)
* **Database:** PostgreSQL (Hosted on Supabase)
* **Frontend:** Blade, Tailwind / Bootstrap, JavaScript
* **Media Storage:** Cloudinary API
* **Deployment & Hosting:** Render (Docker & Apache)

---

## ✨ Features

* **Guest & Authenticated Access:** Public post feeds for guests, with full interactive features (posting, liking, following) for authenticated users.
* **Media Uploads:** Seamless image and video uploading powered by Cloudinary.
* **Social Graph:** Follow/Unfollow system and User Blocking functionality.
* **Performance Optimized:** Eager loading (`with()`) to prevent N+1 query issues and database indexing for fast retrieval.
* **Security:** Role-based access control using Laravel Gates and Middleware.

---

## 🌐 Live Access

You can visit and test the live application directly in your browser:

> **Live Website URL:**  
> 👉 [https://post-and-chat-laravel.onrender.com](https://post-and-chat-laravel.onrender.com)

---

> [!NOTE]
> The application is hosted on Render's free tier. If the site has been inactive for a while, the initial request might take up to 50 seconds to load as the server wakes up from its cold start.
